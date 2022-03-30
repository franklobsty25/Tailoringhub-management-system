<?php

namespace App\Http\Controllers;

use App\Models\Support;
use App\Mail\SupportMail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\CancelSubscriptionMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class MailController extends Controller
{
    // Display form to send support email
    public function supportPage() {
        return view('mails.support');
    }


    // Send support email
    public function sendSupport(Request $request) {
        $request->validate([
            'subject' => 'required',
            'message' => 'required',
        ]);

        $support = new Support([
            'subject' => Str::ucfirst($request->subject),
            'message' => $request->message,
        ]);

        Auth::user()->support()->save($support);

        Mail::to('colonkodedenterprise@gmail.com')
            ->cc('support@colonkoded.com')
            ->send(new SupportMail($support));

        Session::flash('success', 'Message sent');

        return back();
    }


    /**
     *  Subscriber cancellation email
     */
    public function cancelSubscription() {
        Mail::to('colonkodedenterprise@gmail.com')
            ->send(new CancelSubscriptionMail(Auth::user()));

        return back();
    }

}
