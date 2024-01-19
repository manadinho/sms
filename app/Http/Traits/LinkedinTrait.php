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

            return json_decode((string) $response->getBody(), true);
        } catch (\Exception $e) {
            // Handle exceptions (e.g., GuzzleHttp\Exception\RequestException)
            return [
                'error' => true,
                'message' => $e->getMessage(),
            ];
        }
    }
}