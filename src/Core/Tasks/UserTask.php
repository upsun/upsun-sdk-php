<?php

namespace Upsun\Core\Tasks;

use OpenAPI\Client\apisgen\OrganizationsApi;
use OpenAPI\Client\apisgen\UsersApi;
use Upsun\UpsunClient;

class UserTask extends TaskBase
{

    public readonly UsersApi $api;
    
    public function __construct(
        public readonly UpsunClient $client,
    )
    {
        $this->api = new UsersApi($this->client->apiClient, $this->client->apiConfig);
    }
    
    public function me() {
        return $this->api->getCurrentUser();
    }
    
    public function getUser(string $id) {
        return $this->api->getUser($id);
    }
}