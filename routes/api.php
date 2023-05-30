<?php

use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::controller(ProductController::class)->group(function(){
    Route::get('/products', 'index');
    Route::post('/products', 'store');
    Route::put('/products/{id}', 'update');
    Route::delete('/products/{id}', 'destroy');

});
