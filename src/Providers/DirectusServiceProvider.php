<?php

namespace BoxyBird\Directus\Providers;

use BoxyBird\Directus\Directus\Api\Api;
use Illuminate\Support\ServiceProvider;
use BoxyBird\Directus\Directus\Api\Auth;
use BoxyBird\Directus\Directus\Api\Files;
use BoxyBird\Directus\Directus\Api\Items;
use BoxyBird\Directus\Directus\Api\Users;
use BoxyBird\Directus\Directus\Api\Collections;

class DirectusServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/directus.php',
            'directus_config'
        );

        $this->app->bind(Api::class, function () {
            return new Api(
                config('directus_config.api.base_url'),
                config('directus_config.api.project_name')
            );
        });

        $this->app->bind(Auth::class, function () {
            return new Auth(
                config('directus_config.api.base_url'),
                config('directus_config.api.project_name')
            );
        });

        $this->app->bind(Users::class, function () {
            return new Users(
                config('directus_config.api.base_url'),
                config('directus_config.api.project_name')
            );
        });

        $this->app->bind(Items::class, function () {
            return new Items(
                config('directus_config.api.base_url'),
                config('directus_config.api.project_name')
            );
        });

        $this->app->bind(Collections::class, function () {
            return new Collections(
                config('directus_config.api.base_url'),
                config('directus_config.api.project_name')
            );
        });

        $this->app->bind(Files::class, function () {
            return new Files(
                config('directus_config.api.base_url'),
                config('directus_config.api.project_name')
            );
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../config/directus.php' => config_path('directus.php'),
        ]);
    }
}
