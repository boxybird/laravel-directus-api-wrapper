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
}
