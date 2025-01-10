@extends('layouts.admin.master')
@section('page-title', 'Purchase View - Max Limited')
@section('dashboard-content')
    <div class="card">
        <div class="card-header">
            <h5>Purchase Details #{{ $purchase->id }} <span class="float-end">{{ date('d M Y', strtotime($purchase->created_at)) }}</span></h5>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Product</th>
                        <th scope="col">Zone</th>
                        <th scope="col">Price</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($purchase->products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->zone->name }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->pivot->quantity }}</td>
                        <td>{{ $product->pivot->total }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="4">
                            <strong class="float-end">Total:</strong>
                        </td>
                        <td>
                            <strong>{{ $purchase->total }}</strong>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
