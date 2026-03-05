<?php

namespace Upsun\Core\Tasks;

use InvalidArgumentException;
use Psr\Http\Client\ClientExceptionInterface;
use Upsun\Api\ApiException;
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
use Upsun\Model\ListOrgProjects200Response;
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
        private readonly ProjectApi $prjApi,
        private readonly OrganizationProjectsApi $organizationApi,
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
     * Clears the build cache for a project.
     * 
     * @param string $projectId
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the project ID is invalid
     */
    public function clearBuildCache(string $projectId): AcceptedResponse
    {
        $this->checkProjectId($projectId);

        return $this->prjApi->actionProjectsClearBuildCache(projectId: $projectId);
    }

    /**
     * Creates a project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if required parameters are missing or invalid
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
        $this->checkOrganizationId($organizationId);
        $this->checkProjectRegion($projectRegion);

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
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the organization ID is invalid
     */
    public function canCreate(string $organizationId): CanCreateNewOrgSubscription200Response
    {
        $this->checkOrganizationId($organizationId);

        return $this->subscriptionsApi->canCreateNewOrgSubscription(organizationId: $organizationId);
    }

    /**
     * Deletes a project. This will effectively delete the project, along with any related resources and data.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID is invalid
     */
    public function delete(string $projectId): void
    {
        $this->checkProjectId($projectId);

        $project = $this->get($projectId);
        $subscriptionId = $this->extractSubscriptionId(projectLicenceUri: $project->getSubscription()->getLicenseUri());

        $this->subscriptionsApi->deleteOrgSubscription(
            organizationId: $project->getOrganization(),
            subscriptionId: $subscriptionId
        );
    }

    /**
     * Get or update a project.
     * 
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if required parameters are missing or invalid
     */
    public function info(
        string $projectId, 
        ?string $title = null,
        ?string $defaultBranch = null,
        ?string $description = null,
        ?string $defaultDomain = null,
        ?array $attributes = [],
        ?string $timezone = null,
        ?string $region = null,
    ): Project {
        $this->checkProjectId($projectId);

        if ($title || $defaultBranch || $description || $defaultDomain || $attributes || $timezone || $region) {
            $this->update(
                $projectId,
                $title, 
                $defaultBranch, 
                $description, 
                $defaultDomain, 
                $attributes, 
                $timezone, 
                $region
            );
        } 

        return $this->get($projectId);
    }

    /**
     * Gets a project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID is invalid
     */
    public function get(string $projectId): Project
    {
        $this->checkProjectId($projectId);

        return $this->prjApi->getProjects(projectId: $projectId);
    }

    /**
     * Updates a project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if required parameters are missing or invalid
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
        $this->checkProjectId($projectId);

        return $this->prjApi->updateProjects(
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
     * Lists projects for an organization.
     * 
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the organization ID is invalid
     */
    public function list(string $organizationId): ListOrgProjects200Response
    {
        $this->checkOrganizationId($organizationId);

        return $this->organizationApi->listOrgProjects($organizationId);
    }

    /**
     * Get the subscription details for a project. This method retrieves the subscription information associated with the
     * project, including details such as the subscription ID, status, plan, and other relevant information about the
     * subscription that is linked to the project.
     * 
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID is invalid or if the subscription ID cannot be extracted from 
     * the project information
     */
    public function getSubscription(string $projectId): Subscription
    {
        $this->checkProjectId($projectId);
        $project = $this->get($projectId);
        $subscriptionId = $this->extractSubscriptionId(projectLicenceUri: $project->getSubscription()->getLicenseUri());

        $this->checkSubscriptionId($subscriptionId);
        $this->checkOrganizationId($project->getOrganization());

        return $this->subscriptionsApi->getOrgSubscription(
            $project->getOrganization(),
            $subscriptionId
        );
    }

    /**
     * Retrieves the capabilities that are available for the specified project.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID is invalid
     */
    public function getCapabilities(string $projectId): ProjectCapabilities
    {
        $this->checkProjectId($projectId);

        return $this->prjApi->getProjectsCapabilities(projectId: $projectId);
    }

    /**
     * Cancel an invitation to a project. This will revoke the access that was granted to the invitee through the
     * invitation, and the invite will no longer be valid.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID or invitation ID is invalid
     */
    public function cancelInvite(string $projectId, string $invitationId): void
    {
        $this->client->invitations->cancelProjectInvite(projectId: $projectId, invitationId: $invitationId);
    }

    /**
     * Invites user to a project by email. This will send an invitation to the specified email address, allowing the
     * recipient to accept the invitation and gain access to the project with the specified role and permissions.
     *
     * @param array<int, 'read'|'write'|'admin'>|null $permissions
     * @param array<int, array{id: string, name: string}>|null $environments
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID or email is invalid
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
     * List all pending invitations for a project, with optional filtering.
     *
     * @throws ClientExceptionInterface on network errors
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
     * Gets project settings
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID is invalid
     */
    public function getSettings(string $projectId): ProjectSettings
    {
        $this->checkProjectId($projectId);

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
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID is invalid or if the provided settings are not valid
     */
    public function updateSettings(
        string $projectId,
        ?array $initialize = null,
        ?array $dataRetention = null,
        ?float $cpu = null,
        ?int $memory = null
    ): AcceptedResponse {
        $this->checkProjectId($projectId);

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
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID is invalid or if the provided variable details are not valid
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
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID is invalid or if the project variable ID is invalid
     */
    public function getVariable(string $projectId, string $variableId): ProjectVariable
    {
        $this->checkProjectId($projectId);
        $this->checkVariableId($variableId);

        return $this->client->variables->getProjectVariable(
            projectId: $projectId,
            projectVariableId: $variableId
        );
    }

    /**
     * Deletes a project variable
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID is invalid or if the project variable ID is invalid
     */
    public function deleteVariable(string $projectId, string $variableId): AcceptedResponse
    {
        $this->checkProjectId($projectId);
        $this->checkVariableId($variableId);

        return $this->client->variables->deleteProjectVariable(
            projectId: $projectId,
            projectVariableId: $variableId
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
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID is invalid or if the project variable ID is invalid
     */
    public function updateVariable(
        string $projectId,
        string $variableId,
        ?string $name = null,
        ?string $value = null,
        ?array $attributes = null,
        ?bool $isJson = null,
        ?bool $isSensitive = null,
        ?bool $visibleBuild = null,
        ?bool $visibleRuntime = null,
        ?array $applicationScope = null,
    ): AcceptedResponse {
        $this->checkProjectId($projectId);
        $this->checkVariableId($variableId);

        return $this->client->variables->updateProjectVariable(
            projectId: $projectId,
            projectVariableId: $variableId,
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
     * @return Activity[]
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID is invalid
     */
    public function listActivities(string $projectId): array
    {
        return $this->client->activities->list(projectId: $projectId);
    }

    /**
     * Gets a project activity log entry
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID or activity ID is invalid
     */
    public function getActivity(string $projectId, string $activityId): Activity
    {
        return $this->client->activities->get(projectId: $projectId, activityId: $activityId);
    }

    /**
     * Cancels a project activity
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID or activity ID is invalid
     */
    public function cancelActivity(string $projectId, string $activityId): AcceptedResponse
    {
        return $this->client->activities->cancel(projectId: $projectId, activityId: $activityId);
    }

    /**
     * Creates a project deployment target
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID is invalid or if the provided deployment target details are 
     * not valid
     */
    public function createDeployment(
        string $projectId,
        DeploymentTargetCreateInput $deploymentTargetCreateInput,
    ): AcceptedResponse {
        $this->checkProjectId($projectId);

        return $this->deploymentTargetApi->createProjectsDeployments(
            projectId: $projectId,
            deploymentTargetCreateInput: $deploymentTargetCreateInput,
        );
    }

    /**
     * Deletes a single project deployment target
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID or deployment target configuration ID is invalid
     */
    public function deleteDeployment(string $projectId, string $deploymentTargetConfigurationId): AcceptedResponse
    {
        $this->checkProjectId($projectId);

        return $this->deploymentTargetApi->deleteProjectsDeployments(
            projectId: $projectId,
            deploymentTargetConfigurationId: $deploymentTargetConfigurationId
        );
    }

    /**
     * Gets a single project deployment target
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID or deployment target configuration ID is invalid
     */
    public function getDeployment(string $projectId, string $deploymentTargetConfigurationId): DeploymentTarget
    {
        $this->checkProjectId($projectId);
        
        return $this->deploymentTargetApi->getProjectsDeployments(
            projectId: $projectId,
            deploymentTargetConfigurationId: $deploymentTargetConfigurationId
        );
    }

    /**
     * Gets project deployment target info
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID is invalid
     * @return DeploymentTarget[]
     */
    public function listDeployments(string $projectId): array
    {
        $this->checkProjectId($projectId);

        return $this->deploymentTargetApi->listProjectsDeployments(projectId: $projectId);
    }

    /**
     * Updates a project deployment
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID or deployment target configuration ID is invalid
     */
    public function updateDeployment(
        string $projectId,
        string $deploymentTargetConfigurationId,
        DeploymentTargetPatch $deploymentTargetPatch,
    ): AcceptedResponse {
        $this->checkProjectId($projectId);

        return $this->deploymentTargetApi->updateProjectsDeployments(
            projectId: $projectId,
            deploymentTargetConfigurationId: $deploymentTargetConfigurationId,
            deploymentTargetPatch: $deploymentTargetPatch
        );
    }

    /**
     * Gets a blob object
     *
     * @deprecated use $this->client->repositories->getGitBlob() instead
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID or repository blob ID is invalid
     */
    public function getGitBlob(string $projectId, string $repositoryBlobId): Blob
    {
        return $this->client->repositories->getGitBlob(projectId: $projectId, repositoryBlobId: $repositoryBlobId);
    }

    /**
     * Gets a commit object
     *
     * @deprecated use $this->client->repositories->getGitCommit() instead
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID or repository commit ID is invalid
     */
    public function getGitCommit(string $projectId, string $repositoryCommitId): Commit
    {
        return $this->client->repositories->getGitCommit(
            projectId: $projectId,
            repositoryCommitId: $repositoryCommitId
        );
    }

    /**
     * Gets a Git ref object
     *
     * @deprecated use $this->client->repositories->getGitRef() instead
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID or repository ref ID is invalid
     */
    public function getGitRef(string $projectId, string $repositoryRefId): Ref
    {
        return $this->client->repositories->getGitRef(
            projectId: $projectId,
            repositoryRefId: $repositoryRefId
        );
    }

    /**
     * Gets a Git tree object
     *
     * @deprecated use $this->client->repositories->getGitTree() instead
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID or repository tree ID is invalid
     */
    public function getGitTree(string $projectId, string $repositoryTreeId): Tree
    {
        return $this->client->repositories->getGitTree(
            projectId: $projectId,
            repositoryTreeId: $repositoryTreeId
        );
    }

    /**
     * Gets list of repository refs
     *
     * @deprecated use $this->client->repositories->listGitRefs() instead
     * @throws ClientExceptionInterface on network errors
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException if the project ID is invalid
     * @return Ref[]
     */
    public function listGitRefs(string $projectId): array
    {
        return $this->client->repositories->listGitRefs(projectId: $projectId);
    }

    /**
     * Get information about the Git server.
     *
     * @deprecated use $this->client->repositories->getGitInfo() instead
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID is invalid
     */
    public function getGitInfo(string $projectId): SystemInformation
    {
        return $this->client->repositories->getGitInfo(projectId: $projectId);
    }

    /**
     * Adds a project domain
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID is invalid or if the provided domain details are not valid
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
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID or domain ID is invalid
     */
    public function deleteDomain(string $projectId, string $domainId): AcceptedResponse
    {
        return $this->client->domains->delete(projectId: $projectId, domainId: $domainId);
    }

    /**
     * Gets a project domain
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID or domain ID is invalid
     */
    public function getDomain(string $projectId, string $domainId): Domain
    {
        return $this->client->domains->get(projectId: $projectId, domainId: $domainId);
    }

    /**
     * Gets list of project domains
     *
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID is invalid
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
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID or domain ID is invalid 
     * or if the provided domain details are not valid
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
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID is invalid or if the provided certificate details are not 
     * valid
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
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID or certificate ID is invalid
     */
    public function deleteCertificate(string $projectId, string $certificateId): AcceptedResponse
    {
        return $this->client->certificates->delete(projectId: $projectId, certificateId: $certificateId);
    }

    /**
     * Gets an SSL certificate
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID or certificate ID is invalid
     */
    public function getCertificate(string $projectId, string $certificateId): Certificate
    {
        return $this->client->certificates->get(projectId: $projectId, certificateId: $certificateId);
    }

    /**
     * Gets list of SSL certificates
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID is invalid
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
     * @deprecated use getTeamProjectAccessByProject() instead
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID or team ID is invalid
     */
    public function getProjectTeamAccess(string $projectId, string $teamId): TeamProjectAccess
    {
        return $this->getTeamProjectAccessByProject(projectId: $projectId, teamId: $teamId);
    }

    /**
     * Gets team access for a project
     *
     * @deprecated use getTeamProjectAccessByProject() instead
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID or team ID is invalid
     */
    public function getTeamProjectAccessByProject(string $projectId, string $teamId): TeamProjectAccess
    {
        return $this->client->teams->getTeamProjectAccessByProject(projectId: $projectId, teamId: $teamId);
    }

    /**
     * Gets project access for a team
     *
     * @deprecated use getTeamProjectAccessByTeam() instead
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID or team ID is invalid
     */
    public function getTeamProjectAccess(string $teamId, string $projectId): TeamProjectAccess
    {
        return $this->getTeamProjectAccessByTeam(teamId: $teamId, projectId: $projectId);
    }

    /**
     * Gets team access for a project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID or team ID is invalid
     */
    public function getTeamProjectAccessByTeam(string $teamId, string $projectId): TeamProjectAccess
    {
        return $this->client->teams->getTeamProjectAccessByTeam(teamId: $teamId, projectId: $projectId);
    }

    /**
     * Grants team access to a project
     *
     * @deprecated use grantTeamProjectAccessToProject() instead
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID or team ID is invalid or if the
     */
    public function grantProjectTeamAccess(string $projectId, array $access): void
    {
        $this->grantTeamProjectAccessToProject(
            projectId: $projectId,
            access: $access
        );
    }

    /**
     * Grants team access to a project for a team
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID is invalid or if the provided access details are not valid
     */
    public function grantTeamProjectAccessToProject(string $projectId, array $access): void
    {
        $this->client->teams->grantTeamProjectAccessToProject(
            projectId: $projectId,
            access: $access
        );
    }

    /**
     * Grants project access to a team
     *
     * @deprecated use grantTeamProjectAccessToTeam() instead
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the team ID is invalid
     */
    public function grantTeamProjectAccess(string $teamId, array $access): void
    {
        $this->grantTeamProjectAccessToTeam(teamId: $teamId, access: $access);
    }

    /**
     * Grants project access to a team
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the team ID is invalid
     */
    public function grantTeamProjectAccessToTeam(string $teamId, array $access): void
    {
        $this->client->teams->grantTeamProjectAccessToTeam(teamId: $teamId, access: $access);
    }

    /**
     * Lists team access for a project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID is invalid
     */
    public function listProjectTeamAccessByProject(
        string $projectId,
        ?int $pageSize = null,
        ?string $pageBefore = null,
        ?string $pageAfter = null,
        ?string $sort = null
    ): ListProjectTeamAccess200Response {
        return $this->client->teams->listTeamProjectAccessByProject(
            projectId: $projectId,
            pageSize: $pageSize,
            pageBefore: $pageBefore,
            pageAfter: $pageAfter,
            sort: $sort
        );
    }

    /**
     * Lists project team access for a project
     * 
     * @deprecated use listProjectTeamAccessByProject() instead
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID is invalid
     */
    public function listProjectTeamAccess(
        string $projectId,
        ?int $pageSize = null,
        ?string $pageBefore = null,
        ?string $pageAfter = null,
        ?string $sort = null
    ): ListProjectTeamAccess200Response {
        return $this->listProjectTeamAccessByProject(
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
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the team ID is invalid
     */
    public function listTeamProjectAccessByTeam(
        string $teamId,
        ?int $pageSize = null,
        ?string $pageBefore = null,
        ?string $pageAfter = null,
        ?string $sort = null
    ): ListProjectTeamAccess200Response {
        return $this->client->teams->listTeamProjectAccessByTeam(
            teamId: $teamId,
            pageSize: $pageSize,
            pageBefore: $pageBefore,
            pageAfter: $pageAfter,
            sort: $sort
        );
    }

    /**
     * Lists project access for a team
     *
     * @deprecated use listTeamProjectAccessByTeam() instead
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the team ID is invalid
     */
    public function listTeamProjectAccess(
        string $teamId,
        ?int $pageSize = null,
        ?string $pageBefore = null,
        ?string $pageAfter = null,
        ?string $sort = null
    ): ListProjectTeamAccess200Response {
        return $this->listTeamProjectAccessByTeam(
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
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID or team ID is invalid
     */
    public function revokeTeamProjectAccessByProject(string $projectId, string $teamId): void
    {
        $this->client->teams->revokeTeamProjectAccessByProject(projectId: $projectId, teamId: $teamId);
    }

    /**
     * Removes team access for a project
     *
     * @deprecated use revokeTeamProjectAccessByProject() instead
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID or team ID is invalid
     */
    public function revokeProjectTeamAccess(string $projectId, string $teamId): void
    {
        $this->revokeTeamProjectAccessByProject(projectId: $projectId, teamId: $teamId);
    }    

    /**
     * Removes project access for a team
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the team ID is invalid
     */
    public function revokeTeamProjectAccessByTeam(string $teamId, string $projectId): void
    {
        $this->client->teams->revokeTeamProjectAccessByTeam(teamId: $teamId, projectId: $projectId);
    }

    /**
     * Removes project access for a team
     *
     * @deprecated use revokeTeamProjectAccessByTeam() instead
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the team ID is invalid
     */
    public function revokeTeamProjectAccess(string $teamId, string $projectId): void
    {
        $this->revokeTeamProjectAccessByTeam(teamId: $teamId, projectId: $projectId);
    }    

    /**
     * Get the access details of a user to a project. This method retrieves the access information for a specific user 
     * in relation to a project, including the level of access granted to the user, the permissions they have, and any
     * relevant metadata about the user's access to the project.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID or user ID is invalid
     */
    public function getUserProjectAccessByProject(string $projectId, string $userId): UserProjectAccess
    {
        return $this->client->users->getUserProjectAccessByProject(projectId: $projectId, userId: $userId);
    }

    /**
     * Gets user access for a project
     *
     * @deprecated use getUserProjectAccessByProject() instead
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID or user ID is invalid
     */
    public function getProjectUserAccess(string $projectId, string $userId): UserProjectAccess
    {
        return $this->getUserProjectAccessByProject(projectId: $projectId, userId: $userId);
    }

    /**
     * Grants user access to a project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID or user ID is invalid
     */
    public function grantUserProjectAccessByProject(string $projectId, array $permissions): void
    {
        $this->client->users->addToProject(
            projectId: $projectId,
            permissions: $permissions
        );
    }

    /**
     * Grants user access to a project
     *
     * @deprecated use grantUserProjectAccessByProject() instead
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID or user ID is invalid
     */
    public function grantProjectUserAccess(string $projectId, array $permissions): void
    {
        $this->grantUserProjectAccessByProject(
            projectId: $projectId,
            permissions: $permissions
        );
    }    

    /**
     * Revoke access to a project for a user. This method allows you to revoke the access that a user has to a project,
     * which will remove the user's permissions and access to the project. Once the request is accepted, the user will 
     * no longer have access to the project.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID or user ID is invalid
     */
    public function revokeUserProjectAccessByProject(string $projectId, string $userId): void
    {
        $this->client->users->removeFromProject(projectId: $projectId, userId: $userId);
    }

    /**
     * Removes user access for a project
     *
     * @deprecated use revokeUserProjectAccessByProject() instead
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID or user ID is invalid
     */
    public function revokeProjectUserAccess(string $projectId, string $userId): void
    {
        $this->revokeUserProjectAccessByProject(projectId: $projectId, userId: $userId);
    }

    /**
     * Updates user access for a project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID or user ID is invalid or if the
     */
    public function updateUserProjectAccessByProject(
        string $projectId,
        string $userId,
        ?array $permissions = null
    ): void {
        $this->client->users->updateProjectUserAccessByProject(
            projectId: $projectId,
            userId: $userId,
            permissions: $permissions
        );
    }

    /**
     * Updates user access for a project
     *
     * @deprecated use updateUserProjectAccessByProject() instead
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID or user ID is invalid or if the
     */
    public function updateProjectUserAccess(
        string $projectId,
        string $userId,
        ?array $permissions = null
    ): void {
        $this->updateUserProjectAccessByProject(
            projectId: $projectId,
            userId: $userId,
            permissions: $permissions
        );
    }

    /**
     * Lists user access for a project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID is invalid
     */
    public function listUserProjectAccessByProject(
        string $projectId,
        ?int $pageSize = null,
        ?string $pageBefore = null,
        ?string $pageAfter = null,
        ?string $sort = null
    ): ListProjectUserAccess200Response {
        return $this->client->users->listProjectUserAccesses(
            projectId: $projectId,
            pageSize: $pageSize,
            pageBefore: $pageBefore,
            pageAfter: $pageAfter,
            sort: $sort
        );
    }

    /**
     * Lists user access for a project
     *
     * @deprecated use listUserProjectAccessByProject() instead
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID is invalid
     */
    public function listProjectUserAccess(
        string $projectId,
        ?int $pageSize = null,
        ?string $pageBefore = null,
        ?string $pageAfter = null,
        ?string $sort = null
    ): ListProjectUserAccess200Response {
        return $this->listUserProjectAccessByProject(
            projectId: $projectId,
            pageSize: $pageSize,
            pageBefore: $pageBefore,
            pageAfter: $pageAfter,
            sort: $sort
        );
    }

    /**
     * List the access details of all projects to a user. This method retrieves a list of all projects that a user has
     * access to, along with the access details for each project, including the level of access, permissions, and any
     * relevant metadata about their access to the projects.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the user ID is invalid
     */
    public function listUserProjectAccessByUser(
        string $userId,
        ?string $filterOrganizationId = null,
        ?int $pageSize = null,
        ?string $pageBefore = null,
        ?string $pageAfter = null,
        ?string $sort = null
    ): ListProjectUserAccess200Response {
        return $this->client->users->listUserProjectAccessByUser(
            userId: $userId,
            filterOrganizationId: $filterOrganizationId,
            pageSize: $pageSize,
            pageBefore: $pageBefore,
            pageAfter: $pageAfter,
            sort: $sort
        );
    }

    /**
     * Lists project access for a user
     *
     * @deprecated use listUserProjectAccessByUser() instead
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the user ID is invalid
     */
    public function listUserProjectAccess(
        string $userId,
        ?string $filterOrganizationId = null,
        ?int $pageSize = null,
        ?string $pageBefore = null,
        ?string $pageAfter = null,
        ?string $sort = null
    ): ListProjectUserAccess200Response {
        return $this->listUserProjectAccessByUser(
            userId: $userId,
            filterOrganizationId: $filterOrganizationId,
            pageSize: $pageSize,
            pageBefore: $pageBefore,
            pageAfter: $pageAfter,
            sort: $sort
        );
    }

    /**
     * List all environments associated with a project. This method retrieves a list of all environments that are linked
     * to the specified project.
     *
     * @throws ClientExceptionInterface on network errors
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException if the project ID is invalid
     * @return Environment[]
     */
    public function listEnvironments(string $projectId): array
    {
        return $this->client->environments->list(projectId: $projectId);
    }

    /**
     * Integrates project with a third-party service
     *
     * @deprecated use $this->client->integrations->createIntegration() instead
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID is invalid or if the provided integration details are not 
     * valid
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
     * @deprecated use $this->client->integrations->deleteIntegration() instead
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID or integration ID is invalid
     */
    public function deleteIntegration(string $projectId, string $integrationId): AcceptedResponse
    {
        return $this->client->integrations->deleteIntegration(
            projectId: $projectId,
            integrationId: $integrationId
        );
    }

    /**
     * Gets information about an existing third-party integration
     *
     * @deprecated use $this->client->integrations->getIntegration() instead
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID or integration ID is invalid
     */
    public function getIntegration(string $projectId, string $integrationId): Integration
    {
        return $this->client->integrations->getIntegration(
            projectId: $projectId,
            integrationId: $integrationId
        );
    }

    /**
     * Gets list of existing integrations for a project
     *
     * @deprecated use $this->client->integrations->listIntegrations() instead
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID is invalid
     * @return Integration[]
     */
    public function listIntegrations(string $projectId): array
    {
        return $this->client->integrations->listIntegrations(projectId: $projectId);
    }

    /**
     * Updates an existing third-party integration
     *
     * @deprecated use $this->client->integrations->updateIntegration() instead
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID or integration ID is invalid or if the
     * provided integration details are not valid
     */
    public function updateIntegration(
        string $projectId,
        string $integrationId,
        IntegrationPatch $integrationPatch,
    ): AcceptedResponse {
        return $this->client->integrations->updateIntegration(
            projectId: $projectId,
            integrationId: $integrationId,
            integrationUpdateInput: $integrationPatch
        );
    }

}
