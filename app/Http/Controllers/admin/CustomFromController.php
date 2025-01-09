<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Customform;
use App\Models\Option;
use Exception;
use Illuminate\Http\Request;

class CustomFromController extends Controller
{
    public function index()
    {
        $custom_from_title = Option::where('key', 'custom_from_title')->first();
        $custom_from_input_title = Option::where('key', 'custom_from_input_title')->first();
        $datas = Customform::orderBy('id', 'DESC')->paginate(10);
        return view('admin.customform.index', compact('datas', 'custom_from_title', 'custom_from_input_title'));
    }

    public function delete($id)
    {
        $custom_form = Customform::findOrFail($id);
        $custom_form->delete();
        return back()->with('success', 'Data deleted');
    }

    public function update(Request $request)
    {

        $request->validate(
            [
                'custom_from_title' => 'required|string|max:255',
                'custom_from_input_title' => 'required|string|max:255'
            ]
        );

        $custom_from_title = Option::where('key', 'custom_from_title')->first();
        $custom_from_input_title = Option::where('key', 'custom_from_input_title')->first();
        if (!$custom_from_title) {
            try {
                Option::create([
                    'key' => 'custom_from_title',
                    'value' => $request->custom_from_title,
                ]);
            } catch (Exception $e) {
                return back()->with('error', 'Notice update error');
            }
        } else {
            try {
                Option::where('key', 'custom_from_title')->update([
                    'value' => $request->custom_from_title
                ]);
            } catch (Exception $e) {
                return back()->with('error', 'Update error');
            }
        }

        if (!$custom_from_input_title) {
            try {
                Option::create([
                    'key' => 'custom_from_input_title',
                    'value' => $request->custom_from_input_title,
                ]);
                return back()->with('success', 'Updated!');
            } catch (Exception $e) {
                return back()->with('error', 'Update error');
            }
        } else {
            try {
                Option::where('key', 'custom_from_input_title')->update([
                    'value' => $request->custom_from_input_title
                ]);
            } catch (Exception $e) {
                return back()->with('error', 'Update error');
            }
        }

        return back()->with('success', 'Updated!');
    }

    public function api_cfinfo()
    {
        $custom_from_title = Option::where('key', 'custom_from_title')->first();
        $custom_from_input_title = Option::where('key', 'custom_from_input_title')->first();
        $response = [
            'main_title' => $custom_from_title->value,
            'input_title' => $custom_from_input_title->value
        ];

        return $response;
    }

    public function api_cfcreate(Request $request)
    {
        if (!$request->name) return response(['error' => 'Name is required'], 400);
        if (!$request->phone) return response(['error' => 'Phone is required'], 400);
        if (!$request->address) return response(['error' => 'Address is required'], 400);

        try {
            Customform::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
                'customfield' => $request->customfield
            ]);
            return response(['success' => 'Submit success!']);
        } catch (Exception $e) {
            return response(['error' => 'Something went wrong, try again'], 400);
        }
    }
}
