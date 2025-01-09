<?php

namespace App\Http\Controllers\admin;

use Exception;
use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::orderBy('rank')->get();
        return view('admin.package.index', compact('packages'));
    }

    public function createPage()
    {
        return view('admin.package.create');
    }

    public function editPage($packageId)
    {
        $package = Package::findOrFail($packageId);
        if (!$package) return back()->with('error', 'Package not found!');
        return view('admin.package.update', compact('package'));
    }

    public function createPackage(Request $request)
    {
        $request->validate(
            [
                'package_name' => 'required|string|max:255',
                'speed' => 'required|string|max:255',
                'speed_type' => 'required|string|max:255',
                'price' => 'required|integer|max:10000000',
                'description' => 'required|string|max:2500',
                'rank' => 'required|integer|max:1000',
                'type' => 'required|string|max:255',
            ],
            [
                'package_name.required' => 'Package name is required',
                'speed.required' => 'Package speed must be in number only',
                'speed_type.required' => 'Speed type is required as MBPS or KBPS',
                'price.required' => 'Package price required',
                'description.required' => 'package description is required',
                'rank.required' => 'Rank is required',
                'type.required' => 'Type is required'
            ]
        );

        try {
            Package::create([
                'name' => $request->package_name,
                'speed' => $request->speed,
                'speed_type' => $request->speed_type,
                'price' => $request->price,
                'description' => $request->description,
                'rank' => $request->rank,
                'type' => $request->type
            ]);
            // return back()->with('success', 'Server has been added');
            return redirect(route('admin.package.index'))->with('success', 'Package Created!');
        } catch (Exception $e) {
            return back()->with('error', 'Server not saved');
        }
    }

    public function update(Request $request)
    {
        $request->validate(
            [
                'id' => 'required|integer|max:100000',
                'package_name' => 'required|string|max:255',
                'speed' => 'required|string|max:255',
                'speed_type' => 'required|string|max:255',
                'price' => 'required|integer|max:10000000',
                'description' => 'required|string|max:2500',
                'rank' => 'required|integer|max:1000',
                'type' => 'required|string|max:255'
            ],
            [
                'id.required' => 'Package ID is missing',
                'package_name.required' => 'Package name is required',
                'speed.required' => 'Package speed must be in number only',
                'speed_type.required' => 'Speed type is required as MBPS or KBPS',
                'price.required' => 'Package price required',
                'description.required' => 'package description is required',
                'rank.required' => 'Rank is required',
                'type.required' => 'Type is required'
            ]
        );

        // FIND THE PACKAGE
        $package = Package::findOrFail($request->id);
        if (!$package) return back()->with('error', 'Invalid package ID');

        $update_payload = [
            'name' => $request->package_name,
            'speed' => $request->speed,
            'speed_type' => $request->speed_type,
            'price' => $request->price,
            'description' => $request->description,
            'rank' => $request->rank,
            'type' => $request->type
        ];

        try {
            Package::where('id', $request->id)->update($update_payload);
            return redirect(route('admin.package.index'))->with('success', 'Package Updated');
        } catch (Exception $e) {
            return back()->with('error', 'Update Faild!');
        }
    }

    public function delete($packageId)
    {
        try {
            $ftp = Package::findOrFail($packageId);
            $ftp->delete();
            return back()->with('success', 'Server has deleted!');
        } catch (Exception $e) {
            return back()->with('error', 'Server not deleted');
        }
    }
}
