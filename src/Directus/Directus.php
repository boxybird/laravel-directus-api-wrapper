<?php

namespace BoxyBird\Directus\Directus;

use Illuminate\Support\Facades\Cache;

class Directus
{
    public $jwt_key = 'directus_auth_jwt';

    public function setJwt(string $jwt, int $ttl)
    {
        return Cache::put($this->jwt_key, $jwt, $ttl);
    }

    public function getJwt()
    {
        return Cache::get($this->jwt_key, '');
    }
}
