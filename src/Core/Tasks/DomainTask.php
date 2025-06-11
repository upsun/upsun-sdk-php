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

    public function __construct(
        public UpsunClient          $client,
        private readonly DomainManagementApi $api,
    )
    {
        parent::__construct($this->client);
    }
    
    /**
     * Adds a project (or environment) domain
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function create(
        string  $projectId,
        array   $domainCreateInput,
        ?string $environmentId = null
    ): AcceptedResponse
    {
        $this->refreshToken();
        $domainCreateInput = new DomainCreateInput($domainCreateInput);
        if (!$environmentId) {
            return $this->api->createProjectsDomains($projectId, $domainCreateInput);
        } else {
            return $this->api->createProjectsEnvironmentsDomains(
                $projectId,
                $environmentId,
                $domainCreateInput
            );
        }
    }

    /**
     * Deletes a project (or environment) domain
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function delete(string $projectId, string $domainId, ?string $environmentId = null): AcceptedResponse
    {
        $this->refreshToken();
        if (!$environmentId) {
            return $this->api->deleteProjectsDomains($projectId, $domainId);
        } else {
            return $this->api->deleteProjectsEnvironmentsDomains($projectId, $environmentId, $domainId);
        }
    }

    /**
     * Gets a project (or environment) domain
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function get(string $projectId, string $domainId, ?string $environmentId = null): Domain
    {
        $this->refreshToken();
        if (!$environmentId) {
            return $this->api->getProjectsDomains($projectId, $domainId);
        } else {
            return $this->api->getProjectsEnvironmentsDomains($projectId, $environmentId, $domainId);
        }
    }

    /**
     * Gets list of project (or environment) domains
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function list(string $projectId, ?string $environmentId = null): array
    {
        $this->refreshToken();
        if (!$environmentId) {
            return $this->api->listProjectsDomains($projectId);
        } else {
            return $this->api->listProjectsEnvironmentsDomains($projectId, $environmentId);
        }
    }

    /**
     * Updates a project (or environment) domain
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function update(
        string  $projectId,
        string  $domainId,
        array   $domainPatch,
        ?string $environmentId = null
    ): AcceptedResponse
    {
        $this->refreshToken();
        $domainPatch = new DomainPatch($domainPatch);
        if (!$environmentId) {
            return $this->api->updateProjectsDomains($projectId, $domainId, $domainPatch);
        } else {
            return $this->api->updateProjectsEnvironmentsDomains(
                $projectId,
                $environmentId,
                $domainId,
                $domainPatch
            );
        }
    }
}
