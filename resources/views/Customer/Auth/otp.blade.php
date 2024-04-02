@extends('Components.customer.index')
@section('title')
<title>OTP</title>
@endsection
@section('Css')
<link rel="stylesheet" href="{{asset('css/login.css')}}">
<link rel="stylesheet" href="{{asset('css/snippet.css')}}">
@endsection
@section('Js')
<script src="{{asset('js/otp.js')}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
@section('content')
<section class="login-block">
    <div class="container login-back">
        <div class="row">
            <div class="col-md-4 login-sec " id="otp">
                <h2 class="text-center">Otp</h2>
                @if (session('error_message'))
                <div class="message-error" id="message-login-error">
                    {{ session('error_message') }}
                </div>
                @endif
                <form method="post" action="{{ route('post-register')}}" id="form-otp">
                    @csrf
                    <div class="message-error" id="message-otp-error"></div>
                    <div class="form-group">
                        <div class="input-group has-validation">
                            <span class="input-group-text"><i class="fa fa-commenting-o" aria-hidden="true"></i></span>
                            <input type="number" class="form-control" id="otp" name="otp" value="{{ old('otp') }}" placeholder="Enter otp">
                        </div>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <a href="javascript:void(0);">Sent otp again ?</a>
                        </label>
                        <button type="submit" class="btn btn-login float-right" onclick="verify()">Confirm</button>
                    </div>
                </form>
                <a href="javascript:void(0);"><- Back</a>
            </div>
            <div class="col-md-4 snippet-sec" id="snippet" style="display: none;">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="loader6">
                                <span class="loader-inner"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8 banner-sec" style="padding: 0;">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active">
                            <img class="d-block img-login" src="{{asset('img/login/anh10.png')}}" alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block img-login" src="{{asset('img/login/linh-kien-may-tinh.png')}}" alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block img-login" src="{{asset('img/login/tin-tuc-981.png')}}" alt="First slide">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('sweetalert::alert')
@endsection