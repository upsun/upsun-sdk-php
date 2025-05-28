<?php

namespace Upsun\Core\Tasks;

use InvalidArgumentException;
use OpenAPI\Client\ApiException;
use OpenAPI\Client\apisgen\DeploymentTargetApi;
use OpenAPI\Client\apisgen\ProjectActivityApi;
use OpenAPI\Client\apisgen\ProjectApi;
use OpenAPI\Client\apisgen\ProjectInvitationsApi;
use OpenAPI\Client\apisgen\ProjectSettingsApi;
use OpenAPI\Client\apisgen\ProjectVariablesApi;
use OpenAPI\Client\HeaderSelector;
use OpenAPI\Client\Model\AcceptedResponse;
use OpenAPI\Client\Model\Activity;
use OpenAPI\Client\Model\CreateProjectInviteRequest;
use OpenAPI\Client\Model\DeploymentTarget;
use OpenAPI\Client\Model\DeploymentTargetCreateInput;
use OpenAPI\Client\Model\DeploymentTargetPatch;
use OpenAPI\Client\Model\Domain;
use OpenAPI\Client\Model\DomainPatch;
use OpenAPI\Client\Model\Environment;
use OpenAPI\Client\Model\Error;
use OpenAPI\Client\Model\Project;
use OpenAPI\Client\Model\ProjectCapabilities;
use OpenAPI\Client\Model\ProjectInvitation;
use OpenAPI\Client\Model\ProjectPatch;
use OpenAPI\Client\Model\ProjectSettings;
use OpenAPI\Client\Model\ProjectSettingsPatch;
use OpenAPI\Client\Model\ProjectVariable;
use OpenAPI\Client\Model\ProjectVariableCreateInput;
use OpenAPI\Client\Model\ProjectVariablePatch;
use OpenAPI\Client\Model\Subscription;
use Upsun\UpsunClient;

class ProjectTask extends TaskBase
{
    protected HeaderSelector $headerSelector;

    public readonly ProjectApi $api;
    public readonly ProjectInvitationsApi $invitationsApi;
    public readonly ProjectSettingsApi $settingsApi;
    public readonly ProjectVariablesApi $variablesApi;
    public readonly ProjectActivityApi $activityApi;
    public readonly DeploymentTargetApi $deploymentTargetApi;

