@extends('layouts.master')
@section('page-title', 'Custom Form - Max Limited')
@section('content')
    <div class="container mt-5 mb-5 pb-5">
        <h2 class="text-center">{{ $custom_from_title->value }}</h2>
        <form class="row g-3" method="POST" action="{{ route('customform.store') }}">
          @csrf
            <div class="col-md-6">
              <label for="name" class="form-label">Name</label>
              <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name">
              @error('name')
                <span class="text-danger"> {{ $message }} </span>
              @enderror
            </div>
            <div class="col-md-6">
              <label for="phone" class="form-label">Phone</label>
              <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone">
              @error('phone')
                <span class="text-danger"> {{ $message }} </span>
              @enderror
            </div>
            <div class="col-12">
              <label for="inputAddress" class="form-label">Address</label>
              <input type="text" class="form-control @error('address') is-invalid @enderror" id="inputAddress" name="address">
              @error('address')
                <span class="text-danger"> {{ $message }} </span>
              @enderror
            </div>
            <div class="col-12">
              <label for="custom-field" class="form-label"> {{ $custom_from_input_title->value }} </label>
              <input type="text" class="form-control @error('customfield') is-invalid @enderror " id="custom-field" name="customfield">
            </div>
            <div class="col-12 mt-2">
              <button type="submit" class="btn btn-primary">SUBMIT</button>
            </div>
          </form>
    </div>
@endsection

@section('internal-page-js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (Session()->has('success'))
        <script>
            Swal.fire(
                '{{ session()->get('success') }}',
                '',
                'success'
            )
        </script>
    @endif
    @if (Session()->has('error'))
        <script>
            Swal.fire(
                '{{ session()->get('error') }}',
                'success'
            )
        </script>
        @endif
@endsection
