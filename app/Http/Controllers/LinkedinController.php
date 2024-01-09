<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Exceptions;

class LinkedinController extends Controller
{
    public function redirectToLinkedin()
    {
        return Socialite::driver('linkedin-openid')->redirect();
    }

    public function handleLinkedinCallback()
    {
        try {
            $userInfo = Socialite::driver('linkedin-open-id')->user();
            $findUser = User::where('provider_id', $userInfo->id)->first();

            if ($findUser) {
                Auth::login($findUser);
            } else {
                $checkUser = User::where('email', $userInfo->email)->first();

                if ($checkUser) {
                    $checkUser->provider = 'linkedin';
                    $checkUser->provider_id = $userInfo->id;
                    $checkUser->save();
                    Auth::login($checkUser);
                } else {
                    $newUser = User::create([
                        'name' => $userInfo->name,
                        'email' => $userInfo->email,
                        'provider' => 'linkedin',
                        'provider_id' => $userInfo->id,
                        'password' => encrypt(rand(100000,999999)),
                    ]);

                    Auth::login($newUser);
                }
            }
            return redirect('/welcome')->with('succus', 'User Logged in!');

        } catch (\Exception $e) {
            return redirect('login')->with('status', 'Something went wrong! Please try again later.');
        }
    }
}
