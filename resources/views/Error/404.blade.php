@extends('Components.customer.index')
@section('title')
<title>404</title>
@endsection
@section('Css')
<link rel="stylesheet" href="{{asset('css/error.css')}}">
@endsection
@section('content')
<div class="container">
<div class="error-404">
    <div class="error-code m-b-10 m-t-20">404 <i class="fa fa-warning"></i></div>
    <h2 class="font-bold">Oops 404! That page can’t be found.</h2>

    <div class="error-desc">
        Sorry, but the page you are looking for was either not found or does not exist. <br/>
        Try refreshing the page or click the button below to go back to the Homepage.
        <div><br/>
            <!-- <a class=" login-detail-panel-button btn" href="http://vultus.de/"> -->
            <a href="{{route('home')}}" class="btn btn-primary"><span class="glyphicon glyphicon-home"></span> Go back to Homepage</a>
        </div>
    </div>
</div>
</div>
@endsection