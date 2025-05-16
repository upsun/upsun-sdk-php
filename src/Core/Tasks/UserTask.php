<?php

namespace Upsun\Core\Tasks;

use OpenAPI\Client\apisgen\UsersApi;

class UserTask extends TaskBase
{

    public function me() {
        $api = new UsersApi($this->client->apiClient, $this->client->apiConfig);
        return $api->getCurrentUser();
    }
}