<?php

namespace Upsun\Core\Tasks;

//use GuzzleHttp\Client;
use Upsun\UpsunClient;

abstract class TaskBase
{
    public function __construct(public readonly UpsunClient $client)
    {
    }

    public function refreshToken()
    {
        $this->client->apiConfig->setAccessToken($this->client->auth->getAccessToken());
    }
}
