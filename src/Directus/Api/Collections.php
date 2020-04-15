<?php

namespace  BoxyBird\Directus\Directus\Api;

use BoxyBird\Directus\Directus\ApiWrapperBase;

class Collections extends ApiWrapperBase
{
    public function list(array $params = [])
    {
        return $this->handleApiRequest(
            $this->http::get("{$this->preparedDirectusUrl()}/collections", $params)
        );
    }

    public function retrieve(string $collection, array $params = [])
    {
        return $this->handleApiRequest(
            $this->http::get("{$this->preparedDirectusUrl()}/collections/{$collection}", $params)
        );
    }
}
