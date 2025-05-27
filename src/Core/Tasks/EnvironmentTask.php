<?php

namespace Upsun\Core\Tasks;

use OpenAPI\Client\apisgen\EnvironmentApi;
use Upsun\UpsunClient;

class EnvironmentTask extends TaskBase
{
    public EnvironmentApi $api;
    
    public function __construct(
        public readonly UpsunClient $client,
    )
    {
        $this->api = new EnvironmentApi($this->client->apiClient, $this->client->apiConfig);
    }
}