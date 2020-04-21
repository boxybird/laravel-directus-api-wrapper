<?php

namespace BoxyBird\Directus\Directus\Api;

use BoxyBird\Directus\Directus\ApiWrapperBase;

class Files extends ApiWrapperBase
{
    public function create(array $params, string $jwt = '')
    {
        return $this->handleApiRequest('POST', '/files', $params, $jwt);
    }

    public function update(int $id, array $params, string $jwt = '')
    {
        return $this->handleApiRequest('PATCH', "/files/{$id}", $params, $jwt);
    }
}
