<?php

namespace Upsun\Core\Tasks;

use InvalidArgumentException;
use Upsun\Api\ThirdPartyIntegrationsApi;
use Upsun\Model\AcceptedResponse;
use Upsun\Model\AddonCredential1;
use Upsun\Model\IntegrationCreateInput;
use Upsun\Model\OAuth2Consumer1;
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
     * @throws InvalidArgumentException
     * @return AcceptedResponse
     */
    public function createIntegration(
        string $projectId,
        string $type,
        ?string $repository = null,
        ?string $url = null,
        ?string $username = null,
        ?string $token = null,
        ?string $project = null,
        ?string $serviceId = null,
        ?array $recipients = null,
        ?string $routingKey = null,
        ?string $channel = null,
        ?string $licenseKey = null,
        ?string $script = null,
        ?string $index = null,
        ?array $appCredentials = null,
        ?array $addonCredentials = null,
        ?string $fromAddress = null,
        ?string $sharedKey = null,
        ?bool $fetchBranches = null,
        ?bool $pruneBranches = null,
        ?string $environmentInitResources = null,
        ?bool $buildPullRequests = null,
        ?bool $pullRequestsCloneParentData = null,
        ?bool $resyncPullRequests = null,
        ?array $events = [],
        ?array $environments = [],
        ?array $excludedEnvironments = [],
        ?array $states = [],
        ?string $result = null,
        ?string $baseUrl = null,
        ?bool $buildDraftPullRequests = null,
        ?bool $buildPullRequestsPostMerge = null,
        ?bool $rotateToken = null,
        ?int $rotateTokenValidityInWeeks = null,
        ?bool $buildMergeRequests = null,
        ?bool $buildWipMergeRequests = null,
        ?bool $mergeRequestsCloneParentData = null,
        ?array $extra = [],
        ?array $headers = [],
        ?bool $tlsVerify = null,
        ?array $excludedServices = [],
        ?string $sourceType = null,
        ?string $category = null,
        ?string $host = null,
        ?int $port = null,
        ?string $protocol = null,
        ?int $facility = null,
        ?string $messageFormat = null,
        ?string $authToken = null,
        ?string $authMode = null,
    ): AcceptedResponse {
        parent::checkProjectId($projectId);

        if (empty($type)) {
            throw new InvalidArgumentException('Integration type is required');
        }

        return $this->thirdPartyIntegrationsApi->createProjectsIntegrations(
            projectId: $projectId,
            integrationCreateInput: new IntegrationCreateInput(
                type: $type,
                repository: $repository,
                url: $url,
                username: $username,
                token: $token,
                project: $project,
                serviceId: $serviceId,
                recipients: $recipients,
                routingKey: $routingKey,
                channel: $channel,
                licenseKey: $licenseKey,
                script: $script,
                index: $index,
                appCredentials: $appCredentials ?
                    new OAuth2Consumer1(
                        $appCredentials['key'],
                        $appCredentials['secret'],
                    ) : null,
                addonCredentials: $addonCredentials ?
                    new AddonCredential1(
                        $addonCredentials['addonKey'],
                        $addonCredentials['clientKey'],
                        $addonCredentials['sharedSecret'],
                    ) : null,
                fromAddress: $fromAddress,
                sharedKey: $sharedKey,
                fetchBranches: $fetchBranches,
                pruneBranches: $pruneBranches,
                environmentInitResources: $environmentInitResources,
                buildPullRequests: $buildPullRequests,
                pullRequestsCloneParentData: $pullRequestsCloneParentData,
                resyncPullRequests: $resyncPullRequests,
                events: $events,
                environments: $environments,
                excludedEnvironments: $excludedEnvironments,
                states: $states,
                result: $result,
                baseUrl: $baseUrl,
                buildDraftPullRequests: $buildDraftPullRequests,
                buildPullRequestsPostMerge: $buildPullRequestsPostMerge,
                rotateToken: $rotateToken,
                rotateTokenValidityInWeeks: $rotateTokenValidityInWeeks,
                buildMergeRequests: $buildMergeRequests,
                buildWipMergeRequests: $buildWipMergeRequests,
                mergeRequestsCloneParentData: $mergeRequestsCloneParentData,
                extra: $extra,
                headers: $headers,
                tlsVerify: $tlsVerify,
                excludedServices: $excludedServices,
                sourcetype: $sourceType,
                category: $category,
                host: $host,
                port: $port,
                protocol: $protocol,
                facility: $facility,
                messageFormat: $messageFormat,
                authToken: $authToken,
                authMode: $authMode
            )
        );
    }
}
