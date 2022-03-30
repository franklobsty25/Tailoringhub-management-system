<?php

namespace App\Http\Controllers;

use App\Models\KabaSlit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class KabaSlitController extends Controller
{
    /**
     * Displaying kaba & slit form page
     */
    public function kabaSlitPage() {
        if (request()->session()->has('customer')) {
            $customer = request()->session()->get('customer');
        }
        return view('components.measurements.kaba_slit.create', ['customer'=> $customer]);
    }

    /**
     * Persisting kaba & slit measurement to database
     */
    public function createKabaSlit(Request $request) {
        if ($request->session()->has('customer')) {
            $customer = $request->session()->get('customer');
        }
        $kabaSlit = new KabaSlit();
        $kabaSlit->bust = $request->bust ?? 0;
        $kabaSlit->waist = $request->waist ?? 0;
        $kabaSlit->shoulder = $request->shoulder ?? 0;
        $kabaSlit->shoulder_nipple = $request->shoulder_nipple ?? 0;
        $kabaSlit->nipple_nipple = $request->nipple_nipple ?? 0;
        $kabaSlit->nape_waist = $request->nape_waist ?? 0;
        $kabaSlit->shoulder_waist = $request->shoulder_waist ?? 0;
        $kabaSlit->shoulder_hip = $request->shoulder_hip ?? 0;
        $kabaSlit->across_chest = $request->across_chest ?? 0;
        $kabaSlit->kaba_length = $request->kaba_length ?? 0;
        $kabaSlit->sleeve_length = $request->sleeve_length ?? 0;
        $kabaSlit->around_arm = $request->around_arm ?? 0;
        $kabaSlit->across_back = $request->across_back ?? 0;
        $kabaSlit->slit_length = $request->slit_length ?? 0;

        $customer->kabaSlit()->save($kabaSlit);

        Session::flash('success', $customer->fullName . ' kaba & slit measurement saved successfully.');

        return back();
    }

    /**
     * Displaying edit kaba & slit measurement form page
     */
    public function editKabaSlit() {
        if (request()->session()->has('customer')) {
            $customer = request()->session()->get('customer');
        }
        $kabaSlit = $customer->kabaSlit;
        return view('components.measurements.kaba_slit.edit', ['customer'=> $customer, 'kabaSlit'=> $kabaSlit]);
    }

    /**
     * Updating kabe & slit measurement, persisting to database
     */
    public function updateKabaSlit(Request $request) {
        if ($request->session()->has('customer')) {
            $customer = $request->session()->get('customer');
        }
        $kabaSlit = $customer->kabaSlit;
        $kabaSlit->update([
            'bust'=> $request->bust,
            'waist'=> $request->waist,
            'hip'=> $request->hip,
            'shoulder'=> $request->shoulder,
            'shoulder_nipple'=> $request->shoulder_nipple,
            'nipple_nipple'=> $request->nipple_nipple,
            'nape_waist'=> $request->nape_waist,
            'shoulder_waist'=> $request->shoulder_waist,
            'shoulder_hip'=> $request->shoulder_hip,
            'across_chest'=> $request->across_chest,
            'kaba_length'=> $request->kaba_length,
            'sleeve_length'=> $request->sleeve_length,
            'around_arm'=> $request->around_arm,
            'across_back'=> $request->across_back,
            'slit_length'=> $request->slit_length,
        ]);

        Session::flash('success', $customer->fullName . ' kabe & slit measurement updated successfully.');

        return back();
    }
}
