@extends('layouts.admin.master')
@section('page-title', 'Custom Form - Max Limited')
@section('page-css')
  
@endsection
@section('dashboard-content')
<div class="container">
    <form action="{{ route('admin.customform.update') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <label for="maint">Main Title</label>
                <input type="text" id="maint" name="custom_from_title" class="form-control @error('custom_from_title') is-invalid @enderror" value="{{ old('custom_from_title') ? old('custom_from_title') : ($custom_from_title == null ? '' : $custom_from_title->value) }}">
            </div>
            <div class="col-md-6">
                <label for="cin">Custom Input Name</label>
                <input type="text" id="cin" class="form-control @error('custom_from_input_title') is-invalid @enderror" name="custom_from_input_title" value="{{ old('custom_from_input_title') ? old('custom_from_input_title') : ($custom_from_input_title == null ? '' : $custom_from_input_title->value) }}">
            </div>
        </div>
        <button class="btn btn-sm btn-primary mt-3" type="submit">UPDATE</button>
    </form>
    <hr>
    <div class="card w-100">
        <div class="card-body p-4">
            <h5 class="card-title fw-semibold mb-4"> {{ $custom_from_title == null ? '' : $custom_from_title->value }} Data List</h5>
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
                                <h6 class="fw-semibold mb-0">Address</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0"> {{ $custom_from_input_title != null ? $custom_from_input_title->value : 'Custom Field' }} </h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Action</h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $datas as $data )
                        <tr>
                            <td class="border-bottom-0">
                                <h6 class="fw-semibold mb-1"> {{ $data->name }} </h6>
                            </td>
                            <td class="border-bottom-0">{{ $data->phone }}</td>
                            <td class="border-bottom-0">
                                <p class="mb-0 fw-normal"> {{ $data->address }}</p>
                            </td>
                            <td class="border-bottom-0">
                                {{ $data->customfield }}
                            </td>
                            <td class="border-bottom-0">
                                <a onclick="return confirm('Are you sure you want to delete?')" href="{{ route('admin.customform.delete', $data->id) }}">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
                @if ($datas->hasPages())
                    <div class="pagination-wrapper">
                        {{ $datas->links('pagination::bootstrap-5') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
