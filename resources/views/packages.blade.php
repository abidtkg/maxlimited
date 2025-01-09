@extends('layouts.master')
@section('page-title', 'Packages - Max Limited')
@section('internal-page-css')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Alkatra:wght@400;600&family=Noto+Sans:ital,wght@0,300;0,400;0,600;0,900;1,300;1,900&display=swap');
        @import url(//fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700,800);

        .pricing1 {
            font-family: "Montserrat", sans-serif;
            color: #8d97ad;
            font-weight: 300;
        }

        .pricing1 h1,
        .pricing1 h2,
        .pricing1 h3,
        .pricing1 h4,
        .pricing1 h5,
        .pricing1 h6 {
            color: #3e4555;
        }

        .pricing1 .font-weight-medium {
            font-weight: 500;
        }

        .pricing1 .bg-light {
            background-color: #f4f8fa !important;
        }

        .pricing1 .subtitle {
            color: #8d97ad;
            line-height: 24px;
            font-size: 14px;
        }

        .pricing1 .font-14 {
            font-size: 14px;
        }

        .pricing1 h5 {
            line-height: 22px;
            font-size: 18px;
        }

        .pricing1 .card.card-shadow {
            -webkit-box-shadow: 0px 0px 30px rgba(115, 128, 157, 0.1);
            box-shadow: 0px 0px 30px rgba(115, 128, 157, 0.1);
        }

        .pricing1 .on-hover {
            -webkit-transition: 0.1s;
            -o-transition: 0.1s;
            transition: 0.1s;
        }

        .pricing1 .on-hover:hover {
            -ms-transform: scale(1.05);
            transform: scale(1.05);
            -webkit-transform: scale(1.05);
            -webkit-font-smoothing: antialiased;
        }

        .pricing1 .btn-md {
            padding: 15px 30px;
            font-size: 16px;
        }

        .pricing1 .onoffswitch {
            width: 70px;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            margin: 0 auto;
        }

        .pricing1 .onoffswitch-label {
            cursor: pointer;
            border: 2px solid transparent;
            border-radius: 20px;
        }

        .pricing1 .onoffswitch-inner {
            width: 200%;
            margin-left: -100%;
            -webkit-transition: margin 0.3s ease-in 0s;
            -o-transition: margin 0.3s ease-in 0s;
            transition: margin 0.3s ease-in 0s;
        }

        .pricing1 .onoffswitch-inner::before,
        .pricing1 .onoffswitch-inner::after {
            display: block;
            float: left;
            width: 50%;
            height: 30px;
            padding: 0;
            line-height: 30px;
            font-size: 14px;
            color: white;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
        }

        .pricing1 .onoffswitch-inner::before {
            content: "";
            padding-right: 27px;
            background-color: #2cdd9b;
            color: #FFFFFF;
        }

        .pricing1 .onoffswitch-inner::after {
            content: "";
            padding-right: 24px;
            background-color: #3e4555;
            color: #999999;
            text-align: right;
        }

        .pricing1 .onoffswitch-switch {
            width: 23px;
            margin: 6px;
            height: 23px;
            top: -1px;
            bottom: 0;
            right: 35px;
            border-radius: 20px;
            -webkit-transition: all 0.3s ease-in 0s;
            -o-transition: all 0.3s ease-in 0s;
            transition: all 0.3s ease-in 0s;
        }

        .pricing1 .onoffswitch-checkbox:checked+.onoffswitch-label .onoffswitch-inner {
            margin-left: 0;
        }

        .pricing1 .onoffswitch-checkbox:checked+.onoffswitch-label .onoffswitch-switch {
            right: 0px;
        }

        .pricing1 .price-badge {
            top: -13px;
            left: 0;
            right: 0;
            width: 100px;
            margin: 0 auto;
        }

        .pricing1 .badge-inverse {
            background-color: #3e4555;
        }

        .pricing1 .display-5 {
            font-size: 3rem;
            color: #263238;
        }

        .pricing1 .pricing sup {
            font-size: 18px;
            top: -20px;
        }

        .pricing1 .pricing .yearly {
            display: none;
        }

        .package-name {
            font-size: 2.5rem !important;
            font-family: 'Alkatra'
        }

        .btn-info:hover {
            background-color: #1998ff;
            color: white;
        }
    </style>
@endsection
@section('content')
    <div class="container mt-5">
        <div class="pricing1 py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 text-center">
                        <h3 class="mt-3 font-weight-medium mb-1">Internet Packages</h3>
                        <h6 class="subtitle">High speed Optical Fiber internet connectivity right to your door steps</h6>
                        <a class="btn btn-lg btn-info mt-2" href="{{ route('packages') }}">
                            Home Package
                        </a>
                        <a class="btn btn-lg btn-outline-info mt-2" href="{{ route('packages.hotspot') }}">
                            Hotspot Package
                        </a>
                    </div>
                </div>
                <!-- Row  -->
                <div class="row mt-5">
                    <!-- Column -->
                    @foreach ($packages as $package)
                        <div class="col-lg-3 col-md-6">
                            <div class="card card-shadow on-hover border-0 mb-4">
                                <div class="card-body font-14">
                                    <div class="text-center">
                                        <h5 class="mt-3 mb-1 font-weight-medium package-name">{{ $package->name }}</h5>
                                        <h5 class="mt-3 mb-1 font-weight-medium" style="font-weight: bold">
                                            {{ $package->speed }}
                                            {{ $package->speed_type }} </h5>
                                        {{-- <h6 class="subtitle font-weight-normal">For Team of 3-5 Members</h6> --}}
                                        <div class="pricing
                                            my-3">
                                            <sup>৳</sup>
                                            <span class="monthly display-5">{{ $package->price }} </span>
                                            <span class="yearly display-5">240</span>
                                            <small class="monthly">/mo</small>
                                        </div>
                                    </div>

                                    <p style="white-space: pre;"> {{ $package->description }} </p>
                                    <div class="bottom-btn">
                                        <a class="btn btn-dark btn-md  btn-block" href="{{ route('conreq.page') }}">
                                            <span>Choose Plan</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
