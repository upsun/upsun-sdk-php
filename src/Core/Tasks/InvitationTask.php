<?php

namespace Upsun\Core\Tasks;

use InvalidArgumentException;
use OpenAPI\Client\ApiException;
use OpenAPI\Client\apisgen\OrganizationInvitationsApi;
use OpenAPI\Client\apisgen\ProjectInvitationsApi;
use OpenAPI\Client\Model\CreateOrgInviteRequest;
use OpenAPI\Client\Model\CreateProjectInviteRequest;
use OpenAPI\Client\Model\Error;
use OpenAPI\Client\Model\OrganizationInvitation;
use OpenAPI\Client\Model\ProjectInvitation;
use Upsun\UpsunClient;

class InvitationTask extends TaskBase
{
    private OrganizationInvitationsApi $organizationInvitationsApi;

    private ProjectInvitationsApi $projectInvitationsApi;

    public function __construct(
        public readonly UpsunClient $client,
    ) {
        $this->organizationInvitationsApi = new OrganizationInvitationsApi(
            $this->client->apiClient,
            $this->client->apiConfig
        );
        $this->projectInvitationsApi = new ProjectInvitationsApi($this->client->apiClient, $this->client->apiConfig);
    }

    /************** **************************/
    /********* Getter ************************/
    /************** **************************/
    
    public function getOrganizationInvitationsApi(): OrganizationInvitationsApi
    {
        return $this->organizationInvitationsApi;
    }
    
    public function getProjectInvitationsApi(): ProjectInvitationsApi
    {
        return $this->projectInvitationsApi;
    }
    
    /************** **************************************/
    /********* OrganizationInvitationsApi ****************/
    /************** **************************************/

    /**
     * Operation cancelOrgInvite
     *
     * Cancel a pending invitation to an organization
     *
     * @param string $organization_id The ID of the organization. (required)
     * @param string $invitation_id The ID of the invitation. (required)
     *
     * @return void
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function cancelOrgInvite(string $organization_id, string $invitation_id): void
    {
        $this->refreshToken();
        $this->getOrganizationInvitationsApi()->cancelOrgInvite($organization_id, $invitation_id);
    }

    /**
     * Operation createOrgInvite
     *
     * Invite user to an organization by email
     *
     * @param string $organization_id
     * @param string $email
     * @param array $permissions
     * @param bool $force
     * @return Error|OrganizationInvitation
     * @throws ApiException
     */
    public function createOrgInvite(
        string $organization_id,
        string $email,
        array $permissions,
        ?bool $force = true
    ): Error|OrganizationInvitation {
        $this->refreshToken();

        $inviteRequest = new CreateOrgInviteRequest([
            'email' => $email,
            'permissions' => $permissions,
            'force' => $force
        ]);
        return $this->getOrganizationInvitationsApi()->createOrgInvite($organization_id, $inviteRequest);
    }

    /**
     * Operation listOrgInvites
     *
     * List invitations to an organization
     *
     * @param string $organization_id The ID of the organization. (required)
     * @param array|null $filter_state Allows filtering by `state` of the invitations:
     *        'pending' (default), 'error'. (optional)
     * @param int|null $page_size Determines the number of items to show. (optional)
     * @param string|null $page_before Pagination cursor. This is automatically generated as necessary
     *        and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param string|null $page_after Pagination cursor. This is automatically generated as necessary
     *        and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param string|null $sort Allows sorting by a single field. Use a dash ('-') to sort descending. (optional)
     *
     * @return OrganizationInvitation[]|Error
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listOrgInvites(
        string $organization_id,
        ?array $filter_state = null,
        ?int $page_size = null,
        ?string $page_before = null,
        ?string $page_after = null,
        ?string $sort = null
    ): Error|array {
        $this->refreshToken();
        return $this->getOrganizationInvitationsApi()->listOrgInvites(
            $organization_id,
            $filter_state,
            $page_size,
            $page_before,
            $page_after,
            $sort
        );
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
        $this->getProjectInvitationsApi()->cancelProjectInvite($project_id, $invitation_id);
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
    public function createProjectInvite(
        string $project_id,
        ?CreateProjectInviteRequest $create_project_invite_request = null
    ): ProjectInvitation|Error {
        $this->refreshToken();
        return $this->getProjectInvitationsApi()->createProjectInvite($project_id, $create_project_invite_request);
    }

    /**
     * Operation listProjectInvites
     *
     * List invitations to a project
     *
     * @param string $project_id The ID of the project. (required)
     * @param array|null $filter_state Allows filtering by `state` of the invtations:
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
    public function listProjectInvites(
        string $project_id,
        ?array $filter_state = null,
        ?int $page_size = null,
        ?string $page_before = null,
        ?string $page_after = null,
        ?string $sort = null
    ): Error|array {
        $this->refreshToken();
        return $this->getProjectInvitationsApi()->listProjectInvites(
            $project_id,
            $filter_state,
            $page_size,
            $page_before,
            $page_after,
            $sort
        );
    }
}
