<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,$request->email',
            'phone' => 'required|string|max:12',
            'address' => 'required|string|max:255',
            'password' => 'required|string|max:16|min:6',
            'role' => 'required|string|max:255'
        ]);

        $hashedPassword = bcrypt($request->password);

        try{
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'user_type' => $request->role,
                'password' => $hashedPassword
            ]);
            return redirect()->route('admin.user.index')->with('success', 'User has created!');
        }catch(Exception $e){
            return back()->with('error', 'Something went wrong!');
        }
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|max:12',
            'address' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'password' => 'nullable|string|max:16|min:6'
        ]);

        if($request->password){
            $hashedPassword = bcrypt($request->password);
            $user = User::findOrFail($request->id);
            $user->password = $hashedPassword;
            $user->save();
        }
        try{
            User::where('id', $request->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'user_type' => $request->role
            ]);
            return redirect()->route('admin.user.index')->with('success', 'User has updated!');
        }catch(Exception $e){
            return back()->with('error', 'Something went wrong!');
        }
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        if(Auth::user()->id == $user->id) return back()->with('error', 'Logged In user can not be deleted!');

        try{
            $user->delete();
            return back()->with('success', 'User has deleted!');
        }catch(Exception $e){
            return back()->with('error', 'Something went wrong!');
        }
    }
}
