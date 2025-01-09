@extends('layouts.admin.master')
@section('page-title', 'Upozilas - Max Limited')
@section('dashboard-content')
    <div class="row">
        <div class="col-12">
            <button class="btn btn-info btn-lg float-end" data-bs-toggle="modal" data-bs-target="#createftpmodal">
                ADD UPOZILA
            </button>
        </div>
    </div>
    <div class="row mt-4">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col"># DBID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Date</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($upozilas as $upozila)
                    <tr>
                        <th scope="row"> {{ $upozila->id }} </th>
                        <td> {{ $upozila->name }} </td>
                        <td> {{ date('d M Y', strtotime($upozila->created_at)) }} </td>
                        <td>
                            <a href="{{ route('admin.location.upozila.edit', $upozila->id) }}" class="btn btn-info me-1">
                                <i class="ti ti-edit"></i>
                            </a>
                            <a onclick="return confirm('Are you sure you want to delete?')"
                                href="{{ route('admin.location.upozila.delete', $upozila->id) }}" class="btn btn-info me-1">
                                <i class="ti ti-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="createftpmodal" tabindex="-1" aria-labelledby="createftpmodallabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createftpmodallabel">Create Upozila</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.location.upozila.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Upozila Name </label>
                            <input type="text" class="form-control" name="name" id="name" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Create Upozila</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
