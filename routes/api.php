<?php

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::controller(RegisterController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
});

Route::middleware('auth:sanctum')->group( function () {
    Route::resource('products', ProductController::class);
});

// Route::controller(ProductController::class)->group(function(){
//     Route::get('/products', 'index');
//     Route::post('/products', 'store');
//     Route::put('/products/{id}', 'update');
//     Route::delete('/products/{id}', 'destroy');

// });
