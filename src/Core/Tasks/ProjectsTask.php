<?php

namespace Upsun\Core\Tasks;

use Psr\Http\Client\ClientExceptionInterface;
use Upsun\Api\ApiException;
use Upsun\Api\DeploymentTargetApi;
use Upsun\Api\ProjectApi;
use Upsun\Api\ProjectSettingsApi;
use Upsun\Api\RepositoryApi;
use Upsun\Api\SubscriptionsApi;
use Upsun\Api\SystemInformationApi;
use Upsun\Api\ThirdPartyIntegrationsApi;
use Upsun\Model\AcceptedResponse;
use Upsun\Model\Activity;
use Upsun\Model\AddonCredential1;
use Upsun\Model\Blob;
use Upsun\Model\BuildResources2;
use Upsun\Model\CanCreateNewOrgSubscription200Response;
use Upsun\Model\Certificate;
use Upsun\Model\Commit;
use Upsun\Model\CreateOrgSubscriptionRequest;
use Upsun\Model\DeploymentTarget;
use Upsun\Model\DeploymentTargetCreateInput;
use Upsun\Model\DeploymentTargetPatch;
use Upsun\Model\Domain;
use Upsun\Model\Environment;
use Upsun\Model\Integration;
use Upsun\Model\IntegrationCreateInput;
use Upsun\Model\IntegrationPatch;
use Upsun\Model\ListProjectTeamAccess200Response;
use Upsun\Model\ListProjectUserAccess200Response;
use Upsun\Model\OAuth2Consumer1;
use Upsun\Model\Project;
use Upsun\Model\ProjectCapabilities;
use Upsun\Model\ProjectInvitation;
use Upsun\Model\ProjectPatch;
use Upsun\Model\ProjectSettings;
use Upsun\Model\ProjectSettingsPatch;
use Upsun\Model\ProjectVariable;
use Upsun\Model\Ref;
use Upsun\Model\Subscription;
use Upsun\Model\SystemInformation;
use Upsun\Model\TeamProjectAccess;
use Upsun\Model\Tree;
use Upsun\Model\UserProjectAccess;
use Upsun\UpsunClient;

/**
 * ProjectTask class.
 *
 * @author    Upsun Advocacy Team
 * @license   MIT
 * @see       https://docs.upsun.com
 */
class ProjectsTask extends TaskBase
{
    public function __construct(
        UpsunClient $client,
        private readonly ProjectApi $api,
        private readonly ProjectSettingsApi $settingsApi,
        private readonly DeploymentTargetApi $deploymentTargetApi,
        private readonly RepositoryApi $repositoryApi,
        private readonly SystemInformationApi $systemInfoApi,
        private readonly ThirdPartyIntegrationsApi $thirdPartyIntegrationsApi,
        private readonly SubscriptionsApi $subscriptionsApi,
    ) {
        parent::__construct($client);
    }

    /**
     * Deletes a project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function delete(string $projectId): void
    {
        $project = $this->get($projectId);
        $path = parse_url($project->getSubscription()->getLicenseUri(), PHP_URL_PATH);
        $subscriptionId = basename($path);

        $this->subscriptionsApi->deleteOrgSubscription(
            $project->getOrganization(),
            $subscriptionId
        );
    }

    /**
     * Gets a project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function get(string $projectId): Project
    {
        return $this->api->getProjects($projectId);
    }

    /**
     * Creates a project
     *
     * @throws ApiException
     * @throws ClientExceptionInterface
     */
    public function create(
        string $organizationId,
        string $projectRegion,
        ?string $title = null,
        ?string $defaultBranch = null,
        ?string $plan = null,
        ?string $optionsUrl = null,
        ?int $environments = null,
        ?int $storage = null,
    ): Subscription {
        $createProjectData = new CreateOrgSubscriptionRequest(
            projectRegion: $projectRegion,
            plan: $plan,
            projectTitle: $title,
            optionsUrl: $optionsUrl,
            defaultBranch: $defaultBranch,
            environments: $environments,
            storage: $storage
        );
        return $this->subscriptionsApi->createOrgSubscription($organizationId, $createProjectData);
    }

