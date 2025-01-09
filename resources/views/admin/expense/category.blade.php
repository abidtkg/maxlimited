@extends('layouts.admin.master')
@section('page-title', 'Expense Category - Max Limited')
@section('dashboard-content')
    <div class="row">
        <div class="col-12">
            <button class="btn btn-info float-end" data-bs-toggle="modal" data-bs-target="#createftpmodal">
                ADD CATEGORY
            </button>
        </div>
    </div>
    <div class="card w-100 mt-3">
        <div class="card-body p-4">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Date</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <th scope="row"> {{ $category->id }} </th>
                            <td> {{ $category->name }} </td>
                            <td> {{ date('d M Y', strtotime($category->created_at)) }} </td>
                            <td>
                                <a href="{{ route('admin.expense.category.edit', $category->id) }}" class="btn btn-info me-1">
                                    <i class="ti ti-edit"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="createftpmodal" tabindex="-1" aria-labelledby="createftpmodallabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createftpmodallabel">Create Expense Category</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.expense.category.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Category Name</label>
                            <input type="text" class="form-control" name="name" id="name" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
