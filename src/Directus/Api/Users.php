<?php

namespace BoxyBird\Directus\Directus\Api;

use BoxyBird\Directus\Directus\ApiWrapperBase;

class Users extends ApiWrapperBase
{
    public function me($params = [], $jwt = '')
    {
        return $this->handleApiRequest('GET', '/users/me', $params, $jwt);
    }
}
