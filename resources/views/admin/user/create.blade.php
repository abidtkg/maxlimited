@extends('layouts.admin.master')
@section('page-title', 'Create User - Max Limited')
@section('dashboard-content')
    <div class="container">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Create User Account</h5>
                    <form class="row" method="POST" action="{{ route('admin.user.store') }}">
                        @csrf
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" name="name"
                                class="form-control  @error('name') is-invalid @enderror"
                                value="{{ old('name') }}" id="name">
                            @error('name')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" name="phone"
                                class="form-control  @error('phone') is-invalid @enderror"
                                value="{{ old('phone') }}" id="phone">
                            @error('phone')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" name="address"
                                class="form-control  @error('address') is-invalid @enderror"
                                value="{{ old('address') }}" id="address">
                            @error('address')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email"
                                class="form-control @error('email') is-invalid @enderror" id="email"
                                value="{{ old('email') }}">
                            @error('email')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror" id="password">
                            @error('password')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-select @error('role') is-invalid @enderror" id="role"
                                name="role" value="{{ old('role') }}">
                                <option value="admin">Admin</option>
                                <option value="client">Client</option>
                                <option value="employee">Employee</option>
                            </select>
                            @error('role')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">CREATE</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
