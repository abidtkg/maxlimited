@extends('layouts.admin.master')
@section('page-title', 'Products - Max Limited')
@section('dashboard-content')
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
                            <a href="{{ route('employee.order.view', $order->id) }}" class="btn btn-info me-1">
                                <i class="ti ti-eye"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if($orders->hasPages())
        <div class="pagination-wrapper">
            {{ $orders->links('pagination::bootstrap-5') }}
        </div>
    @endif
    </div>
</div>
@endsection
