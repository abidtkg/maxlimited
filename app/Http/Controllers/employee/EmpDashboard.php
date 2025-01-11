<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\Order;
use App\Models\OrderTransaction;
use Illuminate\Http\Request;

class EmpDashboard extends Controller
{
    public function index()
    {
        $user_id = auth()->id();  // Get the ID of the currently logged-in user

        $todays_expenses = Expense::whereDate('created_at', date('Y-m-d'))
            ->where('user_id', $user_id)  // Add user_id filter
            ->sum('amount');
        
        $last_seven_days_expense = Expense::where('created_at', '>=', date('Y-m-d', strtotime('-7 days')))
            ->where('user_id', $user_id)  // Add user_id filter
            ->sum('amount');
        
        $this_month_expense = Expense::where('created_at', '>=', date('Y-m-01'))
            ->where('user_id', $user_id)  // Add user_id filter
            ->sum('amount');
        
        $last_month_expense = Expense::where('created_at', '>=', date('Y-m-01', strtotime('-1 month')))
            ->where('created_at', '<', date('Y-m-01'))
            ->where('user_id', $user_id)  // Add user_id filter
            ->sum('amount');
        $cash_in_hand_balance = OrderTransaction::where('collected_by', auth()->user()->id)->where('verified', false)->sum('amount');
        
        return view('employee.dashboard', compact('todays_expenses', 'last_seven_days_expense', 'this_month_expense', 'last_month_expense', 'cash_in_hand_balance'));
    }
}
