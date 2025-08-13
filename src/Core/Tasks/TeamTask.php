<?php

namespace Upsun\Core\Tasks;

use OpenAPI\Client\ApiException;
use OpenAPI\Client\apisgen\TeamAccessApi;
use OpenAPI\Client\apisgen\TeamsApi;
use OpenAPI\Client\Model\CreateTeamMemberRequest;
use OpenAPI\Client\Model\CreateTeamRequest;
use OpenAPI\Client\Model\Error;
use OpenAPI\Client\Model\ListTeamMembers200Response;
use OpenAPI\Client\Model\ListTeamProjectAccess200Response;
use OpenAPI\Client\Model\ListTeams200Response;
use OpenAPI\Client\Model\Team;
use OpenAPI\Client\Model\TeamMember;
use OpenAPI\Client\Model\TeamProjectAccess;
use Upsun\UpsunClient;

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
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function create(array $createTeamRequest): Team|Error
    {
        $this->refreshToken();
        $createTeamRequest = new CreateTeamRequest($createTeamRequest);
        return $this->teamsApi->createTeam($createTeamRequest);
    }

    /**
     * Creates team member
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function createMember(string $teamId, array $createTeamMemberRequest): Error|TeamMember
    {
        $this->refreshToken();
        $createTeamMemberRequest = new CreateTeamMemberRequest($createTeamMemberRequest);
        return $this->teamsApi->createTeamMember($teamId, $createTeamMemberRequest);
    }

    /**
     * Deletes team
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function delete(string $teamId): void
    {
        $this->refreshToken();
        $this->teamsApi->deleteTeam($teamId);
    }

    /**
     * Deletes team member
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function deleteMember(string $teamId, string $userId): void
    {
        $this->refreshToken();
        $this->teamsApi->deleteTeamMember($teamId, $userId);
    }

    /**
     * Gets team
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function get(string $teamId): Team|Error
    {
        $this->refreshToken();
        return $this->teamsApi->getTeam($teamId);
    }

    /**
     * Gets team member
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getMember(string $teamId, string $userId): Error|TeamMember
    {
        $this->refreshToken();
        return $this->teamsApi->getTeamMember($teamId, $userId);
    }

    /**
     * Lists team members
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listMembers(
        string $teamId,
        ?string $pageBefore = null,
        ?string $pageAfter = null,
        ?string $sort = null
    ): Error|ListTeamMembers200Response {
        $this->refreshToken();
        return $this->teamsApi->listTeamMembers($teamId, $pageBefore, $pageAfter, $sort);
    }

    /**
     * Lists teams
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function list(
        ?array $filterOrganizationId = null,
        ?array $filterId = null,
        ?array $filterUpdatedAt = null,
        ?int $pageSize = null,
        ?string $pageBefore = null,
        ?string $pageAfter = null,
        ?string $sort = null
    ): Error|ListTeams200Response {
        $this->refreshToken();
        return $this->teamsApi->listTeams(
            $filterOrganizationId,
            $filterId,
            $filterUpdatedAt,
            $pageSize,
            $pageBefore,
            $pageAfter,
            $sort
        );
    }

    /**
     * Lists User teams
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
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
        $this->refreshToken();
        return $this->teamsApi->listUserTeams(
            $userId,
            $filterOrganizationId,
            $filterUpdatedAt,
            $pageSize,
            $pageBefore,
            $pageAfter,
            $sort
        );
    }

    /**
     * Updates team
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function update(string $teamId, ?array $updateTeamRequest = null): Team|Error
    {
        $this->refreshToken();
        return $this->teamsApi->updateTeam($teamId, $updateTeamRequest);
    }

    /**
     * Gets team access for a project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getProjectTeamAccess(string $projectId, string $teamId): Error|TeamProjectAccess
    {
        $this->refreshToken();
        return $this->accessApi->getProjectTeamAccess($projectId, $teamId);
    }


    /**
     * Gets project access for a team
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getTeamProjectAccess(string $teamId, string $projectId): Error|TeamProjectAccess
    {
        $this->refreshToken();
        return $this->accessApi->getTeamProjectAccess($teamId, $projectId);
    }

    /**
     * Grants team access to a project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function grantProjectTeamAccess(string $projectId, array $grantProjectTeamAccessRequestInner): void
    {
        $this->refreshToken();
        $this->accessApi->grantProjectTeamAccess($projectId, $grantProjectTeamAccessRequestInner);
    }

    /**
     * Grants project access to a team
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function grantTeamProjectAccess(string $teamId, array $grantTeamProjectAccessRequestInner): void
    {
        $this->refreshToken();
        $this->accessApi->grantTeamProjectAccess($teamId, $grantTeamProjectAccessRequestInner);
    }

    /**
     * Lists team access for a project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listProjectTeamAccess(
        string $projectId,
        ?int $pageSize = null,
        ?string $pageBefore = null,
        ?string $pageAfter = null,
        ?string $sort = null
    ): Error|ListTeamProjectAccess200Response {
        $this->refreshToken();
        return $this->accessApi->listProjectTeamAccess($projectId, $pageSize, $pageBefore, $pageAfter, $sort);
    }

    /**
     * Lists project access for a team
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listTeamProjectAccess(
        string $teamId,
        ?int $pageSize = null,
        ?string $pageBefore = null,
        ?string $pageAfter = null,
        ?string $sort = null
    ): Error|ListTeamProjectAccess200Response {
        $this->refreshToken();
        return $this->accessApi->listTeamProjectAccess($teamId, $pageSize, $pageBefore, $pageAfter, $sort);
    }

    /**
     * Removes team access for a project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function removeProjectTeamAccess(string $projectId, string $teamId): void
    {
        $this->refreshToken();
        $this->accessApi->removeProjectTeamAccess($projectId, $teamId);
    }

    /**
     * Removes project access for a team
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function removeTeamProjectAccess(string $teamId, string $projectId): void
    {
        $this->refreshToken();
        $this->accessApi->removeTeamProjectAccess($teamId, $projectId);
    }
}
