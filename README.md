# Laravel Directus API Wrapper

A collection of Laravel facades to interact with Directus CMS.

## Requirements

- Laravel 7/8
- Directus 8

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

## Core Usage

### Requests: https://docs.directus.io/api/reference.html#endpoints

```php
use BoxyBird\Directus\Facades\Api;

// General API endpoint facade - 'PARAMS' and 'JWT' are optional
$request = Api::request('HTTP_METHOD', 'ENDPOINT', 'PARAMS', 'JWT');

// Examples
Api::request('GET', '/users');
Api::request('POST', '/items/posts', ['...params']);
Api::request('DELETE', '/server/projects/my_project');

// Reference: https://docs.directus.io/api/reference.html#endpoints
```

### Authentication: https://docs.directus.io/api/authentication.html

#### Per Request:

```php
<?php

use BoxyBird\Directus\Facades\Api;
use BoxyBird\Directus\Facades\Auth;

$auth = Auth::authenticate([
    'email'    => 'some-directus-user@gmail.com',
    'password' => '12345678'
]);

// Get token
$jwt = data_get($auth, 'data.token');

Api::request('GET', '/posts', ['...params'], $jwt);
Api::request('POST', '/items/posts', ['...params'], $jwt);
// etc...
```

#### Per session:

```php
<?php

use BoxyBird\Directus\Facades\Api;
use BoxyBird\Directus\Facades\Auth;

Route::post('/login', function (Request $request) {
    $auth = Auth::authenticate([
        'email'    => $request->input('email'),
        'password' => $request->input('password'),
    ]);

    // Handle invalid credentials
    if (data_get($auth, 'error')) {
        abort(403);
    } 

    // Store in session
    $request->session()->put('current_user', $auth);
    
    return view('some-view');
});

Route::post('/posts', function (Request $request) {
    $current_user = $request->session()->get('current_user');

    $jwt = data_get($current_user, 'data.token');

    $created_post = Api::request('POST', '/items/posts', [
        'title'   => 'Hello, World.',
        'content' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit!',
    ], $jwt);

    // ...
});
```

#### Globally:

In some apps you may only need to connect to Directus using a single user. So rather than passing a JWT as an argument on every request, you can use the `BoxyBird\Directus\Facades\Directus` helper facade.

> Under the hood, each request will look to see if `Directus::getJwt()` is set.

```php
<?php

use BoxyBird\Directus\Facades\Auth;
use BoxyBird\Directus\Facades\Directus;

$auth = Auth::authenticate([
    'email'    => 'some-directus-user@gmail.com',
    'password' => '12345678'
]);

// Get token or ''
$jwt = data_get($auth, 'data.token', '');

// Get user or []
$user = data_get($auth, 'data.user', []);

// Cache token globally with 15 min ttl
Directus::setJwt($jwt, 900);

// Cache user globally with 15 min ttl
Directus::setUser($user, 900);

// Cached jwt and user helpers
Directus::getJwt();
Directus::getUser();

// Reference: https://docs.directus.io/api/authentication.html#retrieve-a-temporary-access-token

---

// Attempt to refresh global token
$auth = Auth::refresh();

// Reference: https://docs.directus.io/api/authentication.html#refresh-a-temporary-access-token
```

## Additional Helpers

### Items: https://docs.directus.io/api/items.html

```php
<?php

use BoxyBird\Directus\Facades\Items;

// Get item from collection 'posts' with id '1'
$item = Items::retrieve('posts', 1);

// Reference: https://docs.directus.io/api/items.html#retrieve-an-item

---

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

---

// Create new item in collection 'posts'
$create = Items::create('posts', [
    'title'   => 'Hello, World.',
    'content' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit!',
]);

// Reference: https://docs.directus.io/api/items.html#create-an-item

---

// Update item in collection 'posts' with id '1'
$update = Items::update('posts', 1, [
    'title'   => 'Hi, World.',
]);

// Reference: https://docs.directus.io/api/items.html#update-an-item

---

// Delete item in collection 'posts' with id '1'
$delete = Items::delete('posts', 1);

// Reference: https://docs.directus.io/api/items.html#delete-an-item

---

// Get all revisions in collection 'posts' with id '1'
$revisions = Items::listRevisions('posts', 1);

// Reference: https://docs.directus.io/api/items.html#list-item-revisions

// Get revision in collection 'posts' with id '1' at offset '3'
$revision = Items::retrieveRevision('posts', 1, 3);

// Reference: https://docs.directus.io/api/items.html#retrieve-an-item-revision

// Revert to revision in collection 'posts' with id '1' at offset '3'
$revert = Items::revertRevision('posts', 1, 3);

// Reference: https://docs.directus.io/api/items.html#revert-to-a-given-revision
```

### Files: https://docs.directus.io/api/files.html

```php
<?php

use BoxyBird\Directus\Facades\Files;

// Get file with id '1'
$file = Files::retrieve(1);

// Reference: https://docs.directus.io/api/files.html#list-the-files

---

// Get files
$files = Files::list();

// Reference: https://docs.directus.io/api/files.html#list-the-files

---

// Create new file
$create = Files::create([
    'data' => // Raw file data (multipart/form-data), base64 string of file data, or URL you want to embed.
]);

// Reference: https://docs.directus.io/api/files.html#create-a-file

---

// Update file 'tags' with id '1'
$update = Files::update(1, [
    'tags' => ['apple', 'pear', 'banana']
]);

// Reference: https://docs.directus.io/api/files.html#update-a-file

---

// Delete file with id '1'
$delete = Files::delete(1);

// Reference: https://docs.directus.io/api/files.html#delete-a-file

---

// Get all file revisions with id '1'
$revisions = File::listRevisions(1);

// Reference: https://docs.directus.io/api/files.html#list-file-revisions

// Get file revision with id '1' at offset '3'
$revision = Files::retrieveRevision(1, 3);

// Reference: https://docs.directus.io/api/files.html#retrieve-a-file-revision
```

### Collections: https://docs.directus.io/api/collections.html

```php
<?php

use BoxyBird\Directus\Facades\Collections;

// Retrieves the details of collection 'posts'
$collection = Collections::retrieve('posts');

// Reference: https://docs.directus.io/api/collections.html#retrieve-a-collection

---

// List of the collections available in the project.
$collections = Collections::list();

// Reference: https://docs.directus.io/api/collections.html#list-collections

---

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

---

// Update the collection 'my_collection'
$update = Collections::update('my_collection', [
    'note' => 'This is my first collection'
]);

// Reference: https://docs.directus.io/api/collections.html#update-a-collection

---

// Delete the collection 'my_collection'
$delete = Collections::delete('my_collection');

// Reference: https://docs.directus.io/api/collections.html#delete-a-collection
```

## License

[MIT license](https://opensource.org/licenses/MIT)
