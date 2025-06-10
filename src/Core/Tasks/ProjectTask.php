<?php

namespace Upsun\Core\Tasks;

use InvalidArgumentException;
use OpenAPI\Client\ApiException;
use OpenAPI\Client\apisgen\DeploymentTargetApi;
use OpenAPI\Client\apisgen\ProjectApi;
use OpenAPI\Client\apisgen\ProjectSettingsApi;
use OpenAPI\Client\apisgen\RepositoryApi;
use OpenAPI\Client\apisgen\SystemInformationApi;
use OpenAPI\Client\apisgen\ThirdPartyIntegrationsApi;
use OpenAPI\Client\HeaderSelector;
use OpenAPI\Client\Model\AcceptedResponse;
use OpenAPI\Client\Model\Activity;
use OpenAPI\Client\Model\Blob;
use OpenAPI\Client\Model\Certificate;
use OpenAPI\Client\Model\Commit;
use OpenAPI\Client\Model\CreateProjectInviteRequest;
use OpenAPI\Client\Model\DeploymentTarget;
use OpenAPI\Client\Model\DeploymentTargetCreateInput;
use OpenAPI\Client\Model\DeploymentTargetPatch;
use OpenAPI\Client\Model\Domain;
use OpenAPI\Client\Model\Environment;
use OpenAPI\Client\Model\Error;
use OpenAPI\Client\Model\GrantProjectTeamAccessRequestInner;
use OpenAPI\Client\Model\GrantProjectUserAccessRequestInner;
use OpenAPI\Client\Model\GrantTeamProjectAccessRequestInner;
use OpenAPI\Client\Model\Integration;
use OpenAPI\Client\Model\IntegrationCreateInput;
use OpenAPI\Client\Model\IntegrationPatch;
use OpenAPI\Client\Model\ListProjectUserAccess200Response;
use OpenAPI\Client\Model\ListTeamProjectAccess200Response;
use OpenAPI\Client\Model\Project;
use OpenAPI\Client\Model\ProjectCapabilities;
use OpenAPI\Client\Model\ProjectInvitation;
use OpenAPI\Client\Model\ProjectPatch;
use OpenAPI\Client\Model\ProjectSettings;
use OpenAPI\Client\Model\ProjectSettingsPatch;
use OpenAPI\Client\Model\ProjectVariable;
use OpenAPI\Client\Model\Ref;
use OpenAPI\Client\Model\Subscription;
use OpenAPI\Client\Model\SystemInformation;
use OpenAPI\Client\Model\TeamProjectAccess;
use OpenAPI\Client\Model\Tree;
use OpenAPI\Client\Model\UserProjectAccess;
use Upsun\UpsunClient;

class ProjectTask extends TaskBase
{
    protected HeaderSelector $headerSelector;

    public readonly ProjectApi $api;
    public readonly ProjectSettingsApi $settingsApi;
    public readonly DeploymentTargetApi $deploymentTargetApi;
    public readonly RepositoryApi $repositoryApi;
    public readonly SystemInformationApi $systemInfoApi;
    public readonly ThirdPartyIntegrationsApi $thirdPartyIntegrationsApi;

    public function __construct(
        public readonly UpsunClient $client,
    ) {
        $this->headerSelector = new HeaderSelector();
        $this->api = new ProjectApi($this->client->apiClient, $this->client->apiConfig);
        $this->settingsApi = new ProjectSettingsApi($this->client->apiClient, $this->client->apiConfig);
        $this->deploymentTargetApi = new DeploymentTargetApi($this->client->apiClient, $this->client->apiConfig);
        $this->repositoryApi = new RepositoryApi($this->client->apiClient, $this->client->apiConfig);
        $this->systemInfoApi = new SystemInformationApi($this->client->apiClient, $this->client->apiConfig);
        $this->thirdPartyIntegrationsApi = new ThirdPartyIntegrationsApi(
            $this->client->apiClient,
            $this->client->apiConfig
        );
    }

    /************** **********************/
    /********* ProjectApi ****************/
    /************** **********************/

