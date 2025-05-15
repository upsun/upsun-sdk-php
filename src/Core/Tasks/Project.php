<?php

namespace Upsun\Core\Tasks;

use Upsun\Core\AbstractTask;
use Upsun\Exception\UpsunException;

class Project extends AbstractTask
{
    public function list($organizationId)
    {
        // Implement the logic to retrieve the list of projects for the given organization ID.
        // This would typically involve making an HTTP request to the external API.
        
        // Example of how you might structure the request:
        $response = $this->client->get("/organizations/{$organizationId}/projects");

        if ($response->getStatusCode() !== 200) {
            throw new UpsunException("Failed to retrieve projects for organization ID: {$organizationId}");
        }

        return $response->getBody(); // Assuming the response body contains the project data.
    }
}