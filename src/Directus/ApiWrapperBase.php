<?php

namespace  BoxyBird\Directus\Directus;

use Exception;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

abstract class ApiWrapperBase
{
    public $http;

    public $base_url;

    public $project_name;

    public $directus_response;

    public function __construct(string $base_url, string $project_name)
    {
        $this->http         = Http::class;
        $this->base_url     = $base_url;
        $this->project_name = $project_name;
    }

    protected function handleApiRequest(Response $response)
    {
        $this->setDirectusResponse($response);

        if (!$this->directus_response) {
            $this->handleNoDirectusResponse($response);
        }

        return $this->directus_response;
    }

    protected function preparedDirectusUrl()
    {
        return "{$this->base_url}/{$this->project_name}";
    }

    protected function setDirectusResponse(Response $response)
    {
        $this->directus_response = $response->json();
    }

    protected function handleNoDirectusResponse(Response $response)
    {
        $uri = $response->effectiveUri();
        $url = "{$uri->getScheme()}://{$uri->getHost()}{$uri->getPath()}{$uri->getQuery()}";
        throw new Exception(
            "No data returned from Directus URL \"{$url}\""
        );
    }
}
