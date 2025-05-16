<?php

namespace Upsun\Core\Tasks;

//use GuzzleHttp\Client;
use OpenAPI\Client\apisgen\OrganizationsApi;
use Upsun\UpsunClient;

abstract class TaskBase
{
    
    public OrganizationsApi $api;
    
    public function __construct(
        public readonly UpsunClient $client,
    )
    {
        $this->api = new OrganizationsApi($this->client->apiClient, $this->client->apiConfig);
    }
}