<?php

namespace Upsun\Core\Tasks;

use InvalidArgumentException;
use OpenAPI\Client\ApiException;
use OpenAPI\Client\apisgen\ProjectApi;
use OpenAPI\Client\apisgen\ProjectInvitationsApi;
use OpenAPI\Client\Model\AcceptedResponse;
use OpenAPI\Client\Model\CreateProjectInviteRequest;
use OpenAPI\Client\Model\Error;
use OpenAPI\Client\Model\Project;
use OpenAPI\Client\Model\ProjectCapabilities;
use OpenAPI\Client\Model\ProjectInvitation;
use OpenAPI\Client\Model\ProjectPatch;
use Upsun\UpsunClient;

class ProjectTask extends TaskBase
{
    public readonly ProjectApi $api;
    public readonly ProjectInvitationsApi $invitationsApi;

    public function __construct(
        public readonly UpsunClient $client,
    )
    {
        $this->api = new ProjectApi($this->client->apiClient, $this->client->apiConfig);
        $this->invitationsApi = new ProjectInvitationsApi($this->client->apiClient, $this->client->apiConfig);
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
    
}