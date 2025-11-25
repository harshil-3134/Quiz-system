<?php

use App\Http\Controllers\AdminController;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/',[UserController::class,'welcome']);
Route::get('user-quiz-list/{id}/{category}',[UserController::class,'userQuizList']);
Route::get('start-quiz/{id}/{name}',[UserController::class,'startQuiz']);

Route::view('user-signup','user-signup');
Route::view('user-login','user-login');
Route::post('user-login',[UserController::class,'userLogin']);
Route::get('user-login-quiz',[UserController::class,'userLoginQuiz']);

Route::post('user-signup',[UserController::class,'userSignup']);
Route::get('user-signup-quiz',[UserController::class,'userSignupQuiz']);
Route::get('user-logout',[UserController::class,'userLogout']);

Route::middleware('CheckUserAuth')->group(function(){

Route::get('user-details',[UserController::class,'userDetails']);
Route::get('submit-next/{id}',[UserController::class,'submitAndNext']);
Route::get('mcq/{id}/{name}',[UserController::class,'mcq']);

});


Route::view('Admin-login','admin-login');

Route::get('/admin-login', function () {
    return view('admin-login');
});


Route::post('admin-login',[AdminController::class,'Login']);

Route::middleware('CheckUserAuth')->group(function(){

Route::get('dashboard',[AdminController::class,'dashboard']);

Route::get('admin-categories',[AdminController::class,'categories']);
Route::get('admin-logout',[AdminController::class,'logout']);
Route::post('add-category',[AdminController::class,'addcategory']);
Route::get('category/delete/{id}',[AdminController::class,'deletecategory']);
Route::get('add-quiz',[AdminController::class,'addQuiz']);
Route::post('add-mcq',[AdminController::class,'addMCQs']);
Route::get('end-quiz',[AdminController::class,'endQuiz']);
Route::get('show-quiz/{id}/{quizName}',[AdminController::class,'showQuiz']);
Route::get('quiz-list/{id}/{category}',[AdminController::class,'quizList']);
});