    /**
     * Operation deleteProjects
     *
     * Delete a project
     *
     * @param string $project_id project_id (required)
     *
     * @return AcceptedResponse
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function delete(string $project_id): AcceptedResponse
    {
        $this->refreshToken();
        return $this->api->deleteProjects($project_id);
    }

    /**
     * Gets a project
     *
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function get(string $project_id): Project
    {
        $this->refreshToken();
        return $this->api->getProjects($project_id);
    }

    /**
     * Operation getProjectsCapabilities
     *
     * Get a project's capabilities
     *
     * @param string $project_id project_id (required)
     *
     * @return ProjectCapabilities
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getCapabilities(string $project_id): ProjectCapabilities
    {
        $this->refreshToken();
        return $this->api->getProjectsCapabilities($project_id);
    }

    /**
     * Operation updateProjects
     *
     * Update a project
     *
     * @param string $project_id project_id (required)
     * @param array $project_data (required)
     *
     * @return AcceptedResponse
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function update(string $project_id, array $project_data): AcceptedResponse
    {
        $this->refreshToken();
        $project_patch = new ProjectPatch($project_data);
        return $this->api->updateProjects($project_id, $project_patch);
    }

    /************** ************************************/
    /********* InvitationTask shortcuts ****************/
    /************** ************************************/

    /**
     * Operation cancelProjectInvite
     *
     * Cancel a pending invitation to a project
     *
     * @param string $project_id The ID of the project. (required)
     * @param string $invitation_id The ID of the invitation. (required)
     *
     * @return void
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function cancelInvite(string $project_id, string $invitation_id): void
    {
        $this->client->invitations->cancelProjectInvite($project_id, $invitation_id);
    }

    /**
     * Operation createProjectInvite
     *
     * Invite user to a project by email
     *
     * @param string $project_id The ID of the project. (required)
     * @param CreateProjectInviteRequest|null $create_project_invite_request create_project_invite_request (optional)
     *
     * @return ProjectInvitation|Error
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function createInvite(
        string $project_id,
        CreateProjectInviteRequest $create_project_invite_request = null
    ): ProjectInvitation|Error {
        return $this->client->invitations->createProjectInvite($project_id, $create_project_invite_request);
    }

    /**
     * Operation listProjectInvites
     *
     * List invitations to a project
     *
     * @param string $project_id The ID of the project. (required)
     * @param array|null $filter_state Allows filtering by `state` of the invitations:
     *        'pending' (default), 'error'. (optional)
     * @param int|null $page_size Determines the number of items to show. (optional)
     * @param string|null $page_before Pagination cursor. This is automatically generated as necessary
     *        and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param string|null $page_after Pagination cursor. This is automatically generated as necessary
     *        and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param string|null $sort Allows sorting by a single field. Use a dash ('-') to sort descending. (optional)
     *
     * @return ProjectInvitation[]|Error
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listInvites(
        string $project_id,
        array $filter_state = null,
        int $page_size = null,
        string $page_before = null,
        string $page_after = null,
        string $sort = null
    ): Error|array {
        return $this->client->invitations->listProjectInvites(
            $project_id,
            $filter_state,
            $page_size,
            $page_before,
            $page_after,
            $sort
        );
    }

    /************** ******************************/
    /********* ProjectSettingsApi ****************/
    /************** ******************************/

    /**
     * Operation getProjectsSettings
     *
     * Get list of project settings
     *
     * @param string $project_id project_id (required)
     * @return ProjectSettings
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getSettings(string $project_id): ProjectSettings
    {
        $this->refreshToken();
        return $this->settingsApi->getProjectsSettings($project_id);
    }

    /**
     * Operation updateProjectsSettings
     *
     * Update a project setting
     *
     * @param string $project_id project_id (required)
     * @param array $project_settings_patch (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function updateSettings(string $project_id, array $project_settings_patch): AcceptedResponse
    {
        $this->refreshToken();
        $project_settings_patch = new ProjectSettingsPatch($project_settings_patch);
        return $this->settingsApi->updateProjectsSettings($project_id, $project_settings_patch);
    }

    /************** **********************************/
    /********* VariableTask shortcuts ****************/
    /************** **********************************/

