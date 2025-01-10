@extends('layouts.admin.master')
@section('page-title', 'Products - Max Limited')
@section('dashboard-content')
    <div class="row">
        <div class="col-12">
            <a class="btn btn-info float-end" href="{{ route('admin.product.create') }}">
                Add Product
            </a>
        </div>
    </div>
    <div class="card w-100 mt-3">
        <div class="card-body p-4">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Stock</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Date</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <th scope="row"> {{ $product->stock }} </th>
                            <td> {{ $product->name }} ({{ $product->zone->name }}) </td>
                            <td> {{ $product->price }} </td>
                            <td> {{ date('d M Y', strtotime($product->created_at)) }} </td>
                            <td>
                                <a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-info me-1">
                                    <i class="ti ti-edit"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
