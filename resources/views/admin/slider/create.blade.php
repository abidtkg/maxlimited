@extends('layouts.admin.master')
@section('page-title', 'Create Slider - Max Limited')
@section('dashboard-content')
    <div class="row">
        <div class="col-md-12 mt-5">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">Create A Slider</h5>
                    <form method="POST" enctype="multipart/form-data" action="{{ route('admin.slider.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Slider Title</label>
                            <input type="text" name="title" value="{{ old('title') }}"
                                class="form-control @error('title') is-invalid @enderror" id="title">
                            @error('title')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="rank" class="form-label">Rank</label>
                            <input type="number" value="1" name="rank" value="{{ old('rank') }}"
                                class="form-control @error('rank') is-invalid @enderror" id="rank">
                            @error('rank')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <div class="mb-3">
                                <label for="image" class="form-label">Select Image (PNG,JPEG, JPG format only)</label>
                                <input class="form-control @error('image') is-invalid @enderror" type="file"
                                    name="image" id="image" accept="image/png, image/jpeg, image/jpg">
                                @error('image')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">CREATE</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
