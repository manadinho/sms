<?php

namespace App\Http\Traits;

use App\Models\UserSocialProfile;
use GuzzleHttp\Client;
use Carbon\Carbon;

trait FacebookTrait 
{
    /**
     * Get Facebook access token using authorization code.
     *
     * This makes a POST request to the Facebook OAuth token endpoint to exchange 
     * the authorization code for an access token. Required parameters like app ID, 
     * app secret, redirect URI and authorization code are passed in the form body.
     * 
     * The response body containing the access token is JSON decoded and returned.
     * If request fails, null is returned.
     */
    private function getFacebookAccessToken()
    {
        $client = new Client();

        try {
            $response = $client->post('https://graph.facebook.com/v15.0/oauth/access_token', [
                'form_params' => [
                    'client_id' => env('FACEBOOK_APP_ID'),
                    'client_secret' => env('FACEBOOK_APP_SECRET'),
                    'redirect_uri' => env('FACEBOOK_REDIRECT_URL'),
                    'code' => $this->code,
                ],
            ]);

            return json_decode((string) $response->getBody(), true);
        } catch (\Exception $e) {
            // Handle exception or log error
            return null;
        }
    }
    
    /**
     * Get user profile from Facebook API.
     *
     * This makes a GET request to the Facebook user profile endpoint to get 
     * details like id, name, first_name, last_name, email using the access token.
     * The response body containing the user data is JSON decoded and returned.
     * If request fails, null is returned.  
     */    
    private function getProfile()
    {
        try {
            $client = new Client();
            $response = $client->get("https://graph.facebook.com/v15.0/me?fields=id,name,first_name,last_name,email&access_token=" . $this->accessToken);
            return json_decode((string) $response->getBody(), true);
        } catch (\Exception $e) {
            // Handle exception or log error
            return null;
        }
    }

    /**
     * Calculate expiration date by adding number of seconds to current time.
     *
     * @param int $seconds Number of seconds to add 
     * @return \Illuminate\Support\Carbon Expiration date/time  
     */
    private function expirationDate($seconds)
    {
        return Carbon::now()->addSeconds($seconds);
    }

    /**
     * Save Facebook profile data.
     *
     * Checks if a profile already exists for the user. 
     * If yes, updates the existing profile.
     * If no, creates a new profile.
     * 
     * @param array $profile The Facebook profile data
     */
    private function saveProfile($profile): void
    {
        if ($this->profileExists($profile)) {
            $this->updateProfile($profile);
            return;
        }

        $this->createProfile($profile);
    }

    /**
     * Check if a Facebook profile exists for the user.
     *
     * @param array $profile The Facebook profile data
     * @return bool True if a matching profile exists, false otherwise
     */
    private function profileExists($profile): bool
    {
        return UserSocialProfile::where(['provider_id' => $profile['id'], 'user_id' => auth()->id()])
            ->where('provider', 'FACEBOOK')
            ->exists();
    }

    /**
     * Create a new user social profile from Facebook profile data.
     *
     * @param array $profile The Facebook profile data
     */
    private function createProfile($profile): void
    {
        $social_profile = [
            'provider' => 'FACEBOOK',
            'provider_id' => $profile['id'],
            'user_id' => auth()->user()->id,
            'access_token' => $this->accessToken,
            'refresh_token' => $this->accessToken,
            'expires_at' => $this->expiresAt,
            'email' => $profile['email'],
            'name' => $profile['name'],
        ];

        UserSocialProfile::create($social_profile);
    }

    /**
     * Update an existing user social profile with new Facebook profile data.
     * 
     * @param array $profile The updated Facebook profile data
     */    private function updateProfile($profile): void
    {
        $social_profile = [
            'access_token' => $this->accessToken,
            'refresh_token' => $this->accessToken,
            'expires_at' => $this->expiresAt,
            'email' => $profile['email'],
            'name' => $profile['name'],
        ];

        UserSocialProfile::where(['provider_id' => $profile['id'], 'user_id' => auth()->id()])->update($social_profile);
    }

    private function getPages()
    {
        try {
            // https://graph.facebook.com/v15.0/me/accounts?access_token=EAAHMArQUWR4BO2i9l0tZBcCrZA9dx33ZBJoQ0ixwR4O3tW3q0TlQvGooKJFyVSLgoM89RdjJMVl2xzsxPnTIoZCq86VENWP1ahaeB8YdXoZBOH3WZCtNOq2jKcAJFlZCiewPh38c0035qIMN3c0KmikLUOasuICvLLQDiuZBYaUeyP6ccJR6uSWhSSfjhnCIZBZCbjFdqtuqz4Nc49ols6grL7IM70SjuIzCSc7AhCIqYqo7JoBiQlYZBQY&fields=id,name,access_token,category_list,username,link,cover,picture,tasks,location{street,city,city_id,state,zip,country,region,region_id}
            $client = new Client();
            $response = $client->get("https://graph.facebook.com/v15.0/me/accounts?access_token=" . $this->accessToken. "&fields=id,name,access_token,category_list,username,link,cover,picture,tasks,location{street,city,city_id,state,zip,country,region,region_id}");
            return json_decode((string) $response->getBody(), true);
        } catch (\Exception $e) {
            // Handle exception or log error
            return null;
        }
    }
}
