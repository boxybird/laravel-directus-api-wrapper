<?php

namespace BoxyBird\Directus\Directus\Api;

use BoxyBird\Directus\Directus\ApiWrapperBase;

class Items extends ApiWrapperBase
{
    public function list(string $collection, array $params = [])
    {
        return $this->processApiGetRequest(
            $this->http::get("{$this->preparedDirectusUrl()}/items/{$collection}", $params)
        );
    }

    public function retrieve(string $collection, int $id, array $params = [])
    {
        return $this->processApiGetRequest(
            $this->http::get("{$this->preparedDirectusUrl()}/items/{$collection}/{$id}", $params)
        );
    }
}
