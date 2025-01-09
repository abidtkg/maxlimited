<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Union;
use App\Models\Upozila;
use Illuminate\Http\Request;
use Exception;

class LocationController extends Controller
{
    public function upozilas()
    {
        $upozilas = Upozila::orderBy('created_at', 'desc')->get();

        return view('admin.location.upozilas', compact('upozilas'));
    }

    public function storeUpozila(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
            ],
            [
                'name.required' => 'Name is required',
            ]
        );

        try {
            Upozila::create([
                'name' => $request->name,
            ]);
            return back()->with('success', 'Upozila has added');
        } catch (Exception $e) {
            return back()->with('success', 'Upozila create faild!');
        }
    }

    public function editUpozila($upozila_id)
    {
        $upozila = Upozila::findOrFail($upozila_id);
        if (!$upozila) return back()->with('error', 'Upozila not found!');
        return view('admin.location.upozilaupdate', compact('upozila'));
    }

    public function updateUpozila(Request $request)
    {
        $request->validate(
            [
                'id' => 'required|integer|max:100000',
                'name' => 'required|string|max:255'
            ],
            [
                'id.required' => 'ID is required',
                'name.required' => 'Name is required',
            ]
        );

        try {
            Upozila::where('id', $request->id)->update(['name' => $request->name]);
            return redirect(route('admin.location.upozilas'))->with('success', 'Upozila has Updated');
        } catch (Exception $e) {
            return back()->with('error', 'Update Faild!');
        }
    }

    public function deleteUpozila($upozila_id)
    {
        try {
            $ftp = Upozila::findOrFail($upozila_id);
            $ftp->delete();

            return back()->with('success', 'Server has deleted!');
        } catch (Exception $e) {
            return back()->with('error', 'Upozila was not deleted!');
        }
    }

    // UNION
    public function unions()
    {
        $unions = Union::orderBy('created_at', 'desc')->get();
        return view('admin.location.unions', compact('unions'));
    }

    public function createUnion()
    {
        $upozilas = Upozila::get();
        return view('admin.location.unioncreate', compact('upozilas'));
    }

    public function storeUnion(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'upozila_id' => 'required|integer|max:25500'
            ],
            [
                'name.required' => 'Name is required',
                'upozila_id.required' => 'Please select a upozila',
            ]
        );

        try {
            Union::create([
                'upozila_id' => $request->upozila_id,
                'name' => $request->name,
            ]);
            return redirect(route('admin.location.unions'))->with('success', 'Union has created');
        } catch (Exception $e) {
            return back()->with('error', 'Upozila create faild!');
        }
    }

    public function deleteUnion($union_id)
    {
        try {
            $union = Union::findOrFail($union_id);
            $union->delete();

            return back()->with('success', 'Union has deleted!');
        } catch (Exception $e) {
            return back()->with('error', 'Union was not deleted!');
        }
    }
}
