<?php

namespace Upsun\Core\Tasks;

use Upsun\Api\DomainManagementApi;
use Upsun\Model\AcceptedResponse;
use Upsun\Model\Domain;
use Upsun\Model\DomainCreateInput;
use Upsun\Model\DomainPatch;
use Upsun\UpsunClient;

/**
 * DomainTask class.
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
     * Adds a project (or environment) domain
     *
     * @param array{
     *     name: string,
     *     attributes?: array,
     *     isDefault?: bool,
     *     replacementFor?: string,
     * } $data
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function create(
        string $projectId,
        array $data = [],
        ?string $environmentId = null
    ): AcceptedResponse {
        $domainCreateInput = new DomainCreateInput(...$data);
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
     * @throws ClientExceptionInterface
     */
    public function delete(string $projectId, string $domainId, ?string $environmentId = null): AcceptedResponse
    {
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
     * @throws ClientExceptionInterface
     */
    public function get(string $projectId, string $domainId, ?string $environmentId = null): Domain
    {
        if (!$environmentId) {
            return $this->api->getProjectsDomains($projectId, $domainId);
        } else {
            return $this->api->getProjectsEnvironmentsDomains($projectId, $environmentId, $domainId);
        }
    }

    /**
     * Gets list of project (or environment) domains
     *
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @return Domain[]
     */
    public function list(string $projectId, ?string $environmentId = null): array
    {
        if (!$environmentId) {
            return $this->api->listProjectsDomains($projectId);
        } else {
            return $this->api->listProjectsEnvironmentsDomains($projectId, $environmentId);
        }
    }

    /**
     * Updates a project (or environment) domain
     *
     * @param array{
     *     attributes?: array,
     *     isDefault?: bool,
     * } $data
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function update(
        string $projectId,
        string $domainId,
        array $data,
        ?string $environmentId = null
    ): AcceptedResponse {
        $domainPatch = new DomainPatch(...$data);
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
