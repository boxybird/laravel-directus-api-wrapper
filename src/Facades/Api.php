<?php

namespace BoxyBird\Directus\Facades;

use Illuminate\Support\Facades\Facade;
use BoxyBird\Directus\Directus\Api\Api as ApiClass;

class Api extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return ApiClass::class;
    }
}
