@extends('layouts.admin.master')
@section('page-title', 'Expenses - Max Limited')
@section('dashboard-content')
<div class="card">
    <div class="card-header">
        <h5>Ceate Expense</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('employee.expense.store') }}" method="POST" class="row g-2" enctype="multipart/form-data">
            @csrf
            <div class="col-md-6">
                <label for="expense_category_id" class="form-label">Category</label>
                <select class="form-select @error('expense_category_id') is-invalid @enderror" name="expense_category_id" id="expense_category_id">
                    <option value="" disabled selected>Select Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('expense_category_id') == $category->id ? 'selected' : ''}} > {{ $category->name }} </option>
                    @endforeach
                </select>
                @error('expense_category_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="amount" class="form-label">Amount</label>
                <input type="decimal" class="form-control @error('amount') is-invalid @enderror" name="amount" id="amount" value="{{ old('amount') }}">
                @error('amount')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="image" class="form-label">Memo Image (JPEG, JPG, PNG)</label>
                <input class="form-control @error('image') is-invalid @enderror" type="file" name="image" id="image" accept="image/*">
                @error('image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>
            <div class="col-md-12">
                <label for="note" class="form-label">Note / Description</label>
                <textarea class="form-control @error('note') is-invalid @enderror" name="note" id="note" rows="3">{{ old('note') }}</textarea>
                @error('note')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-12">
                <button type="submit" class="btn btn-info">Create</button>
            </div>
        </form>
    </div>
</div>
@endsection
