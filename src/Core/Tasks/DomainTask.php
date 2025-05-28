<?php

namespace Upsun\Core\Tasks;

use OpenAPI\Client\ApiException;
use OpenAPI\Client\apisgen\DomainManagementApi;
use OpenAPI\Client\Model\AcceptedResponse;
use OpenAPI\Client\Model\Domain;
use OpenAPI\Client\Model\DomainCreateInput;
use OpenAPI\Client\Model\DomainPatch;
use Upsun\UpsunClient;

class DomainTask extends TaskBase
{
    public readonly DomainManagementApi $api;

    public function __construct(
        public readonly UpsunClient $client,
    )
    {
        $this->api = new DomainManagementApi($this->client->apiClient, $this->client->apiConfig);
    }

    /************** ********************************/
    /********* DomainManagementApi  ****************/
    /************** ********************************/

    /**
     * Operation createProjectsDomains
     *
     * Add a project domain
     *
     * @param string $project_id project_id (required)
     * @param array $domain_create_input (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function createProjectsDomains(string $project_id, array $domain_create_input): AcceptedResponse
    {
        $this->refreshToken();
        $domain_create_input = new DomainCreateInput($domain_create_input);
        return $this->api->createProjectsDomains($project_id, $domain_create_input);
    }

    /**
     * Operation createProjectsEnvironmentsDomains
     *
     * Add an environment domain
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @param array $domain_create_input (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function createProjectsEnvironmentsDomains(string $project_id, string $environment_id, array $domain_create_input): AcceptedResponse
    {
        $this->refreshToken();
        $domain_create_input = new DomainCreateInput($domain_create_input);
        return $this->api->createProjectsEnvironmentsDomains($project_id, $environment_id, $domain_create_input);
    }

    /**
     * Operation deleteProjectsDomains
     *
     * Delete a project domain
     *
     * @param string $project_id project_id (required)
     * @param string $domain_id domain_id (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function deleteProjectsDomains(string $project_id, string $domain_id): AcceptedResponse
    {
        $this->refreshToken();
        return $this->api->deleteProjectsDomains($project_id, $domain_id);
    }

    /**
     * Operation deleteProjectsEnvironmentsDomains
     *
     * Delete an environment domain
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @param string $domain_id domain_id (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function deleteProjectsEnvironmentsDomains(string $project_id, string $environment_id, string $domain_id): AcceptedResponse
    {
        $this->refreshToken();
        return $this->api->deleteProjectsEnvironmentsDomains($project_id, $environment_id, $domain_id);
    }

    /**
     * Operation getProjectsDomains
     *
     * Get a project domain
     *
     * @param string $project_id project_id (required)
     * @param string $domain_id domain_id (required)
     * @return Domain
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getProjectsDomains(string $project_id, string $domain_id): Domain
    {
        $this->refreshToken();
        return $this->api->getProjectsDomains($project_id, $domain_id);
    }

    /**
     * Operation getProjectsEnvironmentsDomains
     *
     * Get an environment domain
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @param string $domain_id domain_id (required)
     * @return Domain
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getProjectsEnvironmentsDomains(string $project_id, string $environment_id, string $domain_id): Domain
    {
        $this->refreshToken();
        return $this->api->getProjectsEnvironmentsDomains($project_id, $environment_id, $domain_id);
    }

    /**
     * Operation listProjectsDomains
     *
     * Get list of project domains
     *
     * @param string $project_id project_id (required)
     * @return Domain[]
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listProjectsDomains(string $project_id): array
    {
        $this->refreshToken();
        return $this->api->listProjectsDomains($project_id);
    }

    /**
     * Operation listProjectsEnvironmentsDomains
     *
     * Get a list of environment domains
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @return Domain[]
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listProjectsEnvironmentsDomains(string $project_id, string $environment_id): array
    {
        $this->refreshToken();
        return $this->api->listProjectsEnvironmentsDomains($project_id, $environment_id);
    }

    /**
     * Operation updateProjectsDomains
     *
     * Update a project domain
     *
     * @param string $project_id project_id (required)
     * @param string $domain_id domain_id (required)
     * @param array $domain_patch (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function updateProjectsDomains(string $project_id, string $domain_id, array $domain_patch): AcceptedResponse
    {
        $this->refreshToken();
        $domain_patch = new DomainPatch($domain_patch);
        return $this->api->updateProjectsDomains($project_id, $domain_id, $domain_patch);
    }

    /**
     * Operation updateProjectsEnvironmentsDomains
     *
     * Update an environment domain
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @param string $domain_id domain_id (required)
     * @param array $domain_patch (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function updateProjectsEnvironmentsDomains(string $project_id, string $environment_id, string $domain_id, array $domain_patch): AcceptedResponse
    {
        $this->refreshToken();
        $domain_patch = new DomainPatch($domain_patch);
        return $this->api->updateProjectsEnvironmentsDomains($project_id, $environment_id, $domain_id, $domain_patch);
    }
}