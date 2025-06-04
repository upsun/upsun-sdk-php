<?php

namespace Upsun\Core\Tasks;

use OpenAPI\Client\ApiException;
use OpenAPI\Client\apisgen\TeamAccessApi;
use OpenAPI\Client\apisgen\TeamsApi;
use OpenAPI\Client\Model\CreateTeamMemberRequest;
use OpenAPI\Client\Model\CreateTeamRequest;
use OpenAPI\Client\Model\Error;
use OpenAPI\Client\Model\GrantProjectTeamAccessRequestInner;
use OpenAPI\Client\Model\GrantTeamProjectAccessRequestInner;
use OpenAPI\Client\Model\ListTeamMembers200Response;
use OpenAPI\Client\Model\ListTeamProjectAccess200Response;
use OpenAPI\Client\Model\ListTeams200Response;
use OpenAPI\Client\Model\Team;
use OpenAPI\Client\Model\TeamMember;
use OpenAPI\Client\Model\TeamProjectAccess;
use Upsun\UpsunClient;

class TeamTask extends TaskBase
{
    public readonly TeamsApi $teamsApi;
    public readonly TeamAccessApi $accessApi;

    public function __construct(
        public readonly UpsunClient $client,
    ) {
        $this->teamsApi  = new TeamsApi($this->client->apiClient, $this->client->apiConfig);
        $this->accessApi = new TeamAccessApi($this->client->apiClient, $this->client->apiConfig);
    }

    /************** ********************/
    /********* TeamsApi ****************/
    /************** ********************/

