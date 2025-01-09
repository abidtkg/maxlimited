@extends('layouts.admin.master')
@section('page-title', 'Scroll Notice - Max Limited')
@section('page-css')

@endsection
@section('dashboard-content')
    <div class="container">
        <form action="{{ route('admin.notice.update') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="homescrollnotice" class="form-label">Enter your scrollable notice here</label>
                    <textarea name="homescrollnotice" class="form-control " id="homescrollnotice" cols="20" rows="10">{{ $notice->value ?? '' }}</textarea>
                    <button class="btn btn-info mt-3">UPDATE</button>
                </div>
            </div>
        </form>
    </div>
@endsection
