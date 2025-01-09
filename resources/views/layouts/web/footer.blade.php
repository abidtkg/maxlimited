<section class="contact-details container mt-4" id="contact-details-section">
    <div class="row text-center text-md-left">
        <div class="col-12 col-md-6 col-lg-4 grid-margin">
            <img src="{{ asset('assets/website/images/maxspeed.png') }}" alt="" class="pb-2"
                style="height: auto; width: 70%;">
            <div class="pt-2">
                <p class="text-muted m-0">contact@maxlimited.net</p>
                <a class="text-muted m-0" href="tel:+8801722272781">+88 01722272781</a>
            </div>
        </div>
        <!-- <div class="col-12 col-md-6 col-lg-3 grid-margin">
          <h5 class="pb-2">Get in Touch</h5>
          <p class="text-muted">Don't miss any updates of our new templates and extensions.!</p>
          <form>
            <input type="text" class="form-control" id="Email" placeholder="Email id">
          </form>
          <div class="pt-3">
            <button class="btn btn-dark">Subscribe</button>
          </div>
        </div> -->
        <div class="col-12 col-md-6 col-lg-4 grid-margin">
            <h5 class="pb-2">Our Guidelines</h5>
            <a href="{{ route('terms') }}">
                <p class="m-0 pb-2">Terms & Conditions</p>
            </a>
            <a href="{{ route('policy.privacy') }}">
                <p class="m-0 pb-2">Privacy Policy</p>
            </a>
            <a href="{{ route('policy.refund') }}">
                <p class="m-0 pb-2">Refund Policy</p>
            </a>
            <a href="#">
                <p class="m-0 pt-1 pb-2">Contact With Us</p>
            </a>
        </div>
        <div class="col-12 col-md-6 col-lg-4 grid-margin">
            <h5 class="pb-2">Our address</h5>
            <p class="text-muted"> {{ config('app.name', 'Laravel') }} provides high speed broadband service in Jaldhaka, Nilphamari</p>
            <p>Trade Licence No: 2839-00</p>
            <div class="d-flex justify-content-center justify-content-md-start">
                <a href="#"><span class="mdi mdi-facebook"></span></a>
                <a href="#"><span class="mdi mdi-twitter"></span></a>
                <a href="#"><span class="mdi mdi-instagram"></span></a>
                <a href="#"><span class="mdi mdi-linkedin"></span></a>
            </div>
        </div>
    </div>
</section>

<footer class="border-top">
    <div class="text-center">
        <img src="{{ asset('assets/website/images/PaymentChannelsFooterSSL.png') }}" alt="SSLCOM" class="img-fluid" style="max-width: 80%">
    </div>
    <p class="text-center text-muted pt-4">Copyright © 2024<a href="https://maxlimited.net" class="px-1">Max limited</a>All rights reserved.</p>
</footer>
