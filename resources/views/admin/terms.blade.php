@extends('layouts.admin.master')
@section('page-title', 'Terms & Condition - Max Limited')
@section('page-css')

@endsection
@section('dashboard-content')
    <script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>

    <div class="container">
        <form action="{{ route('admin.terms.update') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="terms" class="form-label">Update Terms & Conditions</label>
                    <textarea name="terms" class="form-control " id="terms" cols="30" rows="30">{{ $terms->value ?? '' }}</textarea>
                    <button class="btn btn-info mt-3">UPDATE</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        ClassicEditor
            .create(document.querySelector('#terms'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
