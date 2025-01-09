@extends('layouts.admin.master')
@section('page-title', 'Connection Requests - Max Limited')
@section('dashboard-content')
    <div class="row">
        <div class="col-md-12 mt-5">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">Internet Connection Requests</h5>
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Name</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Phone</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Location</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Package</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Date</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Action</h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($requests as $request)
                                    <tr @if ($request->seen == false) style="background: #9cfcff85" @endif>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">{{ $request->name }}</h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-1">{{ $request->phone }}</h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal"> {{ $request->upozila }} <br> {{ $request->union }}
                                            </p>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal"> {{ $request->package }}</p>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal">
                                                {{ date('d M Y', strtotime($request->created_at)) }}
                                            </p>
                                        </td>
                                        <td class="border-bottom-0">
                                            <a href="{{ route('admin.con.req.view', $request->id) }}"
                                                class="btn btn-info me-1">
                                                <i class="ti ti-eye"></i>
                                            </a>
                                            <a onclick="return confirm('Are you sure you want to delete?')"
                                                href="{{ route('admin.conn.req.delete', $request->id) }}"
                                                class="btn btn-info">
                                                <i class="ti ti-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if ($requests->hasPages())
                            <div class="pagination-wrapper">
                                {{ $requests->links('pagination::bootstrap-5') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
