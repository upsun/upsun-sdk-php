<?php

namespace Upsun\Core\Tasks;

use Exception;
use Upsun\ApiException;
use Upsun\Api\TeamAccessApi;
use Upsun\Api\TeamsApi;
use Upsun\Model\CreateTeamMemberRequest;
use Upsun\Model\CreateTeamRequest;
use Upsun\Model\DateTimeFilter;
use Upsun\Model\Error;
use Upsun\Model\ListTeamMembers200Response;
use Upsun\Model\ListTeamProjectAccess200Response;
use Upsun\Model\ListTeams200Response;
use Upsun\Model\StringFilter;
use Upsun\Model\Team;
use Upsun\Model\TeamMember;
use Upsun\Model\TeamProjectAccess;
use Upsun\UpsunClient;

/**
 * TeamTask class.
 *
 * @author    Upsun SDK Team
 * @license   Apache-2.0
 * @see       https://docs.upsun.com
 */
class TeamTask extends TaskBase
{
    public function __construct(
        public UpsunClient $client,
        private readonly TeamsApi $teamsApi,
        private readonly TeamAccessApi $accessApi,
    ) {
        parent::__construct($this->client);
    }

    /**
     * Creates team
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function create(array $createTeamRequest): Team|Error
    {
        var_dump($createTeamRequest);
        $createTeamRequest = new CreateTeamRequest($createTeamRequest);
        return $this->teamsApi->createTeam($createTeamRequest);
    }

    /**
     * Creates team member
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function createMember(string $teamId, array $createTeamMemberRequest): Error|TeamMember
    {
        $createTeamMemberRequest = new CreateTeamMemberRequest($createTeamMemberRequest);
        return $this->teamsApi->createTeamMember($teamId, $createTeamMemberRequest);
    }

    /**
     * Deletes team
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function delete(string $teamId): void
    {
        $this->teamsApi->deleteTeam($teamId);
    }

    /**
     * Deletes team member
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function deleteMember(string $teamId, string $userId): void
    {
        $this->teamsApi->deleteTeamMember($teamId, $userId);
    }

    /**
     * Gets team
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function get(string $teamId): Team|Error
    {
        return $this->teamsApi->getTeam($teamId);
    }

    /**
     * Gets team member
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function getMember(string $teamId, string $userId): Error|TeamMember
    {
        return $this->teamsApi->getTeamMember($teamId, $userId);
    }

    /**
     * Lists team members
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function listMembers(
        string $teamId,
        ?string $pageBefore = null,
        ?string $pageAfter = null,
        ?string $sort = null
    ): array {
        return $this->teamsApi->listTeamMembers($teamId, $pageBefore, $pageAfter, $sort);
    }

    /**
     * Lists teams
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function list(
        ?array $filterOrganizationId = [],
        ?array $filterId = [],
        ?array $filterUpdatedAt = [],
        ?int $pageSize = null,
        ?string $pageBefore = null,
        ?string $pageAfter = null,
        ?string $sort = null
    ): array {
        var_dump($filterId, $filterOrganizationId, new StringFilter(...$filterId));
        
        return $this->teamsApi->listTeams(
            new StringFilter(...$filterOrganizationId),
            new StringFilter(...$filterId),
            new DateTimeFilter(...$filterUpdatedAt),
            $pageSize,
            $pageBefore,
            $pageAfter,
            $sort
        );
    }

    /**
     * Lists User teams
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function listUserTeams(
        string $userId,
        ?array $filterOrganizationId = null,
        ?array $filterUpdatedAt = null,
        ?int $pageSize = null,
        ?string $pageBefore = null,
        ?string $pageAfter = null,
        ?string $sort = null
    ): Error|ListTeams200Response {
        return $this->teamsApi->listUserTeams(
            $userId,
            new StringFilter($filterOrganizationId),
            new DateTimeFilter($filterUpdatedAt),
            $pageSize,
            $pageBefore,
            $pageAfter,
            $sort
        );
    }

    /**
     * Updates team
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function update(string $teamId, ?array $updateTeamRequest = null): Team|Error
    {
        return $this->teamsApi->updateTeam($teamId, $updateTeamRequest);
    }

    /**
     * Gets team access for a project
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function getProjectTeamAccess(string $projectId, string $teamId): Error|TeamProjectAccess
    {
        return $this->accessApi->getProjectTeamAccess($projectId, $teamId);
    }


    /**
     * Gets project access for a team
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function getTeamProjectAccess(string $teamId, string $projectId): Error|TeamProjectAccess
    {
        return $this->accessApi->getTeamProjectAccess($teamId, $projectId);
    }

    /**
     * Grants team access to a project
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function grantProjectTeamAccess(string $projectId, array $grantProjectTeamAccessRequestInner): void
    {
        $this->accessApi->grantProjectTeamAccess($projectId, $grantProjectTeamAccessRequestInner);
    }

    /**
     * Grants project access to a team
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function grantTeamProjectAccess(string $teamId, array $grantTeamProjectAccessRequestInner): void
    {
        $this->accessApi->grantTeamProjectAccess($teamId, $grantTeamProjectAccessRequestInner);
    }

    /**
     * Lists team access for a project
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function listProjectTeamAccess(
        string $projectId,
        ?int $pageSize = null,
        ?string $pageBefore = null,
        ?string $pageAfter = null,
        ?string $sort = null
    ): Error|ListTeamProjectAccess200Response {
        return $this->accessApi->listProjectTeamAccess($projectId, $pageSize, $pageBefore, $pageAfter, $sort);
    }

    /**
     * Lists project access for a team
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function listTeamProjectAccess(
        string $teamId,
        ?int $pageSize = null,
        ?string $pageBefore = null,
        ?string $pageAfter = null,
        ?string $sort = null
    ): Error|ListTeamProjectAccess200Response {
        return $this->accessApi->listTeamProjectAccess($teamId, $pageSize, $pageBefore, $pageAfter, $sort);
    }

    /**
     * Removes team access for a project
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function removeProjectTeamAccess(string $projectId, string $teamId): void
    {
        $this->accessApi->removeProjectTeamAccess($projectId, $teamId);
    }

    /**
     * Removes project access for a team
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function removeTeamProjectAccess(string $teamId, string $projectId): void
    {
        $this->accessApi->removeTeamProjectAccess($teamId, $projectId);
    }
}
