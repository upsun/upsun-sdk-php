<?php

namespace Upsun\Core\Tasks;

use InvalidArgumentException;
use Upsun\ApiException;
use Upsun\API\DeploymentTargetApi;
use Upsun\API\OrganizationProjectsApi;
use Upsun\API\ProjectApi;
use Upsun\API\ProjectSettingsApi;
use Upsun\API\RepositoryApi;
use Upsun\API\SubscriptionsApi;
use Upsun\API\SystemInformationApi;
use Upsun\API\ThirdPartyIntegrationsApi;
use Upsun\Model\AcceptedResponse;
use Upsun\Model\Activity;
use Upsun\Model\Blob;
use Upsun\Model\CanCreateNewOrgSubscription200Response;
use Upsun\Model\Certificate;
use Upsun\Model\Commit;
use Upsun\Model\CreateOrgSubscriptionRequest;
use Upsun\Model\DeploymentTarget;
use Upsun\Model\DeploymentTargetCreateInput;
use Upsun\Model\DeploymentTargetPatch;
use Upsun\Model\Domain;
use Upsun\Model\Error;
use Upsun\Model\Integration;
use Upsun\Model\IntegrationCreateInput;
use Upsun\Model\IntegrationPatch;
use Upsun\Model\ListProjectUserAccess200Response;
use Upsun\Model\ListTeamProjectAccess200Response;
use Upsun\Model\OrganizationProject;
use Upsun\Model\ProjectCapabilities;
use Upsun\Model\ProjectInvitation;
use Upsun\Model\ProjectPatch;
use Upsun\Model\ProjectSettings;
use Upsun\Model\ProjectSettingsPatch;
use Upsun\Model\Ref;
use Upsun\Model\SystemInformation;
use Upsun\Model\TeamProjectAccess;
use Upsun\Model\Tree;
use Upsun\Model\UserProjectAccess;
use Upsun\UpsunClient;

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
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function delete(string $projectId): AcceptedResponse
    {
        $this->refreshToken();
        return $this->api->deleteProjects($projectId);
    }

    /**
     * Gets a project
     *
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function get(string $projectId): OrganizationProject
    {
        $this->refreshToken();
        $project = $this->api->getProjects($projectId);
        $orgId = $project->getOrganization();
        return $this->organizationProjectsApi->getOrgProject($orgId, $projectId);
    }

    /**
     * Creates a project
     *
     * @throws ApiException
     */
    public function create(string $organizationId, array $projectData): Error|OrganizationProject
    {
        $this->refreshToken();
        $createProjectData = new CreateOrgSubscriptionRequest($projectData);
        $subscription = $this->subscriptionsApi->createOrgSubscription($organizationId, $createProjectData);
        return $this->organizationProjectsApi->getOrgProject(
            $this->api->getProjects($subscription->getProjectId())->getOrganization(),
            $subscription->getProjectId()
        );
    }

    /**
     * Checks if the user is able to create a new project in the organization.
     *
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function canCreate(string $organizationId): CanCreateNewOrgSubscription200Response|Error
    {
        $this->refreshToken();
        return $this->subscriptionsApi->canCreateNewOrgSubscription($organizationId);
    }

    /**
     * Gets a project's capabilities
     *
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getCapabilities(string $projectId): ProjectCapabilities
    {
        $this->refreshToken();
        return $this->api->getProjectsCapabilities($projectId);
    }

    /**
     * Updates a project
     *
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function update(string $projectId, array $projectData): AcceptedResponse
    {
        $this->refreshToken();
        $project_patch = new ProjectPatch($projectData);
        return $this->api->updateProjects($projectId, $project_patch);
    }

    /**
     * Cancels a pending invitation to a project
     *
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function cancelInvite(string $projectId, string $invitationId): void
    {
        $this->client->invitations->cancelProjectInvite($projectId, $invitationId);
    }

    /**
     * Invites user to a project by email
     *
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function createInvite(
        string $projectId,
        ?array $createProjectInviteRequest = null
    ): ProjectInvitation|Error {
        return $this->client->invitations->createProjectInvite($projectId, $createProjectInviteRequest);
    }

    /**
     * Lists invitations to a project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listInvites(
        string $projectId,
        ?array $filterState = null,
        ?int $pageSize = null,
        ?string $pageBefore = null,
        ?string $pageAfter = null,
        ?string $sort = null
    ): Error|array {
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
     */
    public function getSettings(string $projectId): ProjectSettings
    {
        $this->refreshToken();
        return $this->settingsApi->getProjectsSettings($projectId);
    }

    /**
     * Updates a project setting
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function updateSettings(string $projectId, array $projectSettingsPatch): AcceptedResponse
    {
        $this->refreshToken();
        $projectSettingsPatch = new ProjectSettingsPatch($projectSettingsPatch);
        return $this->settingsApi->updateProjectsSettings($projectId, $projectSettingsPatch);
    }

    /**
     * Adds a project variable
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function createVariable(string $projectId, array $projectVariableCreateInput): AcceptedResponse
    {
        return $this->client->variables->createProjectVariable($projectId, $projectVariableCreateInput);
    }

    /**
     * Deletes a project variable
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function deleteVariable(string $projectId, string $projectVariableId): AcceptedResponse
    {
        return $this->client->variables->deleteProjectVariable($projectId, $projectVariableId);
    }

    /**
     * Gets list of project variables
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listVariables(string $projectId): array
    {
        return $this->client->variables->listProjectVariables($projectId);
    }

    /**
     * Updates a project variable
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
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
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function cancelActivity(string $projectId, string $activityId): AcceptedResponse
    {
        return $this->client->activity->cancel($projectId, $activityId);
    }

    /**
     * Gets a project activity log entry
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getActivity(string $projectId, string $activityId): Activity
    {
        return $this->client->activity->get($projectId, $activityId);
    }

    /**
     * Gets project activity log
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listActivities(string $projectId): array
    {
        return $this->client->activity->list($projectId);
    }

    /**
     * Creates a project deployment target
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function createDeployment(string $projectId, array $deploymentTargetCreateInput): AcceptedResponse
    {
        $this->refreshToken();
        $deploymentTargetCreateInput = new DeploymentTargetCreateInput($deploymentTargetCreateInput);
        return $this->deploymentTargetApi->createProjectsDeployments($projectId, $deploymentTargetCreateInput);
    }

    /**
     * Deletes a single project deployment target
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function deleteDeployment(string $projectId, string $deploymentTargetConfigurationId): AcceptedResponse
    {
        $this->refreshToken();
        return $this->deploymentTargetApi->deleteProjectsDeployments($projectId, $deploymentTargetConfigurationId);
    }

    /**
     * Gets a single project deployment target
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getDeployment(string $projectId, string $deploymentTargetConfigurationId): DeploymentTarget
    {
        $this->refreshToken();
        return $this->deploymentTargetApi->getProjectsDeployments($projectId, $deploymentTargetConfigurationId);
    }

    /**
     * Gets project deployment target info
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listDeployments(string $projectId): array
    {
        $this->refreshToken();
        return $this->deploymentTargetApi->listProjectsDeployments($projectId);
    }

    /**
     * Updates a project deployment
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function updateDeployment(
        string $projectId,
        string $deploymentTargetConfigurationId,
        array $deploymentTargetPatch
    ): AcceptedResponse {
        $this->refreshToken();
        $deploymentTargetPatch = new DeploymentTargetPatch($deploymentTargetPatch);
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
     */
    public function getGitBlob(string $projectId, string $repositoryBlobId): Blob
    {
        $this->refreshToken();
        return $this->repositoryApi->getProjectsGitBlobs($projectId, $repositoryBlobId);
    }

    /**
     * Gets a commit object
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getGitCommit(string $projectId, string $repositoryCommitId): Commit
    {
        $this->refreshToken();
        return $this->repositoryApi->getProjectsGitCommits($projectId, $repositoryCommitId);
    }

    /**
     * Gets a Git ref object
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getGitRef(string $projectId, string $repositoryRefId): Ref
    {
        $this->refreshToken();
        return $this->repositoryApi->getProjectsGitRefs($projectId, $repositoryRefId);
    }

    /**
     * Gets a Git tree object
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getGitTree(string $projectId, string $repositoryTreeId): Tree
    {
        $this->refreshToken();
        return $this->repositoryApi->getProjectsGitTrees($projectId, $repositoryTreeId);
    }


    /**
     * Gets list of repository refs
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listGitRefs(string $projectId): array
    {
        $this->refreshToken();
        return $this->repositoryApi->listProjectsGitRefs($projectId);
    }

    /**
     * Restarts the Git server
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function restartGitServer(string $projectId): AcceptedResponse
    {
        $this->refreshToken();
        return $this->systemInfoApi->actionProjectsSystemRestart($projectId);
    }

    /**
     * Get information about the Git server.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getGitInfo(string $projectId): SystemInformation
    {
        $this->refreshToken();
        return $this->systemInfoApi->getProjectsSystem($projectId);
    }

    /**
     * Integrates project with a third-party service
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function createIntegration(string $projectId, array $integrationCreateInput): AcceptedResponse
    {
        $this->refreshToken();
        $integrationCreateInput = new IntegrationCreateInput($integrationCreateInput);
        return $this->thirdPartyIntegrationsApi->createProjectsIntegrations($projectId, $integrationCreateInput);
    }

    /**
     * Deletes an existing third-party integration
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function deleteIntegration(string $projectId, string $integrationId): AcceptedResponse
    {
        $this->refreshToken();
        return $this->thirdPartyIntegrationsApi->deleteProjectsIntegrations($projectId, $integrationId);
    }

    /**
     * Gets information about an existing third-party integration
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getIntegration(string $projectId, string $integrationId): Integration
    {
        $this->refreshToken();
        return $this->thirdPartyIntegrationsApi->getProjectsIntegrations($projectId, $integrationId);
    }

    /**
     * Gets list of existing integrations for a project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listIntegrations(string $projectId): array
    {
        $this->refreshToken();
        return $this->thirdPartyIntegrationsApi->listProjectsIntegrations($projectId);
    }

    /**
     * Updates an existing third-party integration
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function updateIntegration(
        string $projectId,
        string $integrationId,
        array $integrationPatch
    ): AcceptedResponse {
        $this->refreshToken();
        $integrationPatch = new IntegrationPatch($integrationPatch);
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
     */
    public function createDomain(string $projectId, array $domainCreateInput): AcceptedResponse
    {
        return $this->client->domain->create($projectId, $domainCreateInput);
    }

    /**
     * Deletes a project domain
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function deleteDomain(string $projectId, string $domainId): AcceptedResponse
    {
        return $this->client->domain->delete($projectId, $domainId);
    }

    /**
     * Gets a project domain
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getDomain(string $projectId, string $domainId): Domain
    {
        return $this->client->domain->get($projectId, $domainId);
    }

    /**
     * Gets list of project domains
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listDomains(string $projectId): array
    {
        $this->refreshToken();
        return $this->client->domain->list($projectId);
    }

    /**
     * Updates a project domain
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function updateDomain(string $projectId, string $domainId, array $domainPatch): AcceptedResponse
    {
        return $this->client->domain->update($projectId, $domainId, $domainPatch);
    }

    /**
     * Adds an SSL certificate
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function createCertificate(string $projectId, array $certificateCreateInput): AcceptedResponse
    {
        return $this->client->certificate->create($projectId, $certificateCreateInput);
    }

    /**
     * Deletes an SSL certificate
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function deleteCertificate(string $projectId, string $certificateId): AcceptedResponse
    {
        return $this->client->certificate->delete($projectId, $certificateId);
    }

    /**
     * Gets an SSL certificate
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getCertificate(string $projectId, string $certificateId): Certificate
    {
        return $this->client->certificate->get($projectId, $certificateId);
    }

    /**
     * Gets list of SSL certificates
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listCertificates(string $projectId): array
    {
        return $this->client->certificate->list($projectId);
    }

    /**
     * Updates an SSL certificate
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
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
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
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
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getProjectTeamAccess(string $projectId, string $teamId): Error|TeamProjectAccess
    {
        return $this->client->team->getProjectTeamAccess($projectId, $teamId);
    }


    /**
     * Gets project access for a team
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getTeamProjectAccess(string $teamId, string $projectId): Error|TeamProjectAccess
    {
        return $this->client->team->getTeamProjectAccess($teamId, $projectId);
    }

    /**
     * Grants team access to a project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function grantProjectTeamAccess(string $projectId, array $grantProjectTeamAccessRequestInner): void
    {
        $this->client->team->grantProjectTeamAccess($projectId, $grantProjectTeamAccessRequestInner);
    }

    /**
     * Grants project access to a team
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function grantTeamProjectAccess(string $teamId, array $grantTeamProjectAccessRequestInner): void
    {
        $this->client->team->grantTeamProjectAccess($teamId, $grantTeamProjectAccessRequestInner);
    }

    /**
     * Lists team access for a project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listProjectTeamAccess(
        string $projectId,
        ?int $pageSize = null,
        ?string $pageBefore = null,
        ?string $pageAfter = null,
        ?string $sort = null
    ): Error|ListTeamProjectAccess200Response {
        return $this->client->team->listProjectTeamAccess($projectId, $pageSize, $pageBefore, $pageAfter, $sort);
    }

    /**
     * Lists project access for a team
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listTeamProjectAccess(
        string $teamId,
        ?int $pageSize = null,
        ?string $pageBefore = null,
        ?string $pageAfter = null,
        ?string $sort = null
    ): Error|ListTeamProjectAccess200Response {
        return $this->client->team->listTeamProjectAccess($teamId, $pageSize, $pageBefore, $pageAfter, $sort);
    }

    /**
     * Removes team access for a project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function removeProjectTeamAccess(string $projectId, string $teamId): void
    {
        $this->client->team->removeProjectTeamAccess($projectId, $teamId);
    }

    /**
     * Removes project access for a team
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function removeTeamProjectAccess(string $teamId, string $projectId): void
    {
        $this->client->team->removeTeamProjectAccess($teamId, $projectId);
    }

    /**
     * Gets user access for a project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getProjectUserAccess(string $projectId, string $userId): Error|UserProjectAccess
    {
        return $this->client->user->getProjectUserAccess($projectId, $userId);
    }

    /**
     * Grants user access to a project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function grantProjectUserAccess(string $projectId, array $grantProjectUserAccessRequestInner): void
    {
        $this->client->user->grantProjectUserAccess($projectId, $grantProjectUserAccessRequestInner);
    }

    /**
     * Removes user access for a project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function removeProjectUserAccess(string $projectId, string $userId): void
    {
        $this->client->user->removeProjectUserAccess($projectId, $userId);
    }

    /**
     * Updates user access for a project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
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
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listProjectUserAccess(
        string $projectId,
        ?int $pageSize = null,
        ?string $pageBefore = null,
        ?string $pageAfter = null,
        ?string $sort = null
    ): ListProjectUserAccess200Response|Error {
        return $this->client->user->listProjectUserAccess($projectId, $pageSize, $pageBefore, $pageAfter, $sort);
    }

    /**
     * Lists environments of a project
     *
     * @throws ApiException
     */
    public function listEnvironments(string $projectId): array
    {
        return $this->client->environment->list($projectId);
    }
}
