<?php

namespace BoxyBird\Directus\Directus\Api;

use BoxyBird\Directus\Directus\ApiWrapperBase;

class Collections extends ApiWrapperBase
{
    public function list(array $params = [], $jwt = '')
    {
        return $this->handleApiRequest('GET', '/collections', $params, $jwt);
    }

    public function retrieve(string $collection, array $params = [], $jwt = '')
    {
        return $this->handleApiRequest('GET', "/collections/{$collection}", $params, $jwt);
    }

    public function create(array $params, string $jwt = '')
    {
        return $this->handleApiRequest('POST', '/collections', $params, $jwt);
    }

    public function update(string $collection, array $params, string $jwt = '')
    {
        return $this->handleApiRequest('PATCH', "/collections/{$collection}", $params, $jwt);
    }

    public function delete(string $collection, string $jwt = '')
    {
        return $this->handleApiRequest('DELETE', "/collections/{$collection}", [], $jwt);
    }
}
