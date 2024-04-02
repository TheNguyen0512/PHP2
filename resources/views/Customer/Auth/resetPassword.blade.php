@extends('Components.customer.index')
@section('title')
<title>Home</title>
@endsection
@section('Css')
@endsection
@section('Js')
<script src="{{asset('js/reset.password.js')}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
@section('content')
<div class="container p-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Reset Password
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('post-reset-password')}}">
                        @csrf
                        <!-- <input type="hidden" id="token" name="token" value="{{ $token }}"> -->
                        <div class="form-group">
                            <label for="newPassword">New Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="{{ old('password') }}" placeholder="Enter passowrd">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror 
                        </div>
                        <div class="form-group">
                            <label for="confirmPassword">Confirm Password</label>
                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Enter confirm passowrd">
                            @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror 
                        </div>
                        <button type="submit" class="btn btn-primary">Change Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection