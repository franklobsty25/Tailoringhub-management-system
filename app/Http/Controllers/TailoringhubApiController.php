<?php

namespace App\Http\Controllers;

use App\Models\Suit;
use App\Models\User;
use App\Models\Shirt;
use App\Models\Detail;
use App\Models\Support;
use App\Models\Customer;
use App\Models\KabaSlit;
use App\Mail\SupportMail;
use Illuminate\Support\Str;
use App\Models\ShortTrouser;
use Illuminate\Http\Request;
use App\Models\BlouseDressSkirt;
use App\Mail\CancelSubscriptionMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\QueryException;

class TailoringhubApiController extends Controller
{
    /**
     * Api call for tailoringhub mobile device
     *
     *  Tailor/Seamstress login
     */

     public function login(Request $request) {
        $request->validate([
            'email'=> 'required',
            'password'=> 'required',
            'deviceId'=> 'required',
        ]);

        $user = User::whereEmail($request->input('email'))->first();

        if (!$user || !Hash::check($request->input('password'), $user->password)) {

            return response()->json(['success'=> false, 'message' => 'The provided credentials are invalid']);
        }

        // Create token for authentication
        $token = $user->createToken($request->input('deviceId'));

        return response()->json(['success'=> true, 'token'=> $token->plainTextToken]);
     }


     /**
      *  Tailor/Seamstress registerAction
      */
      public function register(Request $request) {
          $request->validate([
              'firstName'=> 'required',
              'lastName'=> 'required',
              'email'=> 'required',
              'password'=> 'required',
              'deviceId'=> 'required',
          ]);

          $user = User::create([
              'firstName'=> Str::ucfirst($request->input('firstName')),
              'lastName'=> Str::ucfirst($request->input('lastName')),
              'email'=> $request->input('email'),
              'password'=> Hash::make($request->input('password')),
          ]);

          $user->role()->create(['role'=> 'Subscriber']);

          $token = $user->createToken($request->input('deviceId'));

          return response()->json(['success'=> true, 'token'=> $token->plainTextToken]);
      }


      // Create user details/profile if not exists
      public function createUserProfile(Request $request) {

            // Save user detail if not exist
            $detail = new Profile();
            $detail->image = 'images/logo.png'; // default image
            $detail->about = Str::ucfirst($request->input('about'));
            $detail->company = Str::ucfirst($request->input('company'));
            $detail->job = Str::ucfirst($request->input('job'));
            $detail->country = Str::ucfirst($request->input('country'));
            $detail->address = Str::ucfirst($request->input('address'));
            $detail->phone = $request->input('phone');
            $detail->twitter = $request->input('twitter');
            $detail->facebook = $request->input('facebook');
            $detail->instagram = $request->input('instagram');
            $detail->linkedIn = $request->input('linkedIn');

            Auth::user()->profile()->save($detail);

            return response()->json(['success'=> true]);
      }

      // Update Tailor/Seamstress profile detail
      public function updateUserProfile(Request $request) {

        if (Auth::user()->profile) {
            // Update user detail if present
            Auth::user()->profile()->update([
                'about'=> Str::ucfirst($request->input('about')),
                'company'=> Str::ucfirst($request->input('company')),
                'job'=> Str::ucfirst($request->input('job')),
                'country'=> Str::ucfirst($request->input('country')),
                'address'=> Str::ucfirst($request->input('address')),
                'phone'=> $request->input('phone'),
                'twitter'=> $request->input('twitter'),
                'facebook'=> $request->input('facebook'),
                'instagram'=> $request->input('instagram'),
                'linkedIn'=> $request->input('linkedIn'),
            ]);
        }

            return response()->json(['success'=> true]);

      }

      // create/update user profile image
      public function createProfileImage(Request $request) {
          // image upload
          if ($request->hasFile('file') && Auth::user()->profile) {
            Auth::user()->profile()->update([
                'image' => $request->file('file')->store('images'),
            ]);

            return response()->json(['success'=> true]);

        }
      }


