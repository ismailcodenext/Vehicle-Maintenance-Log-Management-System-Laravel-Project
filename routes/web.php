<?php


use Illuminate\Support\Facades\Route;



// ------------Controller Work By  start--------------------
use App\Http\Controllers\UserController;

// ------------Controller Work By  End--------------------


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Open Dashboard API Route
Route::view('/', 'pages.front-end-page.auth.login-page');

// front-page User API Route Start

Route::view('/vlmms-login-page', 'pages.front-end-page.auth.login-page')->name('login');
Route::view('/registration', 'pages.front-end-page.auth.registration-page');
Route::view('/sendOtp', 'pages.front-end-page.auth.send-otp-page');
Route::view('/verifyOtp', 'pages.front-end-page.auth.verify-otp-page');
Route::view('/resetPassword', 'pages.front-end-page.auth.reset-pass-page');
Route::view('/userProfile', 'pages.dashboard.profile-page');


// User Web API Routes
// Route::post('/user-registration', [UserController::class, 'UserRegistration'])->middleware('auth:sanctum');
Route::post('/user-registration', [UserController::class, 'UserRegistration']);
Route::post('/user-login', [UserController::class, 'UserLogin']);
Route::get('/user-profile', [UserController::class, 'UserProfile'])->middleware('auth:sanctum');
Route::get('/vlmms-logout-page', [UserController::class, 'UserLogout'])->middleware('auth:sanctum');
Route::post('/user-update', [UserController::class, 'UpdateProfile'])->middleware('auth:sanctum');
Route::post('/send-otp', [UserController::class, 'SendOTPCode']);
Route::post('/verify-otp', [UserController::class, 'VerifyOTP']);
Route::post('/reset-password', [UserController::class, 'ResetPassword'])->middleware('auth:sanctum');

// front-page API Route End

// Dashboard API Route start
// Route::view('/dashboardSummary','pages.back-end-page.dashboard-page');
Route::view('/dashboardSummary', 'pages.dashboard.dashboard-page')->middleware('auth:sanctum');

//  Page View API Route

// Dashboard API Route End

// ----------------------------Dashboard Route Work Robiul End-----------------------------------------------------