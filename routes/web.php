<?php


use Illuminate\Support\Facades\Route;


include_once __DIR__.'/customer.php';
include_once __DIR__.'/customer_handling.php';
include_once __DIR__.'/admin.php';
include_once __DIR__.'/admin_handling.php';
Route::get('/{any}', function () {
    return redirect()->route('404');
})->where('any', '.*');