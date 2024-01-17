<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\GoogleLoginController;
use App\Http\Controllers\LinkedinController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\HomeController;

Route::get('auth/google/redirect', [GoogleLoginController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('auth/google/callback', [GoogleLoginController::class, 'handleGoogleCallback'])->name('google.callback');


Route::get('auth/linkedin/redirect', [LinkedinController::class,   'redirectToLinkedin'])->name('linkedin.redirect');
Route::get('auth/linkedin/callback', [LinkedinController::class, 'handleLinkedinCallback'])->name('linkedin.callback');
Route::get('auth/linkedin/authenticate', [LinkedInController::class, 'authenticate'])->name('linkedin.authenticate');
   
Route::group(['prefix' => 'auth', 'as' => 'auth.'], function() {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login-with-magic-link', [AuthController::class, 'loginMagicLink'])->name('login-with-magic-link');
    Route::get('/magic-link-login/{token}', [AuthController::class, 'loginWithToken'])->name('magic-link-token');
    Route::get('/check-email',[AuthController::class, 'checkEmail'])->name('check-email');
});

Route::group(['prefix' => 'connect', 'middleware' => 'auth'], function() {
    Route::get('/facebook', [FacebookController::class, 'connect'])->name('facebook.connect');
    Route::get('/google', [GoogleLoginController::class, 'redirectToGoogle'])->name('google');
    Route::get('/linkedin', [LinkedinController::class, 'connect'])->name('linkedin.connect');
});

Route::group(['prefix' => 'callback', 'middleware' => 'auth'], function() {
    Route::get('/facebook', [FacebookController::class, 'callback'])->name('facebook.callback');
    Route::get('/google', [GoogleLoginController::class, 'redirectToGoogle'])->name('google');
    Route::get('/linkedin', [LinkedinController::class, 'redirectToLinkedin'])->name('linkedin');
});

Route::group(['middleware' => ['auth']], function() {
    Route::get('/home',[HomeController::class, 'index']);
    Route::get('/', function () {return view('welcome');})->name('welcome');
    Route::group(['prefix' => 'socials', 'as' => 'socials.'], function() {
        Route::get('/',[HomeController::class, 'network'])->name('index');
    });
});



require __DIR__.'/auth.php';
