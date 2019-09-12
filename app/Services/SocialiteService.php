<?php


namespace App\Services;


use App\Models\User;

class SocialiteService
{
    /**
     * @param $getInfo
     * @return mixed
     */
    public function createOrGetUser($getInfo)
    {
        $user = User::where('provider_id', $getInfo->id)->first();
        if (!$user) {
            $user = User::create([
                'name'     => $getInfo->name,
                'email'    => $getInfo->email,
                'provider_id' => $getInfo->id,
            ]);
        }
        return $user;
    }
}
