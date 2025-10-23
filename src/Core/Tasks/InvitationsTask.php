<?php

namespace Upsun\Core\Tasks;

use Upsun\ApiException;
use Upsun\Api\OrganizationInvitationsApi;
use Upsun\Api\ProjectInvitationsApi;
use Upsun\Model\CreateOrgInviteRequest;
use Upsun\Model\CreateProjectInviteRequest;
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
class InvitationsTask extends TaskBase
{
    public function __construct(
        UpsunClient $client,
        private readonly OrganizationInvitationsApi $orgInvApi,
        private readonly ProjectInvitationsApi $prjInvApi,
    ) {
        parent::__construct($client);
    }

    /**
     * Cancels a pending invitation to an organization
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function cancelOrgInvite(string $organizationId, string $invitationId): void
    {
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
    ): OrganizationInvitation {
        $inviteRequest = new CreateOrgInviteRequest(
            email: $email,
            permissions: $permissions,
            force: $force,
        );
        return $this->orgInvApi->createOrgInvite($organizationId, $inviteRequest);
    }

    /**
     * Lists invitations to an organization
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     *
     * @return OrganizationInvitation[]
     */
    public function listOrgInvites(
        string $organizationId,
        ?array $filterState = null,
        ?int $pageSize = null,
        ?string $pageBefore = null,
        ?string $pageAfter = null,
        ?string $sort = null
    ): array {
        return $this->orgInvApi->listOrgInvites(
            $organizationId,
            new StringFilter(...$this->normalizeFilter($filterState)),
            $pageSize,
            $pageBefore,
            $pageAfter,
            $sort
        );
    }

    /**
     * Cancels a pending invitation to a project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function cancelProjectInvite(string $projectId, string $invitationId): void
    {
        $this->prjInvApi->cancelProjectInvite($projectId, $invitationId);
    }

    /**
     * Invites user to a project by email
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @param array{
     *     email: string,
     *     role?: string,
     *     permissions?: array,
     *     environments?: bool,
     *     force?: bool
     * } $data
     */
    public function createProjectInvite(
        string $projectId,
        array $data
    ): ProjectInvitation {
        $createProjectInviteRequest = new CreateProjectInviteRequest(...$data);
        return $this->prjInvApi->createProjectInvite($projectId, $createProjectInviteRequest);
    }

    /**
     * Lists invitations to a project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     *
     * @return ProjectInvitation[]
     */
    public function listProjectInvites(
        string $projectId,
        ?array $filterState = null,
        ?int $pageSize = null,
        ?string $pageBefore = null,
        ?string $pageAfter = null,
        ?string $sort = null
    ): array {
        return $this->prjInvApi->listProjectInvites(
            $projectId,
            new StringFilter(...$this->normalizeFilter($filterState)),
            $pageSize,
            $pageBefore,
            $pageAfter,
            $sort
        );
    }
}
