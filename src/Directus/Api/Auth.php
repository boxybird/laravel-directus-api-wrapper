<?php

namespace BoxyBird\Directus\Directus\Api;

use BoxyBird\Directus\Directus\ApiWrapperBase;

class Auth extends ApiWrapperBase
{
    public function authenticate(array $params)
    {
        return $this->handleApiRequest('POST', '/auth/authenticate', $params);
    }

    public function refresh(string $jwt = '')
    {
        return $this->handleApiRequest('POST', '/auth/refresh', [
            'token' => $this->handleJwt($jwt)
        ]);
    }

    public function passwordRequest(array $params)
    {
        return $this->handleApiRequest('POST', '/auth/password/request', $params);
    }

    public function passwordReset(string $password, string $one_time_use_token)
    {
        return $this->handleApiRequest('POST', '/auth/password/reset', [
            'password' => $password,
            'token'    => $one_time_use_token,
        ]);
    }
}
