# Laravel Directus API Wrapper

A collection of Laravel 7 facades to interact with Directus CMS (version 8).

## Disclaimer

This package is brand new and not ready for production.

## Installation

You can install the package via composer:

```
composer require boxybird/laravel-directus-api-wrapper
```

Publish config file:

```
php artisan vendor:publish --provider="BoxyBird\Directus\Providers\DirectusServiceProvider
```

Add to .env:

```
# No trailing /
DIRECTUS_BASE_URL=http://some-directus-install.com
DIRECTUS_PROJECT_NAME=some-project-name
```

## Usage

### Authentication:

```php
<?php

use BoxyBird\Directus\Facades\Auth;
use BoxyBird\Directus\Facades\Directus;

Route::get('/auth/authenticate', function () {
    $auth = Auth::authenticate([
        'email'    => 'some-directus-user@gmail.com',
        'password' => '12345678'
    ]);

    // Get token or ''
    $jwt = data_get($auth, 'data.token', '');

    // Cache token with 15 min ttl
    Directus::setJwt($jwt, 900);

    // Reference: https://docs.directus.io/api/authentication.html#retrieve-a-temporary-access-token
});

Route::get('/auth/refresh', function () {
    // Attempt to refresh token
    $auth = Auth::refresh();

    // Reference: https://docs.directus.io/api/authentication.html#refresh-a-temporary-access-token
});
```

### Items:

```php
<?php

use BoxyBird\Directus\Facades\Items;

Route::get('/item', function () {
    // Get item from collection 'posts' with id '1'
    $item = Items::retrieve('posts', 1);

    // Reference: https://docs.directus.io/api/items.html#retrieve-an-item
});

Route::get('/items', function () {
    // Get items from collection 'posts'
    $items = Items::list('posts');

    // Get items from collection 'posts' with params
    $items = Items::list('posts', [
        'fields' => '*.*.*',
        'meta'   => '*',
        'filter' => [
            'title' => [
                'like' => 'Hello, World.'
            ]
        ],
    ]);

    // Reference: https://docs.directus.io/api/items.html#list-the-items
});
```

## Completed Endpoint Mappings

- _Coming soon..._

## Todos

- Continue to map Directus API endpoints (https://docs.directus.io/api/reference.html)

## License

[MIT license](https://opensource.org/licenses/MIT)
