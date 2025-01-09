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
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title"> 12 </h1>
                        <h6 class="card-subtitle mb-2 text-muted">FTP Servers</h6>
                        <a href="{{ route('admin.ftp') }}" class="card-link">See All</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title">12</h1>
                        <h6 class="card-subtitle mb-2 text-muted">Internet Packages</h6>
                        <a href="{{ route('admin.package.index') }}" class="card-link">See All</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
