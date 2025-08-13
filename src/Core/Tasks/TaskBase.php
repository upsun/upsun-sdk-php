<?php

namespace Upsun\Core\Tasks;

use Upsun\UpsunClient;

abstract class TaskBase
{
    public function __construct(
        public UpsunClient $client,
    ) {
    }

    public function refreshToken()
    {
        $this->client->apiConfig->setAccessToken($this->client->auth->getAccessToken());
    }
}
