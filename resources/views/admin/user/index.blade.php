@extends('layouts.admin.master')
@section('page-title', 'User Management - Max Limited')
@section('dashboard-content')
<div class="row">
    <div class="col-md-12 mt-5">
        <div class="card w-100">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">
                    Manage Users
                    <a href="{{ route('admin.user.create') }}" class="btn btn-sm btn-info float-end">Create User</a>
                </h5>
                <div class="table-responsive">
                    <table class="table text-nowrap mb-0 align-middle">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Name</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Email</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Role</h6>
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
                            @foreach ($users as $user)
                                <tr>
                                    <td class="border-bottom-0">{{ $user->name }}</td>
                                    <td class="border-bottom-0">{{ $user->email }}</td>
                                    <td class="border-bottom-0 text-uppercase">
                                        <span class="badge text-bg-dark">{{ $user->user_type }}</span>
                                    </td>
                                    <td class="border-bottom-0 text-uppercase">{{ date('d M Y', strtotime($user->created_at)) }}</td>
                                    <td class="border-bottom-0 text-uppercase">
                                        <a href="{{ route('admin.user.edit', $user->id) }}"
                                            class="btn btn-info me-1">
                                            <i class="ti ti-edit"></i>
                                        </a>
                                        <a onclick="return confirm('Are you sure you want to delete?')"
                                            href="{{ route('admin.user.delete', $user->id) }}"
                                            class="btn btn-info">
                                            <i class="ti ti-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- @if ($requests->hasPages())
                        <div class="pagination-wrapper">
                            {{ $requests->links('pagination::bootstrap-5') }}
                        </div>
                    @endif --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
