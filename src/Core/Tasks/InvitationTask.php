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

    public function __construct(
        public readonly UpsunClient                 $client,
        private readonly OrganizationInvitationsApi $orgInvApi,
        private readonly ProjectInvitationsApi      $prjInvApi,
    )
    {
    }

    /**
     * Cancels a pending invitation to an organization
     *
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function cancelOrgInvite(string $organizationId, string $invitationId): void
    {
        $this->refreshToken();
        $this->orgInvApi->cancelOrgInvite($organizationId, $invitationId);
    }

    /**
     * Invites user to an organization by email
     *
     * @throws ApiException
     */
    public function createOrgInvite(
        string $organizationId,
        string $email,
        array  $permissions,
        ?bool  $force = true
    ): Error|OrganizationInvitation
    {
        $this->refreshToken();

        $inviteRequest = new CreateOrgInviteRequest([
            'email' => $email,
            'permissions' => $permissions,
            'force' => $force
        ]);
        return $this->orgInvApi->createOrgInvite($organizationId, $inviteRequest);
    }

    /**
     * Lists invitations to an organization
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listOrgInvites(
        string  $organizationId,
        ?array  $filterState = null,
        ?int    $pageSize = null,
        ?string $pageBefore = null,
        ?string $pageAfter = null,
        ?string $sort = null
    ): Error|array
    {
        $this->refreshToken();
        return $this->orgInvApi->listOrgInvites(
            $organizationId,
            $filterState,
            $pageSize,
            $pageBefore,
            $pageAfter,
            $sort
        );
    }

    /**
     * Cancels a pending invitation to a project
     *
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function cancelProjectInvite(string $projectId, string $invitationId): void
    {
        $this->refreshToken();
        $this->prjInvApi->cancelProjectInvite($projectId, $invitationId);
    }

    /**
     * Invites user to a project by email
     *
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function createProjectInvite(
        string                      $projectId,
        ?CreateProjectInviteRequest $createProjectInviteRequest = null
    ): ProjectInvitation|Error
    {
        $this->refreshToken();
        return $this->prjInvApi->createProjectInvite($projectId, $createProjectInviteRequest);
    }

    /**
     * Lists invitations to a project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listProjectInvites(
        string  $projectId,
        ?array  $filterState = null,
        ?int    $pageSize = null,
        ?string $pageBefore = null,
        ?string $pageAfter = null,
        ?string $sort = null
    ): Error|array
    {
        $this->refreshToken();
        return $this->prjInvApi->listProjectInvites(
            $projectId,
            $filterState,
            $pageSize,
            $pageBefore,
            $pageAfter,
            $sort
        );
    }
}