    /**
     * Operation createVariable
     *
     * Add a project variable
     *
     * @param string $project_id project_id (required)
     * @param array $project_variable_create_input (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function createVariable(string $project_id, array $project_variable_create_input): AcceptedResponse
    {
        return $this->client->variables->createProjectVariable($project_id, $project_variable_create_input);
    }

    /**
     * Operation deleteVariable
     *
     * Delete a project variable
     *
     * @param string $project_id project_id (required)
     * @param string $project_variable_id project_variable_id (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function deleteVariable(string $project_id, string $project_variable_id): AcceptedResponse
    {
        return $this->client->variables->deleteProjectVariable($project_id, $project_variable_id);
    }

    /**
     * Operation listVariables
     *
     * Get list of project variables
     *
     * @param string $project_id project_id (required)
     * @return ProjectVariable[]
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listVariables(string $project_id): array
    {
        return $this->client->variables->listProjectVariables($project_id);
    }

    /**
     * Operation updateVariable
     *
     * Update a project variable
     *
     * @param string $project_id project_id (required)
     * @param string $project_variable_id project_variable_id (required)
     * @param array $project_variable_patch (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function updateVariable(
        string $project_id,
        string $project_variable_id,
        array $project_variable_patch
    ): AcceptedResponse {
        return $this->client->variables->updateProjectVariable(
            $project_id,
            $project_variable_id,
            $project_variable_patch
        );
    }

    /************** **********************************/
    /********* ActivityTask shortcuts ****************/
    /************** **********************************/

    /**
     * Operation cancelActivity
     *
     * Cancel a project activity
     *
     * @param string $project_id project_id (required)
     * @param string $activity_id activity_id (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function cancelActivity(string $project_id, string $activity_id): AcceptedResponse
    {
        return $this->client->activity->projectCancel($project_id, $activity_id);
    }

    /**
     * Operation getActivity
     *
     * Get a project activity log entry
     *
     * @param string $project_id project_id (required)
     * @param string $activity_id activity_id (required)
     * @return Activity
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getActivity(string $project_id, string $activity_id): Activity
    {
        return $this->client->activity->projectGet($project_id, $activity_id);
    }

    /**
     * Operation listProjectsActivities
     *
     * Get project activity log
     *
     * @param string $project_id project_id (required)
     * @return Activity[]
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listActivities(string $project_id): array
    {
        return $this->client->activity->projectList($project_id);
    }

    /************** ********************************/
    /********* DeploymentTargetApi  ****************/
    /************** ********************************/

    /**
     * Operation createDeployment
     *
     * Create a project deployment target
     *
     * @param string $project_id project_id (required)
     * @param array $deployment_target_create_input (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function createDeployment(string $project_id, array $deployment_target_create_input): AcceptedResponse
    {
        $this->refreshToken();
        $deployment_target_create_input = new DeploymentTargetCreateInput($deployment_target_create_input);
        return $this->deploymentTargetApi->createProjectsDeployments($project_id, $deployment_target_create_input);
    }

    /**
     * Operation deleteProjectsDeployments
     *
     * Delete a single project deployment target
     *
     * @param string $project_id project_id (required)
     * @param string $deployment_target_configuration_id deployment_target_configuration_id (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function deleteDeployment(string $project_id, string $deployment_target_configuration_id): AcceptedResponse
    {
        $this->refreshToken();
        return $this->deploymentTargetApi->deleteProjectsDeployments($project_id, $deployment_target_configuration_id);
    }

    /**
     * Operation getProjectsDeployments
     *
     * Get a single project deployment target
     *
     * @param string $project_id project_id (required)
     * @param string $deployment_target_configuration_id deployment_target_configuration_id (required)
     * @return DeploymentTarget
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getDeployment(string $project_id, string $deployment_target_configuration_id): DeploymentTarget
    {
        $this->refreshToken();
        return $this->deploymentTargetApi->getProjectsDeployments($project_id, $deployment_target_configuration_id);
    }

    /**
     * Operation listProjectsDeployments
     *
     * Get project deployment target info
     *
     * @param string $project_id project_id (required)
     * @return DeploymentTarget[]
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listDeployments(string $project_id): array
    {
        $this->refreshToken();
        return $this->deploymentTargetApi->listProjectsDeployments($project_id);
    }

    /**
     * Operation updateDeployment
     *
     * Update a project deployment
     *
     * @param string $project_id project_id (required)
     * @param string $deployment_target_configuration_id deployment_target_configuration_id (required)
     * @param array $deployment_target_patch (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function updateDeployment(
        string $project_id,
        string $deployment_target_configuration_id,
        array $deployment_target_patch
    ): AcceptedResponse {
        $this->refreshToken();
        $deployment_target_patch = new DeploymentTargetPatch($deployment_target_patch);
        return $this->deploymentTargetApi->updateProjectsDeployments(
            $project_id,
            $deployment_target_configuration_id,
            $deployment_target_patch
        );
    }

    /************** **************************/
    /********* RepositoryApi  ****************/
    /************** **************************/

