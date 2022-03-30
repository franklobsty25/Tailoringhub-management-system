<?php

namespace App\Http\Controllers;

use App\Models\Suit;
use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{
    /**
     * Displaying customer page form
     */
    public function customerPage() {
        return view('components.measurements.customers.create');
    }

    /**
     * Displaying search page form
     */
    public function searchPage() {
        $customers = Auth::user()->customers()->orderBy('firstName', 'asc')->get();

        return view('components.measurements.customers.search', ['customers'=> $customers]);
    }

    /**
     * Displaying customer measurement selection page & passing selected customer for measurement addition
     */
    public function customerSelectionPage(Customer $customer) {
        // Set session
        request()->session()->put('customer', $customer);

        return view('components.measurements.choose', ['customer'=> $customer]);
    }

    /**
     * Display selected customer profile
     */
    public function showCustomer(Customer $customer) {
        return view('components.measurements.customers.edit', ['customer'=> $customer]);
    }

    /**
     * Creating customer to persist to database
     */
    public function createCustomer(Request $request) {
        $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'contact' => 'required|min:10|max:10',
            'address' => 'required',
            'collectionDate' => 'required',
            'charge' => 'required',
        ]);

        try {

        $customer = new Customer();
        $customer->firstName = Str::ucfirst($request->firstName);
        $customer->lastName = Str::ucfirst($request->lastName);
        $customer->contact = $request->contact;
        $customer->address = Str::ucfirst($request->address);
        $customer->collectionDate = $request->collectionDate;
        $customer->charge = $request->charge;
        $customer->advance = $request->advance ?? 0;
        $customer->balance = $request->balance ?? 0;
        $customer->style = Str::ucfirst($request->style);
        $customer->materialType = Str::ucfirst($request->materialType);

        Auth::user()->customers()->save($customer);

        $request->session()->put('customer', $customer);

        return redirect()->route('customer.selection', $customer);

        } catch (QueryException $e) {
            Session::flash('error', 'Sorry! customer with that contact already exist.');
            return back();
        }
    }

    /**
     * Updating customer profile
     */
    public function updateCustomer(Customer $customer, Request $request) {
        $customer->update([
            'firstName'=> Str::ucfirst($request->firstName),
            'lastName'=> Str::ucfirst($request->lastName),
            'contact'=> $request->contact,
            'address'=> Str::ucfirst($request->address),
            'collectionDate'=> $request->collectionDate,
            'charge'=> $request->charge,
            'advance'=> $request->advance,
            'balance'=> $request->balance,
            'style'=> Str::ucfirst($request->style),
            'materialType'=> Str::ucfirst($request->materialType),
        ]);

        Session::flash('success', $customer->firstName . ' ' . $customer->lastName . ' profile updated successfully.');

        return back();
    }

    /**
     * Delete user customer from the system
     */
    public function deleteCustomer(Customer $customer) {
        $customer->delete();
        return back();
    }

    /**
     *  Create sms message
     */
    public function createSMSMessage($customer) {
        $customer = Auth::user()->customers()->find($customer);

        return view('messages.message', ['customer'=> $customer]);

    }

    /**
     *  Send sms message to customer for pick up
     */
    public function sendSMSMessage(Request $request) {
        $request->validate([
            'message'=> 'required',
        ]);
        $to = strval($request->contact);
        $msg = urlencode($request->message);

        $response = Http::get('https://apps.mnotify.net/smsapi?key=' . env('SMS_API_KEY') . '&to=' . $to . '&msg=' . $msg . '&sender_id=Tailorinhub');

        $res = json_decode($response, true);

        if ($res['code'] == 1000) {
            Session::flash('success', 'Message submitted successful.');
        } else {
            Session::flash('error', 'Sending message failed.');
        }

        return back();
    }
}
