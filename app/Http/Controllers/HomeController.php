<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Customers count/total
        $totalCustomers = Auth::user()->customers()->get()->count();
        // Customers array for the table
        $customers = Auth::user()->customers()->orderBy('firstName', 'asc')->get();
        // Percentage of today customers added
        $increase = $this->calculateTodayCustomersIncrease();
        // Customers who have collection date today
        $todayCustomers = Auth::user()->customers()->where('collectionDate', date_format(now(), 'Y-m-d'))->orderBy('firstName', 'asc')->get();
        // Total customers who have collection date today
        $totalCustomersWithCollectionDatetoday = Auth::user()->customers()->whereDate('collectionDate', date_format(now(), 'Y-m-d'))->get()->count();
        // Customers whose collection date is tomorrow
        $totalCustomersWithCollectionDatetomorrow = $this->calculateCustomersWithCollectionDateTomorrow();

        return view('components.users.dashboard', [
            'totalCustomers'=> $totalCustomers,
            'customers'=> $customers,
            'increase'=> $increase,
            'todayCustomers'=> $todayCustomers,
            'totalCustomersWithCollectionDatetoday'=> $totalCustomersWithCollectionDatetoday,
            'totalCustomersWithCollectionDatetomorrow'=> $totalCustomersWithCollectionDatetomorrow,
        ]);
    }

    /**
     * Passing user detail to profile page
     */
    public function profilePage() {
        $profiles = Profile::all();
        return view('components.users.profile', ['details'=> $profiles]);
    }

    /**
     * Store user detail to database
     */
    public function storeProfile(Request $request) {
        // Check if file exists
        if ($request->hasFile('image') && Auth::user()->profile) {
            Auth::user()->profile()->update([
                'image' => $request->file('image')->store('images'),
            ]);

        }

        if (Auth::user()->profile) {
            // Update user detail if present
            Auth::user()->profile()->update([
                'about'=> Str::ucfirst($request->about),
                'company'=> Str::ucfirst($request->company),
                'job'=> Str::ucfirst($request->job),
                'country'=> Str::ucfirst($request->country),
                'address'=> Str::ucfirst($request->address),
                'phone'=> $request->phone,
                'twitter'=> $request->twitter,
                'facebook'=> $request->facebook,
                'instagram'=> $request->instagram,
                'linkedIn'=> $request->linkedIn,
            ]);

            Session::flash('update-message', 'Profile information updated successfully');

            return back();
        } else {
            // Save user detail if not exist
            $detail = new Profile();
            $detail->image = $request->file('image')->store('images') ?? 'assets/img/logo.png';
            $detail->about = Str::ucfirst($request->about);
            $detail->company = Str::ucfirst($request->company);
            $detail->job = Str::ucfirst($request->job);
            $detail->country = Str::ucfirst($request->country);
            $detail->address = Str::ucfirst($request->address);
            $detail->phone = $request->phone;
            $detail->twitter = $request->twitter;
            $detail->facebook = $request->facebook;
            $detail->instagram = $request->instagram;
            $detail->linkedIn = $request->linkedIn;

            Auth::user()->profile()->save($detail);

            Session::flash('update-message', 'Profile information updated successfully');

            return back();
        }

    }

    public function updatePassword(Request $request) {
        $request->validate([
            'current_password'=> 'required',
            'new_password'=> 'required|confirmed|min:8',
        ]);

        if (Auth::check()) {
            if (Hash::check(Str::of($request->current_password)->trim(), Auth::user()->password)) {
                Auth::user()->password = Hash::make(Str::of($request->new_password)->trim());
                Auth::user()->save();

                Session::flash('update-password', 'Password changed successfully.');
                return back();

            } else {
                Session::flash('mismatch', 'Current password does not match');
                return back();
            }
        }
    }

    public function search(Request $request) {
        $customers = Customer::where('firstName', Str::ucfirst($request->search))->orWhere('lastName', Str::ucfirst($request->search))->orWhere('contact', Str::ucfirst($request->search))->orderBy('firstName', 'asc')->get();

        return view('components.measurements.customers.search', ['customers'=> $customers]);

    }

    /**
     *  FILTERATION ON CUSTOMERS TABLE
     */

    // Filtering today customers
    public function filterTodayCustomers() {
        $customers = Auth::user()->customers()->whereDate('created_at', date_format(now(), 'Y-m-d'))->orderBy('firstName', 'asc')->get();
        // Customers count/total
        $totalCustomers = Auth::user()->customers()->get()->count();
        // Percentage of today customers added
        $increase = $this->calculateTodayCustomersIncrease();
        // Customers who have collection date today
        $todayCustomers = Auth::user()->customers()->where('collectionDate', date_format(now(), 'Y-m-d'))->orderBy('firstName', 'asc')->get();
        // Total customers who have collection date today
        $totalCustomersWithCollectionDatetoday = Auth::user()->customers()->whereDate('collectionDate', date_format(now(), 'Y-m-d'))->get()->count();
        // Total customers whose collection date is tomorrow
        $totalCustomersWithCollectionDatetomorrow = $this->calculateCustomersWithCollectionDateTomorrow();

        return view('components.users.dashboard', [
            'totalCustomers'=> $totalCustomers,
            'customers'=> $customers,
            'increase'=> $increase,
            'todayCustomers'=> $todayCustomers,
            'totalCustomersWithCollectionDatetoday'=> $totalCustomersWithCollectionDatetoday,
            'totalCustomersWithCollectionDatetomorrow'=> $totalCustomersWithCollectionDatetomorrow,
        ]);
    }

    // Filtering current month of customers
    public function filterMonthOfCustomers() {
        $customers = Auth::user()->customers()->whereMonth('created_at', date('m'))->orderBy('firstName', 'asc')->get();
        // Customers count/total
        $totalCustomers = Auth::user()->customers()->get()->count();
        // Percentage of today customers added
        $increase = $this->calculateTodayCustomersIncrease();
        // Customers who have collection date today
        $todayCustomers = Auth::user()->customers()->where('collectionDate', date_format(now(), 'Y-m-d'))->orderBy('firstName', 'asc')->get();
        // Total customers who have collection date today
        $totalCustomersWithCollectionDatetoday = Auth::user()->customers()->whereDate('collectionDate', date_format(now(), 'Y-m-d'))->get()->count();
        // Total customers whose collection date is tomorrow
        $totalCustomersWithCollectionDatetomorrow = $this->calculateCustomersWithCollectionDateTomorrow();

        return view('components.users.dashboard', [
            'totalCustomers'=> $totalCustomers,
            'customers'=> $customers,
            'increase'=> $increase,
            'todayCustomers'=> $todayCustomers,
            'totalCustomersWithCollectionDatetoday'=> $totalCustomersWithCollectionDatetoday,
            'totalCustomersWithCollectionDatetomorrow'=> $totalCustomersWithCollectionDatetomorrow,
        ]);
    }

    // Filtering current year of customers
    public function filterYearOfCustomers() {
        $customers = Auth::user()->customers()->whereYear('created_at', date('Y'))->orderBy('firstName', 'asc')->get();
        // Customers count/total
        $totalCustomers = Auth::user()->customers()->get()->count();
        // Percentage of today customers added
        $increase = $this->calculateTodayCustomersIncrease();
        // Customers who have collection date today
        $todayCustomers = Auth::user()->customers()->where('collectionDate', date_format(now(), 'Y-m-d'))->orderBy('firstName', 'asc')->get();
        // Total customers who have collection date today
        $totalCustomersWithCollectionDatetoday = Auth::user()->customers()->whereDate('collectionDate', date_format(now(), 'Y-m-d'))->get()->count();
        // Total customers whose collection date is tomorrow
        $totalCustomersWithCollectionDatetomorrow = $this->calculateCustomersWithCollectionDateTomorrow();

        return view('components.users.dashboard', [
            'totalCustomers'=> $totalCustomers,
            'customers'=> $customers,
            'increase'=> $increase,
            'todayCustomers'=> $todayCustomers,
            'totalCustomersWithCollectionDatetoday'=> $totalCustomersWithCollectionDatetoday,
            'totalCustomersWithCollectionDatetomorrow'=> $totalCustomersWithCollectionDatetomorrow,
        ]);
    }

    // Calculating the percentage increase of customers added today
    private function calculateTodayCustomersIncrease() {
        $totalCustomers = Auth::user()->customers()->get()->count();
        $todayCustomers = Customer::whereDate('created_at', date_format(now(), 'Y-m-d'))->get()->count();

        if ($totalCustomers > 0) {
            return ($todayCustomers / $totalCustomers) * 100;
        }

        return 0;
    }

    // Getting customers who have delivery date tomorrow
    private function calculateCustomersWithCollectionDateTomorrow() {
        $tomorrowDate = date_add(now(), date_interval_create_from_date_string('1 day'));
        $totalCustomersTomorrow = Auth::user()->customers()->whereDate('collectionDate', '=', date_format($tomorrowDate, 'Y-m-d'))->get()->count();
        return $totalCustomersTomorrow;
    }

}
