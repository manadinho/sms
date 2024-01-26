<?php

namespace App\Http\Controllers;

use App\Http\Traits\InstagramTrait;

class InstagramController extends Controller
{
    use InstagramTrait;

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
        return redirect()->to("https://www.facebook.com/".env('FACEBOOK_API_VERSION')."/dialog/oauth?client_id=" . env('INSTAGRAM_APP_ID') . "&redirect_uri=" . env('INSTAGRAM_REDIRECT_URL') . "&scope=" . env('INSTAGRAM_SCOPES') . "");
    }

    /**
     * Handle Facebook OAuth callback request to exchange authorization code 
     * for access token. Save access token, expiry time, and user profile.
     *
     * @return void
     */
    public function callback()
    {
        try {
            $this->code = request()->query('code');
            $data = $this->getInstagramAccessToken();
            $this->accessToken = $data['access_token'];
            $this->expiresAt = $this->expirationDate((array_key_exists('expires_in', $data) ? $data['expires_in'] : null));
            $profile = $this->getFacebookProfile();
            $this->profileId = $profile['id'];
            $this->saveProfile($profile);
            $instagramProfile = $this->getInstagramProfile();
            dd($instagramProfile);
            return redirect()->route('socials.index', ['connectstatus' => 'true', 'provider' => 'instagram']);
        } catch (\Exception $e) {
            // return redirect()->route('socials.index', ['connectstatus' => 'false', 'provider' => 'instagram', 'message' => $e->getMessage()]);
            return [
                'error' => null,
                'message' => $e->getMessage(),
            ];
        }
    }
}
