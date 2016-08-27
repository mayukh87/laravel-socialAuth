<?php

namespace App\Service;

use Laravel\Socialite\Contracts\User as ProviderUser;
use App\Models\SocialAccount;
use App\User;

class SocialAccountService {

    public function createOrGetUser(ProviderUser $providerUser) {
        $account = SocialAccount::whereProvider('facebook')
                ->whereProviderUserId($providerUser->getId())
                ->first();

        if (!$account) {
            $account = new SocialAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => 'facebook'
            ]);

            $user = User::whereEmail($providerUser->getEmail())->first();
            if (!$user) {
                $user = User::create([
                            'email' => $providerUser->getEmail(),
                            'name' => $providerUser->getName(),
                ]);
            }
            $account->user()->associate($user);
            $account->save();

            return $user;
        }
        return $account->user;
    }

}