    /**
     * Checks if the user is able to create a new project in the organization.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function canCreate(string $organizationId): CanCreateNewOrgSubscription200Response
    {
        return $this->subscriptionsApi->canCreateNewOrgSubscription($organizationId);
    }

    /**
     * Gets a project's capabilities
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getCapabilities(string $projectId): ProjectCapabilities
    {
        return $this->api->getProjectsCapabilities($projectId);
    }

    /**
     * Updates a project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function update(
        string $projectId,
        ?string $title = null,
        ?string $defaultBranch = null,
        ?string $description = null,
        ?string $defaultDomain = null,
        ?array $attributes = [],
        ?string $timezone = null,
        ?string $region = null,
    ): AcceptedResponse {
        $projectPatch = new ProjectPatch(
            defaultBranch: $defaultBranch,
            defaultDomain: $defaultDomain,
            attributes: $attributes,
            title: $title,
            description: $description,
            timezone: $timezone,
            region: $region
        );
        return $this->api->updateProjects($projectId, $projectPatch);
    }

    /**
     * Cancels a pending invitation to a project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function cancelInvite(string $projectId, string $invitationId): void
    {
        $this->client->invitations->cancelProjectInvite($projectId, $invitationId);
    }

    /**
     * Invites user to a project by email
     *
     * @param array<int, 'read'|'write'|'admin'>|null $permissions
     * @param array<int, array{id: string, name: string}>|null $environments
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function createInvite(
        string $projectId,
        string $email,
        ?string $role = null,
        ?array $permissions = null,
        ?array $environments = null,
        ?bool $force = null,
    ): ProjectInvitation {
        return $this->client->invitations->createProjectInvite(
            $projectId,
            $email,
            $role,
            $permissions,
            $environments,
            $force
        );
    }

    /**
     * Lists invitations to a project
     *
     *
     * @throws ClientExceptionInterface
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @return ProjectInvitation[]
     */
    public function listInvites(
        string $projectId,
        ?array $filterState = null,
        ?int $pageSize = null,
        ?string $pageBefore = null,
        ?string $pageAfter = null,
        ?string $sort = null
    ): array {
        return $this->client->invitations->listProjectInvites(
            $projectId,
            $filterState,
            $pageSize,
            $pageBefore,
            $pageAfter,
            $sort
        );
    }

    /**
     * Gets list of project settings
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getSettings(string $projectId): ProjectSettings
    {
        return $this->settingsApi->getProjectsSettings($projectId);
    }

    /**
     * Updates a project setting
     *
     * @param null|array{
     *     step: string,
     *     status: string
     * } $initialize
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function updateSettings(
        string $projectId,
        ?array $initialize = null,
        ?array $dataRetention = null,
        ?float $cpu = null,
        ?int $memory = null
    ): AcceptedResponse {
        $projectSettingsPatch = new ProjectSettingsPatch(
            dataRetention: $dataRetention,
            initialize: (object)$initialize,
            buildResources: $cpu || $memory ? new BuildResources2(
                cpu: $cpu ?? null,
                memory: $memory ?? null,
            ) : null,
        );
        return $this->settingsApi->updateProjectsSettings($projectId, $projectSettingsPatch);
    }

    /**
     * Adds a project variable
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function createVariable(
        string $projectId,
        string $name,
        string $value,
        ?array $attributes = [],
        ?bool $isJson = null,
        ?bool $isSensitive = null,
        ?bool $visibleBuild = null,
        ?bool $visibleRuntime = null,
        ?array $applicationScope = [],
    ): AcceptedResponse {
        return $this->client->variables->createProjectVariable(
            $projectId,
            $name,
            $value,
            $attributes,
            $isJson,
            $isSensitive,
            $visibleBuild,
            $visibleRuntime,
            $applicationScope
        );
    }

    /**
     * Get a project variable
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getVariable(string $projectId, string $projectVariableId): ProjectVariable
    {
        return $this->client->variables->getProjectVariable($projectId, $projectVariableId);
    }

    /**
     * Deletes a project variable
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function deleteVariable(string $projectId, string $projectVariableId): AcceptedResponse
    {
        return $this->client->variables->deleteProjectVariable($projectId, $projectVariableId);
    }

    /**
     * Gets list of project variables
     *
     *
     * @throws ClientExceptionInterface
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @return ProjectVariable[]
     */
    public function listVariables(string $projectId): array
    {
        return $this->client->variables->listProjectVariables($projectId);
    }

