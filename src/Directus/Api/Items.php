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

    public function update(string $collection, int $id, array $params, string $jwt = '')
    {
        return $this->handleApiRequest('PATCH', "/items/{$collection}/{$id}", $params, $jwt);
    }

    public function delete(string $collection, int $id, string $jwt = '')
    {
        return $this->handleApiRequest('DELETE', "/items/{$collection}/{$id}", [], $jwt);
    }
}
