<?php

namespace Upsun\Core\Tasks;

use InvalidArgumentException;
use Psr\Http\Client\ClientExceptionInterface;
use Upsun\Api\ApiException;
use Upsun\Api\DomainManagementApi;
use Upsun\Model\AcceptedResponse;
use Upsun\Model\Domain;
use Upsun\Model\DomainCreateInput;
use Upsun\Model\DomainPatch;
use Upsun\UpsunClient;

/**
 * DomainsTask class.
 *
 * @author    Upsun Advocacy Team
 * @license   MIT
 * @see       https://docs.upsun.com
 */
class DomainsTask extends TaskBase
{
    public function __construct(
        UpsunClient $client,
        private readonly DomainManagementApi $api,
    ) {
        parent::__construct($client);
    }

    /**
     * Add a project (or environment) domain
     *
     * @param DomainCreateInput $domainCreateInput is an instance of ProdDomainStoragePatch or ReplacementDomainStoragePatch
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if required parameters are missing or invalid
     */
    public function add(
        string $projectId,
        DomainCreateInput $domainCreateInput,
        ?string $environmentId = null
    ): AcceptedResponse {
        $this->checkProjectId($projectId);    

        if (!$environmentId) {
            return $this->api->createProjectsDomains(
                $projectId,
                $domainCreateInput
            );
        } else {
            $this->checkEnvironmentId($environmentId);

            return $this->api->createProjectsEnvironmentsDomains(
                $projectId,
                $environmentId,
                $domainCreateInput
            );
        }
    }

    /**
     * Delete a project (or environment) domain
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if required parameters are missing or invalid
     */
    public function delete(string $projectId, string $domainId, ?string $environmentId = null): AcceptedResponse
    {
        $this->checkProjectId($projectId);
        $this->checkDomainId($domainId);

        if (!$environmentId) {
            return $this->api->deleteProjectsDomains($projectId, $domainId);
        } else {
            $this->checkEnvironmentId($environmentId);

            return $this->api->deleteProjectsEnvironmentsDomains(
                $projectId,
                $environmentId,
                $domainId
            );
        }
    }

    /**
     * Get a project (or environment) domain
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if required parameters are missing or invalid
     */
    public function get(string $projectId, string $domainId, ?string $environmentId = null): Domain
    {
        $this->checkProjectId($projectId);
        $this->checkDomainId($domainId);

        if (!$environmentId) {
            return $this->api->getProjectsDomains(projectId: $projectId, domainId: $domainId);
        } else {
            $this->checkEnvironmentId($environmentId);

            return $this->api->getProjectsEnvironmentsDomains(
                projectId: $projectId,
                environmentId: $environmentId,
                domainId: $domainId
            );
        }
    }

    /**
     * Get list of project (or environment) domains
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if required parameters are missing or invalid
     * @return Domain[]
     */
    public function list(string $projectId, ?string $environmentId = null): array
    {
        $this->checkProjectId($projectId);

        if (!$environmentId) {
            return $this->api->listProjectsDomains(projectId: $projectId);
        } else {
            $this->checkEnvironmentId($environmentId);
        
            return $this->api->listProjectsEnvironmentsDomains(projectId: $projectId, environmentId: $environmentId);
        }
    }

    /**
     * Update a project (or environment) domain
     * 
     * @param DomainPatch $domainPatch is an instance of ProdDomainStoragePatch or ReplacementDomainStoragePatch
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if required parameters are missing or invalid
     */
    public function update(
        string $projectId,
        string $domainId,
        DomainPatch $domainPatch,
        ?string $environmentId = null,
    ): AcceptedResponse {
        $this->checkProjectId($projectId);
        $this->checkDomainId($domainId);

        if (!$environmentId) {
            return $this->api->updateProjectsDomains(
                projectId: $projectId,
                domainId: $domainId,
                domainPatch: $domainPatch
            );
        } else {
            $this->checkEnvironmentId($environmentId);

            return $this->api->updateProjectsEnvironmentsDomains(
                projectId: $projectId,
                environmentId: $environmentId,
                domainId: $domainId,
                domainPatch: $domainPatch
            );
        }
    }
}
