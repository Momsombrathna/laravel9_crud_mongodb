<?php

use Illuminate\Support\Facades\Route;
use App\Mail\MyTestEmail;
use Illuminate\Support\Facades\Mail;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/test-mail', function() {
    $name = "FunnyCoder";

    // The email sending is done using the to method on the Mail facade
    Mail::to('chantpanha@gmail.com')->send(new MyTestEmail($name));
});
