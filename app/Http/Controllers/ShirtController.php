<?php

namespace App\Http\Controllers;

use App\Models\Shirt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ShirtController extends Controller
{
    /**
     * Displaying shirt measurement form page
     */
    public function shirtPage() {
        if (request()->session()->has('customer')) {
            $customer = request()->session()->get('customer');
        }
        return view('components.measurements.shirt.create', ['customer'=> $customer]);
    }

    /**
     * Save shirt measurement to database
     */
    public function createShirt(Request $request) {
        if ($request->session()->has('customer')) {
            $customer = $request->session()->get('customer');
        }
        $shirt = new Shirt();
        $shirt->length = $request->length ?? 0;
        $shirt->chest = $request->chest ?? 0;
        $shirt->back = $request->back ?? 0;
        $shirt->sleeve = $request->sleeve ?? 0;
        $shirt->around_arm = $request->around_arm ?? 0;
        $shirt->cuff = $request->cuff ?? 0;
        $shirt->collar = $request->collar ?? 0;
        $shirt->across_chest = $request->across_chest ?? 0;

        $customer->shirt()->save($shirt);

        Session::flash('success', $customer->fullName . ' shirt measurement saved successfully.');

        return back();
    }

    /**
     * Displaying edit shirt measurement form page
     */
    public function editShirtPage() {
        if (request()->session()->has('customer')) {
            $customer = request()->session()->get('customer');
        }
        $shirt = $customer->shirt;

        return view('components.measurements.shirt.edit', ['customer'=> $customer, 'shirt'=> $shirt]);
    }

    /**
     * Update shirt measurement of a customer
     */
    public function updateShirt(Request $request) {
        $customer = $request->session()->get('customer');
        $shirt = $customer->shirt;
        $shirt->update([
            'length'=> $request->length,
            'chest'=> $request->chest,
            'back'=> $request->back,
            'sleeve'=> $request->sleeve,
            'around_arm'=> $request->around_arm,
            'cuff'=> $request->cuff,
            'collar'=> $request->collar,
            'across_chest'=> $request->across_chest,
        ]);

        Session::flash('success', $customer->fullName . ' shirt measurement updated successfully.');

        return back();
    }
}
