@extends('Components.customer.index')
@section('title')
<title>Forget Password</title>
@endsection
@section('Css')
<link rel="stylesheet" href="{{asset('css/login.css')}}">
<link rel="stylesheet" href="{{asset('css/snippet.css')}}">
@endsection
@section('Js')
<script src="{{asset('js/forget.password.js')}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
@section('content')
<section class="login-block">
    <div class="container login-back">
        <div class="row">
            <div class="col-md-4 login-sec" id="forget">
                <div class="panel-body">
                    <div class="text-center">
                        <img class="icon-for" src="https://usa.afsglobal.org/SSO/SelfPasswordRecovery/images/send_reset_password.svg?v=3" alt="car-key" border="0">
                        <h2 class="text-center">Forgot Password?</h2>
                        @if (session('error_message'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error_message') }}
                        </div>
                        @endif
                        @if (session('success'))
                        <div class="alert alert-primary" role="alert">
                            {{ session('success') }}
                        </div>
                        @endif
                        <form method="post" action="{{ route('post-forget-password')}}" id="form-forget-password">
                            @csrf
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                    <input type="text" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" id="email" name="email" placeholder="Enter email">
                                    @error('email')
                                        <div class="invalid-feedback" id="message-forget">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-primary btn-block btnForget" >Reset Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- <div class="col-md-4 snippet-sec" id="snippet" style="display: none;">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="loader6">
                                <span class="loader-inner"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->

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