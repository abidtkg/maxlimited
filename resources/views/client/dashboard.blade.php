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
                    <h6 class="card-subtitle mb-2 text-white">Purcahse In This Month</h6>
                    <h1 class="card-title text-white"> ৳ {{ number_format($total_order_current_month) }} </h1>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-dark">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2 text-white">Purcahse In Last Month</h6>
                    <h1 class="card-title text-white"> ৳ {{ number_format($total_order_last_month) }} </h1>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-dark">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2 text-white">Purcahse In This Year</h6>
                    <h1 class="card-title text-white"> ৳ {{ number_format($total_order_year) }} </h1>
                </div>
            </div>
        </div>
        

    </div>
</div>
@endsection
