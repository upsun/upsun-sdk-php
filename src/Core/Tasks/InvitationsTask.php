<?php

namespace Upsun\Core\Tasks;

use Psr\Http\Client\ClientExceptionInterface;
use Upsun\Api\ApiException;
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
 * @author    Upsun Advocacy Team
 * @license   MIT
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
     * @throws ClientExceptionInterface
     */
    public function cancelOrgInvite(string $organizationId, string $invitationId): void
    {
        $this->orgInvApi->cancelOrgInvite(
            organizationId: $organizationId,
            invitationId: $invitationId
        );
    }

    /**
     * Invites user to an organization by email
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function createOrgInvite(
        string $organizationId,
        string $email,
        array $permissions,
        ?bool $force = true
    ): OrganizationInvitation {
        return $this->orgInvApi->createOrgInvite(
            organizationId: $organizationId,
            createOrgInviteRequest: new CreateOrgInviteRequest(
                email: $email,
                permissions: $permissions,
                force: $force,
            )
        );
    }

    /**
     * Lists invitations to an organization
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
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
            organizationId: $organizationId,
            filterState: new StringFilter(...$this->normalizeFilter($filterState)),
            pageSize: $pageSize,
            pageBefore: $pageBefore,
            pageAfter: $pageAfter,
            sort: $sort
        );
    }

    /**
     * Cancels a pending invitation to a project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function cancelProjectInvite(string $projectId, string $invitationId): void
    {
        $this->prjInvApi->cancelProjectInvite(projectId: $projectId, invitationId: $invitationId);
    }

    /**
     * Invites user to a project by email
     *
     * @param array<int, 'read'|'write'|'admin'>|null $permissions
     * @param array<int, array{id: string, name: string}>|null $environments
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function createProjectInvite(
        string $projectId,
        string $email,
        ?string $role = null,
        ?array $permissions = null,
        ?array $environments = null,
        ?bool $force = null,
    ): ProjectInvitation {
        return $this->prjInvApi->createProjectInvite(
            projectId: $projectId,
            createProjectInviteRequest: new CreateProjectInviteRequest(
                email: $email,
                role: $role,
                permissions: $permissions,
                environments: $environments,
                force: $force
            )
        );
    }

    /**
     * Lists invitations to a project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
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
            projectId: $projectId,
            filterState: new StringFilter(...$this->normalizeFilter($filterState)),
            pageSize: $pageSize,
            pageBefore: $pageBefore,
            pageAfter: $pageAfter,
            sort: $sort
        );
    }
}
