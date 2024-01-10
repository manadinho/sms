<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Exceptions;

class GoogleLoginController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try{
            $googleUser = Socialite::driver('google')->stateless()->user();
            $user = User::where('email', $googleUser->email)->first();

            if(!$user)
            {
                $user = User::create(['name' => $googleUser->name, 'email' => $googleUser->email, 'password' => \Hash::make(rand(100000,999999)),
                                        'provider' => 'google', 'provider_id' => $googleUser->id,]);
            }

            Auth::login($user);
            return redirect('/home')->with('success', 'User Logged in!');
        }
         catch(\Exception $e) 
            {
                return redirect('auth/login')->with('status', 'Something went wrong! Please try again later.');
            }
        
    }
}