    /**
     * Updates a project variable
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function updateVariable(
        string $projectId,
        string $projectVariableId,
        ?string $name = null,
        ?string $value = null,
        ?array $attributes = null,
        ?bool $isJson = null,
        ?bool $isSensitive = null,
        ?bool $visibleBuild = null,
        ?bool $visibleRuntime = null,
        ?array $applicationScope = null,
    ): AcceptedResponse {
        return $this->client->variables->updateProjectVariable(
            $projectId,
            $projectVariableId,
            $name,
            $value,
            $attributes,
            $isJson,
            $isSensitive,
            $visibleBuild,
            $visibleRuntime,
            $applicationScope,
        );
    }

    /**
     * Gets project activity log
     *
     *
     * @throws ClientExceptionInterface
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @return Activity[]
     */
    public function listActivities(string $projectId): array
    {
        return $this->client->activities->list($projectId);
    }

    /**
     * Gets a project activity log entry
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getActivity(string $projectId, string $activityId): Activity
    {
        return $this->client->activities->get($projectId, $activityId);
    }

    /**
     * Cancels a project activity
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function cancelActivity(string $projectId, string $activityId): AcceptedResponse
    {
        return $this->client->activities->cancel($projectId, $activityId);
    }

    /**
     * Creates a project deployment target
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function createDeployment(
        string $projectId,
        string $type,
        string $name,
        ?array $hosts = [],
        ?array $enforcedMounts = null,
        ?array $siteUrls = null,
        ?array $sshHosts = [],
        ?array $enterpriseEnvironmentsMapping = null,
        ?bool $useDedicatedGrid = null,
    ): AcceptedResponse {
        $deploymentTargetCreateInput = new DeploymentTargetCreateInput(
            type: $type,
            name: $name,
            hosts: $hosts,
            enforcedMounts: (object)$enforcedMounts,
            siteUrls: (object)$siteUrls,
            sshHosts: $sshHosts,
            enterpriseEnvironmentsMapping: (object)$enterpriseEnvironmentsMapping,
            useDedicatedGrid: $useDedicatedGrid,
        );
        return $this->deploymentTargetApi->createProjectsDeployments($projectId, $deploymentTargetCreateInput);
    }

    /**
     * Deletes a single project deployment target
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function deleteDeployment(string $projectId, string $deploymentTargetConfigurationId): AcceptedResponse
    {
        return $this->deploymentTargetApi->deleteProjectsDeployments($projectId, $deploymentTargetConfigurationId);
    }

    /**
     * Gets a single project deployment target
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getDeployment(string $projectId, string $deploymentTargetConfigurationId): DeploymentTarget
    {
        return $this->deploymentTargetApi->getProjectsDeployments($projectId, $deploymentTargetConfigurationId);
    }

    /**
     * Gets project deployment target info
     *
     *
     * @throws ClientExceptionInterface
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @return DeploymentTarget[]
     */
    public function listDeployments(string $projectId): array
    {
        return $this->deploymentTargetApi->listProjectsDeployments($projectId);
    }

    /**
     * Updates a project deployment
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function updateDeployment(
        string $projectId,
        string $deploymentTargetConfigurationId,
        string $type,
        string $name,
        ?array $hosts = [],
        ?array $enforcedMounts = null,
        ?array $siteUrls = null,
        ?array $sshHosts = [],
        ?array $enterpriseEnvironmentsMapping = null,
        ?bool $useDedicatedGrid = null,
    ): AcceptedResponse {
        $deploymentTargetPatch = new DeploymentTargetPatch(
            type: $type,
            name: $name,
            hosts: $hosts,
            enforcedMounts: (object)$enforcedMounts,
            siteUrls: (object)$siteUrls,
            sshHosts: $sshHosts,
            enterpriseEnvironmentsMapping: (object)$enterpriseEnvironmentsMapping,
            useDedicatedGrid: $useDedicatedGrid,
        );

        return $this->deploymentTargetApi->updateProjectsDeployments(
            $projectId,
            $deploymentTargetConfigurationId,
            $deploymentTargetPatch
        );
    }

    /**
     * Gets a blob object
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getGitBlob(string $projectId, string $repositoryBlobId): Blob
    {
        return $this->repositoryApi->getProjectsGitBlobs($projectId, $repositoryBlobId);
    }

    /**
     * Gets a commit object
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getGitCommit(string $projectId, string $repositoryCommitId): Commit
    {
        return $this->repositoryApi->getProjectsGitCommits($projectId, $repositoryCommitId);
    }

    /**
     * Gets a Git ref object
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getGitRef(string $projectId, string $repositoryRefId): Ref
    {
        return $this->repositoryApi->getProjectsGitRefs($projectId, $repositoryRefId);
    }

    /**
     * Gets a Git tree object
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getGitTree(string $projectId, string $repositoryTreeId): Tree
    {
        return $this->repositoryApi->getProjectsGitTrees($projectId, $repositoryTreeId);
    }

    /**
     * Gets list of repository refs
     *
     *
     * @throws ClientExceptionInterface
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @return Ref[]
     */
    public function listGitRefs(string $projectId): array
    {
        return $this->repositoryApi->listProjectsGitRefs($projectId);
    }

