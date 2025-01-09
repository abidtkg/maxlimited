@extends('layouts.admin.master')
@section('page-title', 'Unions - Max Limited')
@section('dashboard-content')
    <div class="row">
        <div class="col-12">
            <a class="btn btn-info btn-lg float-end" href="{{ route('admin.location.union.create') }}">
                ADD UNION
            </a>
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
                @foreach ($unions as $union)
                    <tr>
                        <th scope="row"> {{ $union->id }} </th>
                        <td> {{ $union->name }} </td>
                        <td> {{ date('d M Y', strtotime($union->created_at)) }} </td>
                        <td>
                            {{-- <a href="{{ route('admin.location.upozila.edit', $union->id) }}" class="btn btn-info me-1">
                                <i class="ti ti-edit"></i>
                            </a> --}}
                            <a onclick="return confirm('Are you sure you want to delete?')"
                                href="{{ route('admin.location.union.delete', $union->id) }}" class="btn btn-info me-1">
                                <i class="ti ti-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
