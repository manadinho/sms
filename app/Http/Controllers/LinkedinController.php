<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Exceptions;
use App\Http\Traits\LinkedinTrait;

class LinkedinController extends Controller
{
    use LinkedinTrait;
    private $code = null;
    private $accessToken = null;
    private $expiresAt = null;
    
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
            return redirect()->route('welcome')->with('success', 'User Logged in!');

        } catch (\Exception $e) {
            return redirect('auth/login')->with('status', 'Something went wrong! Please try again later.');
        }
    }

    public function connect()
    {
        return redirect()->to("https://www.linkedin.com/oauth/v2/authorization?response_type=" . "code" ."&client_id=". env('LINKEDIN_CLIENT_ID') . "&redirect_uri=" . env('LINKEDIN_CONNECT_REDIRECT_URL') . "&scope=" . env('LINKEDIN_SCOPES') . "");
    }

    public function callback(){
        $this->code = request()->query('code');
        $data = $this->getLinkedinAccessToken();
        $this->accessToken = $data['access_token'];
        $profile = $this->getProfile();
        dd($profile);
    }
}