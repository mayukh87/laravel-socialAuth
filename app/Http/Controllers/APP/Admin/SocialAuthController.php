<?php

namespace App\Http\Controllers\APP\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;

class SocialAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback()
    {
        $providerUser = \Socialite::driver('facebook')->user();
    }
}
