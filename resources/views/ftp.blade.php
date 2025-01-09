@extends('layouts.master')
@section('page-title', 'Max Limited')
@section('content')
    <div class="container mt-5 mb-5 pb-5">
        <div class="row mt-4">
            <div class="col-md-4 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-body p-4">
                        <div class="mb-4">
                            <h5 class="card-title fw-semibold">Movie Servers</h5>
                        </div>
                        <ul class="list-group">
                            @foreach ($servers as $server)
                                @if ($server->category == 'movie_server')
                                    <li class="list-group-item">
                                        <a target="_blank" href="{{ $server->url }}"
                                            style="font-size: large; text-transform:uppercase"
                                            class="text-info">{{ $server->name }}</a>
                                        <a target="_blank" href="{{ $server->url }}"
                                            class="btn btn-outline-info float-right" style="padding: 5px 15px 5px 15px;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-box-arrow-up-right" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                    d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z" />
                                                <path fill-rule="evenodd"
                                                    d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z" />
                                            </svg>
                                        </a>
                                    </li>
                                @endif
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-body p-4">
                        <div class="mb-4">
                            <h5 class="card-title fw-semibold">Media Server</h5>
                        </div>
                        <ul class="list-group">
                            @foreach ($servers as $server)
                                @if ($server->category == 'media_server')
                                    <li class="list-group-item">
                                        <a target="_blank" href="{{ $server->url }}"
                                            style="font-size: large; text-transform:uppercase"
                                            class="text-info">{{ $server->name }}</a>
                                        <a target="_blank" href="{{ $server->url }}"
                                            class="btn btn-outline-info float-right" style="padding: 5px 15px 5px 15px;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-box-arrow-up-right" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                    d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z" />
                                                <path fill-rule="evenodd"
                                                    d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z" />
                                            </svg>
                                        </a>
                                    </li>
                                @endif
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-body p-4">
                        <div class="mb-4">
                            <h5 class="card-title fw-semibold">OTT Platform</h5>
                        </div>
                        <ul class="list-group">
                            @foreach ($servers as $server)
                                @if ($server->category == 'tv_server')
                                    <li class="list-group-item">
                                        <a target="_blank" href="{{ $server->url }}"
                                            style="font-size: large; text-transform:uppercase"
                                            class="text-info">{{ $server->name }}</a>
                                        <a target="_blank" href="{{ $server->url }}"
                                            class="btn btn-outline-info float-right" style="padding: 5px 15px 5px 15px;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-box-arrow-up-right" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                    d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z" />
                                                <path fill-rule="evenodd"
                                                    d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z" />
                                            </svg>
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
