<?php

use App\Http\Controllers\admin\DashBoardController as AdminDashBoardController;
use App\Http\Controllers\admin\LoginController as AdminLoginController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;

Route::get('/', [LoginController::class, 'index']);

//guest
Route::group(['prefix' => 'account'],function(){
    
    Route::group(['middleware'=> 'guest'],function(){
        Route::get('login',[LoginController::class,'index'])->name('account.login');
        Route::get('register',[LoginController::class,'register'])->name('account.register'); 
        Route::post('processRegister',[LoginController::class,'processRegister'])->name('account.processRegister');
        Route::post('authenticate',[LoginController::class,'authenticate'])->name('account.authenticate');   
    });

    //Authenticated
    Route::group(['middleware' => 'auth'],function(){   
        Route::get('logout',[LoginController::class,'logout'])->name('account.logout');
        Route::get('dashboard',[DashboardController::class,'index'])->name('account.dashboard');

    });

});

Route::group(['prefix' => 'admin'],function(){
    Route::group(['middleware'=> 'admin.guest'],function(){
    Route::get('login',[AdminLoginController::class,'index'])->name('admin.login');
    Route::post('authenticate',[AdminLoginController::class,'authenticate'])->name('admin.authenticate'); 
    });
    //Authenticated
    Route::group(['middleware' => 'admin.auth'],function(){   
    Route::get('dashboard',[AdminDashBoardController::class,'index'])->name('admin.dashboard');
    Route::get('logout',[AdminLoginController::class,'logout'])->name('admin.logout');
    });
});
    
Route::controller(ProductController::class)->group(function(){
    Route::get('/products','index')->name('products.index');
    Route::get('/products/create','create')->name('products.create');
    Route::post('/products','store')->name('products.store');
    Route::get('/products/{product}/edit','edit')->name('products.edit');
    Route::put('/products/{product}','update')->name('products.update');
    Route::delete('/products/{id}', 'destroy')->name('products.destroy');
    Route::post('/products/{id}/purchase', 'purchase')->name('products.purchase');
    Route::get('api/v1/products','get');
});

Route::get('/transactions', [TransactionController::class,'transactions'])->name('transactions.list');