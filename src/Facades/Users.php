<?php

namespace BoxyBird\Directus\Facades;

use Illuminate\Support\Facades\Facade;
use BoxyBird\Directus\Directus\Api\Users as ApiUsers;

class Users extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return ApiUsers::class;
    }
}
