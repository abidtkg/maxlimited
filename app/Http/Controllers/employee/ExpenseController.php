<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::where('user_id', Auth::user()->id)->latest()->paginate(50);
        return view('employee.expense.index', compact('expenses'));
    }

    public function create()
    {
        $categories = ExpenseCategory::latest()->get();
        return view('employee.expense.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'expense_category_id' => 'required|integer',
            'note' => 'nullable|string',
            'image' => 'nullable|file|mimes:jpeg,jpg,png',
        ]);

        if(!is_dir(public_path('uploads/memo'))){
            mkdir(public_path('uploads/memo'), 0755, true);
        }

        $image_name = '';
        if($request->hasFile('image')){
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $image_name = uniqid(). '.' .$extension;
            $image->move(public_path('uploads/memo'), $image_name);
        }

        try{
            Expense::create([
                'amount' => $request->amount,
                'expense_category_id' => $request->expense_category_id,
                'note' => $request->note,
                'image' => $image_name,
                'user_id' => Auth::user()->id,
            ]);
            return redirect()->route('employee.expense.index')->with('success', 'Expense added successfully!');
        }catch(\Exception $e){
            dd($e);
            return back()->with('error', 'Something went wrong! Please try again.');
        }
    }
}
