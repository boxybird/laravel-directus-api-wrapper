<?php

namespace BoxyBird\Directus\Directus\Api;

use BoxyBird\Directus\Directus\ApiWrapperBase;

class Items extends ApiWrapperBase
{
    public function list(string $collection, array $params = [])
    {
        return $this->handleApiRequest(
            $this->http::get("{$this->preparedDirectusUrl()}/items/{$collection}", $params)
        );
    }

    public function retrieve(string $collection, int $id, array $params = [])
    {
        return $this->handleApiRequest(
            $this->http::get("{$this->preparedDirectusUrl()}/items/{$collection}/{$id}", $params)
        );
    }

    public function create(string $collection, array $params = [], string $jwt = '')
    {
        return $this->handleApiRequest(
            $this->http::withToken($jwt)
                ->post("{$this->preparedDirectusUrl()}/items/{$collection}", $params)
        );
    }
}
