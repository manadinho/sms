<?php

namespace App\Http\Traits;

use App\Models\UserSocialProfile;
use GuzzleHttp\Client;
use Carbon\Carbon;

trait LinkedinTrait 
{
    private function getLinkedinAccessToken()
    {
        $client = new Client();
        try {
            $response = $client->post('https://www.linkedin.com/oauth/v2/accessToken', [
                'form_params' => [
                    'grant_type' => 'authorization_code',
                    'client_id' => env('LINKEDIN_CLIENT_ID'),
                    'client_secret' => env('LINKEDIN_CLIENT_SECRET'),
                    'redirect_uri' => env('LINKEDIN_CONNECT_REDIRECT_URL'),
                    'code' => $this->code,
                ],
            ]);
        
            return json_decode((string) $response->getBody(), true);
        } catch (\Exception $e) {
            // Handle exception or log error
            return null;
        }
    }

    private function getProfile()
    {
        $client = new Client();
        try {
            $response = $client->get("https://api.linkedin.com/v2/me", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->accessToken,
                ],
            ]);            

            $profile =  json_decode((string) $response->getBody(), true);
            return [
                'id' => $profile['id'],
                'name' => $profile['localizedFirstName'] . ' ' . $profile['localizedLastName'],
            ];
        } catch (\Exception $e) {
            throw $e;
        }
    }

    private function fetchEmail()
    {
        $client = new Client();
        try {
            $response = $client->get("https://api.linkedin.com/v2/emailAddress?q=members&projection=(elements*(handle~))", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->accessToken,
                ],
            ]);            

            return json_decode((string) $response->getBody(), true)['elements'][0]['handle~']['emailAddress'];
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
        return UserSocialProfile::where(['provider' => 'LINKEDIN', 'provider_id' => $profile['id'], 'user_id' => auth()->id()])
            ->exists();
    }

    private function updateProfile($profile): void
    {
        $social_profile = [
            'access_token' => $this->accessToken,
            'refresh_token' => $this->refreshToken,
            'expires_at' => $this->expiresAt,
            'refresh_token_expires_at' => $this->refreshTokenExpiresAt,
            'name' => $profile['name'],
        ];

        UserSocialProfile::where(['provider_id' => $profile['id'], 'user_id' => auth()->id()])->update($social_profile);
    }

    private function createProfile($profile): void
    {
        $social_profile = [
            'provider' => 'LINKEDIN',
            'provider_id' => $profile['id'],
            'user_id' => auth()->user()->id,
            'access_token' => $this->accessToken,
            'refresh_token' => $this->refreshToken,
            'refresh_token_expires_at' => $this->refreshTokenExpiresAt,
            'expires_at' => $this->expiresAt,
            'email' => $this->fetchEmail(),
            'name' => $profile['name'],
        ];

        UserSocialProfile::create($social_profile);
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
}
