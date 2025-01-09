<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Option;
use Exception;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    public function index()
    {
        $notice = Option::where('key', 'homescrollnotice')->first();

        return view('admin.notice', compact('notice'));
    }

    public function update(Request $request)
    {

        $request->validate(
            [
                'homescrollnotice' => 'required|string|max:1000',
            ],
            [
                'homescrollnotice.required' => 'Description is required',
            ]
        );
        $notice = Option::where('key', 'homescrollnotice')->first();
        if (!$notice) {
            try {
                Option::create([
                    'key' => 'homescrollnotice',
                    'value' => $request->homescrollnotice,
                ]);
                return back()->with('success', 'Notice updated!');
            } catch (Exception $e) {
                return back()->with('error', 'Notice update error');
            }
        } else {
            try {
                Option::where('key', 'homescrollnotice')->update([
                    'value' => $request->homescrollnotice
                ]);
                return back()->with('success', 'Notice updated!');
            } catch (Exception $e) {
                return back()->with('error', 'Notice update error');
            }
        }
    }
}
