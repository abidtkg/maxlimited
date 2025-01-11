@extends('layouts.admin.master')
@section('page-title', 'Cash To Collect - Max Limited')
@section('dashboard-content')
<div class="card w-100 mt-3">
    <div class="card-body p-4">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Employee Name</th>
                    <th scope="col">Balance In Hand</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($balances as $balance)
                    <tr>
                        <th scope="row"> {{ $balance->collected->name }} </th>
                        <td> {{ $balance->total_balance }} </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
