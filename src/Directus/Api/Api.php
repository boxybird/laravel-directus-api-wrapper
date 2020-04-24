<?php

namespace BoxyBird\Directus\Directus\Api;

use BoxyBird\Directus\Directus\ApiWrapperBase;

class Api extends ApiWrapperBase
{
    public function request(string $http_method, string $endpoint, array $params = [], string $jwt = '')
    {
        return $this->handleApiRequest($http_method, $endpoint, $params, $jwt);
    }
}
