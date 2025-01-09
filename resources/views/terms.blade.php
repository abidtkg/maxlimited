@extends('layouts.master')
@section('page-title', 'Terms & Condition - Max Limited')
@section('internal-page-css')

@endsection
@section('content')
    <div class="container mt-5 mb-5">
        {!! $terms->value !!}
    </div>
@endsection