      /**
       * Get user information
       */
      public function getUserProfile() {
          $user = Auth::user();
          $profile = Auth::user()->profile;
          $totalCustomers = Auth::user()->customers()->count();

          return response()->json([
              'success' => true,
              'user' => $user,
              'totalCustomers' => $totalCustomers,
          ]);
      }


      /**
       *  User (Tailor/Seamstress) password change
       */
      public function changeUserPassword(Request $request) {
          $request->validate([
              'currentPassword'=> 'required',
              'newPassword'=> 'required',
          ]);

          if (Auth::check()) {
            if (Hash::check(Str::of($request->input('currentPassword'))->trim(), Auth::user()->password)) {
                Auth::user()->password = Hash::make(Str::of($request->input('newPassword'))->trim());
                Auth::user()->save();

                return response()->json(['success'=> true, 'message'=> 'Password changed successfully.']);

            } else {

                return response()->json(['success'=> false, 'message'=> 'Current password does not match.']);
            }
        }
      }


      /**
       *  Fetch all customers from the database
       */
      public function getCustomers() {
          $customers = Auth::user()->customers;

          return response()->json(['customers'=> $customers]);
      }


    /**
     * Create customer profile
     */
      public function createCustomerProfile(Request $request) {
        $request->validate([
            'firstName'=> 'required',
            'lastName'=> 'required',
            'contact'=> 'required',
            'address'=> 'required',
            'collectionDate'=> 'required',
            'charge'=> 'required',
            'balance'=> 'required',
        ]);

        try {

        $customer = new Customer();
        $customer->firstName = Str::ucfirst($request->input('firstName'));
        $customer->lastName = Str::ucfirst($request->input('lastName'));
        $customer->contact = $request->input('contact');
        $customer->address = Str::ucfirst($request->input('address'));
        $customer->collectionDate = $request->input('collectionDate');
        $customer->charge = $request->input('charge');
        $customer->advance = $request->input('advance') ?? 0;
        $customer->balance = $request->input('balance') ?? 0;
        $customer->style = Str::ucfirst($request->input('style'));
        $customer->materialType = Str::ucfirst($request->input('materialType'));


        Auth::user()->customers()->save($customer);

        return response()->json(['success'=> true, 'contact'=> $customer->contact]);

        } catch (QueryException $e) {
            return response()->json(['success'=> false]);
        }
      }


      /**
     * Updating customer profile
     */
    public function updateCustomerProfile(Customer $customer, Request $request) {
        $customer->update([
            'firstName'=> Str::ucfirst($request->input('firstName')),
            'lastName'=> Str::ucfirst($request->input('lastName')),
            'contact'=> $request->input('contact'),
            'address'=> Str::ucfirst($request->input('address')),
            'collectionDate'=> $request->input('collectionDate'),
            'charge'=> $request->input('charge'),
            'advance'=> $request->input('advance'),
            'balance'=> $request->input('balance'),
            'style'=> Str::ucfirst($request->input('style')),
            'materialType'=> Str::ucfirst($request->input('materialType')),
        ]);

        return response()->json(['success'=> true]);
    }


    /**
     * Delete user customer from the system
     */
    public function deleteCustomerProfile($contact) {
        Customer::whereContact($contact)->delete();
        return response()->json(['success'=> true]);
    }

    /**
     *  Search/Filter customer for their measurements
     */
    public function getCustomerMeasurement($contact) {
        $customer = Customer::whereContact($contact)->first();

        $suit = $customer->suit;
        $shirt = $customer->shirt;
        $shortsTrouser = $customer->shortTrouser;
        $blouseDressSkirt = $customer->blouseDressSkirt;
        $kabaSlit = $customer->kabaSlit;

        return response()->json([
            'success'=> true,
            'suit'=> $suit,
            'shirt'=> $shirt,
            'shortsTrouser'=> $shortsTrouser,
            'blouseDressSkirt'=> $blouseDressSkirt,
            'kabaSlit'=> $kabaSlit,
        ]);
    }

