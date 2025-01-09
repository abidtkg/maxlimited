<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\PackageRequest;
use Exception;
use Illuminate\Http\Request;

class PackageRequestController extends Controller
{
    public function index()
    {
        $requests = PackageRequest::orderBy('id', 'DESC')->paginate(10);
        return view('admin.request.index', compact('requests'));
    }

    public function viewPackage($package_id)
    {
        $package_request = PackageRequest::findOrFail($package_id);
        return view('admin.request.view', compact('package_request'));
    }

    public function markAsRead($package_id)
    {
        $request = PackageRequest::findOrFail($package_id);
        // UPDATE AS MARK AS READ
        try {
            PackageRequest::where('id', $request->id)->update(['seen' => true]);
            return ['success' => true];
        } catch (Exception $e) {
            return ['success' => false];
        }
    }

    public function deletePackage($package_id)
    {
        $package_req = PackageRequest::findOrFail($package_id);
        if (!$package_id) return back()->with('error', 'Package not found!');

        $package_req->delete();
        return back()->with('success', 'Request has deleted');
    }
}
