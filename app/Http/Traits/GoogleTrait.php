<?php

namespace App\Http\Traits;

use App\Models\UserSocialProfile;
use Carbon\Carbon;

trait GoogleTrait 
{
    private function fetchAccessToken() 
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->post('https://oauth2.googleapis.com/token', [
            'form_params' => [
                'client_id' => env('GOOGLE_CONNECT_CLIENT_ID'),
                'client_secret' => env('GOOGLE_CONNECT_CLIENT_SECRET'),
                'code' => $this->code,
                'grant_type' => 'authorization_code',
                'redirect_uri' => env('GOOGLE_CONNECT_REDIRECT_URL'),
            ],
        ]);
        return json_decode((string) $response->getBody(), true);
    }

    /**
     * Calculate expiration date by adding number of seconds to current time.
     *
     * @param int $seconds Number of seconds to add 
     * @return \Illuminate\Support\Carbon Expiration date/time  
     */
    private function expirationDate($seconds)
    {
        return Carbon::now()->addSeconds($seconds)->subDays(5);
    }

    private function fetchProfile() 
    {
        $client = new \GuzzleHttp\Client();
        try {
            $response = $client->get('https://www.googleapis.com/oauth2/v3/userinfo', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->accessToken,
                ],
            ]);
            return json_decode((string) $response->getBody(), true);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    private function saveProfile($profile): void
    {
        if ($this->profileExists($profile)) {
            $this->updateProfile($profile);
            return;
        }

        $this->createProfile($profile);
    }

    private function profileExists($profile): bool
    {
        return UserSocialProfile::where(['provider' => 'GOOGLE', 'provider_id' => $profile['sub'], 'user_id' => auth()->id()])->exists();
    }

    private function updateProfile($profile): void
    {
        UserSocialProfile::where(['provider_id' => $profile['sub'], 'user_id' => auth()->id()])->update([
            'access_token' => $this->accessToken,
            'refresh_token' => $this->refreshToken,
            'expires_at' => $this->expiresAt,
            'name' => $profile['name'],
        ]);
    }

    private function createProfile($profile): void
    {
        UserSocialProfile::create([
            'provider' => 'GOOGLE',
            'provider_id' => $profile['sub'],
            'user_id' => auth()->user()->id,
            'access_token' => $this->accessToken,
            'refresh_token' => $this->refreshToken,
            'expires_at' => $this->expiresAt,
            'email' => $profile['email'],
            'name' => $profile['name'],
        ]);
    }
}
