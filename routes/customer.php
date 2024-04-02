<?php

use App\Http\Controllers\Customer\Auth\ForgetPasswordController;
use App\Http\Controllers\Customer\Auth\LoginController;
use App\Http\Controllers\Customer\Auth\OTPController;
use App\Http\Controllers\Customer\Auth\RegisterController;
use App\Http\Controllers\Customer\Categories\CategoriesController;
use App\Http\Controllers\Customer\IndexController;
use App\Http\Controllers\Customer\Shop\ProductsController;
use App\Http\Controllers\ErrorController;
use Illuminate\Support\Facades\Route;
Route::prefix('/')->group(function (){
    Route::get('/', [IndexController::class, 'index'])->name('home');
    Route::get('login', [LoginController::class, 'index'])->middleware('auth.page')->name('login');
    Route::get('register', [RegisterController::class, 'index'])->middleware('auth.page')->name('register');
    Route::get('otp', [OTPController::class, 'index'])->name('otp');
    Route::get('success-message', [LoginController::class , 'success'])->name('success-message');
    Route::get('logout',  [LoginController::class, 'logout'])->name('logout');
    Route::get('forget-password', [ForgetPasswordController::class, 'index'])->middleware('auth.page')->name('forget-password');
    Route::get('reset-password/{token}', [ForgetPasswordController::class, 'showResetPasswordForm'])->middleware('reset.password.page')->name('reset.password.link');
    Route::get('/c', [CategoriesController::class, 'showAll'])->name('category.showAll');
    Route::get('/c/{id}', [CategoriesController::class, 'show'])->name('category.show');
    Route::get('/c/{id}/details', [ProductsController::class, 'showproduct'])->name('product.show');
    Route::get('404', [ErrorController::class, 'page404'])->name('404');
});