@extends('layouts.admin.master')
@section('page-title', 'View ISP Connection Request - Max Limited')
@section('dashboard-content')
    <div class="container">
        <table class="table">
            <tbody>
                <tr>
                    <th scope="row">Name</th>
                    <td> {{ $package_request->name }} </td>
                </tr>
                <tr>
                    <th scope="row">Phone Number</th>
                    <td>{{ $package_request->phone }}</td>
                </tr>
                <tr>
                    <th scope="row">Upozila</th>
                    <td>{{ $package_request->upozila }}</td>
                </tr>
                <tr>
                    <th scope="row">Union</th>
                    <td>{{ $package_request->union }}</td>
                </tr>
                <tr>
                    <th scope="row">Package</th>
                    <td>{{ $package_request->package }}</td>
                </tr>
                <tr>
                    <th scope="row">Address</th>
                    <td>{{ $package_request->address }}</td>
                </tr>
                <tr>
                    <th scope="row">Near Bazar</th>
                    <td>{{ $package_request->near_bazar }}</td>
                </tr>
                <tr>
                    <th scope="row">Local Dis Provider</th>
                    <td>{{ $package_request->dis_provider }}</td>
                </tr>
                <tr>
                    <th scope="row">Connection For</th>
                    <td>{{ $package_request->why_need }}</td>
                </tr>
                <tr>
                    <th scope="row">Date</th>
                    <td>{{ date('d M Y', strtotime($package_request->created_at)) }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    @if ($package_request->seen == false)
        <script>
            fetch('/api/connection-req/read/{{ $package_request->id }}')
        </script>
    @endif
@endsection
