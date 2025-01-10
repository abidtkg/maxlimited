@extends('layouts.admin.master')
@section('page-title', 'Edit Product - Max Limited')
@section('dashboard-content')
<div class="card">
    <div class="card-header">
        <h5>Create Product</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.product.update') }}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{ $product->id }}">
            <div class="mb-3">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') ? old('name') : $product->name }}">
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="zone_id" class="form-label">Select Zone</label>
                <select id="zone_id" class="form-select @error('zone_id') is-invalid @enderror" name="zone_id">
                    @foreach ($zones as $zone)
                        <option value="{{ $zone->id }}" {{ $product->selling_zone_id ? 'selected' : '' }}>{{ $zone->name }}</option>
                    @endforeach
                </select>
              </div>
            <div class="mb-3">
                <label for="price" class="form-label">Product Price</label>
                <input type="decimal" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') ? old('price') : $product->price }}">
                @error('price')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Product Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description') ? old('description') : $product->description }}</textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update Product</button>
        </form>
    </div>
</div>
@endsection
