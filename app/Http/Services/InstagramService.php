<?php

namespace App\Http\Services;

use App\Models\UserSocialProfile;
use GuzzleHttp\Client;

class InstagramService 
{
    public function fetchAccounts(UserSocialProfile $userSocialProfile) 
    {
        try {
            $client = new Client();
            $response = $client->get("https://graph.facebook.com/".env('FACEBOOK_API_VERSION')."/me/accounts?access_token=" . $userSocialProfile->access_token. "&fields=instagram_business_account{id,username,profile_picture_url},access_token,id,username,cover,picture");
            $responseBody = json_decode((string) $response->getBody(), true);
            return array_key_exists('data', $responseBody) ? $responseBody['data'] : [];
        } catch (\Exception $e) {
            // Handle exception or log error
            return null;
        }
    }

    public function preparePageToCreate($page, $facebookLatetProfile) 
    {
        return [
            'user_id' => auth()->user()->id,
            'user_social_profile_id' => $facebookLatetProfile->id,
            'provider' => 'INSTAGRAM',
            'connected_social_id' => $page['id'],
            'type' => 'account',
            'title' => $page['instagram_business_account']['username'],
            'access_token' => $page['access_token'],
            'photo' => ['instagram_business_account']['profile_picture_url'] ??  asset('/images/instagram.svg'),
            'misc' => json_encode($page),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
