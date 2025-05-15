<?php

namespace Upsun\Core;

use GuzzleHttp\Client;
use Upsun\Exception\UpsunException;

abstract class AbstractTask
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    protected function request($method, $endpoint, $data = [])
    {
        try {
            $response = $this->client->request($method, $endpoint, $data);
            return $this->handleResponse($response);
        } catch (\Exception $e) {
            throw new UpsunException('API request failed: ' . $e->getMessage());
        }
    }

    protected function handleResponse($response)
    {
        if ($response->getStatusCode() !== 200) {
            throw new UpsunException('Unexpected response status: ' . $response->getStatusCode());
        }

        return json_decode($response->getBody(), true);
    }
}