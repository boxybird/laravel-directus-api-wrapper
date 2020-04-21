<?php

namespace BoxyBird\Directus\Facades;

use Illuminate\Support\Facades\Facade;
use BoxyBird\Directus\Directus\Api\Files as ApiFiles;

class Files extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return ApiFiles::class;
    }
}
