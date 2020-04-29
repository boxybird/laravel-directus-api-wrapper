<?php

namespace BoxyBird\Directus\Directus;

use Illuminate\Support\Facades\Cache;

class Directus
{
    public $jwt_key = 'directus_auth_jwt';

    public $user_key = 'directus_auth_user';

    public function setUser(array $user, int $ttl = 900)
    {
        return Cache::put($this->user_key, $user, $ttl);
    }

    public function getUser()
    {
        return Cache::get($this->user_key, '');
    }

    public function setJwt(string $jwt, int $ttl = 900)
    {
        return Cache::put($this->jwt_key, $jwt, $ttl);
    }

    public function getJwt()
    {
        return Cache::get($this->jwt_key, '');
    }
}
