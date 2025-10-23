<?php

namespace Upsun\Core\Tasks;

use Exception;
use InvalidArgumentException;
use Upsun\ApiException;
use Upsun\Api\DeploymentTargetApi;
use Upsun\Api\ProjectApi;
use Upsun\Api\ProjectSettingsApi;
use Upsun\Api\RepositoryApi;
use Upsun\Api\SubscriptionsApi;
use Upsun\Api\SystemInformationApi;
use Upsun\Api\ThirdPartyIntegrationsApi;
use Upsun\Model\AcceptedResponse;
use Upsun\Model\Activity;
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
use Upsun\Model\TheAddonCredentialInformationOptional1;
use Upsun\Model\TheOAuth2ConsumerInformationOptional1;
use Upsun\Model\Tree;
use Upsun\Model\UserProjectAccess;
use Upsun\UpsunClient;

/**
 * ProjectTask class.
 *
 * @author    Upsun SDK Team
 * @license   Apache-2.0
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
     * @throws InvalidArgumentException|Exception
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
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
     * @throws InvalidArgumentException|Exception
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function get(string $projectId): Project
    {
        return $this->api->getProjects($projectId);
    }

    /**
     * Creates a project
     *
     * @param array{
     *     projectRegion: string,
     *     plan?: string,
     *     projectTitle?: string,
     *     optionsUrl?: string,
     *     defaultBranch?: string,
     *     environments?: int,
     *     storage?: int
     * } $projectData Update data
     * @throws ApiException|Exception
     */
    public function create(string $organizationId, array $projectData): Subscription
    {
        $createProjectData = new CreateOrgSubscriptionRequest(...$projectData);
        return $this->subscriptionsApi->createOrgSubscription($organizationId, $createProjectData);
    }

    /**
     * Checks if the user is able to create a new project in the organization.
     *
     * @throws InvalidArgumentException|Exception
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function canCreate(string $organizationId): CanCreateNewOrgSubscription200Response
    {
        return $this->subscriptionsApi->canCreateNewOrgSubscription($organizationId);
    }

    /**
     * Gets a project's capabilities
     *
     * @throws InvalidArgumentException|Exception
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function getCapabilities(string $projectId): ProjectCapabilities
    {
        return $this->api->getProjectsCapabilities($projectId);
    }

    /**
     * Updates a project
     *
     * @param array{
     *   defaultBranch?: string,
     *   defaultDomain?: string,
     *   attributes?: array,
     *   title?: string,
     *   description?: string,
     *   timezone?: string,
     *   region?: string
     * } $data
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     *
     * @throws InvalidArgumentException|Exception
     */
    public function update(string $projectId, array $data): AcceptedResponse
    {
        $project_patch = new ProjectPatch(...$data);
        return $this->api->updateProjects($projectId, $project_patch);
    }

    /**
     * Cancels a pending invitation to a project
     *
     * @throws InvalidArgumentException
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function cancelInvite(string $projectId, string $invitationId): void
    {
        $this->client->invitations->cancelProjectInvite($projectId, $invitationId);
    }

    /**
     * Invites user to a project by email
     *
     * @param array{
     *     email: string,
     *     role?: string,
     *     permissions?: array,
     *     environments?: bool,
     *     force?: bool
     * } $data
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     *
     * @throws InvalidArgumentException
     */
    public function createInvite(string $projectId, array $data): ProjectInvitation
    {
        return $this->client->invitations->createProjectInvite($projectId, $data);
    }

    /**
     * Lists invitations to a project
     *
     * @return ProjectInvitation[]
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
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
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function getSettings(string $projectId): ProjectSettings
    {
        return $this->settingsApi->getProjectsSettings($projectId);
    }

    /**
     * Updates a project setting
     *
     * @param array{
     *     dataRetention?: array,
     *     initialize: string,
     *     cpu?: float,
     *     memory?: int
     * } $data
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     *
     */
    public function updateSettings(string $projectId, array $data): AcceptedResponse
    {
        $projectSettingsPatch = new ProjectSettingsPatch(
            dataRetention: $data['dataRetention'] ?? null,
            initialize: $data['initialize'] ?? null,
            buildResources: $data['cpu'] || $data['memory'] ? new BuildResources2(
                cpu: $data['cpu'] ?? null,
                memory: $data['memory'] ?? null,
            ) : null,
        );
        return $this->settingsApi->updateProjectsSettings($projectId, $projectSettingsPatch);
    }

    /**
     * Adds a project variable
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function createVariable(string $projectId, array $projectVariableCreateInput): AcceptedResponse
    {
        return $this->client->variables->createProjectVariable($projectId, $projectVariableCreateInput);
    }

    /**
     * Get a project variable
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function getVariable(string $projectId, string $projectVariableId): ProjectVariable
    {
        return $this->client->variables->getProjectVariable($projectId, $projectVariableId);
    }

    /**
     * Deletes a project variable
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function deleteVariable(string $projectId, string $projectVariableId): AcceptedResponse
    {
        return $this->client->variables->deleteProjectVariable($projectId, $projectVariableId);
    }

    /**
     * Gets list of project variables
     *
     * @return ProjectVariable[]
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     *
     */
    public function listVariables(string $projectId): array
    {
        return $this->client->variables->listProjectVariables($projectId);
    }

    /**
     * Updates a project variable
     *
     * @param array{
     *     name?: string,
     *     attributes?: array,
     *     value?: string,
     *     isJson?: bool,
     *     isSensitive?: bool,
     *     visibleBuild?: bool,
     *     visibleRuntime?: bool,
     * } $data
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     *
     */
    public function updateVariable(
        string $projectId,
        string $projectVariableId,
        array $data
    ): AcceptedResponse {
        return $this->client->variables->updateProjectVariable(
            $projectId,
            $projectVariableId,
            $data
        );
    }

    /**
     * Gets project activity log
     *
     * @return Activity[]
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     *
     */
    public function listActivities(string $projectId): array
    {
        return $this->client->activities->list($projectId);
    }

    /**
     * Gets a project activity log entry
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function getActivity(string $projectId, string $activityId): Activity
    {
        return $this->client->activities->get($projectId, $activityId);
    }

    /**
     * Cancels a project activity
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function cancelActivity(string $projectId, string $activityId): AcceptedResponse
    {
        return $this->client->activities->cancel($projectId, $activityId);
    }

    /**
     * Creates a project deployment target
     *
     * @param array{
     *     type: string,
     *     name: string,
     *     hosts?: array,
     *     enforcedMounts?: string,
     *     siteUrls?: string,
     *     sshHosts?: array,
     *     enterpriseEnvironmentsMapping?: array,
     *     useDedicatedGrid?: bool,
     * } $data
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     *
     */
    public function createDeployment(string $projectId, array $data): AcceptedResponse
    {
        $deploymentTargetCreateInput = new DeploymentTargetCreateInput(
            type: $data['type'],
            name: $data['name'],
            hosts: $data['hosts'] ?? null,
            enforcedMounts: (object)$data['enforcedMounts'] ?? null,
            siteUrls: (object)$data['siteUrls'] ?? null,
            sshHosts: $data['sshHosts'] ?? null,
            enterpriseEnvironmentsMapping: (object)$data['enterpriseEnvironmentsMapping'] ?? null,
            useDedicatedGrid: $data['useDedicatedGrid'] ?? null,
        );
        return $this->deploymentTargetApi->createProjectsDeployments($projectId, $deploymentTargetCreateInput);
    }

    /**
     * Deletes a single project deployment target
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function deleteDeployment(string $projectId, string $deploymentTargetConfigurationId): AcceptedResponse
    {
        return $this->deploymentTargetApi->deleteProjectsDeployments($projectId, $deploymentTargetConfigurationId);
    }

    /**
     * Gets a single project deployment target
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function getDeployment(string $projectId, string $deploymentTargetConfigurationId): DeploymentTarget
    {
        return $this->deploymentTargetApi->getProjectsDeployments($projectId, $deploymentTargetConfigurationId);
    }

    /**
     * Gets project deployment target info
     *
     * @return DeploymentTarget[]
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     *
     */
    public function listDeployments(string $projectId): array
    {
        return $this->deploymentTargetApi->listProjectsDeployments($projectId);
    }

    /**
     * Updates a project deployment
     *
     * @param array{
     *     type: string,
     *     name: string,
     *     hosts?: array,
     *     enforcedMounts?: string,
     *     siteUrls?: string,
     *     sshHosts?: array,
     *     enterpriseEnvironmentsMapping?: array,
     *     useDedicatedGrid?: bool,
     * } $data
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     *
     */
    public function updateDeployment(
        string $projectId,
        string $deploymentTargetConfigurationId,
        array $data
    ): AcceptedResponse {
        $deploymentTargetPatch = new DeploymentTargetPatch(
            type: $data['type'],
            name: $data['name'],
            hosts: $data['hosts'] ?? null,
            enforcedMounts: (object)$data['enforcedMounts'] ?? null,
            siteUrls: (object)$data['siteUrls'] ?? null,
            sshHosts: $data['sshHosts'] ?? null,
            enterpriseEnvironmentsMapping: (object)$data['enterpriseEnvironmentsMapping'] ?? null,
            useDedicatedGrid: $data['useDedicatedGrid'] ?? null,
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
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function getGitBlob(string $projectId, string $repositoryBlobId): Blob
    {
        return $this->repositoryApi->getProjectsGitBlobs($projectId, $repositoryBlobId);
    }

    /**
     * Gets a commit object
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function getGitCommit(string $projectId, string $repositoryCommitId): Commit
    {
        return $this->repositoryApi->getProjectsGitCommits($projectId, $repositoryCommitId);
    }

    /**
     * Gets a Git ref object
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function getGitRef(string $projectId, string $repositoryRefId): Ref
    {
        return $this->repositoryApi->getProjectsGitRefs($projectId, $repositoryRefId);
    }

    /**
     * Gets a Git tree object
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function getGitTree(string $projectId, string $repositoryTreeId): Tree
    {
        return $this->repositoryApi->getProjectsGitTrees($projectId, $repositoryTreeId);
    }


    /**
     * Gets list of repository refs
     *
     * @return Ref[]
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     *
     */
    public function listGitRefs(string $projectId): array
    {
        return $this->repositoryApi->listProjectsGitRefs($projectId);
    }

    /**
     * Restarts the Git server
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function restartGitServer(string $projectId): AcceptedResponse
    {
        return $this->systemInfoApi->actionProjectsSystemRestart($projectId);
    }

    /**
     * Get information about the Git server.
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function getGitInfo(string $projectId): SystemInformation
    {
        return $this->systemInfoApi->getProjectsSystem($projectId);
    }

    /**
     * Integrates project with a third-party service
     *
     * @param array{
     *     type: string,
     *     repository: string,
     *     url: string,
     *     username: string,
     *     token: string,
     *     project: string,
     *     serviceId: string,
     *     recipients: array,
     *     routingKey: array,
     *     channel: string,
     *     licenseKey: string,
     *     index: string,
     *     script: string,
     *     states: string,
     *     pruneBranches?: bool,
     *     environmentInitResources?: string,
     *     appCredentials?: array{
     *       key: string,
     *       secret: string
     *     },
     *     addonCredentials?: array{
     *       addonKey: string,
     *       clientKey: string,
     *       sharedSecret: string,
     *     },
     *     buildPullRequests?: bool,
     *     pullRequestsCloneParentData?: bool,
     *     resyncPullRequests?: bool,
     *     events?: array,
     *     environments?: array,
     *     excludedEnvironments?: array,
     *     state?: array,
     *     result?: string,
     *     baseUrl?: string,
     *     buildDraftPullRequests?: bool,
     *     buildPullRequestsPostMerge?: bool,
     *     buildMergeRequests?: bool,
     *     buildWipMergeRequests?: bool,
     *     mergeRequestsCloneParentData?: bool,
     *     fromAddress?: string,
     *     sharedKey?: string,
     *     extra?: array,
     *     headers?: array,
     *     tlsVerify?: bool,
     *     sourcetype?: string,
     *     category?: string,
     *     host?: string,
     *     port?: int,
     *     protocol?: string,
     *     facility?: int,
     *     messageFormat?: string,
     *     authToken?: string,
     *     authMode?: string,
     * } $data
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     *
     */
    public function createIntegration(string $projectId, array $data): AcceptedResponse
    {
        $integrationCreateInput = new IntegrationCreateInput(
            type: $data['type'],
            repository: $data['repository'],
            url: $data['url'],
            username: $data['username'],
            token: $data['token'],
            project: $data['project'],
            serviceId: $data['serviceId'],
            recipients: $data['recipients'],
            routingKey: $data['routingKey'],
            channel: $data['channel'],
            licenseKey: $data['licenseKey'],
            script: $data['script'],
            index: $data['index'],
            appCredentials: $data['appCredentials'] ?
                new TheOAuth2ConsumerInformationOptional1(...$data['appCredentials']) : null,
            addonCredentials: $data['addonCredentials'] ?
                new TheAddonCredentialInformationOptional1(...$data['addonCredentials']) : null,
            fromAddress: $data['fromAddress'] ?? null,
            sharedKey: $data['sharedKey'] ?? null,
            pruneBranches: $data['pruneBranches'] ?? null,
            environmentInitResources: $data['environmentInitResources'] ?? null,
            buildPullRequests: $data['buildPullRequests'] ?? null,
            pullRequestsCloneParentData: $data['pullRequestsCloneParentData'] ?? null,
            resyncPullRequests: $data['resyncPullRequests'] ?? null,
            events: $data['events'] ?? null,
            environments: $data['environments'] ?? null,
            excludedEnvironments: $data['excludedEnvironments'] ?? null,
            states: $data['state'] ?? null,
            result: $data['result'] ?? null,
            baseUrl: $data['baseUrl'] ?? null,
            buildDraftPullRequests: $data['buildDraftPullRequests'] ?? null,
            buildPullRequestsPostMerge: $data['buildPullRequestsPostMerge'] ?? null,
            buildMergeRequests: $data['buildMergeRequests'] ?? null,
            buildWipMergeRequests: $data['buildWipMergeRequests'] ?? null,
            mergeRequestsCloneParentData: $data['mergeRequestsCloneParentData'] ?? null,
            extra: $data['extra'] ?? null,
            headers: $data['headers'] ?? null,
            tlsVerify: $data['tlsVerify'] ?? null,
            sourcetype: $data['sourcetype'] ?? null,
            category: $data['category'] ?? null,
            host: $data['host'] ?? null,
            port: $data['port'] ?? null,
            protocol: $data['protocol'] ?? null,
            facility: $data['facility'] ?? null,
            messageFormat: $data['messageFormat'] ?? null,
            authToken: $data['authToken'] ?? null,
            authMode: $data['authMode'] ?? null,
        );
        return $this->thirdPartyIntegrationsApi->createProjectsIntegrations($projectId, $integrationCreateInput);
    }

    /**
     * Deletes an existing third-party integration
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function deleteIntegration(string $projectId, string $integrationId): AcceptedResponse
    {
        return $this->thirdPartyIntegrationsApi->deleteProjectsIntegrations($projectId, $integrationId);
    }

    /**
     * Gets information about an existing third-party integration
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function getIntegration(string $projectId, string $integrationId): Integration
    {
        return $this->thirdPartyIntegrationsApi->getProjectsIntegrations($projectId, $integrationId);
    }

    /**
     * Gets list of existing integrations for a project
     *
     * @return Integration[]
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     *
     */
    public function listIntegrations(string $projectId): array
    {
        return $this->thirdPartyIntegrationsApi->listProjectsIntegrations($projectId);
    }

    /**
     * Updates an existing third-party integration
     *
     * @param array{
     *     type: string,
     *     repository: string,
     *     url: string,
     *     username: string,
     *     token: string,
     *     project: string,
     *     serviceId: string,
     *     recipients: array,
     *     routingKey: array,
     *     channel: string,
     *     licenseKey: string,
     *     index: string,
     *     script: string,
     *     states: string,
     *     pruneBranches?: bool,
     *     environmentInitResources?: string,
     *     appCredentials?: array{
     *       key: string,
     *       secret: string
     *     },
     *     addonCredentials?: array{
     *       addonKey: string,
     *       clientKey: string,
     *       sharedSecret: string,
     *     },
     *     buildPullRequests?: bool,
     *     pullRequestsCloneParentData?: bool,
     *     resyncPullRequests?: bool,
     *     events?: array,
     *     environments?: array,
     *     excludedEnvironments?: array,
     *     state?: array,
     *     result?: string,
     *     baseUrl?: string,
     *     buildDraftPullRequests?: bool,
     *     buildPullRequestsPostMerge?: bool,
     *     buildMergeRequests?: bool,
     *     buildWipMergeRequests?: bool,
     *     mergeRequestsCloneParentData?: bool,
     *     fromAddress?: string,
     *     sharedKey?: string,
     *     extra?: array,
     *     headers?: array,
     *     tlsVerify?: bool,
     *     sourcetype?: string,
     *     category?: string,
     *     host?: string,
     *     port?: int,
     *     protocol?: string,
     *     facility?: int,
     *     messageFormat?: string,
     *     authToken?: string,
     *     authMode?: string,
     * } $data
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     *
     */
    public function updateIntegration(
        string $projectId,
        string $integrationId,
        array $data
    ): AcceptedResponse {
        $integrationPatch = new IntegrationPatch(
            type: $data['type'],
            repository: $data['repository'],
            url: $data['url'],
            username: $data['username'],
            token: $data['token'],
            project: $data['project'],
            serviceId: $data['serviceId'],
            recipients: $data['recipients'],
            routingKey: $data['routingKey'],
            channel: $data['channel'],
            licenseKey: $data['licenseKey'],
            script: $data['script'],
            index: $data['index'],
            appCredentials: $data['appCredentials'] ?
                new TheOAuth2ConsumerInformationOptional1(...$data['appCredentials']) : null,
            addonCredentials: $data['addonCredentials'] ?
                new TheAddonCredentialInformationOptional1(...$data['addonCredentials']) : null,
            fromAddress: $data['fromAddress'] ?? null,
            sharedKey: $data['sharedKey'] ?? null,
            pruneBranches: $data['pruneBranches'] ?? null,
            environmentInitResources: $data['environmentInitResources'] ?? null,
            buildPullRequests: $data['buildPullRequests'] ?? null,
            pullRequestsCloneParentData: $data['pullRequestsCloneParentData'] ?? null,
            resyncPullRequests: $data['resyncPullRequests'] ?? null,
            events: $data['events'] ?? null,
            environments: $data['environments'] ?? null,
            excludedEnvironments: $data['excludedEnvironments'] ?? null,
            states: $data['state'] ?? null,
            result: $data['result'] ?? null,
            baseUrl: $data['baseUrl'] ?? null,
            buildDraftPullRequests: $data['buildDraftPullRequests'] ?? null,
            buildPullRequestsPostMerge: $data['buildPullRequestsPostMerge'] ?? null,
            buildMergeRequests: $data['buildMergeRequests'] ?? null,
            buildWipMergeRequests: $data['buildWipMergeRequests'] ?? null,
            mergeRequestsCloneParentData: $data['mergeRequestsCloneParentData'] ?? null,
            extra: $data['extra'] ?? null,
            headers: $data['headers'] ?? null,
            tlsVerify: $data['tlsVerify'] ?? null,
            sourcetype: $data['sourcetype'] ?? null,
            category: $data['category'] ?? null,
            host: $data['host'] ?? null,
            port: $data['port'] ?? null,
            protocol: $data['protocol'] ?? null,
            facility: $data['facility'] ?? null,
            messageFormat: $data['messageFormat'] ?? null,
            authToken: $data['authToken'] ?? null,
            authMode: $data['authMode'] ?? null,
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
     * @param array{
     *     name: string,
     *     attributes?: array,
     *     isDefault?: bool,
     *     replacementFor?: string,
     * } $data
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     *
     */
    public function createDomain(string $projectId, array $data): AcceptedResponse
    {
        return $this->client->domains->create($projectId, $data);
    }

    /**
     * Deletes a project domain
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function deleteDomain(string $projectId, string $domainId): AcceptedResponse
    {
        return $this->client->domains->delete($projectId, $domainId);
    }

    /**
     * Gets a project domain
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function getDomain(string $projectId, string $domainId): Domain
    {
        return $this->client->domains->get($projectId, $domainId);
    }

    /**
     * Gets list of project domains
     *
     * @return Domain[]
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     *
     */
    public function listDomains(string $projectId): array
    {
        return $this->client->domains->list($projectId);
    }

    /**
     * Updates a project domain
     *
     * @param array{
     *     attributes?: array,
     *     isDefault?: bool,
     * } $data
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     *
     */
    public function updateDomain(string $projectId, string $domainId, array $data): AcceptedResponse
    {
        return $this->client->domains->update($projectId, $domainId, $data);
    }

    /**
     * Adds an SSL certificate
     *
     * @param array{
     *     certificate?: string,
     *     key?: string,
     *     chain?: array,
     *     isInvalid?: bool
     * } $options Configuration options
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     *
     */
    public function createCertificate(string $projectId, array $options): AcceptedResponse
    {
        return $this->client->certificates->create($projectId, $options);
    }

    /**
     * Deletes an SSL certificate
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function deleteCertificate(string $projectId, string $certificateId): AcceptedResponse
    {
        return $this->client->certificates->delete($projectId, $certificateId);
    }

    /**
     * Gets an SSL certificate
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function getCertificate(string $projectId, string $certificateId): Certificate
    {
        return $this->client->certificates->get($projectId, $certificateId);
    }

    /**
     * Gets list of SSL certificates
     *
     * @return Certificate[]
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     *
     */
    public function listCertificates(string $projectId): array
    {
        return $this->client->certificates->list($projectId);
    }

    /**
     * Updates an SSL certificate
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function updateCertificate(
        string $projectId,
        string $certificateId,
        array $certificatePatch
    ): AcceptedResponse {
        return $this->client->certificates->update($projectId, $certificateId, $certificatePatch);
    }

    /**
     * Executes a runtime operation
     *
     * @param array{
     *     service: string,
     *     operation: string,
     *     parameters: array
     * } $data
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function runOperation(
        string $projectId,
        string $environmentId,
        string $deploymentId,
        array $data
    ): AcceptedResponse {
        return $this->client->operations->run(
            $projectId,
            $environmentId,
            $deploymentId,
            $data
        );
    }

    /**
     * Gets team access for a project
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function getProjectTeamAccess(string $projectId, string $teamId): TeamProjectAccess
    {
        return $this->client->teams->getProjectTeamAccess($projectId, $teamId);
    }


    /**
     * Gets project access for a team
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function getTeamProjectAccess(string $teamId, string $projectId): TeamProjectAccess
    {
        return $this->client->teams->getTeamProjectAccess($teamId, $projectId);
    }

    /**
     * Grants team access to a project
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function grantProjectTeamAccess(string $projectId, array $grantProjectTeamAccessRequestInner): void
    {
        $this->client->teams->grantProjectTeamAccess($projectId, $grantProjectTeamAccessRequestInner);
    }

    /**
     * Grants project access to a team
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function grantTeamProjectAccess(string $teamId, array $data): void
    {
        $this->client->teams->grantTeamProjectAccess($teamId, $data);
    }

    /**
     * Lists team access for a project
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
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
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
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
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function removeProjectTeamAccess(string $projectId, string $teamId): void
    {
        $this->client->teams->removeProjectTeamAccess($projectId, $teamId);
    }

    /**
     * Removes project access for a team
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function removeTeamProjectAccess(string $teamId, string $projectId): void
    {
        $this->client->teams->removeTeamProjectAccess($teamId, $projectId);
    }

    /**
     * Gets user access for a project
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function getProjectUserAccess(string $projectId, string $userId): UserProjectAccess
    {
        return $this->client->users->getProjectUserAccess($projectId, $userId);
    }

    /**
     * Grants user access to a project
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function grantProjectUserAccess(string $projectId, array $data): void
    {
        $this->client->users->grantProjectUserAccess($projectId, $data);
    }

    /**
     * Removes user access for a project
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function removeProjectUserAccess(string $projectId, string $userId): void
    {
        $this->client->users->removeProjectUserAccess($projectId, $userId);
    }

    /**
     * Updates user access for a project
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
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
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
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
     * @return Environment[]
     * @throws ApiException|Exception
     *
     */
    public function listEnvironments(string $projectId): array
    {
        return $this->client->environments->list($projectId);
    }
}
