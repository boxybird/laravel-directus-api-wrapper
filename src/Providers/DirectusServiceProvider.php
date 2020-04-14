<?php

namespace BoxyBird\Directus\Providers;

// use App\Directus\Api\Items;
// use App\Directus\Api\Collections;
use Illuminate\Support\ServiceProvider;

class DirectusServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->app->bind(Items::class, function () {
        //     return new Items(
        //         config('directus.api.base_url'),
        //         config('directus.api.project_name')
        //     );
        // });

        // $this->app->bind(Collections::class, function () {
        //     return new Collections(
        //         config('directus.api.base_url'),
        //         config('directus.api.project_name')
        //     );
        // });
    }
}
