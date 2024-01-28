<?php

namespace App\Http\Controllers;

use App\Http\Traits\GoogleTrait;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

class GoogleLoginController extends Controller
{
    use GoogleTrait;

    private $code = null;
    private $accessToken = null;
    private $refreshToken = null;
    private $expiresAt = null;

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
            return redirect()->route('welcome')->with('success', 'User Logged in!');
        }
         catch(\Exception $e) 
            {
                return redirect('auth/login')->with('status', 'Something went wrong! Please try again later.');
            }
        
    }

    public function connect() 
    {
        $scope = urlencode(str_replace(',', ' ', env('GOOGLE_CONNECT_SCOPES')));
        return redirect()->to("https://accounts.google.com/o/oauth2/auth/oauthchooseaccount?client_id=".env('GOOGLE_CONNECT_CLIENT_ID')."&redirect_uri=".env('GOOGLE_CONNECT_REDIRECT_URL')."&scope=".$scope."&response_type=code&prompt=consent&access_type=offline");
    }

    public function callback() 
    {
        try {
            $this->code = request()->query('code');
            $data = $this->fetchAccessToken();
            $this->accessToken = $data['access_token'];
            $this->refreshToken = $data['refresh_token'];
            $this->expiresAt = $this->expirationDate($data['expires_in']);
            $profile = $this->fetchProfile();
            $this->saveProfile($profile);
            return redirect()->route('socials.index', ['connectstatus' => 'true', 'provider' => 'google']);
        } catch (\Exception $e) {
            return redirect()->route('socials.index', ['connectstatus' => 'false', 'provider' => 'google', 'message' => $e->getMessage()]);
        }
    }
}