    /**
     *  Search customer
     */
    public function searchCustomer($contact) {
        $customer = Customer::where('contact', $contact)->first();

        return response()->json(['success'=> true, 'customer'=> $customer]);
    }


    /**
     * TAILORINGHUB MEASUREMENTS INFORMATION  BEYOND
     * I.E SUIT, SHIRT (LONG/SHORT), TROUSER/SHORT, KAB&SLIT, BLOUSER/DRESS/SKIRT
     */


     /**
      * SUIT MEASUREMENT FUNCTIONS
     */

     // Saving customer suit measurements to database
     public function createSuit(Request $request) {
        $customer = Customer::whereContact($request->input('contact'))->first();

        $customer->suit()->save(new Suit([
            'half_back'=> $request->input('half_back'),
            'shoulder'=> $request->input('shoulder'),
            'elbow'=> $request->input('elbow'),
            'sleeve'=> $request->input('sleeve'),
            'chest'=> $request->input('chest'),
            'suit_length'=> $request->input('suit_length'),
        ]));

        return response()->json(['success'=> true]);
     }

     // Update customer suit measurements
     public function updateSuit(Request $request) {
         $customer = Customer::whereContact($request->input('contact'))->first();

         $suit = $customer->suit;

         $suit->update([
             'half_back'=> $request->input('half_back'),
             'shoulder'=> $request->input('shoulder'),
             'elbow'=> $request->input('elbow'),
             'sleeve'=> $request->input('sleeve'),
             'chest'=> $request->input('chest'),
             'suit_length'=> $request->input('suit_length'),
         ]);

         return response()->json(['success'=> true]);
     }


     /**
      * SHIRT [LONG/SHORT] MEASUREMENT FUNCTIONS
      */

      // Save shirt to database
      public function createShirt(Request $request) {
          $customer = Customer::whereContact($request->input('contact'))->first();

          $customer->shirt()->save(
              new Shirt([
                'length' => $request->input('length'),
                'chest' => $request->input('chest'),
                'back' => $request->input('back'),
                'sleeve' => $request->input('sleeve'),
                'around_arm' => $request->input('around_arm'),
                'cuff' => $request->input('cuff'),
                'collar' => $request->input('collar'),
                'across_chest' => $request->input('across_chest'),
              ])
          );

          return response()->json(['success'=> true]);
      }

      // Update shirt
      public function updateShirt(Request $request) {
          $customer = Customer::whereContact($request->input('contact'))->first();

          $shirt = $customer->shirt;

          $shirt->update([
              'length' => $request->input('length'),
              'chest' => $request->input('chest'),
              'back' => $request->input('back'),
              'sleeve' => $request->input('sleeve'),
              'around_arm' => $request->input('around_arm'),
              'cuff' => $request->input('cuff'),
              'collar' => $request->input('collar'),
              'across_chest' => $request->input('across_chest'),
          ]);

          return response()->json(['success'=> true]);
      }


      /**
      * TROUSER/SHORTS MEASUREMENT FUNCTIONS
      */

      // Save shorts/trouser measurements
      public function createShortsTrouser(Request $request) {
          $customer = Customer::whereContact($request->input('contact'))->first();

          $customer->shortTrouser()->save(
              new ShortTrouser([
                'waist' => $request->input('waist'),
                'length' => $request->input('length'),
                'thighs' => $request->input('thighs'),
                'bass_bottom' => $request->input('bass_bottom'),
                'seat' => $request->input('seat'),
                'knee' => $request->input('knee'),
                'flap_fly' => $request->input('flap_fly'),
                'hip' => $request->input('hip'),
                'waist_knee' => $request->input('waist_knee'),
              ])
          );

          return response()->json(['success'=> true]);
      }


