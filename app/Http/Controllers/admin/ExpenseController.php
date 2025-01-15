<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\User;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function expenses()
    {
        $expenses = Expense::latest()
        ->when(request('expense_category_id'), fn($query) => $query->where('expense_category_id', request('expense_category_id')))
        ->when(request('user_id'), fn($query) => $query->where('user_id', request('user_id')))
        ->when(request('start_date'), fn($query) => $query->where('date', '>=', request('start_date')))
        ->when(request('end_date'), fn($query) => $query->where('date', '<=', request('end_date')));
        if (request('print') !== 'yes') {
            $expenses = $expenses->paginate(50);
            $categories = ExpenseCategory::latest()->get();
            $users = User::whereIn('user_type', ['employee', 'admin'])->latest()->get();
            return view('admin.expense.index', compact('expenses', 'categories', 'users'));
        } else {
            $expenses = $expenses->get();  // Get all results without pagination
            $total_amount = $expenses->sum('amount');
            return view('admin.expense.print', compact('expenses', 'total_amount'));
        }
    }

    public function create()
    {
        $categories = ExpenseCategory::latest()->get();
        $users = User::whereIn('user_type', ['employee', 'admin'])->latest()->get();
        return view('admin.expense.create', compact('categories', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'expense_category_id' => 'required|integer',
            'note' => 'nullable|string',
            'image' => 'nullable|file|mimes:jpeg,jpg,png',
            'user_id' => 'required|integer',
            'datetime' => 'required|date'
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
                'user_id' => $request->user_id,
                'date' => $request->datetime
            ]);
            return redirect()->route('admin.expense.index')->with('success', 'Expense added successfully!');
        }catch(\Exception $e){
            dd($e);
            return back()->with('error', 'Something went wrong! Please try again.');
        }
    }

    public function delete($id)
    {
        $expense = Expense::findOrFail($id);

        if($expense->image){
            if(file_exists(public_path('uploads/memo/'.$expense->image))){
                unlink(public_path('uploads/memo/'.$expense->image));
            }
        }

        try{
            $expense->delete();
            return back()->with('success', 'Expense deleted successfully!');
        }catch(\Exception $e){
            return back()->with('error', 'Something went wrong! Please try again.');
        }
    }

    public function expense_categories()
    {
        $categories = ExpenseCategory::latest()->get();
        return view('admin.expense.category', compact('categories'));
    }

    public function expense_category_edit($id)
    {
        $category = ExpenseCategory::findOrFail($id);
        return view('admin.expense.editcategory', compact('category'));
    }

    public function expense_category_store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        try{
            ExpenseCategory::create([
                'name' => $request->name,
            ]);
            return back()->with('success', 'Expense category added successfully!');
        }catch(\Exception $e){
            return back()->with('error', 'Something went wrong! Please try again.');
        }
    }

    public function expense_category_update(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'name' => 'required|string|max:255',
        ]);

        try{
            ExpenseCategory::findOrFail($request->id)->update([
                'name' => $request->name,
            ]);
            return redirect()->route('admin.expense.category.index')->with('success', 'Expense category updated successfully!');
        }catch(\Exception $e){
            return back()->with('error', 'Something went wrong! Please try again.');
        }
    }
}
