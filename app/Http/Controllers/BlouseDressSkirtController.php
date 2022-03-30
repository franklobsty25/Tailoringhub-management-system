<?php

namespace App\Http\Controllers;

use App\Models\BlouseDressSkirt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BlouseDressSkirtController extends Controller
{
    /**
     * Displaying blouse/dress/skirt form page
     */
    public function blouseDressSkirtPage() {
        if (request()->session()->has('customer')) {
            $customer = request()->session()->get('customer');
        }
        return view('components.measurements.dress_skirt_blouse.create', ['customer'=> $customer]);
    }

    /**
     * Saving blouse/dress/skirt measurement to database
     */
    public function createBlouseDressSkirt(Request $request) {
        if ($request->session()->has('customer')) {
            $customer = $request->session()->get('customer');
        }
        $blouseDressSkirt = new BlouseDressSkirt();
        $blouseDressSkirt->bust = $request->bust ?? 0;
        $blouseDressSkirt->waist = $request->waist ?? 0;
        $blouseDressSkirt->shoulder = $request->shoulder ?? 0;
        $blouseDressSkirt->shoulder_nipple = $request->shoulder_nipple ?? 0;
        $blouseDressSkirt->nipple_nipple = $request->nipple_nipple ?? 0;
        $blouseDressSkirt->nape_waist = $request->nape_waist ?? 0;
        $blouseDressSkirt->shoulder_waist = $request->shoulder_waist ?? 0;
        $blouseDressSkirt->shoulder_hip = $request->shoulder_hip ?? 0;
        $blouseDressSkirt->across_chest = $request->across_chest ?? 0;
        $blouseDressSkirt->dress_length = $request->dress_length ?? 0;
        $blouseDressSkirt->sleeve_length = $request->sleeve_length ?? 0;
        $blouseDressSkirt->around_arm = $request->around_arm ?? 0;
        $blouseDressSkirt->across_back = $request->across_back ?? 0;
        $blouseDressSkirt->skirt_length = $request->skirt_length ?? 0;

        $customer->blouseDressSkirt()->save($blouseDressSkirt);

        Session::flash('success', $customer->fullName . ' blouse or dress or skirt measurement saved successfully.');

        return back();
    }

    /**
     * Displaying edit blouse/dress/skirt measurement form page
     */
    public function editBlouseDressSkirt() {
        if (request()->session()->has('customer')) {
            $customer = request()->session()->get('customer');
        }
        $blouseDressSkirt = $customer->blouseDressSkirt;
        return view('components.measurements.dress_skirt_blouse.edit',['customer'=> $customer, 'blouseDressSkirt'=> $blouseDressSkirt]);
    }

    /**
     * Update blouse/dress/skirt measurement in database
     */
    public function updateBlouseDressSkirt(Request $request) {
        if ($request->session()->has('customer')) {
            $customer = $request->session()->get('customer');
        }
        $blouseDressSkirt = $customer->blouseDressSkirt;
        $blouseDressSkirt->update([
            'bust'=> $request->bust,
            'waist'=> $request->waist,
            'hip'=> $request->hip,
            'shoulder' => $request->shoulder,
            'shoulder_nipple'=> $request->shoulder_nipple,
            'nipple_nipple'=> $request->nipple_nipple,
            'nape_waist'=> $request->nape_waist,
            'shoulder_waist'=> $request->shoulder_waist,
            'shoulder_hip'=> $request->shoulder_hip,
            'across_chest'=> $request->across_chest,
            'dress_length'=> $request->dress_length,
            'sleeve_length'=> $request->sleeve_length,
            'around_arm'=> $request->around_arm,
            'across_back'=> $request->across_back,
            'skirt_length'=> $request->skirt_length,
        ]);

        Session::flash('success', $customer->fullName . ' blouse or dress or skirt measurement updated successfully.');

        return back();
    }
}
