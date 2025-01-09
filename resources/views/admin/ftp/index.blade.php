@extends('layouts.admin.master')
@section('page-title', 'FTP Servers - Max Limited')
@section('dashboard-content')
    <div class="row">
        <div class="col-12">
            <button class="btn btn-info btn-lg float-end" data-bs-toggle="modal" data-bs-target="#createftpmodal">
                ADD SERVER
            </button>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-4 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <div class="mb-4">
                        <h5 class="card-title fw-semibold">Movie Servers</h5>
                    </div>
                    <ol class="list-group list-group-numbered">
                        @foreach ($servers as $server)
                            @if ($server->category == 'movie_server')
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">{{ $server->name }}</div>
                                        <a target="_blank" href="{{ $server->url }}">{{ $server->url }}</a>

                                    </div>
                                    <a href="{{ route('admin.ftp.page.update', $server->id) }}" class="btn btn-info me-1">
                                        <i class="ti ti-edit"></i>
                                    </a>
                                    <a onclick="return confirm('Are you sure you want to delete?')"
                                        href="{{ route('admin.ftp.delete', $server->id) }}" class="btn btn-info">
                                        <i class="ti ti-trash"></i>
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>
        <div class="col-md-4 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <div class="mb-4">
                        <h5 class="card-title fw-semibold">Media Server</h5>
                    </div>
                    <ol class="list-group list-group-numbered">
                        @foreach ($servers as $server)
                            @if ($server->category == 'media_server')
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">{{ $server->name }}</div>
                                        <a target="_blank" href="{{ $server->url }}">{{ $server->url }}</a>
                                    </div>
                                    <a href="{{ route('admin.ftp.page.update', $server->id) }}" class="btn btn-info me-1">
                                        <i class="ti ti-edit"></i>
                                    </a>
                                    <a onclick="return confirm('Are you sure you want to delete?')"
                                        href="{{ route('admin.ftp.delete', $server->id) }}" class="btn btn-info">
                                        <i class="ti ti-trash"></i>
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>
        <div class="col-md-4 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <div class="mb-4">
                        <h5 class="card-title fw-semibold">OTT Platform</h5>
                    </div>
                    <ol class="list-group list-group-numbered">
                        @foreach ($servers as $server)
                            @if ($server->category == 'tv_server')
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">{{ $server->name }}</div>
                                        <a target="_blank" href="{{ $server->url }}">{{ $server->url }}</a>
                                    </div>
                                    <a href="{{ route('admin.ftp.page.update', $server->id) }}" class="btn btn-info me-1">
                                        <i class="ti ti-edit"></i>
                                    </a>
                                    <a onclick="return confirm('Are you sure you want to delete?')"
                                        href="{{ route('admin.ftp.delete', $server->id) }}" class="btn btn-info">
                                        <i class="ti ti-trash"></i>
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="createftpmodal" tabindex="-1" aria-labelledby="createftpmodallabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createftpmodallabel">Create Server</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.ftp.create') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="category" class="form-label">Select Server</label>
                            <select name="category" id="category" class="form-select">
                                <option value="movie_server">Movie Server</option>
                                <option value="media_server">Media Server</option>
                                <option value="tv_server">OTT Platform</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Server Name</label>
                            <input type="text" class="form-control" name="name" id="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="url" class="form-label">Server URL (FULL) </label>
                            <input type="text" class="form-control" name="url" id="url" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Create Server</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
