@extends('layouts.admin.master')
@section('page-title', 'Create Internet Package - Max Limited')
@section('dashboard-content')
    <div class="container">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Create Internet Package</h5>
                    <form class="row" method="POST" action="{{ route('admin.package.store') }}">
                        @csrf
                        <div class="col-md-12 mb-3">
                            <label for="package_name" class="form-label">Package Name</label>
                            <input type="text" name="package_name"
                                class="form-control  @error('package_name') is-invalid @enderror"
                                value="{{ old('package_name') }}" id="package_name">
                            @error('package_name')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="speed" class="form-label">Package Speed</label>
                            <input type="number" name="speed"
                                class="form-control @error('package_name') is-invalid @enderror" id="speed"
                                value="{{ old('speed') }}">
                            @error('speed')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="speed_type" class="form-label">Speed Type</label>
                            <select class="form-select @error('speed_type') is-invalid @enderror" id="speed_type"
                                name="speed_type" value="{{ old('speed_type') }}">
                                <option value="Mbps">Mbps</option>
                                <option value="Kbps">Kbps</option>
                            </select>
                            @error('speed_type')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="type" class="form-label">Connection Type</label>
                            <select class="form-select @error('type') is-invalid @enderror" id="type" name="type"
                                value="{{ old('type') }}">
                                <option value="home_package">Home Package</option>
                                <option value="hotspot_package">Hotspot Package</option>
                            </select>
                            @error('type')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" name="price" class="form-control @error('price') is-invalid @enderror"
                                id="price" value="{{ old('price') }}">
                            @error('price')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="rank" class="form-label">Rank</label>
                            <input type="number" name="rank" class="form-control @error('rank') is-invalid @enderror"
                                id="rank" value="{{ old('rank') ? old('rank') : '0' }}">
                            @error('rank')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="description" class="form-label">Package Description</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description"
                                cols="20" rows="10">{{ old('description') }}</textarea>
                            @error('description')
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
