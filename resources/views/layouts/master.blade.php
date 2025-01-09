<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('page-title')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/website/images/maxspeed.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/vendors/aos/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/style.min.css') }}">

    <meta name="description"
        content="Stay connected with lightning-fast internet speeds and reliable service from our ISP company. Our cutting-edge technology and dedicated customer support team ensure you have a seamless online experience. Upgrade your internet today!">
    <meta property="og:url" content="https://maxlimited.net/" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="Max Limited" />
    <meta property="og:description"
        content="Stay connected with lightning-fast internet speeds and reliable service from our ISP company. Our cutting-edge technology and dedicated customer support team ensure you have a seamless online experience. Upgrade your internet today!" />
    <meta property="og:image" content="{{ asset('assets/website/assets/images/maxspeed.png') }}" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-JW33YEVCKF"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-JW33YEVCKF');
    </script>

    <!-- INTERNAL PAGE CSS -->
    @yield('internal-page-css')
</head>

<body>

    @include('layouts.web.header')
    {{-- <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </div> --}}
    <main>
        @yield('content')
        @include('layouts.web.footer')
    </main>


    <script src="{{ asset('assets/website/vendors/jquery/jquery.min.js') }} "></script>
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> --}}
    <script src="{{ asset('assets/website/vendors/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/website/vendors/aos/js/aos.js') }}"></script>
    <script src="{{ asset('assets/website/js/landingpage.js') }}"></script>
    @yield('internal-page-js')
</body>

</html>
