<?php

use App\Http\Controllers\Admin\Categories\CategoriesController;
use App\Http\Controllers\Admin\Permission\PermissionController;
use App\Http\Controllers\Admin\Products\ProductsController;
use App\Http\Controllers\Customer\Auth\LoginController;
use Illuminate\Support\Facades\Route;
Route::prefix('admin')->group(function (){
    Route::prefix('/category')->group(function (){
        Route::post('/create',  [CategoriesController::class, 'create'])->name('post-categories-create'); 
        Route::post('/update/{id}', [CategoriesController::class, 'update'])->name('post-categories-update'); 
    });
    Route::prefix('/permission')->group(function (){
        Route::post('/create',  [PermissionController::class, 'create'])->name('post-permission-create'); 
    });
    Route::prefix('/product')->group(function (){
        Route::post('/create',[ProductsController::class, 'create'])->name('post-products-create');
        Route::post('/update/{id}',[ProductsController::class, 'update'])->name('post-products-update');     
    });
   
   
});