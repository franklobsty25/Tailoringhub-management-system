<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Unicodeveloper\Paystack\Facades\Paystack;

class PaymentController extends Controller
{
    /**
     * Subscription page
     */
    public function subscriptionPage($customer) {

        // Verify subscription before sending sms message
        $reference = Auth::user()->subscription_reference;

        $response = Http::acceptJson()
                        ->withToken(env('PAYSTACK_SECRET_KEY'))
                        ->get("https://api.paystack.co/transaction/verify/" . $reference);
        $result = json_decode($response, true);

        if ($result['status']) {
            return redirect()->route('create.message', $customer);
        }

        return view('messages.subscription', ['user' => Auth::user()]);

    }

    /**
     * Obtain Paystack payment verify information
     * @return void
     */
    public function verifySubscription($reference)
    {
        $response = Http::acceptJson()
                        ->withToken(env('PAYSTACK_SECRET_KEY'))
                        ->get("https://api.paystack.co/transaction/verify/" . $reference);

        $result = json_decode($response, true);

        Auth::user()->update([
            'subscription_reference' => $result['data']['reference'],
        ]);

        return $response;

    }

}
