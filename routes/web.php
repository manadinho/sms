<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\GoogleLoginController;
use App\Http\Controllers\LinkedinController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\InstagramController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PhotoEditorController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\UserController;

Route::get('auth/google/redirect', [GoogleLoginController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('auth/google/callback', [GoogleLoginController::class, 'handleGoogleCallback'])->name('google.callback');
Route::post('/registeruser' , [ UserController::class,'store'])->name('registeruser');


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
    Route::get('/google', [GoogleLoginController::class, 'connect'])->name('google.connect');
    Route::get('/linkedin', [LinkedinController::class, 'connect'])->name('linkedin.connect');
    Route::get('/instagram', [InstagramController::class, 'connect'])->name('instagram.connect');
});

Route::group(['prefix' => 'callback', 'middleware' => 'auth'], function() {
    Route::get('/facebook', [FacebookController::class, 'callback'])->name('facebook.callback');
    Route::get('/google', [GoogleLoginController::class, 'callback'])->name('google');
    Route::get('/linkedin', [LinkedinController::class, 'callback'])->name('linkedin.callback');
    Route::get('/instagram', [InstagramController::class, 'callback'])->name('instagram.callback');
});

Route::group(['middleware' => ['auth']], function() {
    Route::get('/home',[HomeController::class, 'index']);
    Route::get('/', function () {return view('welcome');})->name('welcome');
    Route::get('/setting', function () {return view('setting');})->name('setting');
    Route::get('/analytics', function () {return view('analytics');})->name('analytics');
    Route::group(['prefix' => 'socials', 'as' => 'socials.'], function() {
        Route::get('/',[SocialController::class, 'index'])->name('index');
        Route::post('/search-entities',[SocialController::class, 'searchEntities'])->name('search-entities');
        Route::post('/connect-entities',[SocialController::class, 'connectEntities'])->name('connect-entities');
        Route::post('/change-status',[SocialController::class, 'statusChange'])->name('change-status');
        Route::post('/change-delete',[SocialController::class, 'deleteSocial'])->name('delete');
    });
    Route::get('/ecommerce',[HomeController::class, 'ecommerce'])->name('ecommerce');

    Route::group(['prefix' => 'photo-editor', 'as' => 'photo.editor.'], function() {
        Route::get('/',[PhotoEditorController::class, 'index'])->name('index');
    });
});



require __DIR__.'/auth.php';
