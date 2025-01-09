<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ExpenseCategory;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
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