    /**
     * Operation getGitBlob
     *
     * Get a blob object
     *
     * @param string $project_id project_id (required)
     * @param string $repository_blob_id repository_blob_id (required)
     * @return Blob
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getGitBlob(string $project_id, string $repository_blob_id): Blob
    {
        $this->refreshToken();
        return $this->repositoryApi->getProjectsGitBlobs($project_id, $repository_blob_id);
    }

    /**
     * Operation getGitCommit
     *
     * Get a commit object
     *
     * @param string $project_id project_id (required)
     * @param string $repository_commit_id repository_commit_id (required)
     * @return Commit
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getGitCommit(string $project_id, string $repository_commit_id): Commit
    {
        $this->refreshToken();
        return $this->repositoryApi->getProjectsGitCommits($project_id, $repository_commit_id);
    }

    /**
     * Operation getGitRef
     *
     * Get a ref object
     *
     * @param string $project_id project_id (required)
     * @param string $repository_ref_id repository_ref_id (required)
     * @return Ref
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getGitRef(string $project_id, string $repository_ref_id): Ref
    {
        $this->refreshToken();
        return $this->repositoryApi->getProjectsGitRefs($project_id, $repository_ref_id);
    }

    /**
     * Operation getGitTree
     *
     * Get a tree object
     *
     * @param string $project_id project_id (required)
     * @param string $repository_tree_id repository_tree_id (required)
     * @return Tree
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getGitTree(string $project_id, string $repository_tree_id): Tree
    {
        $this->refreshToken();
        return $this->repositoryApi->getProjectsGitTrees($project_id, $repository_tree_id);
    }


    /**
     * Operation listGitRefs
     *
     * Get list of repository refs
     *
     * @param string $project_id project_id (required)
     * @return Ref[]
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listGitRefs(string $project_id): array
    {
        $this->refreshToken();
        return $this->repositoryApi->listProjectsGitRefs($project_id);
    }

    /************** *********************************/
    /********* SystemInformationApi  ****************/
    /************** *********************************/

    /**
     * Operation restartGitServer
     *
     * Restart the Git server
     *
     * @param string $project_id project_id (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function restartGitServer(string $project_id): AcceptedResponse
    {
        $this->refreshToken();
        return $this->systemInfoApi->actionProjectsSystemRestart($project_id);
    }

    /**
     * Operation getGitInfo
     *
     * Get information about the Git server.
     *
     * @param string $project_id project_id (required)
     * @return SystemInformation
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getGitInfo(string $project_id): SystemInformation
    {
        $this->refreshToken();
        return $this->systemInfoApi->getProjectsSystem($project_id);
    }

    /************** **************************************/
    /********* ThirdPartyIntegrationsApi  ****************/
    /************** **************************************/

    /**
     * Operation createIntegration
     *
     * Integrate project with a third-party service
     *
     * @param string $project_id project_id (required)
     * @param array $integration_create_input (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function createIntegration(string $project_id, array $integration_create_input): AcceptedResponse
    {
        $this->refreshToken();
        $integration_create_input = new IntegrationCreateInput($integration_create_input);
        return $this->thirdPartyIntegrationsApi->createProjectsIntegrations($project_id, $integration_create_input);
    }

    /**
     * Operation deleteIntegration
     *
     * Delete an existing third-party integration
     *
     * @param string $project_id project_id (required)
     * @param string $integration_id integration_id (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function deleteIntegration(string $project_id, string $integration_id): AcceptedResponse
    {
        $this->refreshToken();
        return $this->thirdPartyIntegrationsApi->deleteProjectsIntegrations($project_id, $integration_id);
    }

    /**
     * Operation getIntegration
     *
     * Get information about an existing third-party integration
     *
     * @param string $project_id project_id (required)
     * @param string $integration_id integration_id (required)
     * @return Integration
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getIntegration(string $project_id, string $integration_id): Integration
    {
        $this->refreshToken();
        return $this->thirdPartyIntegrationsApi->getProjectsIntegrations($project_id, $integration_id);
    }

    /**
     * Operation listIntegrations
     *
     * Get list of existing integrations for a project
     *
     * @param string $project_id project_id (required)
     * @return Integration[]
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listIntegrations(string $project_id): array
    {
        $this->refreshToken();
        return $this->thirdPartyIntegrationsApi->listProjectsIntegrations($project_id);
    }

    /**
     * Operation updateIntegration
     *
     * Update an existing third-party integration
     *
     * @param string $project_id project_id (required)
     * @param string $integration_id integration_id (required)
     * @param array $integration_patch (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function updateIntegration(
        string $project_id,
        string $integration_id,
        array $integration_patch
    ): AcceptedResponse {
        $this->refreshToken();
        $integration_patch = new IntegrationPatch($integration_patch);
        return $this->thirdPartyIntegrationsApi->updateProjectsIntegrations(
            $project_id,
            $integration_id,
            $integration_patch
        );
    }

    /************** ********************************/
    /********* DomainTask shortcuts ****************/
    /************** ********************************/

