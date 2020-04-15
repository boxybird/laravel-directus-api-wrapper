<?php

namespace BoxyBird\Directus\Providers;

use Illuminate\Support\ServiceProvider;
use BoxyBird\Directus\Directus\Api\Auth;
use BoxyBird\Directus\Directus\Api\Items;
use BoxyBird\Directus\Directus\Api\Users;
use BoxyBird\Directus\Directus\Api\Collections;

class DirectusServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(Auth::class, function () {
            return new Auth(
                config('directus.api.base_url'),
                config('directus.api.project_name')
            );
        });

        $this->app->bind(Users::class, function () {
            return new Users(
                config('directus.api.base_url'),
                config('directus.api.project_name')
            );
        });

        $this->app->bind(Items::class, function () {
            return new Items(
                config('directus.api.base_url'),
                config('directus.api.project_name')
            );
        });

        $this->app->bind(Collections::class, function () {
            return new Collections(
                config('directus.api.base_url'),
                config('directus.api.project_name')
            );
        });

        $this->publishes([
            __DIR__ . '/../config/directus.php' => config_path('directus.php'),
        ]);
    }
}
