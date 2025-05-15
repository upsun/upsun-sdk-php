<?php

namespace Upsun\Core\Tasks;

use Upsun\Core\AbstractTask;
use Upsun\Exception\UpsunException;

class Variables extends AbstractTask
{
    public function list()
    {
        // Implementation for listing variables
        // This would typically involve making an HTTP request to the external API
        // and returning the response data.

        try {
            $response = $this->client->get('/variables');
            return $response->getBody();
        } catch (UpsunException $e) {
            // Handle specific Upsun exceptions
            throw new UpsunException('Error retrieving variables: ' . $e->getMessage());
        } catch (\Exception $e) {
            // Handle general exceptions
            throw new UpsunException('An unexpected error occurred: ' . $e->getMessage());
        }
    }

    public function create($data)
    {
        // Implementation for creating a new variable
        // This would typically involve making an HTTP POST request to the external API.

        try {
            $response = $this->client->post('/variables', $data);
            return $response->getBody();
        } catch (UpsunException $e) {
            throw new UpsunException('Error creating variable: ' . $e->getMessage());
        } catch (\Exception $e) {
            throw new UpsunException('An unexpected error occurred: ' . $e->getMessage());
        }
    }

    public function update($variableId, $data)
    {
        // Implementation for updating an existing variable
        // This would typically involve making an HTTP PUT request to the external API.

        try {
            $response = $this->client->put('/variables/' . $variableId, $data);
            return $response->getBody();
        } catch (UpsunException $e) {
            throw new UpsunException('Error updating variable: ' . $e->getMessage());
        } catch (\Exception $e) {
            throw new UpsunException('An unexpected error occurred: ' . $e->getMessage());
        }
    }

    public function delete($variableId)
    {
        // Implementation for deleting a variable
        // This would typically involve making an HTTP DELETE request to the external API.

        try {
            $response = $this->client->delete('/variables/' . $variableId);
            return $response->getBody();
        } catch (UpsunException $e) {
            throw new UpsunException('Error deleting variable: ' . $e->getMessage());
        } catch (\Exception $e) {
            throw new UpsunException('An unexpected error occurred: ' . $e->getMessage());
        }
    }
}