    /**
     * Operation createDomain
     *
     * Add a project domain
     *
     * @param string $project_id project_id (required)
     * @param array $domain_create_input (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function createDomain(string $project_id, array $domain_create_input): AcceptedResponse
    {
        return $this->client->domain->createProjectsDomains($project_id, $domain_create_input);
    }

    /**
     * Operation deleteDomain
     *
     * Delete a project domain
     *
     * @param string $project_id project_id (required)
     * @param string $domain_id domain_id (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function deleteDomain(string $project_id, string $domain_id): AcceptedResponse
    {
        return $this->client->domain->deleteProjectsDomains($project_id, $domain_id);
    }

    /**
     * Operation getDomain
     *
     * Get a project domain
     *
     * @param string $project_id project_id (required)
     * @param string $domain_id domain_id (required)
     * @return Domain
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getDomain(string $project_id, string $domain_id): Domain
    {
        return $this->client->domain->getProjectsDomains($project_id, $domain_id);
    }

    /**
     * Operation listDomains
     *
     * Get list of project domains
     *
     * @param string $project_id project_id (required)
     * @return Domain[]
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listDomains(string $project_id): array
    {
        $this->refreshToken();
        return $this->client->domain->listProjectsDomains($project_id);
    }

    /**
     * Operation updateDomain
     *
     * Update a project domain
     *
     * @param string $project_id project_id (required)
     * @param string $domain_id domain_id (required)
     * @param array $domain_patch (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function updateDomain(string $project_id, string $domain_id, array $domain_patch): AcceptedResponse
    {
        return $this->client->domain->updateProjectsDomains($project_id, $domain_id, $domain_patch);
    }

    /************** *************************************/
    /********* CertificateTask shortcuts ****************/
    /************** *************************************/

    /**
     * Operation createCertificate
     *
     * Add an SSL certificate
     *
     * @param string $project_id project_id (required)
     * @param array $certificate_create_input (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function createCertificate(string $project_id, array $certificate_create_input): AcceptedResponse
    {
        return $this->client->certificate->create($project_id, $certificate_create_input);
    }


    /**
     * Operation deleteCertificate
     *
     * Delete an SSL certificate
     *
     * @param string $project_id project_id (required)
     * @param string $certificate_id certificate_id (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function deleteCertificate(string $project_id, string $certificate_id): AcceptedResponse
    {
        return $this->client->certificate->delete($project_id, $certificate_id);
    }

    /**
     * Operation getCertificate
     *
     * Get an SSL certificate
     *
     * @param string $project_id project_id (required)
     * @param string $certificate_id certificate_id (required)
     * @return Certificate
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getCertificate(string $project_id, string $certificate_id): Certificate
    {
        return $this->client->certificate->get($project_id, $certificate_id);
    }

    /**
     * Operation listCertificates
     *
     * Get list of SSL certificates
     *
     * @param string $project_id project_id (required)
     * @return Certificate[]
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listCertificates(string $project_id): array
    {
        return $this->client->certificate->list($project_id);
    }

    /**
     * Operation updateCertificate
     *
     * Update an SSL certificate
     *
     * @param string $project_id project_id (required)
     * @param string $certificate_id certificate_id (required)
     * @param array $certificate_patch (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function updateCertificate(
        string $project_id,
        string $certificate_id,
        array $certificate_patch
    ): AcceptedResponse {
        return $this->client->certificate->update($project_id, $certificate_id, $certificate_patch);
    }

    /************** ***********************************/
    /********* OperationTask shortcuts ****************/
    /************** ***********************************/