    /**
     * Operation create
     *
     * Create team
     *
     * @param array $create_team_request create_team_request (required)
     * @return Team|Error
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function create(array $create_team_request): Team|Error
    {
        $this->refreshToken();
        $create_team_request = new CreateTeamRequest($create_team_request);
        return $this->teamsApi->createTeam($create_team_request);
    }

    /**
     * Operation createMember
     *
     * Create team member
     *
     * @param string $team_id The ID of the team. (required)
     * @param array $create_team_member_request create_team_member_request (required)
     * @return TeamMember|Error
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function createMember(string $team_id, array $create_team_member_request): Error|TeamMember
    {
        $this->refreshToken();
        $create_team_member_request = new CreateTeamMemberRequest($create_team_member_request);
        return $this->teamsApi->createTeamMember($team_id, $create_team_member_request);
    }

    /**
     * Operation deleteTeam
     *
     * Delete team
     *
     * @param string $team_id The ID of the team. (required)
     * @return void
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function delete(string $team_id): void
    {
        $this->refreshToken();
        $this->teamsApi->deleteTeam($team_id);
    }

    /**
     * Operation deleteTeamMember
     *
     * Delete team member
     *
     * @param string $team_id The ID of the team. (required)
     * @param string $user_id The ID of the user. (required)
     * @return void
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function deleteMember(string $team_id, string $user_id): void
    {
        $this->refreshToken();
        $this->teamsApi->deleteTeamMember($team_id, $user_id);
    }

    /**
     * Operation getTeam
     *
     * Get team
     *
     * @param string $team_id The ID of the team. (required)
     * @return Team|Error
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function get(string $team_id): Team|Error
    {
        $this->refreshToken();
        return $this->teamsApi->getTeam($team_id);
    }

    /**
     * Operation getTeamMember
     *
     * Get team member
     *
     * @param string $team_id The ID of the team. (required)
     * @param string $user_id The ID of the user. (required)
     * @return TeamMember|Error
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getMember(string $team_id, string $user_id): Error|TeamMember
    {
        $this->refreshToken();
        return $this->teamsApi->getTeamMember($team_id, $user_id);
    }

    /**
     * Operation listTeamMembers
     *
     * List team members
     *
     * @param string $team_id The ID of the team. (required)
     * @param string|null $page_before Pagination cursor. This is automatically generated as necessary
     *        and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param string|null $page_after Pagination cursor. This is automatically generated as necessary
     *        and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param string|null $sort Allows sorting by a single field. Use a dash (`-`) to sort descending. (optional)
     * @return ListTeamMembers200Response|Error
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listMembers(
        string $team_id,
        string $page_before = null,
        string $page_after = null,
        string $sort = null
    ): Error|ListTeamMembers200Response {
        $this->refreshToken();
        return $this->teamsApi->listTeamMembers($team_id, $page_before, $page_after, $sort);
    }

    /**
     * Operation listTeams
     *
     * List teams
     *
     * @param array|null $filter_organization_id Allows filtering by `organization_id` using one or more operators.
     *        (optional)
     * @param array|null $filter_id Allows filtering by `id` using one or more operators. (optional)
     * @param array|null $filter_updated_at Allows filtering by `updated_at` using one or more operators. (optional)
     * @param int|null $page_size Determines the number of items to show. (optional)
     * @param string|null $page_before Pagination cursor. This is automatically generated as necessary and provided
     *        in HAL links (_links); it should not be constructed externally. (optional)
     * @param string|null $page_after Pagination cursor. This is automatically generated as necessary
     *        and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param string|null $sort Allows sorting by a single field. Use a dash (`-`) to sort descending. (optional)
     * @return ListTeams200Response|Error
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function list(
        array $filter_organization_id = null,
        array $filter_id = null,
        array $filter_updated_at = null,
        int $page_size = null,
        string $page_before = null,
        string $page_after = null,
        string $sort = null
    ): Error|ListTeams200Response {
        $this->refreshToken();
        return $this->teamsApi->listTeams(
            $filter_organization_id,
            $filter_id,
            $filter_updated_at,
            $page_size,
            $page_before,
            $page_after,
            $sort
        );
    }

    /**
     * Operation listUserTeams
     *
     * User teams
     *
     * @param string $user_id The ID of the user. (required)
     * @param array|null $filter_organization_id Allows filtering by `organization_id`
     *        using one or more operators. (optional)
     * @param array|null $filter_updated_at Allows filtering by `updated_at`
     *        using one or more operators. (optional)
     * @param int|null $page_size Determines the number of items to show. (optional)
     * @param string|null $page_before Pagination cursor. This is automatically generated as necessary
     *        and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param string|null $page_after Pagination cursor. This is automatically generated as necessary
     *        and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param string|null $sort Allows sorting by a single field.
     *        Use a dash (`-`) to sort descending. (optional)
     * @return ListTeams200Response|Error
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listUserTeams(
        string $user_id,
        array $filter_organization_id = null,
        array $filter_updated_at = null,
        int $page_size = null,
        string $page_before = null,
        string $page_after = null,
        string $sort = null
    ): Error|ListTeams200Response {
        $this->refreshToken();
        return $this->teamsApi->listUserTeams(
            $user_id,
            $filter_organization_id,
            $filter_updated_at,
            $page_size,
            $page_before,
            $page_after,
            $sort
        );
    }

    /**
     * Operation updateTeam
     *
     * Update team
     *
     * @param string $team_id The ID of the team. (required)
     * @param array|null $update_team_request update_team_request (optional)
     * @return Team|Error
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function update(string $team_id, array $update_team_request = null): Team|Error
    {
        $this->refreshToken();
        return $this->teamsApi->updateTeam($team_id, $update_team_request);
    }

    /************** *************************/
    /********* TeamAccessApi ****************/
    /************** *************************/

