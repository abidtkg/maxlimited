@extends('layouts.admin.master')
@section('page-title', 'Update User - Max Limited')
@section('dashboard-content')
    <div class="container">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Update User Account</h5>
                    <form class="row" method="POST" action="{{ route('admin.user.update') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" name="name"
                                class="form-control  @error('name') is-invalid @enderror"
                                value="{{ old('name') ? old('name') : $user->name }}" id="name">
                            @error('name')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" name="phone"
                                class="form-control  @error('phone') is-invalid @enderror"
                                value="{{ old('phone') ? old('phone') : $user->phone }}" id="phone">
                            @error('phone')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" name="address"
                                class="form-control  @error('address') is-invalid @enderror"
                                value="{{ old('address') ? old('address') : $user->address }}" id="address">
                            @error('address')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email"
                                class="form-control @error('email') is-invalid @enderror" id="email"
                                value="{{ old('email') ? old('email') : $user->email }}">
                            @error('email')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">Password <span class="text-muted">(fill this for change password)</span> </label>
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
                                <option value="admin" {{ $user->user_type == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="client" {{ $user->user_type == 'client' ? 'selected' : '' }}>Client</option>
                                <option value="employee" {{ $user->user_type == 'employee' ? 'selected' : '' }}>Employee</option>
                            </select>
                            @error('role')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="role" class="form-label">Zone (only for client)</label>
                            <select class="form-select @error('zone_id') is-invalid @enderror" id="zone_id" name="zone_id" value="{{ old('zone_id') }}">
                                <option value="">Select Zone (Only for client)</option>
                                @foreach ($zones as $zone)
                                    <option value="{{ $zone->id }}" {{ $user->zone_id == $zone->id ? 'selected' : '' }}>{{ $zone->name }}</option>
                                @endforeach
                            </select>
                            @error('role')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">UPDATE</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
