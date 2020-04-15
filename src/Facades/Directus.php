<?php

namespace BoxyBird\Directus\Facades;

use Illuminate\Support\Facades\Facade;
use BoxyBird\Directus\Directus\Directus as DirectusClass;

class Directus extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return DirectusClass::class;
    }
}
