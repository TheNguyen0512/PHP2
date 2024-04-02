@extends('Components.customer.index')
@section('title')
<title>Login</title>
@endsection
@section('Css')
<link rel="stylesheet" href="{{asset('css/login.css')}}">
<link rel="stylesheet" href="{{asset('css/snippet.css')}}">
@endsection
@section('Js')
<script src="{{asset('js/login.js')}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
@section('load')
@if ($errors->any() == false && session('error_message') == false)
<div id="preloder">
    <div class="loader"></div>
</div>
@endif
@endsection
@section('content')
<section class="login-block">
    <div class="container login-back">
        <div class="row">
            <div class="col-md-4 login-sec" id="sgin-in">
                <h2 class="text-center">Login</h2>
                @if (session('error_message'))
                <div class="message-error" id="message-login-error">
                    {{ session('error_message') }}
                </div>
                @endif
                <form method="post" action="{{ route('post-login')}}" id="form-login">
                    @csrf
                    <div class="form-group">
                        <div class="input-group mb-3 has-validation">
                            <span class="input-group-text"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Enter email">
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fa fa-key" aria-hidden="true"></i></span>
                            <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}" placeholder="Enter passowrd">
                            <div class="invalid-feedback" id="message-error-password-login"></div>
                        </div>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" id="showPassword">
                            <small>Show password</small>
                        </label>
                        <button type="submit" class="btn btn-login float-right">Login</button>
                    </div>
                </form>
                <div class="copy-text">
                    You don't have an account yet? <a href="{{route('register')}}">Register</a><br>
                    <a href="{{route('forget-password')}}">You forgot your password?</a>
                </div>
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