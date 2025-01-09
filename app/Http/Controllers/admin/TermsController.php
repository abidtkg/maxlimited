<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Option;
use Exception;
use Illuminate\Http\Request;

class TermsController extends Controller
{
    public function index()
    {
        $terms = Option::where('key', 'terms')->first();

        return view('admin.terms', compact('terms'));
    }

    public function update(Request $request)
    {

        $request->validate(
            [
                'terms' => 'required|string|max:100000',
            ],
            [
                'terms.required' => 'Description is required',
            ]
        );
        $notice = Option::where('key', 'terms')->first();
        if (!$notice) {
            try {
                Option::create([
                    'key' => 'terms',
                    'value' => $request->terms,
                ]);
                return back()->with('success', 'Terms and condition updated');
            } catch (Exception $e) {
                return back()->with('error', 'Update error');
            }
        } else {
            try {
                Option::where('key', 'terms')->update([
                    'value' => $request->terms
                ]);
                return back()->with('success', 'Terms and Conditions updated!');
            } catch (Exception $e) {
                return back()->with('error', 'Update error');
            }
        }
    }
}
