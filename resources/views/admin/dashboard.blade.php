@extends('layouts.admin.master')
@section('page-title', 'Dashboard - Max Limited')
@section('page-css')
    <style>
        .card-title {
            font-size: xx-large;
        }
    </style>
@endsection
@section('dashboard-content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="card bg-dark">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-white">Expense Today</h6>
                        <h1 class="card-title text-white"> {{ number_format($todays_expenses) }} </h1>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-dark">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-white">Expense Last 7 Days</h6>
                        <h1 class="card-title text-white"> {{ number_format($last_seven_days_expense) }} </h1>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-dark">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-white">This Month's Expense</h6>
                        <h1 class="card-title text-white"> {{ number_format($this_month_expense) }} </h1>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-dark">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-white">Last Month's Expense</h6>
                        <h1 class="card-title text-white"> {{ number_format($last_month_expense) }} </h1>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <a href="{{ route('admin.order.transaction.handcash') }}">
                    <div class="card bg-dark">
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2 text-white">Order Payment (Employees Hand)</h6>
                            <h1 class="card-title text-white"> {{ number_format($cash_in_hand_balance) }} </h1>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
