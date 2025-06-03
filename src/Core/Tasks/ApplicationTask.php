<?php

namespace Upsun\Core\Tasks;

use OpenAPI\Client\ApiException;
use OpenAPI\Client\apisgen\DeploymentApi;
use Upsun\UpsunClient;

class ApplicationTask extends TaskBase
{
    public readonly DeploymentApi $api;

    public function __construct(
        public readonly UpsunClient $client,
    )
    {
        $this->api = new DeploymentApi($this->client->apiClient, $this->client->apiConfig);
    }

    /**
     * @param string $projectId
     * @param string $environmentId
     * @return array|string
     * @throws ApiException
     */
    public function listApplications(string $projectId, string $environmentId): array
    {
        $deployments = $this->api->listProjectsEnvironmentsDeployments($projectId, $environmentId);
        
        
        
        dd($deployments, $deployments[0]->getWebapps());
        
        
        $defaultEnv = $this->getDefaultEnv($projectId);

        var_dump($projectId);

        $response = $this->getCurlResponse("/projects/" . $projectId . "/environments/" . $defaultEnv . "/deployments");

        if ($response->getStatusCode() != 200) {
            return '';
        }

        $projectDeploy = json_decode($response->getContent());

        $projectDeploy = reset($projectDeploy);
        $webapps = $projectDeploy->webapps ?? [];

        foreach ($webapps as $webapp => $data) {
            $relationShips = (array)$data->relationships;
            if (!empty($relationShips)) {
                foreach ($data->relationships as $relationName => $relationValue) {
                    var_dump($relationName, $relationValue);
                    //TODO check how to detect database relations
                    if (
                        str_contains('database', $relationName)
                        || str_contains('sql', $relationValue->endpoint)
                        || str_contains('db', $relationValue->endpoint)
                    ) {
                        return $webapp;
                    }
                }
            }
        }

        return '';
    }
}