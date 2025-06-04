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
     * Operation createProjectDomain
     *
     * Add a project (or environment) domain
     *
     * @param string $project_id project_id (required)
     * @param array $domain_create_input (required)
     * @param string|null $environment_id (optional)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function create(string $project_id, array $domain_create_input, string $environment_id = null): AcceptedResponse
    {
        $this->refreshToken();
        $domain_create_input = new DomainCreateInput($domain_create_input);
        if (!$environment_id) {
            return $this->api->createProjectsDomains($project_id, $domain_create_input);
        } else {
            return $this->api->createProjectsEnvironmentsDomains($project_id, $environment_id, $domain_create_input);
        }
    }

    /**
     * Operation deleteProjectDomain
     *
     * Delete a project (or environment) domain
     *
     * @param string $project_id project_id (required)
     * @param string $domain_id domain_id (required)
     * @param string|null $environment_id (optional)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function delete(string $project_id, string $domain_id, string $environment_id = null): AcceptedResponse
    {
        $this->refreshToken();
        if (!$environment_id) {
            return $this->api->deleteProjectsDomains($project_id, $domain_id);
        } else {
            return $this->api->deleteProjectsEnvironmentsDomains($project_id, $environment_id, $domain_id);
        }
    }

    /**
     * Operation getProjectsDomains
     *
     * Get a project (or environment) domain
     *
     * @param string $project_id project_id (required)
     * @param string $domain_id domain_id (required)
     * @param string|null $environment_id
     * @return Domain
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function get(string $project_id, string $domain_id, string $environment_id = null): Domain
    {
        $this->refreshToken();
        if (!$environment_id) {
            return $this->api->getProjectsDomains($project_id, $domain_id);
        } else {
            return $this->api->getProjectsEnvironmentsDomains($project_id, $environment_id, $domain_id);
        }
    }

    /**
     * Operation listProjectDomains
     *
     * Get list of project (or environment) domains
     *
     * @param string $project_id project_id (required)
     * @param string|null $environment_id (optional)
     * @return Domain[]
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function list(string $project_id, string $environment_id = null): array
    {
        $this->refreshToken();
        if (!$environment_id) {
            return $this->api->listProjectsDomains($project_id);
        } else {
            return $this->api->listProjectsEnvironmentsDomains($project_id, $environment_id);
        }
    }

    /**
     * Operation updateProjectDomain
     *
     * Update a project (or environment) domain
     *
     * @param string $project_id project_id (required)
     * @param string $domain_id domain_id (required)
     * @param array $domain_patch (required)
     * @param string|null $environment_id (optional)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function update(string $project_id, string $domain_id, array $domain_patch, string $environment_id = null): AcceptedResponse
    {
        $this->refreshToken();
        $domain_patch = new DomainPatch($domain_patch);
        if (!$environment_id) {
            return $this->api->updateProjectsDomains($project_id, $domain_id, $domain_patch);
        } else {
            return $this->api->updateProjectsEnvironmentsDomains($project_id, $environment_id, $domain_id, $domain_patch);
        }
    }
}
