<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

class ErrorController extends Controller
{
    public function __construct()
    {
    }
    public function page404(){
        return view('Error.404');
    }
}