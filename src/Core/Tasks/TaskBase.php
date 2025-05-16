<?php

namespace Upsun\Core\Tasks;

abstract class TaskBase
{
    public function refreshToken() {
        $this->client->apiConfig->setAccessToken($this->client->auth->getAccessToken());
    }
}