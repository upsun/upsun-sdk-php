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
use Upsun\Model\DomainCreateInput;
use Upsun\Model\DomainPatch;
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
        $subscriptionId = $this->extractSubscriptionId(projectLicenceUri: $project->getSubscription()->getLicenseUri());

        $this->subscriptionsApi->deleteOrgSubscription(
            organizationId: $project->getOrganization(),
            subscriptionId: $subscriptionId
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
        return $this->api->getProjects(projectId: $projectId);
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
        return $this->subscriptionsApi->createOrgSubscription(
            organizationId: $organizationId,
            createOrgSubscriptionRequest: new CreateOrgSubscriptionRequest(
                projectRegion: $projectRegion,
                plan: $plan,
                projectTitle: $title,
                optionsUrl: $optionsUrl,
                defaultBranch: $defaultBranch,
                environments: $environments,
                storage: $storage
            )
        );
    }

    /**
     * Checks if the user is able to create a new project in the organization.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function canCreate(string $organizationId): CanCreateNewOrgSubscription200Response
    {
        return $this->subscriptionsApi->canCreateNewOrgSubscription(organizationId: $organizationId);
    }

    /**
     * Gets a project's capabilities
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getCapabilities(string $projectId): ProjectCapabilities
    {
        return $this->api->getProjectsCapabilities(projectId: $projectId);
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
        return $this->api->updateProjects(
            projectId: $projectId,
            projectPatch: new ProjectPatch(
                defaultBranch: $defaultBranch,
                defaultDomain: $defaultDomain,
                attributes: $attributes,
                title: $title,
                description: $description,
                timezone: $timezone,
                region: $region
            )
        );
    }

    /**
     * Cancels a pending invitation to a project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function cancelInvite(string $projectId, string $invitationId): void
    {
        $this->client->invitations->cancelProjectInvite(projectId: $projectId, invitationId: $invitationId);
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
            projectId: $projectId,
            email: $email,
            role: $role,
            permissions: $permissions,
            environments: $environments,
            force: $force
        );
    }

    /**
     * Lists invitations to a project
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
            projectId: $projectId,
            filterState: $filterState,
            pageSize: $pageSize,
            pageBefore: $pageBefore,
            pageAfter: $pageAfter,
            sort: $sort
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
        return $this->settingsApi->getProjectsSettings(projectId: $projectId);
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
        return $this->settingsApi->updateProjectsSettings(
            projectId: $projectId,
            projectSettingsPatch: new ProjectSettingsPatch(
                dataRetention: $dataRetention,
                initialize: (object)$initialize,
                buildResources: $cpu || $memory ? new BuildResources2(
                    cpu: $cpu ?? null,
                    memory: $memory ?? null,
                ) : null,
            )
        );
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
            projectId: $projectId,
            name: $name,
            value: $value,
            attributes: $attributes,
            isJson: $isJson,
            isSensitive: $isSensitive,
            visibleBuild: $visibleBuild,
            visibleRuntime: $visibleRuntime,
            applicationScope: $applicationScope
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
        return $this->client->variables->getProjectVariable(
            projectId: $projectId,
            projectVariableId: $projectVariableId
        );
    }

    /**
     * Deletes a project variable
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function deleteVariable(string $projectId, string $projectVariableId): AcceptedResponse
    {
        return $this->client->variables->deleteProjectVariable(
            projectId: $projectId,
            projectVariableId: $projectVariableId
        );
    }

    /**
     * Gets list of project variables
     *
     * @throws ClientExceptionInterface
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @return ProjectVariable[]
     */
    public function listVariables(string $projectId): array
    {
        return $this->client->variables->listProjectVariables(projectId: $projectId);
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
            projectId: $projectId,
            projectVariableId: $projectVariableId,
            name: $name,
            value: $value,
            attributes: $attributes,
            isJson: $isJson,
            isSensitive: $isSensitive,
            visibleBuild: $visibleBuild,
            visibleRuntime: $visibleRuntime,
            applicationScope: $applicationScope,
        );
    }

    /**
     * Gets project activity log
     *
     * @throws ClientExceptionInterface
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @return Activity[]
     */
    public function listActivities(string $projectId): array
    {
        return $this->client->activities->list(projectId: $projectId);
    }

    /**
     * Gets a project activity log entry
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getActivity(string $projectId, string $activityId): Activity
    {
        return $this->client->activities->get(projectId: $projectId, activityId: $activityId);
    }

    /**
     * Cancels a project activity
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function cancelActivity(string $projectId, string $activityId): AcceptedResponse
    {
        return $this->client->activities->cancel(projectId: $projectId, activityId: $activityId);
    }

    /**
     * Creates a project deployment target
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function createDeployment(
        string $projectId,
        DeploymentTargetCreateInput $deploymentTargetCreateInput,
    ): AcceptedResponse {
        return $this->deploymentTargetApi->createProjectsDeployments(
            projectId: $projectId,
            deploymentTargetCreateInput: $deploymentTargetCreateInput,
        );
    }

    /**
     * Deletes a single project deployment target
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function deleteDeployment(string $projectId, string $deploymentTargetConfigurationId): AcceptedResponse
    {
        return $this->deploymentTargetApi->deleteProjectsDeployments(
            projectId: $projectId,
            deploymentTargetConfigurationId: $deploymentTargetConfigurationId
        );
    }

    /**
     * Gets a single project deployment target
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getDeployment(string $projectId, string $deploymentTargetConfigurationId): DeploymentTarget
    {
        return $this->deploymentTargetApi->getProjectsDeployments(
            projectId: $projectId,
            deploymentTargetConfigurationId: $deploymentTargetConfigurationId
        );
    }

    /**
     * Gets project deployment target info
     *
     * @throws ClientExceptionInterface
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @return DeploymentTarget[]
     */
    public function listDeployments(string $projectId): array
    {
        return $this->deploymentTargetApi->listProjectsDeployments(projectId: $projectId);
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
        DeploymentTargetPatch $deploymentTargetPatch,
    ): AcceptedResponse {
        return $this->deploymentTargetApi->updateProjectsDeployments(
            projectId: $projectId,
            deploymentTargetConfigurationId: $deploymentTargetConfigurationId,
            deploymentTargetPatch: $deploymentTargetPatch
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
        return $this->repositoryApi->getProjectsGitBlobs(projectId: $projectId, repositoryBlobId: $repositoryBlobId);
    }

    /**
     * Gets a commit object
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getGitCommit(string $projectId, string $repositoryCommitId): Commit
    {
        return $this->repositoryApi->getProjectsGitCommits(
            projectId: $projectId,
            repositoryCommitId: $repositoryCommitId
        );
    }

    /**
     * Gets a Git ref object
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getGitRef(string $projectId, string $repositoryRefId): Ref
    {
        return $this->repositoryApi->getProjectsGitRefs(
            projectId: $projectId,
            repositoryRefId: $repositoryRefId
        );
    }

    /**
     * Gets a Git tree object
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getGitTree(string $projectId, string $repositoryTreeId): Tree
    {
        return $this->repositoryApi->getProjectsGitTrees(
            projectId: $projectId,
            repositoryTreeId: $repositoryTreeId
        );
    }

    /**
     * Gets list of repository refs
     *
     * @throws ClientExceptionInterface
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @return Ref[]
     */
    public function listGitRefs(string $projectId): array
    {
        return $this->repositoryApi->listProjectsGitRefs(projectId: $projectId);
    }

    /**
     * Restarts the Git server
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function restartGitServer(string $projectId): AcceptedResponse
    {
        return $this->systemInfoApi->actionProjectsSystemRestart(projectId: $projectId);
    }

    /**
     * Get information about the Git server.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getGitInfo(string $projectId): SystemInformation
    {
        return $this->systemInfoApi->getProjectsSystem(projectId: $projectId);
    }

    /**
     * Integrates project with a third-party service
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function createIntegration(
        string $projectId,
        IntegrationCreateInput $integrationCreateInput,
    ): AcceptedResponse {
        return $this->client->integrations->createIntegration(
            $projectId,
            $integrationCreateInput,
        );
    }

    /**
     * Deletes an existing third-party integration
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function deleteIntegration(string $projectId, string $integrationId): AcceptedResponse
    {
        return $this->thirdPartyIntegrationsApi->deleteProjectsIntegrations(
            projectId: $projectId,
            integrationId: $integrationId
        );
    }

    /**
     * Gets information about an existing third-party integration
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getIntegration(string $projectId, string $integrationId): Integration
    {
        return $this->thirdPartyIntegrationsApi->getProjectsIntegrations(
            projectId: $projectId,
            integrationId: $integrationId
        );
    }

    /**
     * Gets list of existing integrations for a project
     *
     * @throws ClientExceptionInterface
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @return Integration[]
     */
    public function listIntegrations(string $projectId): array
    {
        return $this->thirdPartyIntegrationsApi->listProjectsIntegrations(projectId: $projectId);
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
        IntegrationPatch $integrationPatch,
    ): AcceptedResponse {
        
        return $this->thirdPartyIntegrationsApi->updateProjectsIntegrations(
            projectId: $projectId,
            integrationId: $integrationId,
            integrationPatch: $integrationPatch
        );
    }

    /**
     * Adds a project domain
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function addDomain(
        string $projectId,
        DomainCreateInput $domainCreateInput,
    ): AcceptedResponse {
        return $this->client->domains->add(
            projectId: $projectId,
            domainCreateInput: $domainCreateInput,
        );
    }

    /**
     * Deletes a project domain
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function deleteDomain(string $projectId, string $domainId): AcceptedResponse
    {
        return $this->client->domains->delete(projectId: $projectId, domainId: $domainId);
    }

    /**
     * Gets a project domain
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getDomain(string $projectId, string $domainId): Domain
    {
        return $this->client->domains->get(projectId: $projectId, domainId: $domainId);
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
        return $this->client->domains->list(projectId: $projectId);
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
        DomainPatch $domainPatch
    ): AcceptedResponse {
        return $this->client->domains->update(
            projectId: $projectId,
            domainId: $domainId,
            domainPatch: $domainPatch,
        );
    }

    /**
     * Adds an SSL certificate
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function addCertificate(
        string $projectId,
        string $certificate,
        string $key,
        ?array $chain = null,
        ?bool $isInvalid = null
    ): AcceptedResponse {
        return $this->client->certificates->add(
            projectId: $projectId,
            certificate: $certificate,
            key: $key,
            chain: $chain,
            isInvalid: $isInvalid
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
        return $this->client->certificates->delete(projectId: $projectId, certificateId: $certificateId);
    }

    /**
     * Gets an SSL certificate
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getCertificate(string $projectId, string $certificateId): Certificate
    {
        return $this->client->certificates->get(projectId: $projectId, certificateId: $certificateId);
    }

    /**
     * Gets list of SSL certificates
     *
     * @throws ClientExceptionInterface
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @return Certificate[]
     */
    public function listCertificates(string $projectId): array
    {
        return $this->client->certificates->list(projectId: $projectId);
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
        return $this->client->certificates->update(
            projectId: $projectId,
            certificateId: $certificateId,
            chain: $chain,
            isInvalid: $isInvalid
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
        return $this->client->teams->getProjectTeamAccess(projectId: $projectId, teamId: $teamId);
    }

    /**
     * Gets project access for a team
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getTeamProjectAccess(string $teamId, string $projectId): TeamProjectAccess
    {
        return $this->client->teams->getTeamProjectAccess(teamId: $teamId, projectId: $projectId);
    }

    /**
     * Grants team access to a project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function grantProjectTeamAccess(string $projectId, array $grantProjectTeamAccessRequestInner): void
    {
        $this->client->teams->grantProjectTeamAccess(
            projectId: $projectId,
            grantProjectTeamAccessRequestInner: $grantProjectTeamAccessRequestInner
        );
    }

    /**
     * Grants project access to a team
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function grantTeamProjectAccess(string $teamId, array $data): void
    {
        $this->client->teams->grantTeamProjectAccess(teamId: $teamId, data: $data);
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
        return $this->client->teams->listProjectTeamAccess(
            projectId: $projectId,
            pageSize: $pageSize,
            pageBefore: $pageBefore,
            pageAfter: $pageAfter,
            sort: $sort
        );
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
        return $this->client->teams->listTeamProjectAccess(
            teamId: $teamId,
            pageSize: $pageSize,
            pageBefore: $pageBefore,
            pageAfter: $pageAfter,
            sort: $sort
        );
    }

    /**
     * Removes team access for a project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function revokeProjectTeamAccess(string $projectId, string $teamId): void
    {
        $this->client->teams->revokeProjectTeamAccess(projectId: $projectId, teamId: $teamId);
    }

    /**
     * Removes project access for a team
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function revokeTeamProjectAccess(string $teamId, string $projectId): void
    {
        $this->client->teams->revokeTeamProjectAccess(teamId: $teamId, projectId: $projectId);
    }

    /**
     * Gets user access for a project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getProjectUserAccess(string $projectId, string $userId): UserProjectAccess
    {
        return $this->client->users->getProjectUserAccess(projectId: $projectId, userId: $userId);
    }

    /**
     * Grants user access to a project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function grantProjectUserAccess(string $projectId, array $data): void
    {
        $this->client->users->grantProjectUserAccess(
            projectId: $projectId,
            grantProjectUserAccessRequestInner: $data
        );
    }

    /**
     * Removes user access for a project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function revokeProjectUserAccess(string $projectId, string $userId): void
    {
        $this->client->users->removeProjectUserAccess(projectId: $projectId, userId: $userId);
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
        $this->client->users->updateProjectUserAccess(
            projectId: $projectId,
            userId: $userId,
            permissions: $permissions
        );
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
        return $this->client->users->listProjectUserAccess(
            projectId: $projectId,
            pageSize: $pageSize,
            pageBefore: $pageBefore,
            pageAfter: $pageAfter,
            sort: $sort
        );
    }

    /**
     * Lists project access for a user
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function listUserProjectAccess(
        string $userId,
        ?string $filterOrganizationId = null,
        ?int $pageSize = null,
        ?string $pageBefore = null,
        ?string $pageAfter = null,
        ?string $sort = null
    ): ListProjectUserAccess200Response {
        return $this->client->users->listUserProjectAccess(
            userId: $userId,
            filterOrganizationId: $filterOrganizationId,
            pageSize: $pageSize,
            pageBefore: $pageBefore,
            pageAfter: $pageAfter,
            sort: $sort
        );
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
        return $this->client->environments->list(projectId: $projectId);
    }
}
