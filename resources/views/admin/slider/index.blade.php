@extends('layouts.admin.master')
@section('page-title', 'Sliders - Max Limited')
@section('dashboard-content')
    <div class="row">
        <div class="col-md-12">
            <a href="{{ route('admin.slider.create') }}" class="btn btn-info btn-lg float-end">ADD SLIDER</a>
        </div>
        <div class="col-md-12 mt-5">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">Sliders</h5>
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">RANK</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">IMAGE</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">TITLE</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">ACTION</h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sliders as $slider)
                                    <tr>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0"> {{ $slider->rank }} </h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <img src="{{ asset('uploads/' . $slider->url) }}" alt="{{ $slider->title }}"
                                                class="img-fluid" style="height: 80px; width: auto;">
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal">{{ $slider->title }}</p>
                                        </td>
                                        <td class="border-bottom-0">
                                            <div class="d-flex align-items-center gap-2">
                                                <a href="{{ route('admin.slider.edit', $slider->id) }}"
                                                    class="btn btn-info">
                                                    <i class="ti ti-edit"></i>
                                                </a>
                                                <a onclick="return confirm('Are you sure you want to delete?')"
                                                    href="{{ route('admin.slider.delete', $slider->id) }}"
                                                    class="btn btn-danger">
                                                    <i class="ti ti-trash"></i>
                                                </a>
                                            </div>
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