    /**
     * Restarts the Git server
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function restartGitServer(string $projectId): AcceptedResponse
    {
        return $this->systemInfoApi->actionProjectsSystemRestart($projectId);
    }

    /**
     * Get information about the Git server.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getGitInfo(string $projectId): SystemInformation
    {
        return $this->systemInfoApi->getProjectsSystem($projectId);
    }

    /**
     * Integrates project with a third-party service
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function createIntegration(
        string $projectId,
        string $type,
        string $repository,
        string $url,
        string $username,
        string $token,
        string $project,
        string $serviceId,
        array $recipients,
        string $routingKey,
        string $channel,
        string $licenseKey,
        string $script,
        string $index,
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
        $integrationCreateInput = new IntegrationCreateInput(
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
        );
        return $this->thirdPartyIntegrationsApi->createProjectsIntegrations($projectId, $integrationCreateInput);
    }

    /**
     * Deletes an existing third-party integration
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function deleteIntegration(string $projectId, string $integrationId): AcceptedResponse
    {
        return $this->thirdPartyIntegrationsApi->deleteProjectsIntegrations($projectId, $integrationId);
    }

    /**
     * Gets information about an existing third-party integration
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getIntegration(string $projectId, string $integrationId): Integration
    {
        return $this->thirdPartyIntegrationsApi->getProjectsIntegrations($projectId, $integrationId);
    }

    /**
     * Gets list of existing integrations for a project
     *
     *
     * @throws ClientExceptionInterface
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @return Integration[]
     */
    public function listIntegrations(string $projectId): array
    {
        return $this->thirdPartyIntegrationsApi->listProjectsIntegrations($projectId);
    }

    /**
     * Updates an existing third-party integration
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function updateIntegration(
        string $projectId,
        string $integrationId,
        string $type,
        string $repository,
        string $url,
        string $username,
        string $token,
        string $project,
        string $serviceId,
        array $recipients,
        string $routingKey,
        string $channel,
        string $licenseKey,
        string $script,
        string $index,
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
        $integrationPatch = new IntegrationPatch(
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
        );
        return $this->thirdPartyIntegrationsApi->updateProjectsIntegrations(
            $projectId,
            $integrationId,
            $integrationPatch
        );
    }

    /**
     * Adds a project domain
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function createDomain(
        string $projectId,
        string $name,
        ?array $attributes = null,
        ?bool $isDefault = null,
        ?string $replacementFor = null
    ): AcceptedResponse {
        return $this->client->domains->create($projectId, $name, $attributes, $isDefault, $replacementFor);
    }

    /**
     * Deletes a project domain
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function deleteDomain(string $projectId, string $domainId): AcceptedResponse
    {
        return $this->client->domains->delete($projectId, $domainId);
    }

    /**
     * Gets a project domain
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getDomain(string $projectId, string $domainId): Domain
    {
        return $this->client->domains->get($projectId, $domainId);
    }

    /**
     * Gets list of project domains
     *
     *
     * @throws ClientExceptionInterface
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @return Domain[]
     */
    public function listDomains(string $projectId): array
    {
        return $this->client->domains->list($projectId);
    }

    /**
     * Updates a project domain
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function updateDomain(
        string $projectId,
        string $domainId,
        ?array $attributes,
        ?bool $isDefault
    ): AcceptedResponse {
        return $this->client->domains->update($projectId, $domainId, $attributes, $isDefault);
    }

    /**
     * Adds an SSL certificate
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function createCertificate(
        string $projectId,
        string $certificate,
        string $key,
        ?array $chain = null,
        ?bool $isInvalid = null
    ): AcceptedResponse {
        return $this->client->certificates->create(
            $projectId,
            $certificate,
            $key,
            $chain,
            $isInvalid
        );
    }

    /**
     * Deletes an SSL certificate
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function deleteCertificate(string $projectId, string $certificateId): AcceptedResponse
    {
        return $this->client->certificates->delete($projectId, $certificateId);
    }

    /**
     * Gets an SSL certificate
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getCertificate(string $projectId, string $certificateId): Certificate
    {
        return $this->client->certificates->get($projectId, $certificateId);
    }

    /**
     * Gets list of SSL certificates
     *
     *
     * @throws ClientExceptionInterface
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @return Certificate[]
     */
    public function listCertificates(string $projectId): array
    {
        return $this->client->certificates->list($projectId);
    }

