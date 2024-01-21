<?php

namespace App\Http\Services;

use App\Models\UserSocialProfile;
use GuzzleHttp\Client;

class FacebookService 
{
    public function fetchPages(UserSocialProfile $userSocialProfile) 
    {
        try {
            $client = new Client();
            $response = $client->get("https://graph.facebook.com/".env('FACEBOOK_API_VERSION')."/me/accounts?access_token=" . $userSocialProfile->access_token. "&fields=id,name,access_token,category_list,username,link,cover,picture,tasks,location{street,city,city_id,state,zip,country,region,region_id}");
            $responseBody = json_decode((string) $response->getBody(), true);
            return array_key_exists('data', $responseBody) ? $responseBody['data'] : [];
        } catch (\Exception $e) {
            // Handle exception or log error
            return null;
        }
    }

    public function fetchGroups(UserSocialProfile $userSocialProfile) 
    {
        try {
            $client = new Client();
            $response = $client->get("https://graph.facebook.com/".env('FACEBOOK_API_VERSION')."/me/groups?access_token=" . $userSocialProfile->access_token);
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
            'provider' => 'FACEBOOK',
            'connected_social_id' => $page['id'],
            'type' => 'page',
            'title' => $page['name'],
            'access_token' => $page['access_token'],
            'photo' => $page['picture']['data']['url'],
            'misc' => json_encode($page),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    public function prepareGroupToCreate($group, $facebookLatetProfile) 
    {
        return [
            'user_id' => auth()->user()->id,
            'user_social_profile_id' => $facebookLatetProfile->id,
            'provider' => 'FACEBOOK',
            'connected_social_id' => $group['id'],
            'type' => 'group',
            'title' => $group['name'],
            'photo' => asset('/images/on-board-fb_group.svg'),
            'misc' => json_encode($group),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