    /**
     * Operation getProjectTeamAccess
     *
     * Get team access for a project
     *
     * @param string $project_id The ID of the project. (required)
     * @param string $team_id The ID of the team. (required)
     * @return TeamProjectAccess|Error
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getProjectTeamAccess(string $project_id, string $team_id): Error|TeamProjectAccess
    {
        $this->refreshToken();
        return $this->accessApi->getProjectTeamAccess($project_id, $team_id);
    }


    /**
     * Operation getTeamProjectAccess
     *
     * Get project access for a team
     *
     * @param string $team_id The ID of the team. (required)
     * @param string $project_id The ID of the project. (required)
     * @return TeamProjectAccess|Error
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getTeamProjectAccess(string $team_id, string $project_id): Error|TeamProjectAccess
    {
        $this->refreshToken();
        return $this->accessApi->getTeamProjectAccess($team_id, $project_id);
    }

    /**
     * Operation grantProjectTeamAccess
     *
     * Grant team access to a project
     *
     * @param string $project_id The ID of the project. (required)
     * @param GrantProjectTeamAccessRequestInner[] $grant_project_team_access_request_inner
     *        grant_project_team_access_request_inner (required)
     * @return void
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function grantProjectTeamAccess(string $project_id, array $grant_project_team_access_request_inner): void
    {
        $this->refreshToken();
        $this->accessApi->grantProjectTeamAccess($project_id, $grant_project_team_access_request_inner);
    }

    /**
     * Operation grantTeamProjectAccess
     *
     * Grant project access to a team
     *
     * @param string $team_id The ID of the team. (required)
     * @param GrantTeamProjectAccessRequestInner[] $grant_team_project_access_request_inner
     *        grant_team_project_access_request_inner (required)
     * @return void
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function grantTeamProjectAccess(string $team_id, array $grant_team_project_access_request_inner): void
    {
        $this->refreshToken();
        $this->accessApi->grantTeamProjectAccess($team_id, $grant_team_project_access_request_inner);
    }

    /**
     * Operation listProjectTeamAccess
     *
     * List team access for a project
     *
     * @param string $project_id The ID of the project. (required)
     * @param int|null $page_size Determines the number of items to show. (optional)
     * @param string|null $page_before Pagination cursor. This is automatically generated as necessary
     *        and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param string|null $page_after Pagination cursor. This is automatically generated as necessary
     *        and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param string|null $sort Allows sorting by a single field. Use a dash (`-`) to sort descending.
     *        Supported fields: `granted_at`, `updated_at`. (optional)
     * @return ListTeamProjectAccess200Response|Error
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listProjectTeamAccess(
        string $project_id,
        int $page_size = null,
        string $page_before = null,
        string $page_after = null,
        string $sort = null
    ): Error|ListTeamProjectAccess200Response {
        $this->refreshToken();
        return $this->accessApi->listProjectTeamAccess($project_id, $page_size, $page_before, $page_after, $sort);
    }

    /**
     * Operation listTeamProjectAccess
     *
     * List project access for a team
     *
     * @param string $team_id The ID of the team. (required)
     * @param int|null $page_size Determines the number of items to show. (optional)
     * @param string|null $page_before Pagination cursor. This is automatically generated as necessary
     *          and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param string|null $page_after Pagination cursor. This is automatically generated as necessary
     *        and provided in HAL links (_links); it should not be constructed externally. (optional)
     * @param string|null $sort Allows sorting by a single field. Use a dash (`-`) to sort descending.
     *        Supported fields: `project_title`, `granted_at`, `updated_at`. (optional)
     * @return ListTeamProjectAccess200Response|Error
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listTeamProjectAccess(
        string $team_id,
        int $page_size = null,
        string $page_before = null,
        string $page_after = null,
        string $sort = null
    ): Error|ListTeamProjectAccess200Response {
        $this->refreshToken();
        return $this->accessApi->listTeamProjectAccess($team_id, $page_size, $page_before, $page_after, $sort);
    }

    /**
     * Operation removeProjectTeamAccess
     *
     * Remove team access for a project
     *
     * @param string $project_id The ID of the project. (required)
     * @param string $team_id The ID of the team. (required)
     * @return void
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function removeProjectTeamAccess(string $project_id, string $team_id): void
    {
        $this->refreshToken();
        $this->accessApi->removeProjectTeamAccess($project_id, $team_id);
    }

    /**
     * Operation removeTeamProjectAccess
     *
     * Remove project access for a team
     *
     * @param string $team_id The ID of the team. (required)
     * @param string $project_id The ID of the project. (required)
     * @return void
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function removeTeamProjectAccess(string $team_id, string $project_id): void
    {
        $this->refreshToken();
        $this->accessApi->removeTeamProjectAccess($team_id, $project_id);
    }

    /************** ****************************/
    /********* Custom Functions ****************/
    /************** ****************************/
}
