@extends('layouts.admin.master')
@section('page-title', 'Internet Packages - Max Limited')
@section('dashboard-content')
    <div class="row">
        <div class="col-12">
            <a href="{{ route('admin.package.create') }}" class="btn btn-info btn-lg float-end">
                ADD PACKAGE
            </a>
        </div>
        <div class="col-md-12 mt-5">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">Internet Packages</h5>
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Rank</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Name</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Speed</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Price</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Action</h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($packages as $package)
                                    <tr>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">{{ $package->rank }}</h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-1">{{ $package->name }}</h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal"> {{ $package->speed }} {{ $package->speed_type }} </p>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal"> {{ $package->price }}/- BDT </p>
                                        </td>
                                        <td class="border-bottom-0">
                                            <a href="{{ route('admin.package.edit', $package->id) }}"
                                                class="btn btn-info me-1">
                                                <i class="ti ti-edit"></i>
                                            </a>
                                            <a onclick="return confirm('Are you sure you want to delete?')"
                                                href="{{ route('admin.package.delete', $package->id) }}"
                                                class="btn btn-info">
                                                <i class="ti ti-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
