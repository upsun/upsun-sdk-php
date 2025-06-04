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
    ) {
        $this->api = new DomainManagementApi($this->client->apiClient, $this->client->apiConfig);
    }

    /************** ********************************/
    /********* DomainManagementApi  ****************/
    /************** ********************************/

    /**
     * Operation createProjectDomain
     *
     * Add a project domain
     *
     * @param string $project_id project_id (required)
     * @param array $domain_create_input (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function createProjectDomain(string $project_id, array $domain_create_input): AcceptedResponse
    {
        $this->refreshToken();
        $domain_create_input = new DomainCreateInput($domain_create_input);
        return $this->api->createProjectsDomains($project_id, $domain_create_input);
    }

    /**
     * Operation createEnvironmentDomain
     *
     * Add an environment domain
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @param array $domain_create_input (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function createEnvironmentDomain(
        string $project_id,
        string $environment_id,
        array $domain_create_input
    ): AcceptedResponse {
        $this->refreshToken();
        $domain_create_input = new DomainCreateInput($domain_create_input);
        return $this->api->createProjectsEnvironmentsDomains($project_id, $environment_id, $domain_create_input);
    }

    /**
     * Operation deleteProjectDomain
     *
     * Delete a project domain
     *
     * @param string $project_id project_id (required)
     * @param string $domain_id domain_id (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function deleteProjectDomain(string $project_id, string $domain_id): AcceptedResponse
    {
        $this->refreshToken();
        return $this->api->deleteProjectsDomains($project_id, $domain_id);
    }

    /**
     * Operation deleteEnvironmentsDomain
     *
     * Delete an environment domain
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @param string $domain_id domain_id (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function deleteEnvironmentDomain(
        string $project_id,
        string $environment_id,
        string $domain_id
    ): AcceptedResponse {
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
    public function getProjectDomain(string $project_id, string $domain_id): Domain
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
    public function getEnvironmentDomain(string $project_id, string $environment_id, string $domain_id): Domain
    {
        $this->refreshToken();
        return $this->api->getProjectsEnvironmentsDomains($project_id, $environment_id, $domain_id);
    }

    /**
     * Operation listProjectDomains
     *
     * Get list of project domains
     *
     * @param string $project_id project_id (required)
     * @return Domain[]
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listProjectDomains(string $project_id): array
    {
        $this->refreshToken();
        return $this->api->listProjectsDomains($project_id);
    }

    /**
     * Operation listEnvironmentDomains
     *
     * Get a list of environment domains
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @return Domain[]
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listEnvironmentDomains(string $project_id, string $environment_id): array
    {
        $this->refreshToken();
        return $this->api->listProjectsEnvironmentsDomains($project_id, $environment_id);
    }

    /**
     * Operation updateProjectDomain
     *
     * Update a project domain
     *
     * @param string $project_id project_id (required)
     * @param string $domain_id domain_id (required)
     * @param array $domain_patch (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function updateProjectDomain(string $project_id, string $domain_id, array $domain_patch): AcceptedResponse
    {
        $this->refreshToken();
        $domain_patch = new DomainPatch($domain_patch);
        return $this->api->updateProjectsDomains($project_id, $domain_id, $domain_patch);
    }

    /**
     * Operation updateEnvironmentDomain
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
    public function updateEnvironmentDomain(
        string $project_id,
        string $environment_id,
        string $domain_id,
        array $domain_patch
    ): AcceptedResponse {
        $this->refreshToken();
        $domain_patch = new DomainPatch($domain_patch);
        return $this->api->updateProjectsEnvironmentsDomains($project_id, $environment_id, $domain_id, $domain_patch);
    }
}
