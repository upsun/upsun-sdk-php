<?php

namespace Upsun\Core\Tasks;

use Psr\Http\Client\ClientExceptionInterface;
use Upsun\Api\ApiException;
use Upsun\Api\TeamAccessApi;
use Upsun\Api\TeamsApi;
use Upsun\Model\CreateTeamMemberRequest;
use Upsun\Model\CreateTeamRequest;
use Upsun\Model\DateTimeFilter;
use Upsun\Model\ListProjectTeamAccess200Response;
use Upsun\Model\ListTeamMembers200Response;
use Upsun\Model\ListTeams200Response;
use Upsun\Model\StringFilter;
use Upsun\Model\Team;
use Upsun\Model\TeamMember;
use Upsun\Model\TeamProjectAccess;
use Upsun\Model\UpdateTeamRequest;
use Upsun\UpsunClient;

/**
 * TeamTask class.
 *
 * @author    Upsun Advocacy Team
 * @license   MIT
 * @see       https://docs.upsun.com
 */
class TeamsTask extends TaskBase
{
    public function __construct(
        UpsunClient $client,
        private readonly TeamsApi $teamsApi,
        private readonly TeamAccessApi $accessApi,
    ) {
        parent::__construct($client);
    }

    /**
     * Creates team
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function create(
        string $organizationId,
        string $label,
        ?array $projectPermissions = []
    ): Team {
        $createTeamRequest = new CreateTeamRequest(
            organizationId: $organizationId,
            label: $label,
            projectPermissions: $projectPermissions
        );
        return $this->teamsApi->createTeam(createTeamRequest: $createTeamRequest);
    }

    /**
     * Creates team member
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function createMember(string $teamId, string $userId): TeamMember
    {
        $createTeamMemberRequest = new CreateTeamMemberRequest(userId: $userId);
        return $this->teamsApi->createTeamMember(teamId: $teamId, createTeamMemberRequest: $createTeamMemberRequest);
    }

    /**
     * Deletes team
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function delete(string $teamId): void
    {
        $this->teamsApi->deleteTeam(teamId: $teamId);
    }

    /**
     * Deletes team member
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function deleteMember(string $teamId, string $userId): void
    {
        $this->teamsApi->deleteTeamMember(teamId: $teamId, userId: $userId);
    }

    /**
     * Gets team
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function get(string $teamId): Team
    {
        return $this->teamsApi->getTeam(teamId: $teamId);
    }

    /**
     * Gets team member
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getMember(string $teamId, string $userId): TeamMember
    {
        return $this->teamsApi->getTeamMember(teamId: $teamId, userId: $userId);
    }

    /**
     * Lists team members
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function listMembers(
        string $teamId,
        ?string $pageBefore = null,
        ?string $pageAfter = null,
        ?string $sort = null
    ): ListTeamMembers200Response {
        return $this->teamsApi->listTeamMembers(
            teamId: $teamId,
            pageBefore: $pageBefore,
            pageAfter: $pageAfter,
            sort: $sort
        );
    }

    /**
     * Lists teams
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function list(
        ?array $filterOrganizationId = [],
        ?array $filterId = [],
        ?array $filterUpdatedAt = [],
        ?int $pageSize = null,
        ?string $pageBefore = null,
        ?string $pageAfter = null,
        ?string $sort = null
    ): ListTeams200Response {
        return $this->teamsApi->listTeams(
            filterOrganizationId: new StringFilter(...$this->normalizeFilter($filterOrganizationId)),
            filterId: new StringFilter(...$this->normalizeFilter($filterId)),
            filterUpdatedAt: new DateTimeFilter(...$this->normalizeFilter($filterUpdatedAt)),
            pageSize: $pageSize,
            pageBefore: $pageBefore,
            pageAfter: $pageAfter,
            sort: $sort
        );
    }

    /**
     * Retrieves teams that the specified user is a member of.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function listTeamsByMember(
        string $userId,
        ?array $filterOrganizationId = null,
        ?array $filterUpdatedAt = null,
        ?int $pageSize = null,
        ?string $pageBefore = null,
        ?string $pageAfter = null,
        ?string $sort = null
    ): ListTeams200Response {
        return $this->teamsApi->listUserTeams(
            userId: $userId,
            filterOrganizationId: new StringFilter(...$this->normalizeFilter($filterOrganizationId)),
            filterUpdatedAt: new DateTimeFilter(...$this->normalizeFilter($filterUpdatedAt)),
            pageSize: $pageSize,
            pageBefore: $pageBefore,
            pageAfter: $pageAfter,
            sort: $sort
        );
    }

    /**
     * Lists teams by member
     * @deprecated use listTeamsByMember() instead
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function listUserTeams(
        string $userId,
        ?array $filterOrganizationId = null,
        ?array $filterUpdatedAt = null,
        ?int $pageSize = null,
        ?string $pageBefore = null,
        ?string $pageAfter = null,
        ?string $sort = null
    ): ListTeams200Response {
        return $this->listTeamsByMember(
            userId: $userId,
            filterOrganizationId: $filterOrganizationId,
            filterUpdatedAt: $filterUpdatedAt,
            pageSize: $pageSize,
            pageBefore: $pageBefore,
            pageAfter: $pageAfter,
            sort: $sort
        );
    }

    /**
     * Updates team
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function update(
        string $teamId,
        ?string $label = null,
        ?array $projectPermissions = [],
    ): Team {
        $updateTeamRequest = new UpdateTeamRequest(
            label: $label,
            projectPermissions: $projectPermissions
        );
        return $this->teamsApi->updateTeam(teamId: $teamId, updateTeamRequest: $updateTeamRequest);
    }

    /**
     * Gets team access for a project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getProjectTeamAccess(string $projectId, string $teamId): TeamProjectAccess
    {
        return $this->accessApi->getProjectTeamAccess(projectId: $projectId, teamId: $teamId);
    }

    /**
     * Gets project access for a team
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getTeamProjectAccess(string $teamId, string $projectId): TeamProjectAccess
    {
        return $this->accessApi->getTeamProjectAccess(teamId: $teamId, projectId: $projectId);
    }

    /**
     * Grants team access to a project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function grantProjectTeamAccess(string $projectId, array $grantProjectTeamAccessRequestInner): void
    {
        $this->accessApi->grantProjectTeamAccess(
            projectId: $projectId,
            grantProjectTeamAccessRequestInner: $grantProjectTeamAccessRequestInner
        );
    }

    /**
     * Grants project access to a team
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function grantTeamProjectAccess(string $teamId, array $data): void
    {
        $this->accessApi->grantTeamProjectAccess(teamId: $teamId, grantTeamProjectAccessRequestInner: $data);
    }

    /**
     * Lists team access for a project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function listProjectTeamAccess(
        string $projectId,
        ?int $pageSize = null,
        ?string $pageBefore = null,
        ?string $pageAfter = null,
        ?string $sort = null
    ): ListProjectTeamAccess200Response {
        return $this->accessApi->listProjectTeamAccess(
            projectId: $projectId,
            pageSize: $pageSize,
            pageBefore: $pageBefore,
            pageAfter: $pageAfter,
            sort: $sort
        );
    }

    /**
     * Lists project access for a team
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function listTeamProjectAccess(
        string $teamId,
        ?int $pageSize = null,
        ?string $pageBefore = null,
        ?string $pageAfter = null,
        ?string $sort = null
    ): ListProjectTeamAccess200Response {
        return $this->accessApi->listTeamProjectAccess(
            teamId: $teamId,
            pageSize: $pageSize,
            pageBefore: $pageBefore,
            pageAfter: $pageAfter,
            sort: $sort
        );
    }

    /**
     * Removes team access for a project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function revokeProjectTeamAccess(string $projectId, string $teamId): void
    {
        $this->accessApi->removeProjectTeamAccess(projectId: $projectId, teamId: $teamId);
    }

    /**
     * Removes project access for a team
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function revokeTeamProjectAccess(string $teamId, string $projectId): void
    {
        $this->accessApi->removeTeamProjectAccess(teamId: $teamId, projectId: $projectId);
    }
}
