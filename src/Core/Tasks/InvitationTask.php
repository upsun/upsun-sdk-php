<?php

namespace Upsun\Core\Tasks;

use InvalidArgumentException;
use OpenAPI\Client\ApiException;
use OpenAPI\Client\apisgen\InvitationsApi;
use OpenAPI\Client\Configuration;
use OpenAPI\Client\Model\CreateOrgInviteRequest;
use OpenAPI\Client\Model\CreateProjectInviteRequest;
use OpenAPI\Client\Model\Error;
use OpenAPI\Client\Model\OrganizationInvitation;
use OpenAPI\Client\Model\StringFilter;
use Platformsh\Client\Model\Invitation\ProjectInvitation;
use Upsun\UpsunClient;

class InvitationTask extends TaskBase
{
    public readonly InvitationsApi $api;

    public function __construct(
        public readonly UpsunClient $client,
    )
    {
        $this->api = new InvitationsApi($this->client->apiClient, $this->client->apiConfig);
    }

    public function setHostIndex($hostIndex): void
    {
        $this->refreshToken();
        $this->api->setHostIndex($hostIndex);
    }

    /**
     * Get the host index
     *
     * @return int Host index
     */
    public function getHostIndex()
    {
        $this->refreshToken();
        return $this->api->getHostIndex();
    }

    /**
     * @return Configuration
     */
    public function getConfig()
    {
        $this->refreshToken();
        return $this->api->getConfig();
    }

    /**
     * Operation cancelOrgInvite
     *
     * Cancel a pending invitation to an organization
     *
     * @param string $organization_id The ID of the organization. (required)
     * @param string $invitation_id The ID of the invitation. (required)
     * @param string $contentType The value for the Content-Type header. Check self::contentTypes['cancelOrgInvite'] to see the possible values for this operation
     *
     * @return void
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function cancelOrgInvite(string $organization_id, string $invitation_id, string $contentType = ''): void
    {
        $this->refreshToken();
        $this->api->cancelOrgInvite($organization_id, $invitation_id, $contentType);
    }


    /**
     * Operation cancelProjectInvite
     *
     * Cancel a pending invitation to a project
     *
     * @param string $project_id The ID of the project. (required)
     * @param string $invitation_id The ID of the invitation. (required)
     * @param string $contentType The value for the Content-Type header. Check self::contentTypes['cancelProjectInvite'] to see the possible values for this operation
     *
     * @return void
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function cancelProjectInvite(string $project_id, string $invitation_id, string $contentType = ''): void
    {
        $this->refreshToken();
        $this->api->cancelProjectInvite($project_id, $invitation_id, $contentType);
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
    public function createOrgInvite(string $organization_id, string $email, array $permissions, bool $force = true): Error|OrganizationInvitation
    {
        $this->refreshToken();

        $inviteRequest = new CreateOrgInviteRequest([
            'email' => $email,
            'permissions' => $permissions,
            'force' => $force
        ]);
        return $this->api->createOrgInvite($organization_id, $inviteRequest);
    }

    /**
     * Operation createProjectInvite
     *
     * Invite user to a project by email
     *
     * @param string $project_id The ID of the project. (required)
     * @param CreateProjectInviteRequest|null $create_project_invite_request create_project_invite_request (optional)
     * @param string $contentType The value for the Content-Type header. Check self::contentTypes['createProjectInvite'] to see the possible values for this operation
     *
     * @return \OpenAPI\Client\Model\ProjectInvitation|Error|Error|Error|Error|Error
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function createProjectInvite(string $project_id, CreateProjectInviteRequest $create_project_invite_request = null, string $contentType = ''): ProjectInvitation|Error
    {
        $this->refreshToken();
        return $this->api->createProjectInvite($project_id, $create_project_invite_request, $contentType);
    }

    /**
     * Operation listOrgInvites
     *
     * List invitations to an organization
     *
     * @param string $organization_id The ID of the organization. (required)
     * @param StringFilter|null $filter_state Allows filtering by &#x60;state&#x60; of the invtations: \&quot;pending\&quot; (default), \&quot;error\&quot;. (optional)
     * @param int|null $page_size Determines the number of items to show. (optional)
     * @param string|null $page_before Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param string|null $page_after Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param string|null $sort Allows sorting by a single field.&lt;br&gt; Use a dash (\&quot;-\&quot;) to sort descending. (optional)
     * @param string $contentType The value for the Content-Type header. Check self::contentTypes['listOrgInvites'] to see the possible values for this operation
     *
     * @return OrganizationInvitation[]|Error
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     */
    public function listOrgInvites(string $organization_id, $filter_state = null, $page_size = null, $page_before = null, $page_after = null, $sort = null, string $contentType = '')
    {
        $this->refreshToken();
        return $this->api->listOrgInvites($organization_id, $filter_state, $page_size, $page_before, $page_after, $sort, $contentType);
    }
    
    /**
     * Operation listProjectInvites
     *
     * List invitations to a project
     *
     * @param string $project_id The ID of the project. (required)
     * @param StringFilter|null $filter_state Allows filtering by &#x60;state&#x60; of the invtations: \&quot;pending\&quot; (default), \&quot;error\&quot;. (optional)
     * @param int|null $page_size Determines the number of items to show. (optional)
     * @param string|null $page_before Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param string|null $page_after Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param string|null $sort Allows sorting by a single field.&lt;br&gt; Use a dash (\&quot;-\&quot;) to sort descending. (optional)
     * @param string $contentType The value for the Content-Type header. Check self::contentTypes['listProjectInvites'] to see the possible values for this operation
     *
     * @return \OpenAPI\Client\Model\ProjectInvitation[]|Error|Error
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     */
    public function listProjectInvites(string $project_id, StringFilter $filter_state = null, int $page_size = null, string $page_before = null, string $page_after = null, string $sort = null, string $contentType = '')
    {
        $this->refreshToken();
        return $this->api->listProjectInvites($project_id, $filter_state, $page_size, $page_before, $page_after, $sort, $contentType);
    }
}