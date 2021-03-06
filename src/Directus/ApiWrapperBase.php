<?php

namespace BoxyBird\Directus\Directus;

use Exception;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use BoxyBird\Directus\Facades\Directus;

abstract class ApiWrapperBase
{
    public $http;

    public $base_url;

    public $project_name;

    public $directus_response;

    private $jwt = '';

    public function __construct(string $base_url, string $project_name)
    {
        $this->base_url     = $base_url;
        $this->project_name = $project_name;
        $this->http         = Http::class;
    }

    protected function handleApiRequest(string $http_method, string $endpoint, array $params = [], string $jwt = '')
    {
        return $this->handleApiResponse(
            $this->http::withToken($this->handleJwt($jwt))
                ->$http_method("{$this->buildBaseUrl()}{$endpoint}", $params)
        );
    }

    protected function handleApiResponse(Response $response)
    {
        $this->setDirectusResponse($response);

        if (!$this->directus_response) {
            $this->handleNoDirectusResponse($response);
        }

        return $this->directus_response;
    }

    protected function handleNoDirectusResponse(Response $response)
    {
        $uri = $response->effectiveUri();
        $url = "{$uri->getScheme()}://{$uri->getHost()}{$uri->getPath()}{$uri->getQuery()}";
        throw new Exception(
            "No data returned from Directus URL \"{$url}\""
        );
    }

    protected function handleJwt(string $jwt)
    {
        return empty($jwt)
            ? $this->jwt = Directus::getJwt()
            : $jwt;
    }

    protected function setDirectusResponse(Response $response)
    {
        $json = !empty($response->json()) ? $response->json() : [];

        $this->directus_response = array_merge($json, ['status' => $response->status()]);
    }

    protected function buildBaseUrl()
    {
        return "{$this->base_url}/{$this->project_name}";
    }
}
