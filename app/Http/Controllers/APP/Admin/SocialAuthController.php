<?php

namespace App\Http\Controllers\APP\Admin;

use Illuminate\Http\Request;
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookRequestException;
use Facebook\GraphUser;
use App\Http\Controllers\Controller;
use App\User;

class SocialAuthController extends Controller {
    
    private $appID;
    private $appSecret;
    private $fullURL;
    
    public function __construct() {
        $this->appID = env('FB_APP_ID');
        $this->appSecret = env('FB_APP_SECRET');
        $this->fullURL = url('/user/login/callback/');
    }
    
    public function facebookLogin(Request $request) {
        FacebookSession::setDefaultApplication($this->appID, $this->appSecret);
        $helper = new FacebookRedirectLoginHelper($this->fullURL);
        $fbloginurl = $helper->getLoginUrl(
                array (
                        'scope' => 'public_profile, email'
                    )
                );
        $state = md5(rand());
        $request->session()->set('g_state', $state);
        return redirect()->to($fbloginurl);
    }

    public function fbSignUp() {
        FacebookSession::setDefaultApplication($this->appID, $this->appSecret);
        $helper = new FacebookRedirectLoginHelper(
                $this->fullURL,
                $this->appID,
                $this->appSecret
        );
        try {
            $fbResponse = $helper->getSessionFromRedirect();
        } catch (FacebookRequestException $ex) {
            return $ex->getMessage();
        }
        $this->processSessionData($fbResponse);
    }
    
    private function processSessionData($response) {
        $fieldParams = '/me?fields=id,name,first_name,last_name,email, photos';
        if (isset($response) && $response) {
            try {
                $userProfile = (new FacebookRequest(
                    $response, 'GET', $fieldParams
                ))->execute()->getGraphObject(GraphUser::className());
                if (User::where('email', $userProfile->getProperty("email"))->first()) {
                    //log in user via auth login
                    
                } else{
                    return redirect()->to('/admin/register');
                    
                }
            } catch (FacebookRequestException $ex) {
                return $ex->getMessage();
            }
        }
    }
    
    private function registerUser(FacebookRequest $user) {
    }

}
