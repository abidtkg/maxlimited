@extends('layouts.admin.master')
@section('page-title', 'Update FTP Serer - Max Limited')
@section('dashboard-content')
    <div>
        <div class="container">
            <form action="{{ route('admin.ftp.update') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $server->id }}">
                <div class="mb-3">
                    <label for="category" class="form-label">Select Server</label>
                    <select name="category" id="category" class="form-select">
                        <option value="movie_server" @if ($server->category == 'movie_server') {{ 'selected' }} @endif>Movie
                            Server</option>
                        <option value="media_server" @if ($server->category == 'media_server') {{ 'selected' }} @endif>Media
                            Server</option>
                        <option value="tv_server" @if ($server->category == 'tv_server') {{ 'selected' }} @endif>OTT Platform
                        </option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Server Name</label>
                    <input type="text" value="{{ $server->name }}" class="form-control" name="name" id="name"
                        required>
                </div>
                <div class="mb-3">
                    <label for="url" class="form-label">Server URL (FULL) </label>
                    <input type="text" value="{{ $server->url }}" class="form-control" name="url" id="url"
                        required>
                </div>
                <div class="flot-left">
                    <button type="submit" class="btn btn-primary">Update Server</button>
                </div>
            </form>
        </div>
    </div>
@endsection
