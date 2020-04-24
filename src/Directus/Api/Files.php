<?php

namespace BoxyBird\Directus\Directus\Api;

use BoxyBird\Directus\Directus\ApiWrapperBase;

class Files extends ApiWrapperBase
{
    public function list(array $params = [], string $jwt = '')
    {
        return $this->handleApiRequest('GET', '/files', $params, $jwt);
    }

    public function retrieve(int $id, array $params = [], string $jwt = '')
    {
        return $this->handleApiRequest('GET', "/files/{$id}", $params, $jwt);
    }

    public function create(array $params, string $jwt = '')
    {
        return $this->handleApiRequest('POST', '/files', $params, $jwt);
    }

    public function update(int $id, array $params, string $jwt = '')
    {
        return $this->handleApiRequest('PATCH', "/files/{$id}", $params, $jwt);
    }

    public function delete(int $id, string $jwt = '')
    {
        return $this->handleApiRequest('DELETE', "/files/{$id}", [], $jwt);
    }

    public function listRevisions(int $id, array $params = [], string $jwt = '')
    {
        return $this->handleApiRequest('GET', "/files/{$id}/revisions", $params, $jwt);
    }

    public function retrieveRevision(int $id, int $offset, array $params = [], string $jwt = '')
    {
        return $this->handleApiRequest('GET', "/files/{$id}/revisions/{$offset}", $params, $jwt);
    }
}