    /**
     * Operation runOperation
     *
     * Execute a runtime operation
     *
     * @param string $project_id project_id (required)
     * @param string $environment_id environment_id (required)
     * @param string $deployment_id deployment_id (required)
     * @param array $environment_operation_input (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function runOperation(
        string $project_id,
        string $environment_id,
        string $deployment_id,
        array $environment_operation_input
    ): AcceptedResponse {
        return $this->client->operation->run(
            $project_id,
            $environment_id,
            $deployment_id,
            $environment_operation_input
        );
    }

    /************** ******************************/
    /********* TeamTask shortcuts ****************/
    /************** ******************************/


    /**
     * Operation getProjectTeamAccess
     *
     * Get team access for a project
     *
     * @param string $project_id The ID of the project. (required)
     * @param string $team_id The ID of the team. (required)
     * @return TeamProjectAccess|Error
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getProjectTeamAccess(string $project_id, string $team_id): Error|TeamProjectAccess
    {
        return $this->client->team->getProjectTeamAccess($project_id, $team_id);
    }


    /**
     * Operation getTeamProjectAccess
     *
     * Get project access for a team
     *
     * @param string $team_id The ID of the team. (required)
     * @param string $project_id The ID of the project. (required)
     * @return TeamProjectAccess|Error
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getTeamProjectAccess(string $team_id, string $project_id): Error|TeamProjectAccess
    {
        return $this->client->team->getTeamProjectAccess($team_id, $project_id);
    }

    /**
     * Operation grantProjectTeamAccess
     *
     * Grant team access to a project
     *
     * @param string $project_id The ID of the project. (required)
     * @param GrantProjectTeamAccessRequestInner[] $grant_project_team_access_request_inner
     *        grant_project_team_access_request_inner (required)
     * @return void
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function grantProjectTeamAccess(string $project_id, array $grant_project_team_access_request_inner): void
    {
        $this->client->team->grantProjectTeamAccess($project_id, $grant_project_team_access_request_inner);
    }

    /**
     * Operation grantTeamProjectAccess
     *
     * Grant project access to a team
     *
     * @param string $team_id The ID of the team. (required)
     * @param GrantTeamProjectAccessRequestInner[] $grant_team_project_access_request_inner
     *        grant_team_project_access_request_inner (required)
     * @return void
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function grantTeamProjectAccess(string $team_id, array $grant_team_project_access_request_inner): void
    {
        $this->client->team->grantTeamProjectAccess($team_id, $grant_team_project_access_request_inner);
    }

    /**
     * Operation listProjectTeamAccess
     *
     * List team access for a project
     *
     * @param string $project_id The ID of the project. (required)
     * @param int|null $page_size Determines the number of items to show. (optional)
     * @param string|null $page_before Pagination cursor. This is automatically generated as necessary
     *        and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param string|null $page_after Pagination cursor. This is automatically generated as necessary
     *        and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param string|null $sort Allows sorting by a single field. Use a dash ('-') to sort descending.
     *        Supported fields: `granted_at`, `updated_at`. (optional)
     * @return ListTeamProjectAccess200Response|Error
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listProjectTeamAccess(
        string $project_id,
        int $page_size = null,
        string $page_before = null,
        string $page_after = null,
        string $sort = null
    ): Error|ListTeamProjectAccess200Response {
        return $this->client->team->listProjectTeamAccess($project_id, $page_size, $page_before, $page_after, $sort);
    }

    /**
     * Operation listTeamProjectAccess
     *
     * List project access for a team
     *
     * @param string $team_id The ID of the team. (required)
     * @param int|null $page_size Determines the number of items to show. (optional)
     * @param string|null $page_before Pagination cursor. This is automatically generated as necessary
     *        and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param string|null $page_after Pagination cursor. This is automatically generated as necessary
     *        and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param string|null $sort Allows sorting by a single field. Use a dash ('-') to sort descending.
     *        Supported fields: `project_title`, `granted_at`, `updated_at`. (optional)
     * @return ListTeamProjectAccess200Response|Error
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listTeamProjectAccess(
        string $team_id,
        int $page_size = null,
        string $page_before = null,
        string $page_after = null,
        string $sort = null
    ): Error|ListTeamProjectAccess200Response {
        return $this->client->team->listTeamProjectAccess($team_id, $page_size, $page_before, $page_after, $sort);
    }

    /**
     * Operation removeProjectTeamAccess
     *
     * Remove team access for a project
     *
     * @param string $project_id The ID of the project. (required)
     * @param string $team_id The ID of the team. (required)
     * @return void
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function removeProjectTeamAccess(string $project_id, string $team_id): void
    {
        $this->client->team->removeProjectTeamAccess($project_id, $team_id);
    }

    /**
     * Operation removeTeamProjectAccess
     *
     * Remove project access for a team
     *
     * @param string $team_id The ID of the team. (required)
     * @param string $project_id The ID of the project. (required)
     * @return void
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function removeTeamProjectAccess(string $team_id, string $project_id): void
    {
        $this->client->team->removeTeamProjectAccess($team_id, $project_id);
    }

    /************** ********************************/
    /********* UserTask shortcuts ****************/
    /************** ********************************/

