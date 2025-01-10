@extends('layouts.admin.master')
@section('page-title', 'Create Product - Max Limited')
@section('dashboard-content')
<div class="card">
    <div class="card-header">
        <h5>Create Product</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.product.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="zone_id" class="form-label">Select Zone</label>
                <select id="zone_id" class="form-select @error('zone_id') is-invalid @enderror" name="zone_id">
                    @foreach ($zones as $zone)
                        <option value="{{ $zone->id }}" {{ old('zone_id') == $zone->id ? 'selected' : '' }}>{{ $zone->name }}</option>
                    @endforeach
                </select>
              </div>
            <div class="mb-3">
                <label for="price" class="form-label">Product Price</label>
                <input type="decimal" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') }}">
                @error('price')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Product Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Create Product</button>
        </form>
    </div>
</div>
@endsection
