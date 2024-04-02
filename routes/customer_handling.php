<?php
use App\Http\Controllers\Customer\Auth\ForgetPasswordController;
use App\Http\Controllers\Customer\Auth\LoginController;
use App\Http\Controllers\Customer\Auth\RegisterController;
use App\Http\Controllers\Customer\IndexController;
use App\Http\Controllers\ErrorController;
use Illuminate\Support\Facades\Route;
Route::prefix('/')->group(function (){
    Route::post('login',  [LoginController::class, 'login'])->middleware('auth.page')->name('post-login');
    Route::post('check-register',  [RegisterController::class, 'checkRegister'])->middleware('auth.page')->name('post-check-register');
    Route::post('register',  [RegisterController::class, 'register'])->middleware('auth.page')->name('post-register');
    Route::post('forget-password', [ForgetPasswordController::class, 'submitForgetPasswordForm'])->name('post-forget-password'); 
    Route::post('reset-password', [ForgetPasswordController::class, 'submitResetPasswordForm'])->name('post-reset-password');
});
