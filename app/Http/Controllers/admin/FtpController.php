<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ftp;
use Exception;

class FtpController extends Controller
{
    public function index()
    {
        $servers = Ftp::orderBy('created_at', 'desc')->get();
        return view('admin.ftp.index', compact('servers'));
    }

    public function updatePage($ftpid)
    {
        $server =  Ftp::findOrFail($ftpid);
        return view('admin.ftp.update', compact('server'));
    }

    public function create(Request $request)
    {
        $request->validate(
            [
                'category' => 'required|string|max:255',
                'name' => 'required|string|max:255',
                'url' => 'required|string|max:255'
            ],
            [
                'category.required' => 'Server type is required',
                'name.required' => 'Name required',
                'url.required' => 'Website URL required'
            ]
        );


        try {
            Ftp::create([
                'category' => $request->category,
                'name' => $request->name,
                'url' => $request->url
            ]);

            return back()->with('success', 'Server has been added');
        } catch (Exception $e) {
            return back()->with('error', 'Server not saved');
        }
    }

    public function updateFtp(Request $request)
    {
        $request->validate(
            [
                'id' => 'required|int',
                'category' => 'required|string|max:255',
                'name' => 'required|string|max:255',
                'url' => 'required|string|max:255'
            ],
            [
                'category.required' => 'Server type is required',
                'name.required' => 'Name required',
                'url.required' => 'Website URL required'
            ]
        );

        // FIND THE FTP SERVER
        $ftp = Ftp::findOrFail($request->id);
        if (!$ftp) return back()->with('error', 'FTP ID not valid');

        // UPDATE PAYLOD
        $update_payload = [
            'category' => $request->category,
            'name' => $request->name,
            'url' => $request->url
        ];
        try {
            Ftp::where('id', $request->id)->update($update_payload);
            return redirect(route('admin.ftp'))->with('success', 'FTP Server Updated');
        } catch (Exception $e) {
            return back()->with('error', 'Update Faild!');
        }
    }

    public function delete($ftpid)
    {

        $ftp = Ftp::findOrFail($ftpid);
        $ftp->delete();

        return back()->with('success', 'Server has deleted!');
    }
}
