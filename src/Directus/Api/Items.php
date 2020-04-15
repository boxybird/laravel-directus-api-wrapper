<?php

namespace BoxyBird\Directus\Directus\Api;

use BoxyBird\Directus\Directus\ApiWrapperBase;

class Items extends ApiWrapperBase
{
    public function list(string $collection, array $params = [], string $jwt = '')
    {
        return $this->handleApiRequest('GET', "/items/{$collection}", $params, $jwt);
    }

    public function retrieve(string $collection, int $id, array $params = [], string $jwt = '')
    {
        return $this->handleApiRequest('GET', "/items/{$collection}/{$id}", $params, $jwt);
    }

    public function create(string $collection, array $params, string $jwt = '')
    {
        return $this->handleApiRequest('POST', "/items/{$collection}", $params, $jwt);
    }
}
