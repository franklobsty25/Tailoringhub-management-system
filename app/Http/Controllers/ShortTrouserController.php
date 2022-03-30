<?php

namespace App\Http\Controllers;

use App\Models\ShortTrouser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ShortTrouserController extends Controller
{
    /**
     * Displaying trouser/shorts measurement form page
     */
    public function shortTrouserPage() {
        if (request()->session()->has('customer')) {
            $customer = request()->session()->get('customer');
        }
        return view('components.measurements.trouser_shorts.create', ['customer'=> $customer]);
    }

    /**
     * Saving short/trouser measurement to database
     */
    public function createShortTrouser(Request $request) {
            if ($request->session()->has('customer')) {
                $customer = $request->session()->get('customer');
            }
            $shortTrouser = new ShortTrouser();
            $shortTrouser->waist = $request->waist ?? 0;
            $shortTrouser->length = $request->length ?? 0;
            $shortTrouser->thighs = $request->thighs ?? 0;
            $shortTrouser->bass_bottom = $request->bass_bottom ?? 0;
            $shortTrouser->seat = $request->seat ?? 0;
            $shortTrouser->knee = $request->knee ?? 0;
            $shortTrouser->flap_fly = $request->flap_fly ?? 0;
            $shortTrouser->hip = $request->hip ?? 0;
            $shortTrouser->waist_knee = $request->waist_knee ?? 0;

            $customer->shortTrouser()->save($shortTrouser);

            Session::flash('success', $customer->fullName . ' shorts or trouser measurement saved successfully.');

        return back();
    }

    /**
     * Displaying edit short/trouser form page for editing
     */
    public function editShortTrouserPage() {
        if (request()->session()->has('customer')) {
            $customer = request()->session()->get('customer');
        }
        $shortTrouser = $customer->shortTrouser;
        return view('components.measurements.trouser_shorts.edit', ['customer'=> $customer, 'shortTrouser'=> $shortTrouser]);
    }

    /**
     * Updating short/trouser measurement in database
     */
    public function updateShortTrouser(Request $request) {
        if (request()->session()->has('customer')) {
            $customer = request()->session()->get('customer');
        }
        $shortTrouser = $customer->shortTrouser;
        $shortTrouser->update([
            'waist'=> $request->waist,
            'length'=> $request->length,
            'thighs'=> $request->thighs,
            'bass_bottom' => $request->bass_bottom,
            'seat'=> $request->seat,
            'knee'=> $request->knee,
            'flap_fly'=> $request->flap_fly,
            'hip'=> $request->hip,
            'waist_knee'=> $request->waist_knee,
        ]);

        Session::flash('success', $customer->fullName . ' shorts or trouser measurement updated successfully.');

        return back();
    }
}
