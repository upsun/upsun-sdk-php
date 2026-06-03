<?php

namespace Upsun\Core\Tasks;

use InvalidArgumentException;
use Psr\Http\Client\ClientExceptionInterface;
use Upsun\Api\ApiException;
use Upsun\Api\ReferencesApi;
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
        private readonly ReferencesApi $referencesApi,
    ) {
        parent::__construct($client);
    }

    /**
     * Creates team
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the organization ID is invalid
     */
    public function create(
        string $organizationId,
        string $label,
        ?array $projectPermissions = []
    ): Team {
        $this->checkOrganizationId($organizationId);

        return $this->teamsApi->createTeam(createTeamRequest: new CreateTeamRequest(
            organizationId: $organizationId,
            label: $label,
            projectPermissions: $projectPermissions
        ));
    }

    /**
     * Deletes team
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the team ID is invalid
     */
    public function delete(string $teamId): void
    {
        $this->checkTeamId($teamId);

        $this->teamsApi->deleteTeam(teamId: $teamId);
    }

    /**
     * Get a team by its ID. This method allows you to retrieve the details of a specific team by providing the team ID.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the team ID is invalid
     */
    public function get(string $teamId): Team
    {
        $this->checkTeamId($teamId);

        return $this->teamsApi->getTeam(teamId: $teamId);
    }

    /**
     * Update a team by its ID. This method allows you to update the details of a specific team by providing the team ID
     * and the parameters to update.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the team ID is invalid
     */
    public function update(
        string $teamId,
        ?string $label = null,
        ?array $projectPermissions = [],
    ): Team {
        $this->checkTeamId($teamId);

        return $this->teamsApi->updateTeam(
            teamId: $teamId,
            updateTeamRequest: new UpdateTeamRequest(
                label: $label,
                projectPermissions: $projectPermissions
            )
        );
    }

    /**
     * List teams with optional filtering. This method allows you to retrieve a list of teams based on various filter
     * criteria.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if any of the provided filter parameters are invalid
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
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the user ID is invalid
     */
    public function listByMember(
        string $userId,
        ?array $filterOrganizationId = null,
        ?array $filterUpdatedAt = null,
        ?int $pageSize = null,
        ?string $pageBefore = null,
        ?string $pageAfter = null,
        ?string $sort = null
    ): ListTeams200Response {
        $this->checkUserId($userId);

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
     *
     * @deprecated use listByMember() instead
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the user ID is invalid
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
        return $this->listByMember(
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
     * Add a member to a team. This method allows you to add a user as a member of a specific team by providing the team
     * ID and the user ID.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the team ID or user ID is invalid
     */
    public function addMember(string $teamId, string $userId): TeamMember
    {
        $this->checkTeamId($teamId);
        $this->checkUserId($userId);

        $createTeamMemberRequest = new CreateTeamMemberRequest(userId: $userId);
        return $this->teamsApi->createTeamMember(teamId: $teamId, createTeamMemberRequest: $createTeamMemberRequest);
    }

    /**
     * Creates team member
     *
     * @deprecated use addMember() instead
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the team ID or user ID is invalid
     */
    public function createMember(string $teamId, string $userId): TeamMember
    {
        return $this->addMember(teamId: $teamId, userId: $userId);
    }

    /**
     * Deletes team member
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the team ID or user ID is invalid
     */
    public function deleteMember(string $teamId, string $userId): void
    {
        $this->checkTeamId($teamId);
        $this->checkUserId($userId);

        $this->teamsApi->deleteTeamMember(teamId: $teamId, userId: $userId);
    }

    /**
     * Gets team member
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the team ID or user ID is invalid
     */
    public function getMember(string $teamId, string $userId): TeamMember
    {
        $this->checkTeamId($teamId);
        $this->checkUserId($userId);

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
     * Gets team access for a project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID or team ID is invalid
     */
    public function getTeamProjectAccessByProject(string $projectId, string $teamId): TeamProjectAccess
    {
        $this->checkProjectId($projectId);
        $this->checkTeamId($teamId);

        return $this->accessApi->getProjectTeamAccess(projectId: $projectId, teamId: $teamId);
    }

    /**
     * Gets team access for a project
     *
     * @deprecated use getTeamProjectAccessByProject() instead
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID or team ID is invalid
     */
    public function getProjectTeamAccess(string $projectId, string $teamId): TeamProjectAccess
    {
        return $this->getTeamProjectAccessByProject(projectId: $projectId, teamId: $teamId);
    }

    /**
     * Gets project access for a team
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID or team ID is invalid
     */
    public function getTeamProjectAccessByTeam(string $teamId, string $projectId): TeamProjectAccess
    {
        $this->checkTeamId($teamId);
        $this->checkProjectId($projectId);

        return $this->accessApi->getTeamProjectAccess(teamId: $teamId, projectId: $projectId);
    }

    /**
     * Gets project access for a team
     *
     * @deprecated use getTeamProjectAccessByTeam() instead
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID or team ID is invalid
     */
    public function getTeamProjectAccess(string $teamId, string $projectId): TeamProjectAccess
    {
        return $this->getTeamProjectAccessByTeam(teamId: $teamId, projectId: $projectId);
    }

    /**
     * Grants team access to a project
     *
     * @param array{
     *  teamId: string,
     * } $access
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID or team ID is invalid
     */
    public function grantTeamProjectAccessToProject(string $projectId, array $access): void
    {
        $this->checkProjectId($projectId);

        $this->accessApi->grantProjectTeamAccess(
            projectId: $projectId,
            grantProjectTeamAccessRequestInner: $access
        );
    }

    /**
     * Grants team access to a project
     *
     * @deprecated use grantTeamProjectAccessToProject() instead
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID or team ID is invalid
     */
    public function grantProjectTeamAccess(string $projectId, array $access): void
    {
        $this->grantTeamProjectAccessToProject(
            projectId: $projectId,
            access: $access
        );
    }

    /**
     * Grants project access to a team
     *
     * @param array{
     *  projectId: string,
     * } $access
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID or team ID is invalid
     */
    public function grantTeamProjectAccessToTeam(string $teamId, array $access): void
    {
        $this->checkTeamId($teamId);
        $this->checkProjectId($teamId);

        $this->accessApi->grantTeamProjectAccess(teamId: $teamId, grantTeamProjectAccessRequestInner: $access);
    }

    /**
     * Grants project access to a team
     *
     * @deprecated use grantTeamProjectAccessToTeam() instead
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID or team ID is invalid
     */
    public function grantTeamProjectAccess(string $teamId, array $access): void
    {
        $this->grantTeamProjectAccessToTeam(teamId: $teamId, access: $access);
    }

    /**
     * Lists team access for a project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID is invalid
     */
    public function listTeamProjectAccessByProject(
        string $projectId,
        ?int $pageSize = null,
        ?string $pageBefore = null,
        ?string $pageAfter = null,
        ?string $sort = null
    ): ListProjectTeamAccess200Response {
        $this->checkProjectId($projectId);

        return $this->accessApi->listProjectTeamAccess(
            projectId: $projectId,
            pageSize: $pageSize,
            pageBefore: $pageBefore,
            pageAfter: $pageAfter,
            sort: $sort
        );
    }

    /**
     * Lists team access for a project
     *
     * @deprecated use listTeamProjectAccessByProject() instead
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID is invalid
     */
    public function listProjectTeamAccess(
        string $projectId,
        ?int $pageSize = null,
        ?string $pageBefore = null,
        ?string $pageAfter = null,
        ?string $sort = null
    ): ListProjectTeamAccess200Response {
        return $this->listTeamProjectAccessByProject(
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
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the team ID is invalid
     */
    public function listTeamProjectAccessByTeam(
        string $teamId,
        ?int $pageSize = null,
        ?string $pageBefore = null,
        ?string $pageAfter = null,
        ?string $sort = null
    ): ListProjectTeamAccess200Response {
        $this->checkTeamId($teamId);

        return $this->accessApi->listTeamProjectAccess(
            teamId: $teamId,
            pageSize: $pageSize,
            pageBefore: $pageBefore,
            pageAfter: $pageAfter,
            sort: $sort
        );
    }

    /**
     * Lists project access for a team
     *
     * @deprecated use listTeamProjectAccessByTeam() instead
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the team ID is invalid
     */
    public function listTeamProjectAccess(
        string $teamId,
        ?int $pageSize = null,
        ?string $pageBefore = null,
        ?string $pageAfter = null,
        ?string $sort = null
    ): ListProjectTeamAccess200Response {
        return $this->listTeamProjectAccessByTeam(
            teamId: $teamId,
            pageSize: $pageSize,
            pageBefore: $pageBefore,
            pageAfter: $pageAfter,
            sort: $sort
        );
    }

    /**
     * Revokes team access for a project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID or team ID is invalid
     */
    public function revokeTeamProjectAccessByProject(string $projectId, string $teamId): void
    {
        $this->checkProjectId($projectId);
        $this->checkTeamId($teamId);

        $this->accessApi->removeProjectTeamAccess(projectId: $projectId, teamId: $teamId);
    }

    /**
     * Removes team access for a project
     *
     * @deprecated use revokeTeamProjectAccessByProject() instead
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID or team ID is invalid
     */
    public function revokeProjectTeamAccess(string $projectId, string $teamId): void
    {
        $this->revokeTeamProjectAccessByProject(projectId: $projectId, teamId: $teamId);
    }

    /**
     * Removes project access for a team
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID or team ID is invalid
     */
    public function revokeTeamProjectAccessByTeam(string $teamId, string $projectId): void
    {
        $this->checkTeamId($teamId);
        $this->checkProjectId($projectId);

        $this->accessApi->removeTeamProjectAccess(teamId: $teamId, projectId: $projectId);
    }

    /**
     * Removes project access for a team
     *
     * @deprecated use revokeTeamProjectAccessByTeam() instead
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network errors
     * @throws InvalidArgumentException if the project ID or team ID is invalid
     */
    public function revokeTeamProjectAccess(string $teamId, string $projectId): void
    {
        $this->revokeTeamProjectAccessByTeam(teamId: $teamId, projectId: $projectId);
    }

    /**
     * List referenced teams
     * This method retrieves a list of teams that are referenced by a specific signature.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the in or sig parameter is invalid or empty
     * @return array
     */
    public function listReferencedTeams(string $in, string $sig): array
    {
        if (empty($in)) {
            throw new InvalidArgumentException('In parameter cannot be empty');
        }
        if (empty($sig)) {
            throw new InvalidArgumentException('Sig parameter cannot be empty');
        }

        return $this->referencesApi->listReferencedTeams(in: $in, sig: $sig);
    }
}
