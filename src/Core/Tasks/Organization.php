<?php

namespace Upsun\Core\Tasks;

use Upsun\Core\AbstractTask;
use Upsun\Exception\UpsunException;

class Organization extends AbstractTask
{
    public function __construct($client)
    {
        parent::__construct($client);
    }

    public function list()
    {
        try {
            $response = $this->client->get('/organizations');
            return $response->getBody();
        } catch (UpsunException $e) {
            // Handle the exception as needed
            throw new UpsunException("Failed to retrieve organizations: " . $e->getMessage());
        }
    }
}