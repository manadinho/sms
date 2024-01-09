<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\GoogleLoginController;
use App\Http\Controllers\LinkedinController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

Route::get('/welcome', function () {
    return view('welcome');
});
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

Route::get('auth/google/redirect', [GoogleLoginController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('auth/google/callback', [GoogleLoginController::class, 'handleGoogleCallback'])->name('google.callback');

Route::get('auth/linkedin/redirect',      [LinkedinController::class, 'redirectToLinkedin'])->name('linkedin.redirect');
Route::get('auth/linkedin/callback', [LinkedinController::class, 'handleLinkedinCallback'])->name('linkedin.callback');

Route::get('/dashboard', function () {
    return view('dashboard')->name('dashboard');
});
   

Route::group(['prefix' => 'auth', 'as' => 'auth.'], function() {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login-with-magic-link', [AuthController::class, 'loginMagicLink'])->name('login-with-magic-link');
    Route::get('/magic-link-login/{token}', [AuthController::class, 'loginWithToken'])->name('magic-link-token');
    Route::get('/check-email',[AuthController::class, 'checkEmail'])->name('check-email');
});

Route::group(['middleware' => ['auth']], function() {
    Route::get('/home',[HomeController::class, 'index']);
    Route::get('/', function () {return view('welcome');})->name('welcome');
});



require __DIR__.'/auth.php';
