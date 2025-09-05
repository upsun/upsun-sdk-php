<?php

namespace Upsun\Core\Tasks;

use Exception;
use InvalidArgumentException;
use Upsun\ApiException;
use Upsun\Api\DeploymentTargetApi;
use Upsun\Api\OrganizationProjectsApi;
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
use Upsun\Model\Certificate;
use Upsun\Model\Commit;
use Upsun\Model\CreateOrgSubscriptionRequest;
use Upsun\Model\DeploymentTarget;
use Upsun\Model\DeploymentTargetCreateInput;
use Upsun\Model\DeploymentTargetPatch;
use Upsun\Model\Domain;
use Upsun\Model\Integration;
use Upsun\Model\IntegrationCreateInput;
use Upsun\Model\IntegrationPatch;
use Upsun\Model\ListProjectUserAccess200Response;
use Upsun\Model\OrganizationProject;
use Upsun\Model\ProjectCapabilities;
use Upsun\Model\ProjectInvitation;
use Upsun\Model\ProjectPatch;
use Upsun\Model\ProjectSettings;
use Upsun\Model\ProjectSettingsPatch;
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
class ProjectTask extends TaskBase
{
    public function __construct(
        public UpsunClient $client,
        private readonly ProjectApi $api,
        private readonly ProjectSettingsApi $settingsApi,
        private readonly DeploymentTargetApi $deploymentTargetApi,
        private readonly RepositoryApi $repositoryApi,
        private readonly SystemInformationApi $systemInfoApi,
        private readonly ThirdPartyIntegrationsApi $thirdPartyIntegrationsApi,
        private readonly SubscriptionsApi $subscriptionsApi,
        private readonly OrganizationProjectsApi $organizationProjectsApi,
    ) {
        parent::__construct($this->client);
    }

    /**
     * Deletes a project
     *
     * @throws InvalidArgumentException|Exception
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function delete(string $organizationId, string $projectId): void
    {
        $project = $this->get($projectId);

        $this->subscriptionsApi->deleteOrgSubscription($organizationId, $project->getSubscriptionId());
    }

    /**
     * Gets a project
     *
     * @throws InvalidArgumentException|Exception
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function get(string $projectId): OrganizationProject
    {
        $project = $this->api->getProjects($projectId);
        $orgId = $project->getOrganization();
        return $this->organizationProjectsApi->getOrgProject($orgId, $projectId);
    }

    /**
     * Creates a project
     *
     * @throws ApiException|Exception
     *
     * @param array{
     *     plan?: string,
     *     projectRegion?: string,
     *     projectTitle?: string,
     *     optionsUrl?: string,
     *     defaultBranch?: string,
     *     environments?: int,
     *     storage?: int
     * } $projectData Update data
     */
    public function create(string $organizationId, array $projectData): Error|Subscription
    {
        $createProjectData = new CreateOrgSubscriptionRequest(...$this->normalizeFilter($projectData));
        return $this->subscriptionsApi->createOrgSubscription($organizationId, $createProjectData);
    }

    /**
     * Checks if the user is able to create a new project in the organization.
     *
     * @throws InvalidArgumentException|Exception
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function canCreate(string $organizationId): array
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
     * @throws InvalidArgumentException|Exception
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function update(string $projectId, array $projectData): AcceptedResponse
    {
        $project_patch = new ProjectPatch($projectData);
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
     * @throws InvalidArgumentException
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     *
     * @param array{
     *     email: string,
     *     role?: string,
     *     permissions?: array,
     *     environments?: bool,
     *     force?: bool
     * } $data
     */
    public function createInvite(
        string $projectId,
        array $data
    ): ProjectInvitation {
        return $this->client->invitations->createProjectInvite($projectId, $data);
    }

