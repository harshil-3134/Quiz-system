<?php

use App\Http\Controllers\AdminController;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::view('Admin-login','admin-login');

Route::get('/admin-login', function () {
    return view('admin-login');
});


Route::post('admin-login',[AdminController::class,'Login']);
Route::get('dashboard',[AdminController::class,'dashboard']);