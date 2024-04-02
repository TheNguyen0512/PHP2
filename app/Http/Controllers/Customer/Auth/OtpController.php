<?php

namespace App\Http\Controllers\Customer\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;

class OTPController extends Controller
{
    public function __construct()
    {
        $this->middleware('otp.page');
    }
    public function index(){
        return view('Customer.Auth.otp');
    }

}