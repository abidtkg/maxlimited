@extends('layouts.master')
@section('page-title', 'Make Payment - Max Limited')
@section('internal-page-css')
    <style>
        .inputbox {
            height: 100% !important;
            border: 1px solid rgb(69, 69, 69);
        }

        .inputbox:focus {
            border: 1px solid rgb(69, 69, 69);
        }

        .inputbox:active {
            border: 1px solid rgb(69, 69, 69);
        }

        .pay-btn {
            border-radius: 0px !important;
        }
    </style>
@endsection
@section('content')
    <div class="container text-center">
        <div class="row mt-5 pt-5 pb-5 mb-5">
            <div class="col-md-12">
                {{-- <img src="{{ asset('assets/website/images/bkash_payment_logo.png') }}" alt="bkash-payment" class="img-fluid" style="max-width: 250px"> --}}
                <p class="mt-3">
                    নিচের অংশে আপনার ক্লায়েন্ট ID দিয়ে "PAY BILL" বাটনে ক্লিক করুন <br>
                    বিকাশের পেমেন্টের মাধ্যমে খুব সহজেই আপনার ইন্টারনেট বিল পেমেন্ট করুন! <br>
                    পেমেন্ট সংক্রান্ত যে কোন সমস্যার জন্যে আমাদের <a href="/"
                        class="text-info text-underline">সাপোর্টে</a> যোগাযোগ করুন।
                </p>
                <p></p>
            </div>
            <div class="col-md-12">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="agree_check" onclick='handleCheckboxClick(this);'>
                    <label class="form-check-label" for="agree_check">
                        I agree with the <a class="text-info" href="{{ route('policy.privacy') }}">Privacy Policy</a>,
                        <a class="text-info" href="{{ route('terms') }}">Terms and Conditions</a>, and
                        <a class="text-info" href="{{ route('policy.refund') }}">Refund Policy</a>.
                    </label>
                </div>
            </div>
            <div class="col-md-12 d-flex justify-content-center mt-4 mb-5 pb-5">
                <form class="input-group" style="max-width: 400px;" action="https://hotspot.maxlimited.net/pay.php" method="GET">
                    <input name="q" type="text" placeholder="Enter Client ID" class="form-control inputbox" required>
                    <button class="btn btn-dark pay-btn" id="submitbutton" type="submit" disabled>PAY BILL</button>
                </form>
            </div>
        </div>
    </div>

    <script>
    function handleCheckboxClick(cb) {
        if(cb.checked == true){
            document.getElementById('submitbutton').disabled = false;
        }else{
            document.getElementById('submitbutton').disabled = true;
        }
    }
    </script>
@endsection
