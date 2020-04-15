<?php

namespace BoxyBird\Directus\Directus\Api;

use BoxyBird\Directus\Directus\ApiWrapperBase;

class Collections extends ApiWrapperBase
{
    public function list(array $params = [], $jwt = '')
    {
        return $this->handleApiRequest(
            $this->http::withToken($this->handleJwt($jwt))
                ->get("{$this->preparedDirectusUrl()}/collections", $params)
        );
    }

    public function retrieve(string $collection, array $params = [], $jwt = '')
    {
        return $this->handleApiRequest(
            $this->http::withToken($this->handleJwt($jwt))
                ->get("{$this->preparedDirectusUrl()}/collections/{$collection}", $params)
        );
    }
}
