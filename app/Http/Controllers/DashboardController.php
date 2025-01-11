<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Ftp;
use App\Models\OrderTransaction;
use App\Models\Package;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $todays_expenses = Expense::whereDate('created_at', date('Y-m-d'))->sum('amount');
        $last_seven_days_expense = Expense::where('created_at', '>=', date('Y-m-d', strtotime('-7 days')))->sum('amount');
        $this_month_expense = Expense::where('created_at', '>=', date('Y-m-01'))->sum('amount');
        $last_month_expense = Expense::where('created_at', '>=', date('Y-m-01', strtotime('-1 month')))->where('created_at', '<', date('Y-m-01'))->sum('amount');
        $cash_in_hand_balance = OrderTransaction::where('verified', false)->sum('amount');
        return view('admin.dashboard', compact('todays_expenses', 'last_seven_days_expense', 'this_month_expense', 'last_month_expense', 'cash_in_hand_balance'));
    }
}
