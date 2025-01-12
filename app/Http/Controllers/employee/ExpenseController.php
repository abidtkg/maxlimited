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
        $expenses = Expense::latest()
        ->when(request('expense_category_id'), fn($query) => $query->where('expense_category_id', request('expense_category_id')))
        ->when(request('user_id'), fn($query) => $query->where('user_id', request('user_id')))
        ->when(request('start_date'), fn($query) => $query->where('created_at', '>=', request('start_date')))
        ->when(request('end_date'), fn($query) => $query->where('created_at', '<=', request('end_date')))
        ->where('user_id', auth()->id());  // Filter by the currently logged-in user's ID

        if (request('print') !== 'yes') {
            $expenses = $expenses->paginate(50);
            $categories = ExpenseCategory::latest()->get();
            return view('employee.expense.index', compact('expenses', 'categories'));
        } else {
            $expenses = $expenses->get();  // Get all results without pagination
            return view('admin.expense.print', compact('expenses'));
        }
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