      // Update shorts/trouser measurements
      public function updateShortsTrouser(Request $request) {
        $customer = Customer::whereContact($request->input('contact'))->first();

        $shortsTrouser = $customer->shortTrouser;

        $shortsTrouser->update([
            'waist' => $request->input('waist'),
            'length' => $request->input('length'),
            'thighs' => $request->input('thighs'),
            'bass_bottom' => $request->input('bass_bottom'),
            'seat' => $request->input('seat'),
            'knee' => $request->input('knee'),
            'flap_fly' => $request->input('flap_fly'),
            'hip' => $request->input('hip'),
            'waist_knee' => $request->input('waist_knee'),
        ]);

        return response()->json(['success'=> true]);
      }


      /**
      * BLOUSER/DRESS/SKIRT MEASUREMENT FUNCTIONS
      */

      // Save Blouser/Dress/Skirt measurements
      public function createBlouseDressSkirt(Request $request) {
          $customer = Customer::whereContact($request->input('contact'))->first();

          $customer->blouseDressSkirt()->save(
              new BlouseDressSkirt([
                  'bust' => $request->input('bust'),
                  'waist' => $request->input('waist'),
                  'hip' => $request->input('hip'),
                  'shoulder' => $request->input('shoulder'),
                  'shoulder_nipple' => $request->input('shoulder_nipple'),
                  'nipple_nipple' => $request->input('nipple_nipple'),
                  'nape_waist' => $request->input('nape_waist'),
                  'shoulder_waist' => $request->input('shoulder_waist'),
                  'shoulder_hip' => $request->input('shoulder_hip'),
                  'across_chest' => $request->input('across_chest'),
                  'dress_length' => $request->input('dress_length'),
                  'sleeve_length' => $request->input('sleeve_length'),
                  'around_arm' => $request->input('around_arm'),
                  'across_back' => $request->input('across_back'),
                  'skirt_length' => $request->input('skirt_length'),
              ])
          );

          return response()->json(['success'=> true]);
      }

      // Update Blouser/Dress/Skirt measurements
      public function updateBlouseDressSkirt(Request $request) {
          $customer = Customer::whereContact($request->input('contact'))->first();

          $blouseDressSkirt = $customer->blouseDressSkirt;

          $blouseDressSkirt->update([
            'bust' => $request->input('bust'),
            'waist' => $request->input('waist'),
            'hip' => $request->input('hip'),
            'shoulder' => $request->input('shoulder'),
            'shoulder_nipple' => $request->input('shoulder_nipple'),
            'nipple_nipple' => $request->input('nipple_nipple'),
            'nape_waist' => $request->input('nape_waist'),
            'shoulder_waist' => $request->input('shoulder_waist'),
            'shoulder_hip' => $request->input('shoulder_hip'),
            'across_chest' => $request->input('across_chest'),
            'dress_length' => $request->input('dress_length'),
            'sleeve_length' => $request->input('sleeve_length'),
            'around_arm' => $request->input('around_arm'),
            'across_back' => $request->input('across_back'),
            'skirt_length' => $request->input('skirt_length'),
          ]);

          return response()->json(['success'=> true]);
      }


      /**
      * KABA & SLIT MEASUREMENT FUNCTIONS
      */

      // Save kaba & slit measurements
      public function createKabaSlit(Request $request) {
        $customer = Customer::whereContact($request->input('contact'))->first();

        $customer->kabaSlit()->save(
            new KabaSlit([
                'bust' => $request->input('bust'),
                'waist' => $request->input('waist'),
                'hip' => $request->input('hip'),
                'shoulder' => $request->input('shoulder'),
                'shoulder_nipple' => $request->input('shoulder_nipple'),
                'nipple_nipple' => $request->input('nipple_nipple'),
                'nape_waist' => $request->input('nape_waist'),
                'shoulder_waist' => $request->input('shoulder_waist'),
                'shoulder_hip' => $request->input('shoulder_hip'),
                'across_chest' => $request->input('across_chest'),
                'kaba_length' => $request->input('kaba_length'),
                'sleeve_length' => $request->input('sleeve_length'),
                'around_arm' => $request->input('around_arm'),
                'across_back' => $request->input('across_back'),
                'slit_length' => $request->input('slit_length'),
            ])
        );

        return response()->json(['success'=> true]);
      }

