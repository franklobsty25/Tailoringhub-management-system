<?php

namespace App\Http\Controllers;

use App\Models\Suit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SuitController extends Controller
{
    /**
     * Displaying suit form page
     */
    public function suitPage() {
        if (request()->session()->has('customer')) {
            $customer = request()->session()->get('customer');
        }

        return view('components.measurements.suit.create', ['customer'=> $customer]);
    }

    /**
     * Saving suit measurement to database
     */
    public function createSuit(Request $request) {
        if (request()->session()->has('customer')) {
            $customer = request()->session()->get('customer');
        }
        $suit = new Suit();
        $suit->half_back = $request->half_back ?? 0;
        $suit->shoulder = $request->shoulder ?? 0;
        $suit->elbow = $request->elbow ?? 0;
        $suit->sleeve = $request->sleeve ?? 0;
        $suit->chest = $request->chest ?? 0;
        $suit->suit_length = $request->suit_length ?? 0;

        $customer->suit()->save($suit);

        Session::flash('success', $customer->fullName . " suit measurement saved successfully.");

        return back();
    }

    /**
     * Display suit form page for view or editing
     */
    public function editSuitPage() {
        $customer = request()->session()->get('customer');
        $suit = $customer->suit;

        return view('components.measurements.suit.edit', ['customer'=> $customer, 'suit'=> $suit]);
    }

    /**
     * Update customer suit measurement
     */
    public function updateSuit(Request $request) {
        $customer = request()->session()->get('customer');
        $suit = $customer->suit;
        $suit->update([
            'half_back'=> $request->half_back,
            'shoulder'=> $request->shoulder,
            'elbow'=> $request->elbow,
            'sleeve'=> $request->sleeve,
            'chest'=> $request->chest,
            'suit_length'=> $request->suit_length,
        ]);

        Session::flash('success', $customer->fullName . ' suit measurement updated successfully.');

        return back();
    }
}
