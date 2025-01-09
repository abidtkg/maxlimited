<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Customform;
use Illuminate\Http\Request;
use App\Models\Ftp;
use App\Models\Option;
use App\Models\Package;
use App\Models\PackageRequest;
use App\Models\Union;
use App\Models\Upozila;
use Exception;

class PagesController extends Controller
{
    public function paymnet_page()
    {
        return view('payment');
    }

    public function ftp_page()
    {
        $servers = Ftp::orderBy('created_at', 'desc')->get();
        return view('ftp', compact('servers'));
    }

    public function packagesPage()
    {
        $packages = Package::where('type', '=', 'home_package')->orderBy('rank')->get();
        return view('packages', compact('packages'));
    }

    public function packageHotspotPage()
    {
        $packages = Package::where('type', '=', 'hotspot_package')->orderBy('rank')->get();
        return view('packageshotspot', compact('packages'));
    }

    public function terms()
    {
        $terms = Option::where('key', 'terms')->first();
        return view('terms', compact('terms'));
    }

    public function conReqPage()
    {
        $upozilas = Upozila::get();
        $packages = Package::where('type', '=', 'home_package')->orderBy('rank')->get();
        return view('request', compact('upozilas', 'packages'));
    }

    public function connReqSubmit(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'upozila' => 'required|string|max:255',
                'union' => 'required|string|max:255',
                'package' => 'required|string|max:255',
                'address' => 'required|string|max:1000',
                'near_bazar' => 'required|string|max:1000',
                'why_need' => 'string|max:255|nullable',
                'dis_provider' => 'string|max:255|nullable'
            ],
            [
                'name.required' => 'Your name is required',
                'phone.required' => 'Your phone number is required',
                'upozila.required' => 'Upozila is required',
                'union.required' => 'Union is required',
                'package.required' => 'Please select a package',
                'address.required' => 'Please provide your address',
                'near_bazar.required' => 'Please provide nearest bazar address'
            ]
        );

        // FIND UPOZILA NAME FROM ID

        $upozila = Upozila::findOrFail($request->upozila);

        try {
            PackageRequest::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'upozila' => $upozila->name,
                'union' => $request->union,
                'package' => $request->package,
                'address' => $request->address,
                'near_bazar' => $request->near_bazar,
                'why_need' => $request->why_need,
                'dis_provider' => $request->dis_provider
            ]);

            return back()->with('success', 'SUCCESS');
        } catch (Exception $e) {
            return back()->with('error', 'Error Occured, try again later!');
        }
    }

    public function custom_form_view()
    {
        $custom_from_title = Option::where('key', 'custom_from_title')->first();
        $custom_from_input_title = Option::where('key', 'custom_from_input_title')->first();
        return view('custom-form', compact('custom_from_title', 'custom_from_input_title'));
    }

    public function custom_form_store(Request $request)
    {
        $request->validate(
            [
                'name' => 'string|required|max:255',
                'phone' => 'string|required|max:255',
                'address' => 'string|required|max:255',
                'customfield' => 'string|nullable|max:255'
            ]
        );

        try {
            Customform::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
                'customfield' => $request->customfield
            ]);
            return back()->with('success', 'Success!');
        } catch (Exception $e) {
            return back()->with('error', 'Something went wrong');
        }
    }

    public function privacy_policy()
    {
        return view('privacy');
    }

    public function refund_policy()
    {
        return view('refund-policy');
    }

    public function about()
    {
        return view('about');
    }
}
