<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

// =========================
// Public User Routes
// =========================
Route::get('/', [UserController::class, 'welcome']);
Route::get('user-quiz-list/{id}/{category}', [UserController::class, 'userQuizList']);
Route::get('start-quiz/{id}/{name}', [UserController::class, 'startQuiz']);

// Login / Signup Views
Route::view('user-login', 'user-login');
Route::view('user-forgot-password', 'user-forgot-password');

// User Login Routes
Route::post('user-login', [UserController::class, 'userLogin']);
Route::get('user-login-quiz', [UserController::class, 'userLoginQuiz']);
Route::get('user-login', function () {
    if (!session()->has('user')) {
        return view('user-login');
    } else {
        return redirect('/');
    }
});

// User Signup Routes
Route::get('user-signup', function () {
    if (!session()->has('user')) {
        return view('user-signup');
    } else {
        return redirect('/');
    }
});
Route::post('user-signup', [UserController::class, 'userSignup']);
Route::get('user-signup-quiz', [UserController::class, 'userSignupQuiz']);

// User Forgot Password
Route::post('user-forgot-password', [UserController::class, 'userForgotPassword']);
Route::get('user-forgot-password/{email}', [UserController::class, 'userResetForgotPassword']);
Route::post('user-set-forgot-password', [UserController::class, 'userSetForgotPassword']);

// Search, Categories & Certificate
Route::get('search-quiz', [UserController::class, 'searchQuiz']);
Route::get('categories-list', [UserController::class, 'categories']);
Route::get('certificate', [UserController::class, 'certificate']);
Route::get('download-certifiate', [UserController::class, 'dowloadCertifiate']);

// Email Verification
Route::get('verify-user/{email}', [UserController::class, 'verifyUser']);

// Logout
Route::get('user-logout', [UserController::class, 'userLogout']);


// =========================
// Protected User Routes (Auth Required)
// =========================
Route::middleware('CheckUserAuth')->group(function () {
    Route::get('user-details', [UserController::class, 'userDetails']);
    Route::get('submit-next/{id}', [UserController::class, 'submitAndNext']);
    Route::get('mcq/{id}/{name}', [UserController::class, 'mcq']);
});


// =========================
// Admin Login
// =========================
Route::view('Admin-login', 'admin-login');
Route::get('/admin-login', function () {
    return view('admin-login');
});
Route::post('admin-login', [AdminController::class, 'login']);


// =========================
// Protected Admin Routes (Auth Required)
// =========================
Route::middleware('CheckAdminAuth')->group(function () {

    Route::get('dashboard', [AdminController::class, 'dashboard']);

    // Categories
    Route::get('admin-categories', [AdminController::class, 'categories']);
    Route::post('add-category', [AdminController::class, 'addcategory']);
    Route::get('category/delete/{id}', [AdminController::class, 'deletecategory']);

    // Quiz Management
    Route::get('add-quiz', [AdminController::class, 'addQuiz']);
    Route::post('add-mcq', [AdminController::class, 'addMCQs']);
    Route::get('end-quiz', [AdminController::class, 'endQuiz']);
    Route::get('show-quiz/{id}/{quizName}', [AdminController::class, 'showQuiz']);
    Route::get('quiz-list/{id}/{category}', [AdminController::class, 'quizList']);

    // Admin Logout
    Route::get('admin-logout', [AdminController::class, 'logout']);
});

