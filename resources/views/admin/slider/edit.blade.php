@extends('layouts.admin.master')
@section('page-title', 'Update Slider - Max Limited')
@section('dashboard-content')
    <div class="row">
        <div class="col-md-12 mt-5">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">Update Slider Info</h5>
                    <form method="POST" enctype="multipart/form-data" action="{{ route('admin.slider.update') }}">
                        <div class="text-center">
                            <img src="{{ asset('uploads/' . $slider->url) }}" alt="{{ $slider->id }}" class="img-fluid"
                                style="height: 200px">
                        </div>

                        @csrf
                        <input type="hidden" name="id" value="{{ $slider->id }}">
                        <div class="mb-3">
                            <label for="title" class="form-label">Slider Title</label>
                            <input type="text" name="title" value="{{ old('title') ? old('title') : $slider->title }}"
                                class="form-control @error('title') is-invalid @enderror" id="title">
                            @error('title')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="rank" class="form-label">Rank</label>
                            <input type="number" value="1" name="rank"
                                value="{{ old('rank') ? old('rank') : $slider->rank }}"
                                class="form-control @error('rank') is-invalid @enderror" id="rank">
                            @error('rank')
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