    public function __construct(
        public readonly UpsunClient $client,
        public readonly DomainTask $domainTask
    )
    {
        $this->headerSelector = new HeaderSelector();
        $this->api = new ProjectApi($this->client->apiClient, $this->client->apiConfig);
        $this->invitationsApi = new ProjectInvitationsApi($this->client->apiClient, $this->client->apiConfig);
        $this->settingsApi = new ProjectSettingsApi($this->client->apiClient, $this->client->apiConfig);
        $this->variablesApi = new ProjectVariablesApi($this->client->apiClient, $this->client->apiConfig);
        $this->activityApi = new ProjectActivityApi($this->client->apiClient, $this->client->apiConfig);
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
    public function deleteProjects(string $project_id): AcceptedResponse
    {
        $this->refreshToken();
        return $this->api->deleteProjects($project_id);
    }

    /**
     * Operation getProjects
     *
     * Get a project
     *
     * @param string $project_id project_id (required)
     *
     * @return Project
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getProjects(string $project_id): Project
    {
        $this->refreshToken();
        return $this->api->getProjects($project_id);
    }

    /**
     * Operation getProjectsCapabilities
     *
     * Get a project&#39;s capabilities
     *
     * @param string $project_id project_id (required)
     *
     * @return ProjectCapabilities
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getProjectsCapabilities(string $project_id): ProjectCapabilities
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
    public function updateProjects(string $project_id, array $project_data): AcceptedResponse
    {
        $this->refreshToken();
        $project_patch = new ProjectPatch($project_data);
        return $this->api->updateProjects($project_id, $project_patch);
    }

    /************** *********************************/
    /********* ProjectInvitationsApi ****************/
    /************** *********************************/

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
    public function cancelProjectInvite(string $project_id, string $invitation_id): void
    {
        $this->refreshToken();
        $this->invitationsApi->cancelProjectInvite($project_id, $invitation_id);
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
    public function createProjectInvite(string $project_id, CreateProjectInviteRequest $create_project_invite_request = null): ProjectInvitation|Error
    {
        $this->refreshToken();
        return $this->invitationsApi->createProjectInvite($project_id, $create_project_invite_request);
    }

    /**
     * Operation listProjectInvites
     *
     * List invitations to a project
     *
     * @param string $project_id The ID of the project. (required)
     * @param array|null $filter_state Allows filtering by &#x60;state&#x60; of the invtations: \&quot;pending\&quot; (default), \&quot;error\&quot;. (optional)
     * @param int|null $page_size Determines the number of items to show. (optional)
     * @param string|null $page_before Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param string|null $page_after Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param string|null $sort Allows sorting by a single field.&lt;br&gt; Use a dash (\&quot;-\&quot;) to sort descending. (optional)
     *
     * @return ProjectInvitation[]|Error
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listProjectInvites(string $project_id, array $filter_state = null, int $page_size = null, string $page_before = null, string $page_after = null, string $sort = null): Error|array
    {
        $this->refreshToken();
        return $this->invitationsApi->listProjectInvites($project_id, $filter_state, $page_size, $page_before, $page_after, $sort);
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
    public function getProjectsSettings(string $project_id): ProjectSettings
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
    public function updateProjectsSettings(string $project_id, array $project_settings_patch): AcceptedResponse
    {
        $this->refreshToken();
        $project_settings_patch = new ProjectSettingsPatch($project_settings_patch);
        return $this->settingsApi->updateProjectsSettings($project_id, $project_settings_patch);
    }
    
    /************** ******************************/
    /********* ProjectVariablesApi ****************/
    /************** ******************************/

    /**
     * Operation createProjectsVariables
     *
     * Add a project variable
     *
     * @param string $project_id project_id (required)
     * @param array $project_variable_create_input (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function createProjectsVariables(string $project_id, array $project_variable_create_input): AcceptedResponse
    {
        $this->refreshToken();
        $project_variable_create_input = new ProjectVariableCreateInput($project_variable_create_input);
        return $this->variablesApi->createProjectsVariables($project_id, $project_variable_create_input);
    }

    /**
     * Operation deleteProjectsVariables
     *
     * Delete a project variable
     *
     * @param string $project_id project_id (required)
     * @param string $project_variable_id project_variable_id (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function deleteProjectsVariables(string $project_id, string $project_variable_id): AcceptedResponse
    {
        $this->refreshToken();
        return $this->variablesApi->deleteProjectsVariables($project_id, $project_variable_id);
    }

    /**
     * Operation listProjectsVariables
     *
     * Get list of project variables
     *
     * @param string $project_id project_id (required)
     * @return ProjectVariable[]
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listProjectsVariables(string $project_id): array
    {
        $this->refreshToken();
        return $this->variablesApi->listProjectsVariables($project_id);
    }

    /**
     * Operation updateProjectsVariables
     *
     * Update a project variable
     *
     * @param string $project_id project_id (required)
     * @param string $project_variable_id project_variable_id (required)
     * @param array $project_variable_patch (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function updateProjectsVariables(string $project_id, string $project_variable_id, array $project_variable_patch): AcceptedResponse
    {
        $this->refreshToken();
        $project_variable_patch = new ProjectVariablePatch($project_variable_patch);
        return $this->variablesApi->updateProjectsVariables($project_id, $project_variable_id, $project_variable_patch);
    }

    /************** ******************************/
    /********* ProjectActivityApi ****************/
    /************** ******************************/

    /**
     * Operation actionProjectsActivitiesCancel
     *
     * Cancel a project activity
     *
     * @param string $project_id project_id (required)
     * @param string $activity_id activity_id (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function actionProjectsActivitiesCancel(string $project_id, string $activity_id): AcceptedResponse
    {
        $this->refreshToken();
        return $this->activityApi->actionProjectsActivitiesCancel($project_id, $activity_id);
    }

    /**
     * Operation getProjectsActivities
     *
     * Get a project activity log entry
     *
     * @param string $project_id project_id (required)
     * @param string $activity_id activity_id (required)
     * @return Activity
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getProjectsActivities(string $project_id, string $activity_id): Activity
    {
        $this->refreshToken();
        return $this->activityApi->getProjectsActivities($project_id, $activity_id);
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
    public function listProjectsActivities(string $project_id): array
    {
        $this->refreshToken();
        return $this->activityApi->listProjectsActivities($project_id);
    }

    /************** ********************************/
    /********* DeploymentTargetApi  ****************/
    /************** ********************************/

    /**
     * Operation createProjectsDeployments
     *
     * Create a project deployment target
     *
     * @param string $project_id project_id (required)
     * @param array $deployment_target_create_input (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function createProjectsDeployments(string $project_id, array $deployment_target_create_input): AcceptedResponse
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
    public function deleteProjectsDeployments(string $project_id, string $deployment_target_configuration_id): AcceptedResponse
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
    public function getProjectsDeployments(string $project_id, string $deployment_target_configuration_id): DeploymentTarget
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
    public function listProjectsDeployments(string $project_id): array
    {
        $this->refreshToken();
        return $this->deploymentTargetApi->listProjectsDeployments($project_id);
    }

    /**
     * Operation updateProjectsDeployments
     *
     * Update a project deployment
     *
     * @param string $project_id project_id (required)
     * @param string $deployment_target_configuration_id deployment_target_configuration_id (required)
     * @param array $deployment_target_patch (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function updateProjectsDeployments(string $project_id, string $deployment_target_configuration_id, array $deployment_target_patch): AcceptedResponse
    {
        $this->refreshToken();
        $deployment_target_patch = new DeploymentTargetPatch($deployment_target_patch);
        return $this->deploymentTargetApi->updateProjectsDeployments($project_id, $deployment_target_configuration_id, $deployment_target_patch);
    }

    /************** ********************************/
    /********* DomainTask shortcuts ****************/
    /************** ********************************/


    /**
     * Operation createProjectsDomains
     *
     * Add a project domain
     *
     * @param string $project_id project_id (required)
     * @param array $domain_create_input (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function createProjectsDomains(string $project_id, array $domain_create_input): AcceptedResponse
    {
        return $this->domainTask->createProjectsDomains($project_id, $domain_create_input);
    }

    /**
     * Operation deleteProjectsDomains
     *
     * Delete a project domain
     *
     * @param string $project_id project_id (required)
     * @param string $domain_id domain_id (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function deleteProjectsDomains(string $project_id, string $domain_id): AcceptedResponse
    {
        return $this->domainTask->deleteProjectsDomains($project_id, $domain_id);
    }

    /**
     * Operation getProjectsDomains
     *
     * Get a project domain
     *
     * @param string $project_id project_id (required)
     * @param string $domain_id domain_id (required)
     * @return Domain
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getProjectsDomains(string $project_id, string $domain_id): Domain
    {
        return $this->domainTask->getProjectsDomains($project_id, $domain_id);
    }

    /**
     * Operation listProjectsDomains
     *
     * Get list of project domains
     *
     * @param string $project_id project_id (required)
     * @return Domain[]
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listProjectsDomains(string $project_id): array
    {
        $this->refreshToken();
        return $this->domainTask->listProjectsDomains($project_id);
    }

    /**
     * Operation updateProjectsDomains
     *
     * Update a project domain
     *
     * @param string $project_id project_id (required)
     * @param string $domain_id domain_id (required)
     * @param array $domain_patch (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function updateProjectsDomains(string $project_id, string $domain_id, array $domain_patch): AcceptedResponse
    {
        return $this->domainTask->updateProjectsDomains($project_id, $domain_id, $domain_patch);
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
    public function createProject(string $organization_id, array $project_data): Error|Subscription
    {
        $this->refreshToken();
        return $this->client->organization->createOrgSubscription($organization_id, $project_data);
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
        return $this->client->environment->listProjectsEnvironments($project_id);
    }
    
    
}