<?php

namespace Upsun\Core\Tasks;

use InvalidArgumentException;
use Upsun\ApiException;
use Upsun\Api\OrganizationInvitationsApi;
use Upsun\Api\ProjectInvitationsApi;
use Upsun\Model\CreateOrgInviteRequest;
use Upsun\Model\CreateProjectInviteRequest;
use Upsun\Model\Error;
use Upsun\Model\OrganizationInvitation;
use Upsun\Model\ProjectInvitation;
use Upsun\Model\StringFilter;
use Upsun\UpsunClient;

/**
 * InvitationTask class.
 *
 * @author    Upsun SDK Team
 * @license   Apache-2.0
 * @see       https://docs.upsun.com
 */
class InvitationTask extends TaskBase
{
    public function __construct(
        public UpsunClient $client,
        private readonly OrganizationInvitationsApi $orgInvApi,
        private readonly ProjectInvitationsApi $prjInvApi,
    ) {
        parent::__construct($this->client);
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
        array $permissions,
        ?bool $force = true
    ): Error|OrganizationInvitation {
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
        string $organizationId,
        ?array $filterState = null,
        ?int $pageSize = null,
        ?string $pageBefore = null,
        ?string $pageAfter = null,
        ?string $sort = null
    ): Error|array {
        $this->refreshToken();
        return $this->orgInvApi->listOrgInvites(
            $organizationId,
            new StringFilter($filterState),
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
        string $projectId,
        ?array $createProjectInviteRequest = null
    ): ProjectInvitation|Error {
        $this->refreshToken();
        $createProjectInviteRequest = new CreateProjectInviteRequest($createProjectInviteRequest);
        return $this->prjInvApi->createProjectInvite($projectId, $createProjectInviteRequest);
    }

    /**
     * Lists invitations to a project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listProjectInvites(
        string $projectId,
        ?array $filterState = null,
        ?int $pageSize = null,
        ?string $pageBefore = null,
        ?string $pageAfter = null,
        ?string $sort = null
    ): Error|array {
        $this->refreshToken();
        return $this->prjInvApi->listProjectInvites(
            $projectId,
            new StringFilter($filterState),
            $pageSize,
            $pageBefore,
            $pageAfter,
            $sort
        );
    }
}
