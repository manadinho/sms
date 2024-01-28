<?php

namespace App\Http\Controllers;

use App\Http\Services\FacebookService;
use App\Http\Services\GoogleService;
use App\Http\Services\InstagramService;
use App\Http\Services\LinkedinService;
use App\Models\ConnectedSocial;
use App\Models\UserSocialProfile;

class SocialController extends Controller
{
    public function index() 
    {
        $connectedSocials = ConnectedSocial::where('user_id', auth()->user()->id)->orderBy('updated_at', 'desc')->get();
        $connectedSocials = $connectedSocials->groupBy('provider');;
        
        return view('socials.index', compact('connectedSocials'));
    }

    public function searchEntities() 
    {
        $provider = request()->provider;

        if($provider == 'FACEBOOK') {
            return $this->searchFacebookEntities();
        }

        if($provider == 'LINKEDIN') {
            return $this->searchLinkedinEntities();
        }

        if($provider == 'INSTAGRAM') {
            return $this->searchInstagramEntities();
        }

        if($provider == 'GOOGLE') {
            return $this->searchGoogleEntities();
        }
    }

    private function searchGoogleEntities() 
    {
        $googleService = new GoogleService();
        $googleLatetProfile = UserSocialProfile::where(['user_id' => auth()->user()->id, 'provider' => 'GOOGLE'])->orderBy('updated_at', 'desc')->first();
        $accounts = $googleService->fetchAccounts($googleLatetProfile);
        $html = ($accounts) ? "":'<div class="text-center"><small>No Group Found</small></div>';
        $connectedSocials = ConnectedSocial::where(['user_id' => auth()->user()->id, 'user_social_profile_id' => $googleLatetProfile->id, 'provider' => 'GOOGLE', 'type' => 'account'])->pluck('connected_social_id')->toArray();
        foreach ($accounts as $entity) {
            $html .= view('socials.partials.google-entity', compact('entity', 'connectedSocials'))->render();
        }

        return response()->json([
            'status' => 'success',
            'html' => $html
        ], 200);
    }

    private function searchInstagramEntities() 
    {
        $instagramService = new InstagramService();
        $instagramLatetProfile = UserSocialProfile::where(['user_id' => auth()->user()->id, 'provider' => 'INSTAGRAM'])->orderBy('updated_at', 'desc')->first();
        $accounts = $instagramService->fetchAccounts($instagramLatetProfile);
        $html = ($accounts) ? "":'<div class="text-center"><small>No Group Found</small></div>';
        $connectedSocials = ConnectedSocial::where(['user_id' => auth()->user()->id, 'user_social_profile_id' => $instagramLatetProfile->id, 'provider' => 'INSTAGRAM', 'type' => 'account'])->pluck('connected_social_id')->toArray();
        foreach ($accounts as $entity) {
            $html .= view('socials.partials.instagram-entity', compact('entity', 'connectedSocials'))->render();
        }

        return response()->json([
            'status' => 'success',
            'html' => $html
        ], 200);

    }

    private function searchFacebookEntities() 
    {
        $facebookService = new FacebookService();
        $facebookLatetProfile = UserSocialProfile::where(['user_id' => auth()->user()->id, 'provider' => 'FACEBOOK'])->orderBy('updated_at', 'desc')->first();
        if(request()->type == 'groups'){
            $groups = $facebookService->fetchGroups($facebookLatetProfile);
            $html = ($groups) ? "":'<div class="text-center"><small>No Group Found</small></div>';
            $connectedSocials = ConnectedSocial::where(['user_id' => auth()->user()->id, 'user_social_profile_id' => $facebookLatetProfile->id, 'provider' => 'FACEBOOK', 'type' => 'group'])->pluck('connected_social_id')->toArray();
            
            foreach ($groups as $entity) {
                $type = 'group';
                $html .= view('socials.partials.fb-entity', compact('type', 'entity', 'connectedSocials'))->render();
            }
        } else {
            $pages = $facebookService->fetchPages($facebookLatetProfile);
            $html = ($pages) ? "":'<div class="text-center"><small>No Page Found</small></div>';
            $connectedSocials = ConnectedSocial::where(['user_id' => auth()->user()->id, 'user_social_profile_id' => $facebookLatetProfile->id, 'provider' => 'FACEBOOK', 'type' => 'page'])->pluck('connected_social_id')->toArray();
            
            foreach ($pages as $entity) {
                $type = 'page';
                $html .= view('socials.partials.fb-entity', compact('type', 'entity', 'connectedSocials'))->render();
            }
        }

        return response()->json([
            'status' => 'success',
            'html' => $html
        ], 200);
    }