    /**
     * Lists invitations to a project
     *
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
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     *
     * @param array{
     *     initialize: string,
     *     dataRetention?: array,
     *     cpu?: float,
     *     memory?: int
     * } $data
     */
    public function updateSettings(string $projectId, array $data): AcceptedResponse
    {
        $projectSettingsPatch = new ProjectSettingsPatch(
            initialize: (object) $data['initialize'],
            dataRetention: $data['dataRetention'],
            buildResources: new BuildResources2(
                cpu: $data['cpu'],
                memory: $data['memory'],
            ),
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
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function listVariables(string $projectId): array
    {
        return $this->client->variables->listProjectVariables($projectId);
    }

    /**
     * Updates a project variable
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function updateVariable(
        string $projectId,
        string $projectVariableId,
        array $projectVariablePatch
    ): AcceptedResponse {
        return $this->client->variables->updateProjectVariable(
            $projectId,
            $projectVariableId,
            $projectVariablePatch
        );
    }

    /**
     * Cancels a project activity
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function cancelActivity(string $projectId, string $activityId): AcceptedResponse
    {
        return $this->client->activity->cancel($projectId, $activityId);
    }

    /**
     * Gets a project activity log entry
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function getActivity(string $projectId, string $activityId): Activity
    {
        return $this->client->activity->get($projectId, $activityId);
    }

    /**
     * Gets project activity log
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function listActivities(string $projectId): array
    {
        return $this->client->activity->list($projectId);
    }

    /**
     * Creates a project deployment target
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     *
     * @param array{
     *     type: string,
     *     name: string,
     *     enforceMounts?: string,
     *     siteUrls?: string,
     *     sshHosts?: array,
     *     enterpriseEnvironmentsMapping?: array,
     *     hosts?: array,
     *     useDedicatedGrid?: bool,
     * } $data
     */
    public function createDeployment(string $projectId, array $data): AcceptedResponse
    {
        $deploymentTargetCreateInput = new DeploymentTargetCreateInput(
            type: $data['type'],
            name: $data['name'],
            enforcedMounts: (object) $data['enforceMounts'] ?? null,
            siteUrls: (object) $data['siteUrls'] ?? null,
            sshHosts: $data['sshHosts'],
            enterpriseEnvironmentsMapping: (object)$data['enterpriseEnvironmentsMapping'] ?? null,
            hosts: $data['hosts'] ?? [],
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
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function listDeployments(string $projectId): array
    {
        return $this->deploymentTargetApi->listProjectsDeployments($projectId);
    }

    /**
     * Updates a project deployment
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     *
     * @param array{
     *     type: string,
     *     name: string,
     *     enforceMounts?: string,
     *     siteUrls?: string,
     *     sshHosts?: array,
     *     enterpriseEnvironmentsMapping?: array,
     *     hosts?: array,
     *     useDedicatedGrid?: bool,
     * } $data
     */
    public function updateDeployment(
        string $projectId,
        string $deploymentTargetConfigurationId,
        array $data
    ): AcceptedResponse {
        $deploymentTargetPatch = new DeploymentTargetPatch(
            type: $data['type'],
            name: $data['name'],
            enforcedMounts: (object) $data['enforceMounts'] ?? null,
            siteUrls: (object) $data['siteUrls'] ?? null,
            sshHosts: $data['sshHosts'],
            enterpriseEnvironmentsMapping: (object)$data['enterpriseEnvironmentsMapping'] ?? null,
            hosts: $data['hosts'] ?? [],
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
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
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
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
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
     */
    public function createIntegration(string $projectId, array $data): AcceptedResponse
    {
        $integrationCreateInput = new IntegrationCreateInput(
            type: $data['type'],
            pruneBranches: $data['pruneBranches'] ?? null,
            environmentInitResources: $data['environmentInitResources'] ?? null,
            appCredentials: $data['appCredentials'] ?
                new TheOAuth2ConsumerInformationOptional1(...$data['appCredentials']) : null,
            addonCredentials: $data['addonCredentials'] ?
                new TheAddonCredentialInformationOptional1(...$data['addonCredentials']) : null,
            repository: $data['repository'],
            buildPullRequests: $data['buildPullRequests'] ?? null,
            pullRequestsCloneParentData: $data['pullRequestsCloneParentData'] ?? null,
            resyncPullRequests: $data['resyncPullRequests'] ?? null,
            url: $data['url'],
            username: $data['username'],
            token: $data['token'],
            project: $data['project'],
            events: $data['events'] ?? [],
            environments: $data['environments'] ?? [],
            excludedEnvironments: $data['excludedEnvironments'] ?? [],
            states: $data['state'] ?? [],
            result: $data['result'] ?? null,
            serviceId: $data['serviceId'],
            baseUrl: $data['baseUrl'] ?? null,
            buildDraftPullRequests: $data['buildDraftPullRequests'] ?? null,
            buildPullRequestsPostMerge: $data['buildPullRequestsPostMerge'] ?? null,
            buildMergeRequests: $data['buildMergeRequests'] ?? null,
            buildWipMergeRequests: $data['buildWipMergeRequests'] ?? null,
            mergeRequestsCloneParentData: $data['mergeRequestsCloneParentData'] ?? null,
            fromAddress: $data['fromAddress'] ?? null,
            recipients: $data['recipients'],
            routingKey: $data['routingKey'],
            channel: $data['channel'],
            sharedKey: $data['sharedKey'] ?? null,
            extra: $data['extra'] ?? [],
            headers: $data['headers'] ?? [],
            tlsVerify: $data['tlsVerify'] ?? null,
            licenseKey: $data['licenseKey'],
            script: $data['script'],
            index: $data['index'],
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
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function listIntegrations(string $projectId): array
    {
        return $this->thirdPartyIntegrationsApi->listProjectsIntegrations($projectId);
    }

    /**
     * Updates an existing third-party integration
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
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
     */
    public function updateIntegration(
        string $projectId,
        string $integrationId,
        array $data
    ): AcceptedResponse {
        $integrationPatch = new IntegrationPatch(
            type: $data['type'],
            pruneBranches: $data['pruneBranches'] ?? null,
            environmentInitResources: $data['environmentInitResources'] ?? null,
            appCredentials: $data['appCredentials'] ?
                new TheOAuth2ConsumerInformationOptional1(...$data['appCredentials']) : null,
            addonCredentials: $data['addonCredentials'] ?
                new TheAddonCredentialInformationOptional1(...$data['addonCredentials']) : null,
            repository: $data['repository'],
            buildPullRequests: $data['buildPullRequests'] ?? null,
            pullRequestsCloneParentData: $data['pullRequestsCloneParentData'] ?? null,
            resyncPullRequests: $data['resyncPullRequests'] ?? null,
            url: $data['url'],
            username: $data['username'],
            token: $data['token'],
            project: $data['project'],
            events: $data['events'] ?? [],
            environments: $data['environments'] ?? [],
            excludedEnvironments: $data['excludedEnvironments'] ?? [],
            states: $data['state'] ?? [],
            result: $data['result'] ?? null,
            serviceId: $data['serviceId'],
            baseUrl: $data['baseUrl'] ?? null,
            buildDraftPullRequests: $data['buildDraftPullRequests'] ?? null,
            buildPullRequestsPostMerge: $data['buildPullRequestsPostMerge'] ?? null,
            buildMergeRequests: $data['buildMergeRequests'] ?? null,
            buildWipMergeRequests: $data['buildWipMergeRequests'] ?? null,
            mergeRequestsCloneParentData: $data['mergeRequestsCloneParentData'] ?? null,
            fromAddress: $data['fromAddress'] ?? null,
            recipients: $data['recipients'],
            routingKey: $data['routingKey'],
            channel: $data['channel'],
            sharedKey: $data['sharedKey'] ?? null,
            extra: $data['extra'] ?? [],
            headers: $data['headers'] ?? [],
            tlsVerify: $data['tlsVerify'] ?? null,
            licenseKey: $data['licenseKey'],
            script: $data['script'],
            index: $data['index'],
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
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     *
     * @param array{
     *     name?: string,
     *     attributes?: array,
     *     isDefault?: bool,
     *     replacementFor?: string,
     * } $data
     */
    public function createDomain(string $projectId, array $data): AcceptedResponse
    {
        return $this->client->domain->create($projectId, $data);
    }

    /**
     * Deletes a project domain
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function deleteDomain(string $projectId, string $domainId): AcceptedResponse
    {
        return $this->client->domain->delete($projectId, $domainId);
    }

    /**
     * Gets a project domain
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function getDomain(string $projectId, string $domainId): Domain
    {
        return $this->client->domain->get($projectId, $domainId);
    }

    /**
     * Gets list of project domains
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function listDomains(string $projectId): array
    {
        return $this->client->domain->list($projectId);
    }

    /**
     * Updates a project domain
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function updateDomain(string $projectId, string $domainId, array $domainPatch): AcceptedResponse
    {
        return $this->client->domain->update($projectId, $domainId, $domainPatch);
    }

    /**
     * Adds an SSL certificate
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     *
     * @param array{
     *     certificate?: string,
     *     key?: string,
     *     chain?: array,
     *     isInvalid?: bool
     * } $options Configuration options
     */
    public function createCertificate(string $projectId, array $options): AcceptedResponse
    {
        return $this->client->certificate->create($projectId, $options);
    }

    /**
     * Deletes an SSL certificate
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function deleteCertificate(string $projectId, string $certificateId): AcceptedResponse
    {
        return $this->client->certificate->delete($projectId, $certificateId);
    }

    /**
     * Gets an SSL certificate
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function getCertificate(string $projectId, string $certificateId): Certificate
    {
        return $this->client->certificate->get($projectId, $certificateId);
    }

    /**
     * Gets list of SSL certificates
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function listCertificates(string $projectId): array
    {
        return $this->client->certificate->list($projectId);
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
        return $this->client->certificate->update($projectId, $certificateId, $certificatePatch);
    }

    /**
     * Executes a runtime operation
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function runOperation(
        string $projectId,
        string $environmentId,
        string $deploymentId,
        array $environmentOperationInput
    ): AcceptedResponse {
        return $this->client->operation->run(
            $projectId,
            $environmentId,
            $deploymentId,
            $environmentOperationInput
        );
    }

    /**
     * Gets team access for a project
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function getProjectTeamAccess(string $projectId, string $teamId): TeamProjectAccess
    {
        return $this->client->team->getProjectTeamAccess($projectId, $teamId);
    }


    /**
     * Gets project access for a team
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function getTeamProjectAccess(string $teamId, string $projectId): TeamProjectAccess
    {
        return $this->client->team->getTeamProjectAccess($teamId, $projectId);
    }

    /**
     * Grants team access to a project
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function grantProjectTeamAccess(string $projectId, array $grantProjectTeamAccessRequestInner): void
    {
        $this->client->team->grantProjectTeamAccess($projectId, $grantProjectTeamAccessRequestInner);
    }

    /**
     * Grants project access to a team
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function grantTeamProjectAccess(string $teamId, array $grantTeamProjectAccessRequestInner): void
    {
        $this->client->team->grantTeamProjectAccess($teamId, $grantTeamProjectAccessRequestInner);
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
    ): array {
        return $this->client->team->listProjectTeamAccess($projectId, $pageSize, $pageBefore, $pageAfter, $sort);
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
    ): array {
        return $this->client->team->listTeamProjectAccess($teamId, $pageSize, $pageBefore, $pageAfter, $sort);
    }

    /**
     * Removes team access for a project
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function removeProjectTeamAccess(string $projectId, string $teamId): void
    {
        $this->client->team->removeProjectTeamAccess($projectId, $teamId);
    }

    /**
     * Removes project access for a team
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function removeTeamProjectAccess(string $teamId, string $projectId): void
    {
        $this->client->team->removeTeamProjectAccess($teamId, $projectId);
    }

    /**
     * Gets user access for a project
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function getProjectUserAccess(string $projectId, string $userId): UserProjectAccess
    {
        return $this->client->user->getProjectUserAccess($projectId, $userId);
    }

    /**
     * Grants user access to a project
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function grantProjectUserAccess(string $projectId, array $grantProjectUserAccessRequestInner): void
    {
        $this->client->user->grantProjectUserAccess($projectId, $grantProjectUserAccessRequestInner);
    }

    /**
     * Removes user access for a project
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function removeProjectUserAccess(string $projectId, string $userId): void
    {
        $this->client->user->removeProjectUserAccess($projectId, $userId);
    }

    /**
     * Updates user access for a project
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function updateProjectUserAccess(
        string $projectId,
        string $userId,
        ?array $updateProjectUserAccessRequest = null
    ): void {
        $this->client->user->updateProjectUserAccess($projectId, $userId, $updateProjectUserAccessRequest);
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
        return $this->client->user->listProjectUserAccess($projectId, $pageSize, $pageBefore, $pageAfter, $sort);
    }

    /**
     * Lists environments of a project
     *
     * @throws ApiException|Exception
     */
    public function listEnvironments(string $projectId): array
    {
        return $this->client->environment->list($projectId);
    }
}
