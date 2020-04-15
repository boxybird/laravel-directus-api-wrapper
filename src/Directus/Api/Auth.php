<?php

namespace BoxyBird\Directus\Directus\Api;

use BoxyBird\Directus\Directus\ApiWrapperBase;

class Auth extends ApiWrapperBase
{
    public function authenticate(array $credentials)
    {
        return $this->handleApiRequest(
            $this->http::post("{$this->preparedDirectusUrl()}/auth/authenticate", $credentials)
        );
    }

    public function refresh(string $jwt)
    {
        return $this->handleApiRequest(
            $this->http::post("{$this->preparedDirectusUrl()}/auth/refresh", ['token' => $jwt])
        );
    }

    public function passwordRequest(array $params)
    {
        return $this->handleApiRequest(
            $this->http::post("{$this->preparedDirectusUrl()}/auth/password/request", $params)
        );
    }
}
