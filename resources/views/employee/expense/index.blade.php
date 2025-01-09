@extends('layouts.admin.master')
@section('page-title', 'Expenses - Max Limited')
@section('dashboard-content')
<div class="row">
    <div class="col-12">
        <a href="{{ route('employee.expense.create') }}" class="btn btn-info float-end">
            ADD EXPENSE
        </a>
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
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
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