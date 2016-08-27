<?php

namespace App\Http\Controllers\APP\Admin;

use Illuminate\Http\Request;
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookAuthorizationException;
use Facebook\FacebookRequestException;
use Facebook\GraphObject;
use Facebook\GraphUser;
use App\Http\Controllers\Controller;
use App\Service\SocialAccountService;
use Socialite;

class SocialAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback(SocialAccountService $service)
    {
        $user = $service->createOrGetUser(Socialite::driver('facebook')->user());
        auth()->login($user);
        return redirect()->to('/admin/home');
    }
    
    public function fbSignUp(Request $request)
    {
        FacebookSession::setDefaultApplication(env('FB_APP_ID'),env('FB_APP_SECRET'));
    }
}
