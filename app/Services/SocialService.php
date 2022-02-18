<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\Social;
use App\Models\User as Model;
use Faker\Factory;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Contracts\User;

class SocialService implements Social
{
    public function setUser(User $socialUser, string $network): string
    {
        $user = Model::query()->where('email', $socialUser->getEmail())->first();
        if ($user) {
            $user->name = $socialUser->getName();
            $user->avatar = $socialUser->getAvatar();

            if ($user->save()) {
                Auth::loginUsingId($user->id);

                return route('account');
            }
        } else {
            $data = [
                'name' => $socialUser->getName(),
                'email' => $socialUser->getEmail(),
                'avatar' => $socialUser->getAvatar(),
                'password' => \Illuminate\Support\Facades\Hash::make((new Factory)->create()->password(15)),
            ];

            $created = Model::create($data);
            if ($created) {
                Auth::loginUsingId($created->id);

                return route('account');
            }

            return route('register');
        }

        throw new \Exception("We get error via social network: " . $network);
    }
}
