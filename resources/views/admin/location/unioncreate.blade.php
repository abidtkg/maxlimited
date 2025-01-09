@extends('layouts.admin.master')
@section('page-title', 'Create Union - Max Limited')
@section('dashboard-content')
    <div class="container">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Create Union</h5>
                    <form class="row" method="POST" action="{{ route('admin.location.union.store') }}">
                        @csrf
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Union Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                id="name" value="{{ old('name') }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="upozila_id" class="form-label">Upozila Name</label>
                            <select class="form-select " id="upozila_id" name="upozila_id" value="{{ old('upozila_id') }}">
                                @foreach ($upozilas as $upozila)
                                    <option value="{{ $upozila->id }}" @if (old('upozila_id') == $upozila->id) selected @endif>
                                        {{ $upozila->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">CREATE UNION</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
