<?php
namespace App\Http\Services;

use App\Models\UserSocialProfile;
use GuzzleHttp\Client;

class LinkedinService
{
    public function fetchAccount(UserSocialProfile $userSocialProfile) 
    {
        try {
            $client = new Client();
            $response = $client->get("https://api.linkedin.com/v2/me?projection=(id,vanityName,localizedFirstName,localizedLastName,profilePicture(displayImage~:playableStreams))", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $userSocialProfile->access_token,
                    'X-Restli-Protocol-Version' => '2.0.0'
                ]
            ]);
            $responseBody = json_decode((string) $response->getBody(), true);
            return $this->prepareAccount($responseBody);
        } catch (\Exception $e) {
            // Handle exception or log error
            return [];
        }
    }

    public function prepareAccount($rawProfile) 
    {
        if(!$rawProfile) {
            return null;
        }

        return [
            'id' => $rawProfile['id'],
            'name' => $rawProfile['localizedFirstName'] . ' ' . $rawProfile['localizedLastName'],
            'picture' => $rawProfile['profilePicture']['displayImage~']['elements'][0]['identifiers'][0]['identifier'] ?? null,
            'misc' => json_encode($rawProfile),
        ];
        
    }

    public function fetchOrganisation(UserSocialProfile $userSocialProfile) 
    {
        try {
            $client = new Client();
            $response = $client->get("https://api.linkedin.com/rest/organizationAcls?q=roleAssignee", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $userSocialProfile->access_token,
                    'LinkedIn-Version' => '202305',
                    'X-Restli-Protocol-Version' => '2.0.0',
                ]
            ]);
            $responseBody = json_decode((string) $response->getBody(), true);

            $organisations = [];
            foreach($responseBody['elements'] as $element) {
                $organisation_id = explode(':', $element['organization'])[3];
                $organisation = $this->fetchOrganisationById($organisation_id, $userSocialProfile->access_token);
                $organisation['picture'] = null;
                if(array_key_exists('logoV2', $organisation)) {
                    $organisation['picture'] = $this->fetchOrganisationLogo($organisation_id, $userSocialProfile->access_token);
                }
                $organisations[] = $organisation;
            }
            return $organisations;
        } catch (\Exception $e) {
            // Handle exception or log error
            return [];
        }
    }

    public function fetchOrganisationLogo($organisation_id, $access_token) 
    {
        try {
            $client = new Client();
            $response = $client->get("https://api.linkedin.com/rest/organizationsLookup?projection=(results(".$organisation_id."(logoV2(original~:playableStreams,cropped~:playableStreams,cropInfo))))&ids=List(".$organisation_id.")", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $access_token,
                    'LinkedIn-Version' => '202305',
                    'X-Restli-Protocol-Version' => '2.0.0',
                ]
            ]);
            $responseBody = json_decode((string) $response->getBody(), true);
            return $responseBody['results'][$organisation_id]['logoV2']['original~']['elements'][0]['identifiers'][0]['identifier'] ?? null;
            // return $this->prepareOrganisation($responseBody);
        } catch (\Exception $e) {
            return null;
        }
    }

    public function fetchOrganisationById($organisation_id, $access_token) 
    {
        try {
            $client = new Client();
            $response = $client->get("https://api.linkedin.com/rest/organizations?ids=List(".$organisation_id.")", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $access_token,
                    'LinkedIn-Version' => '202305',
                    'X-Restli-Protocol-Version' => '2.0.0',
                ]
            ]);
            $responseBody = json_decode((string) $response->getBody(), true);
            $rawOrganisation = $responseBody['results'][$organisation_id];

            return [
                'id' => $rawOrganisation['id'],
                'name' => $rawOrganisation['localizedName'],
                'picture' => null,
                'logoV2' => array_key_exists('logoV2', $rawOrganisation) ? $rawOrganisation['logoV2'] : null,
                'misc' => json_encode($rawOrganisation),
            ];
            // return $this->prepareOrganisation($responseBody);
        } catch (\Exception $e) {
            // Handle exception or log error
            return null;
        }
    }

    public function prepareAccountOrOrgToCreate($entity, $linkedinLatetProfile, $type)
    {
        return [
            'user_id' => auth()->user()->id,
            'user_social_profile_id' => $linkedinLatetProfile->id,
            'provider' => 'LINKEDIN',
            'connected_social_id' => $entity['id'],
            'type' => $type,
            'title' => $entity['name'],
            'photo' => $entity['picture'],
            'misc' => $entity['misc'],
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
