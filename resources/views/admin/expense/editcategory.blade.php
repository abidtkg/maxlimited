@extends('layouts.admin.master')
@section('page-title', 'Edit Category - Max Limited')
@section('dashboard-content')
<div class="card">
    <div class="card-header">
        <h5>Edit Expense</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.expense.category.update') }}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{ $category->id }}">
            <div class="mb-3">
                <label for="name" class="form-label">Category Name</label>
                <input type="text" class="form-control @error('name') is-valid @enderror" name="name" id="name" value="{{ old('category') ? old('category') : $category->name }}" required>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-info">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection
