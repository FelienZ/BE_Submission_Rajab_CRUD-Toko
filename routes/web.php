<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(ProductController::class)->group(function(){
    Route::get('/products','index')->name('products.index');
    Route::get('/products/create','create')->name('products.create');
    Route::post('/products','store')->name('products.store');
    Route::get('/products/{product}/edit','edit')->name('products.edit');
    Route::put('/products/{product}','update')->name('products.update');
    Route::delete('/products/{id}', 'destroy')->name('products.destroy');
    Route::post('/products/{id}/purchase', 'purchase')->name('products.purchase');
    Route::get('/transactions', 'transactions')->name('transactions.list');
});

