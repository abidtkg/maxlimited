<style>
    @media only screen and (max-width: 1200px) {
        /*Tablets [601px -> 1200px]*/
    }

    @media only screen and (max-width: 600px) {
        .nav-item {
            width: 100% !important;
        }
    }

    @media only screen and (max-width: 425px) {
        /*Small smartphones [325px -> 425px]*/
    }
</style>
<header id="header-section">
    <nav class="navbar navbar-expand-lg pl-3 pl-sm-0" id="navbar" style="padding-top: 10px; padding-bottom: 10px;">
        <div class="container">
            <div class="navbar-brand-wrapper d-flex w-100">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('assets/website/images/maxspeed.png') }}" width="auto" height="50px"alt="">
                </a>
                <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="mdi mdi-menu navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse navbar-menu-wrapper" id="navbarSupportedContent">
                <ul class="navbar-nav align-items-lg-center align-items-start ml-auto">
                    <li class="d-flex align-items-center justify-content-between pl-4 pl-lg-0">
                        <div class="navbar-collapse-logo">
                            <a href="{{ route('home') }}">
                                <img src="{{ asset('assets/website/images/maxspeed.png') }}" width="auto"
                                    height="50px" alt="">
                            </a>
                        </div>
                        <button class="navbar-toggler close-button" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="mdi mdi-close navbar-toggler-icon pl-5"></span>
                        </button>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('aboutus') }}">About</a>
                    </li>
                    <li class="nav-item" style="width: 115px;" routerLinkActive="active">
                        <a class="nav-link" href="{{ route('packages') }}">Packages</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('conreq.page') }}">Request</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ asset('assets/website/pdf/max-speed.pdf') }}"
                            style="width: 195px !important;">BTRC
                            Approved Tariff</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://www.facebook.com/maxspeedinternet">FB</a>
                    </li>
                    <li class="nav-item btn-contact-us pl-4 pl-lg-0">
                        <!-- <button class="btn btn-info" data-toggle="modal" data-target="#exampleModal">Contact Us</button> -->
                        <a class="btn btn-info" href="https://customer.maxlimited.net/">LOGIN</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