    /**
     * Operation getProjectUserAccess
     *
     * Get user access for a project
     *
     * @param string $project_id The ID of the project. (required)
     * @param string $user_id The ID of the user. (required)
     * @return UserProjectAccess|Error
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getProjectUserAccess(string $project_id, string $user_id): Error|UserProjectAccess
    {
        return $this->client->user->getProjectUserAccess($project_id, $user_id);
    }

    /**
     * Operation grantProjectUserAccess
     *
     * Grant user access to a project
     *
     * @param string $project_id The ID of the project. (required)
     * @param GrantProjectUserAccessRequestInner[] $grant_project_user_access_request_inner
     *        grant_project_user_access_request_inner (required)
     * @return void
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function grantProjectUserAccess(string $project_id, array $grant_project_user_access_request_inner): void
    {
        $this->client->user->grantProjectUserAccess($project_id, $grant_project_user_access_request_inner);
    }

    /**
     * Operation removeProjectUserAccess
     *
     * Remove user access for a project
     *
     * @param string $project_id The ID of the project. (required)
     * @param string $user_id The ID of the user. (required)
     * @return void
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function removeProjectUserAccess(string $project_id, string $user_id): void
    {
        $this->client->user->removeProjectUserAccess($project_id, $user_id);
    }

    /**
     * Operation updateProjectUserAccess
     *
     * Update user access for a project
     *
     * @param string $project_id The ID of the project. (required)
     * @param string $user_id The ID of the user. (required)
     * @param array|null $update_project_user_access_request update_project_user_access_request (optional)
     * @return void
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function updateProjectUserAccess(
        string $project_id,
        string $user_id,
        array $update_project_user_access_request = null
    ): void {
        $this->client->user->updateProjectUserAccess($project_id, $user_id, $update_project_user_access_request);
    }

    /**
     * Operation listProjectUserAccess
     *
     * List user access for a project
     *
     * @param string $project_id The ID of the project. (required)
     * @param int|null $page_size Determines the number of items to show. (optional)
     * @param string|null $page_before Pagination cursor. This is automatically generated as necessary
     *        and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param string|null $page_after Pagination cursor. This is automatically generated as necessary
     *        and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param string|null $sort Allows sorting by a single field. Use a dash ('-') to sort descending.
     *        Supported fields: `granted_at`, `updated_at`. (optional)
     * @return ListProjectUserAccess200Response|Error
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listProjectUserAccess(
        string $project_id,
        int $page_size = null,
        string $page_before = null,
        string $page_after = null,
        string $sort = null
    ): ListProjectUserAccess200Response|Error {
        return $this->client->user->listProjectUserAccess($project_id, $page_size, $page_before, $page_after, $sort);
    }

    /************** ***************************/
    /********* Custom function ****************/
    /************** ***************************/

    /**
     * Operation createProject
     *
     * create a project
     *
     * @param string $organization_id
     * @param array $project_data
     *
     * @return Subscription|Error
     * @throws ApiException
     */
    public function create(string $organization_id, array $project_data): Error|Subscription
    {
        $this->refreshToken();
        return $this->client->organization->createProject($organization_id, $project_data);
    }

    /**
     * Operation listEnvironment
     *
     * (shortcut to EnvironmentTask.listProjectsEnvironments)
     *
     * @param string $project_id
     * @return Environment[]
     * @throws ApiException
     */
    public function listEnvironments(string $project_id): array
    {
        $this->refreshToken();
        return $this->client->environment->list($project_id);
    }
}