      // Update kaba & slit measurements
      public function updateKabaSlit(Request $request) {
        $customer = Customer::whereContact($request->input('contact'))->first();

        $kabaSlit = $customer->kabaSlit;

        $kabaSlit->update([
          'bust' => $request->input('bust'),
          'waist' => $request->input('waist'),
          'hip' => $request->input('hip'),
          'shoulder' => $request->input('shoulder'),
          'shoulder_nipple' => $request->input('shoulder_nipple'),
          'nipple_nipple' => $request->input('nipple_nipple'),
          'nape_waist' => $request->input('nape_waist'),
          'shoulder_waist' => $request->input('shoulder_waist'),
          'shoulder_hip' => $request->input('shoulder_hip'),
          'across_chest' => $request->input('across_chest'),
          'kaba_length' => $request->input('kaba_length'),
          'sleeve_length' => $request->input('sleeve_length'),
          'around_arm' => $request->input('around_arm'),
          'across_back' => $request->input('across_back'),
          'slit_length' => $request->input('slit_length'),
        ]);

        return response()->json(['success'=> true]);
      }


      /**
       *  SEND SUPPORT/SUGGESTION MAIL
       */
      public function sendMail(Request $request) {
          $request->validate([
              'subject' => 'required',
              'message' => 'required',
          ]);

          $support = new Support([
            'subject' => Str::ucfirst($request->input('subject')),
            'message' => $request->input('message'),
        ]);

        Auth::user()->support()->save($support);

        Mail::to('colonkodedenterprise@gmail.com')
            ->send(new SupportMail($support));

        return response()->json(['success'=> true]);
      }


      /**
       * Send SMS
       */
      public function sendCustomerSMS(Request $request) {
        $to = $request->input('contact');
        $msg = $request->input('message');

        $response = Http::get('https://apps.mnotify.net/smsapi?key=' . env('SMS_API_KEY') . '&to=' . $to . '&msg=' . $msg . '&sender_id=Tailorinhub');

        return $response;
      }


      /**
       *  SMS subscription
       */
      // Transaction initialization
      public function initialiseSubscription(Request $request) {
        $response = Http::acceptJson()
                            ->withToken(env('PAYSTACK_SECRET_KEY'))
                            ->post('https://api.paystack.co/transaction/initialize', [
                                'first_name' => Auth::user()->firstName,
                                'last_name' => Auth::user()->lastName,
                                'email' => Auth::user()->email,
                                'amount' => $request->input('amount') * 100,
                                'currency' => 'GHS',
                                'plan' => env('PAYSTACK_PLAN'),
                            ]);

        return $response;
      }


      /**
       *  Subscription payment verification
       */
      public function verifySubscription($reference) {

        $response = Http::acceptJson()
                        ->withToken(env('PAYSTACK_SECRET_KEY'))
                        ->get("https://api.paystack.co/transaction/verify/" . $reference);

        $result = json_decode($response, true);

        Auth::user()->update([
            'subscription_refrence' => $result['data']['reference'],
        ]);

        return $response;
      }


      /**
     *  Subscriber cancellation email
     */
    public function cancelSubscription() {
        Mail::to('colonkodedenterprise@gmail.com')
            ->send(new CancelSubscriptionMail(Auth::user()));

        return response()->json(['success'=> true]);
    }


      /**
       *  LOGOUT
       */
      public function logout() {
          Auth::user()->tokens()->delete();

          return response()->json(['success'=> true]);
      }


}
