<?php

namespace Upsun\Core\Tasks;

use Exception;
use InvalidArgumentException;
use Psr\Http\Client\ClientExceptionInterface;
use Upsun\Api\ApiException;
use Upsun\Api\ThirdPartyIntegrationsApi;
use Upsun\Model\AcceptedResponse;
use Upsun\Model\Integration;
use Upsun\Model\IntegrationCreateInput;
use Upsun\Model\IntegrationPatch;
use Upsun\UpsunClient;

/**
 * IntegrationsTask class.
 *
 * @author    Upsun Advocacy Team
 * @license   MIT
 * @see       https://docs.upsun.com
 */
class IntegrationsTask extends TaskBase
{
    public function __construct(
        UpsunClient $client,
        private readonly ThirdPartyIntegrationsApi $thirdPartyIntegrationsApi,
    ) {
        parent::__construct($client);
    }

    /**
     * Create an integration for a project.
     *
     * @param IntegrationCreateInput $integrationCreateInput An implementation of the IntegrationCreateInput interface.
     *        Use one of the concrete types that implement this interface:
     *        BitbucketIntegrationCreateInput
     *         - BitbucketServerIntegrationCreateInput
     *         - GitHubIntegrationCreateInput
     *         - GitLabIntegrationCreateInput
     *         - WebhookIntegrationCreateInput
     *         - HealthEmailIntegrationCreateInput
     *         - HealthPagerdutyIntegrationCreateInput
     *         - HealthSlackIntegrationCreateInput
     *         - HealthWebhookIntegrationCreateInput
     *         - ScriptIntegrationCreateInput
     *         - NewRelicIntegrationCreateInput
     *         - SplunkIntegrationCreateInput
     *         - SumoLogicIntegrationCreateInput
     *         - SyslogIntegrationCreateInput
     *         - DatadogIntegrationCreateInput
     *         - AppDynamicsIntegrationCreateInput
     *         - LogstashIntegrationCreateInput
     *         - DynatraceIntegrationCreateInput
     * @throws InvalidArgumentException
     * @return AcceptedResponse
     */
    public function createIntegration(
        string $projectId,
        IntegrationCreateInput $integrationCreateInput,
    ): AcceptedResponse {
        parent::checkProjectId($projectId);
        
        if($integrationCreateInput->getType() === "") {
            throw new InvalidArgumentException("Integration type cannot be empty.");
        }

        return $this->thirdPartyIntegrationsApi->createProjectsIntegrations(
            projectId: $projectId,
            integrationCreateInput: $integrationCreateInput
        );
    }

    /**
     * Delete a third-party integration from a project. This method allows you to delete an existing integration from a
     * project.
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the project ID or integration ID is invalid
     */
    public function deleteIntegration(
        string $projectId,
        string $integrationId,
    ): AcceptedResponse {
        parent::checkProjectId($projectId);
        
        if($integrationId === "") {
            throw new InvalidArgumentException("Integration ID cannot be empty.");
        }

        return $this->thirdPartyIntegrationsApi->deleteProjectsIntegrations(
            projectId: $projectId,
            integrationId: $integrationId
        );
    }

    /**
     * List all third-party integrations for a project. This method retrieves a list of all integrations that are
     * associated with the specified project.
     * 
     * @param string $projectId
     * @return Integration[]
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the project ID is invalid
     */
    public function listIntegrations(
        string $projectId,
    ): array {
        parent::checkProjectId($projectId);

        return $this->thirdPartyIntegrationsApi->listProjectsIntegrations(
            projectId: $projectId
        );
    }

    /**
     * Get the details of a specific third-party integration for a project. This method retrieves the details of a
     * specific integration that is associated with the specified project.
     * 
     * @throws InvalidArgumentException if the project ID or integration ID is invalid
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getIntegration(
        string $projectId,
        string $integrationId,
    ): Integration {
        parent::checkProjectId($projectId);
        parent::checkIntegrationId($integrationId);

        return $this->thirdPartyIntegrationsApi->getProjectsIntegrations(
            projectId: $projectId,
            integrationId: $integrationId
        );
    }

    /**
     * Update an existing third-party integration for a project. This method allows you to update the configuration of an
     * existing integration for a project by specifying the new parameters for that integration.
     * 
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors or if the request cannot be completed
     * @throws InvalidArgumentException if the project ID, integration ID, or integration update input is invalid
     */
    public function updateIntegration(
        string $projectId,
        string $integrationId,
        IntegrationPatch $integrationUpdateInput,
    ): AcceptedResponse {
        parent::checkProjectId($projectId);
        parent::checkIntegrationId($integrationId);

        if($integrationUpdateInput->getType() === "") {
            throw new InvalidArgumentException("Integration type cannot be empty.");
        }

        return $this->thirdPartyIntegrationsApi->updateProjectsIntegrations(
            projectId: $projectId,
            integrationId: $integrationId,
            integrationPatch: $integrationUpdateInput
        );
    }
}
