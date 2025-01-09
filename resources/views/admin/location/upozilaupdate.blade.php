@extends('layouts.admin.master')
@section('page-title', 'Update Upozila - Max Limited')
@section('dashboard-content')
    <div>
        <div class="container">
            <form action="{{ route('admin.location.upozila.update') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $upozila->id }}">
                <div class="mb-3">
                    <label for="name" class="form-label">Upozila Name</label>
                    <input type="text" value="{{ $upozila->name }}" class="form-control" name="name" id="name"
                        required>
                </div>
                <div class="flot-left">
                    <button type="submit" class="btn btn-primary">Update Upozila Name</button>
                </div>
            </form>
        </div>
    </div>
@endsection
