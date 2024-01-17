<?php

namespace App\Http\Controllers;

use App\Http\Traits\FacebookTrait;

class FacebookController extends Controller
{
    use FacebookTrait;

    private $code = null;
    private $accessToken = null;
    private $expiresAt = null;

    /**
     * Redirects the user to the Facebook OAuth dialog to connect their Facebook account.
     * Constructs the OAuth URL with the app ID, redirect URL and requested scopes from .env,
     * and returns a redirect response to that URL.
     */
    public function connect()
    {
        return redirect()->to("https://www.facebook.com/v15.0/dialog/oauth?client_id=" . env('FACEBOOK_APP_ID') . "&redirect_uri=" . env('FACEBOOK_REDIRECT_URL') . "&scope=" . env('FACEBOOK_SCOPES') . "");
    }

    /**
     * Handle Facebook OAuth callback request to exchange authorization code 
     * for access token. Save access token, expiry time, and user profile.
     *
     * @return void
     */
    public function callback()
    {
        $this->code = request()->query('code');
        $data = $this->getFacebookAccessToken();
        $this->accessToken = $data['access_token'];
        // $this->expiresAt = $this->expirationDate($data['expires_in']);
        $profile = $this->getProfile();
        $this->saveProfile($profile);
        $pages = $this->getPages();
        dd($pages);
    }
}
