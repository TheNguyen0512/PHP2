<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{
    public function index(){
        // if (Gate::allows('admin')){
        //     return view('Admin.index');
        // }else{
        //     redirect()->route('404');
        // }
        return view('Admin.index');
    }
}