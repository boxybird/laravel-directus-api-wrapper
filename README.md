# Laravel Directus API Wrapper

A collection of Laravel facades to interact with Directus CMS (version 8)

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

### Items:

```php
<?php

use BoxyBird\Directus\Facades\Items;

Route::get('/item', function () {
    // retrieve item from collection 'posts' with id '1'
    $item = Items::retrieve('posts', 1);

    dd($item);

    // Reference: https://docs.directus.io/api/items.html#retrieve-an-item
});

Route::get('/items', function () {
    // name of a example collection 'posts'
    $items = Items::list('posts');

    // name of a example collection 'posts' with params
    $items = Items::list('posts', [
        'fields' => '*.*.*',
        'filter' => [
            'title' => [
                'like' => 'Hello, World.'
            ]
        ]
    ]);

    dd($items);

    // Reference: https://docs.directus.io/api/items.html#list-the-items
});
```

### Authentication:

```php
<?php

use BoxyBird\Directus\Facades\Auth;

Route::get('/auth/authenticate', function () {
    $auth = Auth::authenticate([
        'email'    => 'some-directus-user@gmail.com',
        'password' => '12345678'
    ]);

    dd($auth);

    // Reference: https://docs.directus.io/api/authentication.html#retrieve-a-temporary-access-token
});

Route::get('/auth/refresh', function () {
    $jwt = // eyJ0eXAiOiJ... some token stored in cache
    $auth = Auth::refresh($jwt);

    dd($auth);

    // Reference: https://docs.directus.io/api/authentication.html#refresh-a-temporary-access-token
});

```
