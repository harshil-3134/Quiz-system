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

Route::get('admin-categories',[AdminController::class,'categories']);
Route::get('admin-logout',[AdminController::class,'logout']);
Route::post('add-category',[AdminController::class,'addcategory']);
Route::get('category/delete/{id}',[AdminController::class,'deletecategory']);
Route::get('add-quiz',[AdminController::class,'addQuiz']);
Route::post('add-mcq',[AdminController::class,'addMCQs']);
Route::get('end-quiz',[AdminController::class,'endQuiz']);
Route::get('show-quiz/{id}',[AdminController::class,'showQuiz']);