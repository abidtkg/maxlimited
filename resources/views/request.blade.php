@extends('layouts.master')
@section('page-title', 'ISP Connection Request - Max Limited')
@section('internal-page-css')

@endsection
@section('content')
    <div class="container mt-5 mb-5">
        <form action="{{ route('conreq.create') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mt-2">
                    <label for="name" class="form-label">আপনার নাম</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                        id="name" value="{{ old('name') }}">
                    @error('name')
                        <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>
                <div class="col-md-6 mt-2">
                    <label for="phone" class="form-label">মোবাইল</label>
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone"
                        id="phone" value="{{ old('phone') }}">
                    @error('phone')
                        <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>
                <div class="col-md-6 mt-2">
                    <div class="form-group">
                        <label for="upozila">উপজেলা সিলেক্ট করুন</label>
                        <select class="form-control" id="upozila" name="upozila" onchange="upozilaChanged(this)">
                            <option value="">উপজেলা বাছুন</option>
                            @foreach ($upozilas as $upozila)
                                <option value="{{ $upozila->id }}"> {{ $upozila->name }} </option>
                            @endforeach
                        </select>
                        @error('upozila')
                            <span class="text-danger"> {{ $message }} </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 mt-2">
                    <div class="form-group">
                        <label for="union">ইউনিয়ন সিলেক্ট করুন</label>
                        <select class="form-control" id="union" name="union">

                        </select>
                        @error('upozila')
                            <span class="text-danger"> {{ $message }} </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 mt-2">
                    <div class="form-group">
                        <label for="package">ইন্টারনেট প্যাকেজ সিলেক্ট করুন</label>
                        <select class="form-control" id="package" name="package">
                            @foreach ($packages as $package)
                                <option
                                    value="{{ $package->name }} - {{ $package->speed }} {{ $package->speed_type }} @
                                    {{ $package->price }} TAKA">
                                    {{ $package->name }} - {{ $package->speed }} {{ $package->speed_type }} @
                                    {{ $package->price }} TAKA </option>
                            @endforeach
                        </select>
                        @error('package')
                            <span class="text-danger"> {{ $message }} </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12 mt-2">
                    <label for="address" class="form-label">বিস্তারিত ঠিকানা</label>
                    <input type="text" class="form-control @error('address') is-invalid @enderror" name="address"
                        id="address" value="{{ old('phone') }}">
                    @error('address')
                        <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>
                <div class="col-md-12 mt-2">
                    <label for="near_bazar" class="form-label">আপনার আশেপাশের বাজারের নাম লিখুন</label>
                    <input type="text" class="form-control @error('near_bazar') is-invalid @enderror" name="near_bazar"
                        id="near_bazar" value="{{ old('phone') }}">
                    @error('near_bazar')
                        <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>
                <div class="col-md-12 mt-2">
                    <label for="dis_provider" class="form-label">আপনার এলাকার ডিশ ব্যাবসায়ীর নাম (যদি জানা থাকে)</label>
                    <input type="text" class="form-control @error('dis_provider') is-invalid @enderror"
                        name="dis_provider" id="dis_provider" value="{{ old('phone') }}">
                    @error('dis_provider')
                        <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>
                <div class="col-md-12 mt-2">
                    <label for="why_need" class="form-label">আপনার ইন্টারনেট কানেকশন নেয়ার কারন? (বাসা, অফিস, ব্যাবস্যা
                        প্রতিষ্ঠান, অন্যান্য)</label>
                    <input type="text" class="form-control @error('why_need') is-invalid @enderror" name="why_need"
                        id="why_need" value="{{ old('phone') }}">
                    @error('why_need')
                        <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-info mt-4">SUBMIT</button>
        </form>

    </div>

    <script>
        let unions = [];
        let unionViewHtml = '';
        fetch('/api/unions')
            .then(response => response.json())
            .then(data => unions = data)
            .catch(err => console.error(err));

        function upozilaChanged(upozila) {
            unionViewHtml = '';
            let upozilaId = +upozila.value;
            for (let union of unions) {
                if (union.upozila_id == upozilaId) {
                    unionViewHtml += `
                    <option value='${union.name}'>${union.name}</option>
                    `;
                }
                document.getElementById('union').innerHTML = unionViewHtml;
            }
        }
    </script>

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
@endsection
