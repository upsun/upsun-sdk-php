<?php

namespace Upsun\Core\Tasks;

//use GuzzleHttp\Client;
use OpenAPI\Client\apisgen\OrganizationsApi;
use Upsun\UpsunClient;

abstract class TaskBase
{
    public function __construct(
        public readonly UpsunClient $client,
        public OrganizationsApi $api
    )
    {
        $this->api = new OrganizationsApi($this->client->apiClient, $this->client->apiConfig);
    }
}