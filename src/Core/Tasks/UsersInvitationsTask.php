<?php

namespace Upsun\Core\Tasks;

use InvalidArgumentException;
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
 * UsersInvitationsTask class.
 *
 * @author    Upsun Advocacy Team
 * @license   MIT
 * @see       https://docs.upsun.com
 */
class UsersInvitationsTask extends TaskBase
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
     * @throws ClientExceptionInterface on network error
     * @throws InvalidArgumentException if required parameters are missing or invalid
     */
    public function cancelOrgInvite(string $organizationId, string $invitationId): void
    {
        $this->checkOrganizationId($organizationId);
        $this->checkInvitationId($invitationId);

        $this->orgInvApi->cancelOrgInvite(
            organizationId: $organizationId,
            invitationId: $invitationId
        );
    }

    /**
     * Invites user to an organization by email
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network error
     * @throws InvalidArgumentException if required parameters are missing or invalid
     */
    public function createOrgInvite(
        string $organizationId,
        string $email,
        array $permissions,
        ?bool $force = true
    ): OrganizationInvitation {
        $this->checkOrganizationId($organizationId);
        $this->checkEmail($email);

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
     * @throws ClientExceptionInterface on network error
     * @throws InvalidArgumentException if required parameters are missing or invalid
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
        $this->checkOrganizationId($organizationId);

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
     * @throws ClientExceptionInterface on network error
     * @throws InvalidArgumentException if required parameters are missing or invalid
     */
    public function cancelProjectInvite(string $projectId, string $invitationId): void
    {
        $this->checkProjectId($projectId);
        $this->checkInvitationId($invitationId);

        $this->prjInvApi->cancelProjectInvite(projectId: $projectId, invitationId: $invitationId);
    }

    /**
     * Invites user to a project by email
     *
     * @param array<int, 'read'|'write'|'admin'>|null $permissions
     * @param array<int, array{id: string, name: string}>|null $environments
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network error
     * @throws InvalidArgumentException if required parameters are missing or invalid
     */
    public function createProjectInvite(
        string $projectId,
        string $email,
        ?string $role = null,
        ?array $permissions = null,
        ?array $environments = null,
        ?bool $force = null,
    ): ProjectInvitation {
        $this->checkProjectId($projectId);
        $this->checkEmail($email);

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
     * @throws ClientExceptionInterface on network error
     * @throws InvalidArgumentException if required parameters are missing or invalid
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
        $this->checkProjectId($projectId);
        
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