    private function searchLinkedinEntities() 
    {
       $linkedinService = new LinkedinService();
       $linkedinLatetProfile = UserSocialProfile::where(['user_id' => auth()->user()->id, 'provider' => 'LINKEDIN'])->orderBy('updated_at', 'desc')->first();
       try {
            if(request()->type == 'account') {
                $entity = $linkedinService->fetchAccount($linkedinLatetProfile);
                $html = '<div class="text-center"><small>No Account Found</small></div>';
                $connectedSocials = ConnectedSocial::where(['user_id' => auth()->user()->id, 'user_social_profile_id' => $linkedinLatetProfile->id, 'provider' => 'LINKEDIN', 'type' => 'account'])->pluck('connected_social_id')->toArray();
                if($entity) {
                    $type = 'account';
                    $html = view('socials.partials.linkedin-entity', compact('type', 'entity', 'connectedSocials'))->render();
                }
                return response()->json([
                    'status' => 'success',
                    'html' => $html
                ], 200);
            }

            if(request()->type == 'organisation') {
                $entities = $linkedinService->fetchOrganisation($linkedinLatetProfile);
                $html = (count($entities) > 0) ? '' : '<div class="text-center"><small>No Organisation Found</small></div>';
                $connectedSocials = ConnectedSocial::where(['user_id' => auth()->user()->id, 'user_social_profile_id' => $linkedinLatetProfile->id, 'provider' => 'LINKEDIN', 'type' => 'organisation'])->pluck('connected_social_id')->toArray();
                foreach($entities as $entity) {
                    $type = 'organisation';
                    $html .= view('socials.partials.linkedin-entity', compact('type', 'entity', 'connectedSocials'))->render();
                }
                return response()->json([
                    'status' => 'success',
                    'html' => $html
                ], 200);
            }
       } catch (\Exception $e) {
            fast($e->getMessage());
            // Handle exception or log error
            return null;
       }

    }

    public function connectEntities() 
    {
        $provider = request()->provider;
        if($provider === 'FACEBOOK') {
            $facebookService = new FacebookService();
            $facebookLatetProfile = UserSocialProfile::where(['user_id' => auth()->user()->id, 'provider' => 'FACEBOOK'])->orderBy('updated_at', 'desc')->first();
            if(request()->type === 'pages') {
                $preparedEntities = array_map(function($entity) use ($facebookService, $facebookLatetProfile) {
                   return $facebookService->preparePageToCreate($entity, $facebookLatetProfile);
                }, request()->entities);
            } else{
                $preparedEntities = array_map(function($entity) use ($facebookService, $facebookLatetProfile) {
                    return $facebookService->prepareGroupToCreate($entity, $facebookLatetProfile);
                }, request()->entities);
            }
            
            $type = (request()->type === 'pages') ? 'page':'group' ;
            // TODO: NEED TO SYNC WITH OTHER LOGIC THIS IS INCREASING THE ID NUMBER IN DATABASE.
            ConnectedSocial::where(['user_id' => auth()->user()->id, 'user_social_profile_id' => $facebookLatetProfile->id, 'provider' => 'FACEBOOK', 'type' => $type])->delete();
            ConnectedSocial::insert($preparedEntities);
        }
        if($provider == 'LINKEDIN') {
            $linkedinService = new LinkedinService();
            $linkedinLatetProfile = UserSocialProfile::where(['user_id' => auth()->user()->id, 'provider' => 'LINKEDIN'])->orderBy('updated_at', 'desc')->first();
            
            $preparedEntities = array_map(function($entity) use ($linkedinService, $linkedinLatetProfile) {
                return $linkedinService->prepareAccountOrOrgToCreate($entity, $linkedinLatetProfile, request()->type);
            }, request()->entities);

            ConnectedSocial::where(['user_id' => auth()->user()->id, 'user_social_profile_id' => $linkedinLatetProfile->id, 'provider' => 'LINKEDIN', 'type' => request()->type])->delete();
            ConnectedSocial::insert($preparedEntities);
        }

        if($provider == 'INSTAGRAM') {
            $instagramService = new InstagramService();
            $instagramLatetProfile = UserSocialProfile::where(['user_id' => auth()->user()->id, 'provider' => 'INSTAGRAM'])->orderBy('updated_at', 'desc')->first();
            
            $preparedEntities = array_map(function($entity) use ($instagramService, $instagramLatetProfile) {
                return $instagramService->preparePageToCreate($entity, $instagramLatetProfile);
            }, request()->entities);

            ConnectedSocial::where(['user_id' => auth()->user()->id, 'user_social_profile_id' => $instagramLatetProfile->id, 'provider' => 'INSTAGRAM', 'type' => 'account'])->delete();
            ConnectedSocial::insert($preparedEntities);
        }

        if($provider == 'GOOGLE') {
            $googleService = new GoogleService();
            $googleLatetProfile = UserSocialProfile::where(['user_id' => auth()->user()->id, 'provider' => 'GOOGLE'])->orderBy('updated_at', 'desc')->first();
            
            $preparedEntities = array_map(function($entity) use ($googleService, $googleLatetProfile) {
                return $googleService->preparePageToCreate($entity, $googleLatetProfile);
            }, request()->entities);

            ConnectedSocial::where(['user_id' => auth()->user()->id, 'user_social_profile_id' => $googleLatetProfile->id, 'provider' => 'GOOGLE', 'type' => 'account'])->delete();
            ConnectedSocial::insert($preparedEntities);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Connected successfully'
        ], 200);
    }

    public function statusChange() 
    {
        ConnectedSocial::where(['user_id' => auth()->user()->id, 'id' => request()->id])->update(['status' => !request()->status]);
        return response()->json([
            'status' => 'success',
            'message' => 'Status changed successfully'
        ], 200);
    }

    public function deleteSocial() 
    {
        ConnectedSocial::where(['user_id' => auth()->user()->id, 'id' => request()->id])->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Deleted successfully'
        ], 200);
    }
}
