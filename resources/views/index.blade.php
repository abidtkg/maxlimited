@extends('layouts.master')
@section('page-title', 'Max Limited')
@section('internal-page-css')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500&display=swap');

        a {
            text-decoration: none;
        }

        .service-content-cart .img-content {
            width: 5.4rem;
            height: 5.4rem;
            border-radius: 50%;
            background-color: rgb(247, 247, 247);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
        }

        .service-content-cart .img-content img {
            width: 70px;
            height: 70px;
        }

        .service-content-cart .text {
            color: #4d4b4b;
            font-size: 15px;
            font-weight: 500;
            padding-top: 6px;
        }

        .title_service {
            font-size: 26px;
            color: #787676;
            text-align: center;
            font-weight: 400;
            position: relative;
        }

        .title_service::after {
            content: '';
            position: absolute;
            width: 50px;
            height: 1px;
            background: #3D8E45;
            bottom: -1px;
            left: calc(50% - 24px)
        }

        .title_service::before {
            content: '';
            position: absolute;
            width: 100px;
            height: 1px;
            background: #ddd;
            bottom: -1px;
            left: calc(50% - 50px);
        }

        .marque-text {
            font-family: 'Hind Siliguri', sans-serif;
            background-color: #1D83D4;
            font-size: 2rem;
            color: white;
            border-radius: 5px;
            padding: 5px 0 5px 0px;
        }

        @media only screen and (max-width: 600px) and (min-width: 200px) {
            .marque-text {
                font-size: large;
            }
        }
    </style>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
@endsection
@section('content')
    <div class="banner">
        <div class="slider-box container">
            <div class="homesliders">
                @foreach ($sliders as $slider)
                    <img src="{{ asset('/uploads/' . $slider->url) }}" alt="Slider" width="100%">
                @endforeach
            </div>
        </div>

        <section class="service-area-sc bg-white py-5 pt-5 pb-5 mb-5 container font-bn">
            @if ($notice)
                <marquee class="marque-text">
                    {{ $notice->value }}
                </marquee>
            @endif
            <h2 class="title_service">SERVICES</h2>

            <div class="service-content-warper mb-5">
                <div class="row">
                    <div class="col-4 col-xl-2 mt-4">
                        <a href="https://customer.maxlimited.net/customer/login.php" class="service-content-cart">
                            <div class="img-content">
                                <img src="{{ asset('assets/website/images/isp_xs2a4c.png') }}" alt="ISP">
                            </div>
                            <div class="text-center px-2 text">ISP Login</div>
                        </a>
                    </div>
                    <div class="col-4 col-xl-2 mt-4">
                        <a href="{{ route('payment') }}" class="service-content-cart">
                            <div class="img-content">
                                <img src="{{ asset('assets/website/images/payment-method.png') }}" alt="bKash Pay">
                            </div>
                            <div class="text-center px-2 text">Online Payment</div>
                        </a>
                    </div>
                    <div class="col-4 col-xl-2 mt-4">
                        <a href="{{ route('web.freewifi') }}" class="service-content-cart">
                            <div class="img-content">
                                <img class="ms-2" src="{{ asset('assets/website/images/wifi_2_jellvt.png') }}"
                                    alt="Free WiFi">
                            </div>
                            <div class="text-center px-2 text">Free WiFi</div>
                        </a>
                    </div>
                    <div class="col-4 col-xl-2 mt-4">
                        <a href="{{ route('packages') }}" class="service-content-cart">
                            <div class="img-content">
                                <img class="ms-2" src="{{ asset('assets/website/images/internet.png') }}" alt="Free WiFi">
                            </div>
                            <div class="text-center px-2 text">Internet Packages</div>
                        </a>
                    </div>
                    <div class="col-4 col-xl-2 mt-4">
                        <a href="{{ route('ftp.servers') }}" class="service-content-cart">
                            <div class="img-content">
                                <img class="ms-2" src="{{ asset('assets/website/images/ftp.png') }}" alt="Free WiFi">
                            </div>
                            <div class="text-center px-2 text">FTP Servers</div>
                        </a>
                    </div>
                    <div class="col-4 col-xl-2 mt-4">
                        <a href="{{ route('conreq.page') }}" class="service-content-cart">
                            <div class="img-content">
                                <img class="ms-2" src="{{ asset('assets/website/images/router.png') }}" alt="Free WiFi">
                            </div>
                            <div class="text-center px-2 text">New Connection </div>
                        </a>
                    </div>
                    <div class="col-4 col-xl-2 mt-4">
                        <a href="https://maxskyhost.com/" target="_blank" class="service-content-cart"
                            style="cursor: pointer;">
                            <div class="img-content">
                                <img src="{{ asset('assets/website/images/cloud-server_ohah18.png') }}" alt="Hosting">
                            </div>
                            <div class="text-center px-2 text">Hosting</div>
                        </a>
                    </div>
                    <div class="col-4 col-xl-2 mt-4">
                        <a (click)="comingSoon()" class="service-content-cart" style="cursor: pointer;">
                            <div class="img-content">
                                <img src="{{ asset('assets/website/images/app-development_y0gns0.png') }}" alt="Web Dev.">
                            </div>
                            <div class="text-center px-2 text">Web Dev.</div>
                        </a>
                    </div>
                    <div class="col-4 col-xl-2 mt-4">
                        <a (click)="comingSoon()" class="service-content-cart" style="cursor: pointer;">
                            <div class="img-content">
                                <img src="{{ asset('assets/website/images/camera_fv02jp.png') }}"
                                    alt="Photo & Videography">
                            </div>
                            <div class="text-center px-2 text">Photo & Videography</div>
                        </a>
                    </div>
                    <div class="col-4 col-xl-2 mt-4">
                        <a href="/blog" class="service-content-cart">
                            <div class="img-content">
                                <img src="{{ asset('assets/website/images/blogging_vrrppz.png') }}" alt="Blog">
                            </div>
                            <div class="text-center px-2 text">Blog</div>
                        </a>
                    </div>
                    <div class="col-4 col-xl-2 mt-4">
                        <a href="https://nilphamarishop.com/" target="_blank" class="service-content-cart">
                            <div class="img-content">
                                <img src="{{ asset('assets/website/images/nilphamarishop_gliw3r.png') }}"
                                    alt="Nilphamari Shop">
                            </div>
                            <div class="text-center px-2 text">Nilphamari Shop</div>
                        </a>
                    </div>
                    <div class="col-4 col-xl-2 mt-4">
                        <a href="{{ route('login') }}" class="service-content-cart">
                            <div class="img-content">
                                <img src="{{ asset('assets/website/images/account-protection.png') }}"
                                    alt="Somity Hisab">
                            </div>
                            <div class="text-center px-2 text">Panel Login</div>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('internal-page-js')
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <script>
        $('.homesliders').slick({
            dots: false,
            infinite: true,
            speed: 300,
            accessibility: false,
            prevArrow: false,
            nextArrow: false,
            autoplay: true,
            autoplaySpeed: 2000,
            // lazyLoad: 'progressive'
        });

        // ADD CONTAINER CLASS IF DESKTOP
        $(function() {
            let isMobile = window.matchMedia("only screen and (max-width: 760px)").matches;

            if (isMobile) {
                $('.slider-box').removeClass('container');
            }
        });
    </script>
@endsection
