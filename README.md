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
                'like' => 'Hello, World.',
            ]
        ],
    ]);

    // Reference: https://docs.directus.io/api/items.html#list-the-items
});

Route::get('/item/create', function () {
    // Create new item in collection 'posts'
    $create = Items::create('posts', [
        'title'   => 'Hello, World.',
        'content' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit!',
    ]);

    // Reference: https://docs.directus.io/api/items.html#create-an-item
});

Route::get('/item/update', function () {
    // Update item in collection 'posts' with id '1'
    $create = Items::update('posts', 1, [
        'title'   => 'Hi, World.',
    ]);

    // Reference: https://docs.directus.io/api/items.html#update-an-item
});

Route::get('/item/delete', function () {
    // Delete item in collection 'posts' with id '1'
    $create = Items::delete('posts', 1);

    // Reference: https://docs.directus.io/api/items.html#delete-an-item
});
```

### Collections:

```php
<?php

use BoxyBird\Directus\Facades\Collections;

Route::get('/collection', function () {
    // Retrieves the details of collection 'posts'
    $collection = Collections::retrieve('posts');

    // Reference: https://docs.directus.io/api/collections.html#retrieve-a-collection
});

Route::get('/collections', function () {
    // List of the collections available in the project.
    $collections = Collections::list();

    // Reference: https://docs.directus.io/api/collections.html#list-collections
});

Route::get('/collections/create', function () {
    // Create the new collection 'my_collection' with 2 fields
    $create = Collections::create([
        'collection' => 'my_collection',
        'fields'     => [
            [
                'field'       => 'id',
                'type'        => 'integer',
                'datatype'    => 'int',
                'length'      => 11,
                'interface'   => 'numeric',
                'primary_key' => true,
            ],
            [
                'field'       => 'name',
                'type'        => 'string',
                'datatype'    => 'VARCHAR',
                'length'      => 255,
                'interface'   => 'text-input',
            ]
        ]
    ]);

    // Reference: https://docs.directus.io/api/collections.html#create-a-collection
});

Route::get('/collections/update', function () {
    // Update the collection 'my_collection'
    $update = Collections::update('my_collection', [
        'note' => 'This is my first collection'
    ]);

    // Reference: https://docs.directus.io/api/collections.html#update-a-collection
});

Route::get('/collections/delete', function () {
    // Delete the collection 'my_collection'
    $delete = Collections::delete('my_collection');

    // Reference: https://docs.directus.io/api/collections.html#delete-a-collection
});
```

## Completed Endpoint Mappings

- Collections: https://docs.directus.io/api/collections.html

## Todos

- Continue to map Directus API endpoints (https://docs.directus.io/api/reference.html)

## License

[MIT license](https://opensource.org/licenses/MIT)
