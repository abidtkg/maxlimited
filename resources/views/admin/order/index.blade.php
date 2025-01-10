@extends('layouts.admin.master')
@section('page-title', 'Products - Max Limited')
@section('dashboard-content')
    <div class="row">
        <div class="col-12">
            <a class="btn btn-info float-end" href="{{ route('admin.order.create') }}">
                Add Order
            </a>
        </div>
    </div>
    <div class="card w-100 mt-3">
        <div class="card-body p-4">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Price</th>
                        <th scope="col">Due</th>
                        <th scope="col">User</th>
                        <th scope="col">Status</th>
                        <th scope="col">Date</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <th scope="row"> {{ $order->id }} </th>
                            <td> {{ $order->payable }} </td>
                            <td> {{ $order->due }} </td>
                            <td> {{ $order->user->name }} </td>
                            <td> {{ $order->status }} </td>
                            <td> {{ date('d M Y', strtotime($order->created_at)) }} </td>
                            <td>
                                <a href="{{ route('admin.order.show', $order->id) }}" class="btn btn-info me-1">
                                    <i class="ti ti-eye"></i>
                                </a>
                                <a onclick="return confirm('Are you sure?')" href="{{ route('admin.order.delete', $order->id) }}" class="btn btn-danger me-1">
                                    <i class="ti ti-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