    /**
     * Updates an SSL certificate
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function updateCertificate(
        string $projectId,
        string $certificateId,
        ?array $chain = null,
        ?bool $isInvalid = null,
    ): AcceptedResponse {
        return $this->client->certificates->update($projectId, $certificateId, $chain, $isInvalid);
    }

    /**
     * Executes a runtime operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function runOperation(
        string $projectId,
        string $environmentId,
        string $deploymentId,
        string $service,
        string $operation,
        array $parameters
    ): AcceptedResponse {
        return $this->client->operations->run(
            $projectId,
            $environmentId,
            $deploymentId,
            $service,
            $operation,
            $parameters
        );
    }

    /**
     * Gets team access for a project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getProjectTeamAccess(string $projectId, string $teamId): TeamProjectAccess
    {
        return $this->client->teams->getProjectTeamAccess($projectId, $teamId);
    }


    /**
     * Gets project access for a team
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getTeamProjectAccess(string $teamId, string $projectId): TeamProjectAccess
    {
        return $this->client->teams->getTeamProjectAccess($teamId, $projectId);
    }

    /**
     * Grants team access to a project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function grantProjectTeamAccess(string $projectId, array $grantProjectTeamAccessRequestInner): void
    {
        $this->client->teams->grantProjectTeamAccess($projectId, $grantProjectTeamAccessRequestInner);
    }

    /**
     * Grants project access to a team
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function grantTeamProjectAccess(string $teamId, array $data): void
    {
        $this->client->teams->grantTeamProjectAccess($teamId, $data);
    }

    /**
     * Lists team access for a project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function listProjectTeamAccess(
        string $projectId,
        ?int $pageSize = null,
        ?string $pageBefore = null,
        ?string $pageAfter = null,
        ?string $sort = null
    ): ListProjectTeamAccess200Response {
        return $this->client->teams->listProjectTeamAccess($projectId, $pageSize, $pageBefore, $pageAfter, $sort);
    }

    /**
     * Lists project access for a team
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function listTeamProjectAccess(
        string $teamId,
        ?int $pageSize = null,
        ?string $pageBefore = null,
        ?string $pageAfter = null,
        ?string $sort = null
    ): ListProjectTeamAccess200Response {
        return $this->client->teams->listTeamProjectAccess($teamId, $pageSize, $pageBefore, $pageAfter, $sort);
    }

    /**
     * Removes team access for a project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function removeProjectTeamAccess(string $projectId, string $teamId): void
    {
        $this->client->teams->removeProjectTeamAccess($projectId, $teamId);
    }

    /**
     * Removes project access for a team
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function removeTeamProjectAccess(string $teamId, string $projectId): void
    {
        $this->client->teams->removeTeamProjectAccess($teamId, $projectId);
    }

    /**
     * Gets user access for a project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getProjectUserAccess(string $projectId, string $userId): UserProjectAccess
    {
        return $this->client->users->getProjectUserAccess($projectId, $userId);
    }

    /**
     * Grants user access to a project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function grantProjectUserAccess(string $projectId, array $data): void
    {
        $this->client->users->grantProjectUserAccess($projectId, $data);
    }

    /**
     * Removes user access for a project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function removeProjectUserAccess(string $projectId, string $userId): void
    {
        $this->client->users->removeProjectUserAccess($projectId, $userId);
    }

    /**
     * Updates user access for a project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function updateProjectUserAccess(
        string $projectId,
        string $userId,
        ?array $permissions = null
    ): void {
        $this->client->users->updateProjectUserAccess($projectId, $userId, $permissions);
    }

    /**
     * Lists user access for a project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function listProjectUserAccess(
        string $projectId,
        ?int $pageSize = null,
        ?string $pageBefore = null,
        ?string $pageAfter = null,
        ?string $sort = null
    ): ListProjectUserAccess200Response {
        return $this->client->users->listProjectUserAccess($projectId, $pageSize, $pageBefore, $pageAfter, $sort);
    }

    /**
     * Lists environments of a project
     *
     * @throws ClientExceptionInterface
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @return Environment[]
     */
    public function listEnvironments(string $projectId): array
    {
        return $this->client->environments->list($projectId);
    }
}
