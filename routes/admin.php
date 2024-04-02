<?php

use App\Http\Controllers\Admin\Categories\CategoriesController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Permission\PermissionController;
use App\Http\Controllers\Admin\Products\ProductsController;
use Illuminate\Support\Facades\Route;
Route::prefix('admin')->group(function (){
    Route::get('/', [AdminController::class, 'index'])->name('admin');

    Route::prefix('/categories')->group(function (){
        Route::get('/', [CategoriesController::class, 'index'])->name('admin-categories');
        Route::get('/add', [CategoriesController::class, 'add'])->name('admin-categories-add');
        Route::get('/edit/{id}',[CategoriesController::class, 'edit'])->name('admin-categories-edit');
        Route::get('/delete/{id}',[CategoriesController::class, 'delete'])->name('admin-categories-delete'); 
    });
    //Product
    Route::prefix('/products')->group(function (){
        Route::get('/', [ProductsController::class, 'index'])->name('admin-products');
        Route::get('/add',[ProductsController::class, 'add'])->name('admin-products-add');
        Route::get('/edit/{id}',[ProductsController::class, 'edit'])->name('admin-products-edit');
        Route::get('/delete/{id}',[ProductsController::class, 'delete'])->name('admin-products-delete');  
        Route::get('/change-status/{id}',[ProductsController::class, 'changeStatus'])->name('admin-products-change-status');  
    });
    // //Orders
    // Route::prefix('/order')->group(function () {
    //     Route::get('/', [
    //         'as' => 'order_index',
    //         'uses' => 'AdminOrderController@index',
    //         'middleware'=>'can:orders-list'
    //     ]);
    //     Route::get('/view/{id}', [
    //         'as' => 'order_view',
    //         'uses' => 'AdminOrderController@view',
    //     ]);
    //     Route::get('/update/', [
    //         'as' => 'order_update',
    //         'uses' => 'AdminOrderController@update',
    //         'middleware'=>'can:orders-edit'
    //     ]);
    // });
    // //Sliders
    // Route::prefix('/slider')->group(function (){
    //     Route::get('/', [
    //         'as' => 'slider.index',
    //         'uses' => 'AdminSliderController@index',
    //         'middleware'=>'can:slider-list'
    //     ]);
    //     Route::get('/create',[
    //         'as' => 'slider.create',
    //         'uses' => 'AdminSliderController@create',
    //         'middleware'=>'can:slider-list'
    //     ]);
    //     Route::post('/store',[
    //         'as' => 'slider.store',
    //         'uses' => 'AdminSliderController@store',
    //     ]);
    //     Route::get('/edit/{id}', [
    //         'as' => 'slider.edit',
    //         'uses' => 'AdminSliderController@edit',
    //         'middleware'=>'can:slider-list'
    //     ]);
    //     Route::post('/update/{id}',[
    //         'as' => 'slider.update',
    //         'uses' => 'AdminSliderController@update',
    //     ]);
    //     Route::get('/delete/{id}',[
    //         'as' => 'slider.delete',
    //         'uses' => 'AdminSliderController@delete',
    //         'middleware'=>'can:slider-list'
    //     ]);
    // });
    // //Settings
    // Route::prefix('/setting')->group(function (){
    //     Route::get('/', [
    //         'as' => 'setting.index',
    //         'uses' => 'AdminSettingController@index',
    //         'middleware'=>'can:settings-list'
    //     ]);
    //     Route::get('/create',[
    //         'as' => 'setting.create',
    //         'uses' => 'AdminSettingController@create',
    //         'middleware'=>'can:settings-add'
    //     ]);
    //     Route::post('/store',[
    //         'as' => 'setting.store',
    //         'uses' => 'AdminSettingController@store',
    //     ]);
    //     Route::get('/edit/{id}', [
    //         'as' => 'setting.edit',
    //         'uses' => 'AdminSettingController@edit',
    //         'middleware'=>'can:settings-edit'
    //     ]);
    //     Route::post('/update/{id}',[
    //         'as' => 'setting.update',
    //         'uses' => 'AdminSettingController@update'
    //     ]);
    //     Route::get('/delete/{id}',[
    //         'as' => 'setting.delete',
    //         'uses' => 'AdminSettingController@delete',
    //         'middleware'=>'can:settings-delete'
    //     ]);
    // });
    // //user
    // Route::prefix('/user')->group(function (){
    //     Route::get('/', [
    //         'as' => 'user.index',
    //         'uses' => 'AdminUserController@index',

    //     ]);
    //     Route::get('/edit/{id}', [
    //         'as' => 'user.edit',
    //         'uses' => 'AdminUserController@edit',
    //         'middleware'=>'can:user-edit'
    //     ]);
    //     Route::post('/update/{id}',[
    //         'as' => 'user.update',
    //         'uses' => 'AdminUserController@update'
    //     ]);
    //     Route::get('/delete/{id}',[
    //         'as' => 'user.delete',
    //         'uses' => 'AdminUserController@delete',
    //         'middleware'=>'can:user-delete'
    //     ]);
    // });
    // //Role
    // Route::prefix('/roles')->group(function (){
    //     Route::get('/', [
    //         'as' => 'roles.index',
    //         'uses' => 'AdminRolesController@index',
    //         'middleware'=>'can:role-list'
    //     ]);
    //     Route::get('/create',[
    //         'as' => 'roles.create',
    //         'uses' => 'AdminRolesController@create',
    //         'middleware'=>'can:role-add'
    //     ]);
    //     Route::post('/store/',[
    //         'as' => 'roles.store',
    //         'uses' => 'AdminRolesController@store'
    //     ]);
    //     Route::get('/edit/{id}', [
    //         'as' => 'roles.edit',
    //         'uses' => 'AdminRolesController@edit',
    //         'middleware'=>'can:role-edit'
    //     ]);
    //     Route::post('/update/{id}',[
    //         'as' => 'roles.update',
    //         'uses' => 'AdminRolesController@update'
    //     ]);
    //     Route::get('/delete/{id}',[
    //         'as' => 'roles.delete',
    //         'uses' => 'AdminRolesController@delete',
    //         'middleware'=>'can:role-delete'
    //     ]);
    // });
    // //permission
    Route::prefix('/permission')->group(function (){
        Route::get('/', [PermissionController::class, 'index'])->name('admin-permission');      
    });
    // //Customer
    // Route::prefix('/customer')->group(function (){
    //     Route::get('/',[
    //         'as' => 'customer.index',
    //         'uses' => 'AdminCustomerController@index',
    //         'middleware'=>'can:customer-list'
    //     ]);
    // });
});