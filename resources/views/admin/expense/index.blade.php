@extends('layouts.admin.master')
@section('page-title', 'Expenses - Max Limited')
@section('dashboard-content')
<div class="row">
    <div class="col-12">
        <div class="row">
            <form class="col-md-12" action="" method="get">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="category" class="form-label">Category</label>
                            <select id="category" class="form-control" name="expense_category_id">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ request()->get('expense_category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="users" class="form-label">Employee</label>
                            <select id="users" name="user_id" class="form-control">
                                <option value="">Select Employee</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ request()->get('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="datetime-local" name="start_date" id="start_date" class="form-control" value="{{ request()->get('start_date') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="datetime-local" name="end_date" id="end_date" class="form-control" value="{{ request()->get('end_date') }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for=""></label>
                        <button class="btn btn-info mt-2">Submit</button>
                    </div>
                    <div class="col-md-2">
                        <label for=""></label>
                        <button class="btn btn-dark mt-2" name="print" value="yes">Submit & Print</button>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('admin.expense.create') }}" class="btn btn-info mt-2">
                            ADD EXPENSE
                        </a>
                    </div>
                </div>
            </form>
        </div>
        
    </div>
</div>
<div class="card mt-3">
    <div class="card-body p-4">
        <div class="table-responsive">
            <table class="table" style="overflow-x:auto;">
                <thead>
                    <tr>
                        <th scope="col">Amount</th>
                        <th scope="col">Category</th>
                        <th scope="col">Date</th>
                        <th scope="col">Person</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($expenses as $expense)
                        <tr>
                            <th scope="row"> {{ $expense->amount }} </th>
                            <td> {{ $expense->category->name }} </td>
                            <td> {{ date('d M Y h:iA', strtotime($expense->created_at)) }} </td>
                            <td> {{ $expense->user->name }} </td>
                            <td>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#detailmodal{{ $expense->id }}">
                                    <i class="ti ti-eye"></i>
                                </button>
                                {{-- <a href="{{ route('admin.expense.category.edit', $expense->id) }}" class="btn btn-info me-1">
                                    <i class="ti ti-edit"></i>
                                </a> --}}
                                <a  class="btn btn-danger" onclick="return confirm('Are you sure want to delete?')" href="{{ route('admin.expense.delete', $expense->id) }}">
                                    <i class="ti ti-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if($expenses->hasPages())
            <div class="pagination-wrapper">
                {{ $expenses->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
</div>


@foreach ($expenses as $expense)
<div class="modal fade" id="detailmodal{{ $expense->id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $expense->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel{{ $expense->id }}">{{ __('Expense Details') }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Amount</th>
                        <td>{{ $expense->amount }}</td>
                    </tr>
                    <tr>
                        <th>Category</th>
                        <td>{{ $expense->category->name }}</td>
                    </tr>
                    <tr>
                        <th>Expense By</th>
                        <td>{{ $expense->user->name }}</td>
                    </tr>
                    <tr>
                        <th>Expense Date</th>
                        <td>{{ date('d M Y h:iA', strtotime($expense->created_at)) }}</td>
                    </tr>
                    <tr>
                        <th>Note / Description</th>
                        <td>{{ $expense->note }}</td>
                    </tr>
                    @if($expense->image)
                    <tr>
                        <td colspan="2">
                            <img src="{{ asset('uploads/memo/'.$expense->image) }}" alt="Expense Image" class="img-fluid">
                        </td>
                    </tr>
                    @endif
                </table>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection
