<?php

namespace BoxyBird\Directus\Facades;

use Illuminate\Support\Facades\Facade;
use BoxyBird\Directus\Directus\Api\Auth as ApiAuth;

class Auth extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return ApiAuth::class;
    }
}
