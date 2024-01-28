<?php

namespace App\Http\Services;

use App\Models\UserSocialProfile;
use GuzzleHttp\Client;

class GoogleService 
{
    public function fetchAccounts(UserSocialProfile $userSocialProfile) 
    {
        try {
            $account = $this->fetchProfile($userSocialProfile);
            $locations = $this->fetchLocations($userSocialProfile, $account['accounts'][0]['name']);
            
            if(count($locations['locations']) == 0) {
                return [];
            }

            $googleBusinesses = [];
            foreach ($locations['locations'] as $location) {
                $googleBusinesses[] = [
                    'id' => $location['name'],
                    'name' => $location['title'],
                    'account' => $account['accounts'][0],
                    'refresh_token' => $userSocialProfile->access_token,
                    'link' => "https://www.google.com/maps/search/?api=1&query=".urlencode($location['title']),
                ];
            }
            return $googleBusinesses;

        } catch (\Exception $e) {
            // Handle exception or log error
            return [];
        }
    }

    private function fetchProfile(UserSocialProfile $userSocialProfile) 
    {
        try {
            $client = new Client();
            $response = $client->get("https://mybusinessaccountmanagement.googleapis.com/v1/accounts", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $userSocialProfile->access_token,
                ],
            ]);
            return json_decode((string) $response->getBody(), true);
        } catch (\Exception $e) {
            // Handle exception or log error
            throw $e;
        }
    }

    private function fetchLocations(UserSocialProfile $userSocialProfile, $accountId) 
    {
        try {
            $client = new Client();
            $response = $client->get("https://mybusinessbusinessinformation.googleapis.com/v1/".$accountId."/locations?readMask=title,name", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $userSocialProfile->access_token,
                ],
            ]);
            return json_decode((string) $response->getBody(), true);
        } catch (\Exception $e) {
            // Handle exception or log error
            throw $e;
        }
    }

    public function preparePageToCreate($page, $googleLatetProfile) 
    {
        return [
            'user_id' => auth()->user()->id,
            'user_social_profile_id' => $googleLatetProfile->id,
            'provider' => 'GOOGLE',
            'connected_social_id' => $page['id'],
            'type' => 'account',
            'title' => $page['name'],
            'access_token' => $page['refresh_token'],
            'photo' => asset('/images/google-buisness.svg'),
            'misc' => json_encode($page),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
