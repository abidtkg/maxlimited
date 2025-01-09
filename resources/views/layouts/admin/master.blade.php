<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('page-title') </title>
    <link rel="stylesheet" href="{{ asset('assets/admin/css/styles.min.css') }}" />
    @yield('page-css');
</head>

<body>

    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->

        @include('layouts.admin.sidebar')
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            @include('layouts.admin.header')
            <!--  Header End -->
            <div class="container-fluid">
                @yield('dashboard-content')
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/admin/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/admin/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('assets/admin/js/app.min.js') }}"></script>
    <script src="{{ asset('assets/admin/libs/simplebar/dist/simplebar.js') }}"></script>
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
</body>

</html>
