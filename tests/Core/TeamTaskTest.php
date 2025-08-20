<?php

use Upsun\Configuration;
use PHPUnit\Framework\TestCase;
use Upsun\API\TeamsApi;
use Upsun\API\TeamAccessApi;
use Upsun\Model\{CreateTeamRequest, CreateTeamMemberRequest, Error, ListTeamMembers200Response, ListTeamProjectAccess200Response, ListTeams200Response, Team, TeamMember, TeamProjectAccess};
use Upsun\ApiException;
use Symfony\Component\HttpClient\HttplugClient;
use Upsun\Core\Tasks\TeamTask;
use Upsun\UpsunClient;
use Upsun\UpsunConfig;

class TeamTaskTest extends TestCase
{
    private $client;
    private $teamsApi;
    private $accessApi;
    private TeamTask $task;

    protected function setUp(): void
    {
        $this->client = new class() extends UpsunClient {
            public HttplugClient $apiClient;
            public Configuration $apiConfig;
            public UpsunConfig $upsunConfig;
            public function __construct()
            {
            }
        };

        $this->teamsApi = $this->createMock(TeamsApi::class);
        $this->accessApi = $this->createMock(TeamAccessApi::class);

        $this->task = new class($this->client, $this->teamsApi, $this->accessApi) extends TeamTask {
            public function refreshToken(): void {}
        };
    }

    public function testCreateSuccess(): void
    {
        $input = ['name' => 'Dev Team'];
        $team = $this->createMock(Team::class);

        $this->teamsApi->expects($this->once())
            ->method('createTeam')
            ->with($this->isInstanceOf(CreateTeamRequest::class))
            ->willReturn($team);

        $result = $this->task->create($input);
        $this->assertSame($team, $result);
    }

    public function testCreateError(): void
    {
        $input = ['name' => 'Dev Team'];
        $error = $this->createMock(Error::class);

        $this->teamsApi->expects($this->once())
            ->method('createTeam')
            ->willReturn($error);

        $result = $this->task->create($input);
        $this->assertSame($error, $result);
    }

    public function testCreateMemberSuccess(): void
    {
        $member = $this->createMock(TeamMember::class);
        $this->teamsApi->expects($this->once())
            ->method('createTeamMember')
            ->willReturn($member);

        $result = $this->task->createMember('team_1', ['user_id' => 'user_1']);
        $this->assertSame($member, $result);
    }

    public function testCreateMemberError(): void
    {
        $error = $this->createMock(Error::class);
        $this->teamsApi->expects($this->once())
            ->method('createTeamMember')
            ->willReturn($error);

        $result = $this->task->createMember('team_1', ['user_id' => 'user_1']);
        $this->assertSame($error, $result);
    }

    public function testGetSuccess(): void
    {
        $team = $this->createMock(Team::class);
        $this->teamsApi->method('getTeam')->willReturn($team);
        $this->assertSame($team, $this->task->get('team_1'));
    }

    public function testGetError(): void
    {
        $error = $this->createMock(Error::class);
        $this->teamsApi->method('getTeam')->willReturn($error);
        $this->assertSame($error, $this->task->get('team_1'));
    }

    public function testListSuccess(): void
    {
        $response = $this->createMock(ListTeams200Response::class);
        $this->teamsApi->method('listTeams')->willReturn($response);
        $this->assertSame($response, $this->task->list());
    }

    public function testListError(): void
    {
        $error = $this->createMock(Error::class);
        $this->teamsApi->method('listTeams')->willReturn($error);
        $this->assertSame($error, $this->task->list());
    }

    public function testListMembersSuccess(): void
    {
        $response = $this->createMock(ListTeamMembers200Response::class);
        $this->teamsApi->method('listTeamMembers')->willReturn($response);
        $this->assertSame($response, $this->task->listMembers('team_1'));
    }

    public function testListMembersError(): void
    {
        $error = $this->createMock(Error::class);
        $this->teamsApi->method('listTeamMembers')->willReturn($error);
        $this->assertSame($error, $this->task->listMembers('team_1'));
    }

    public function testListUserTeamsSuccess(): void
    {
        $response = $this->createMock(ListTeams200Response::class);
        $this->teamsApi->method('listUserTeams')->willReturn($response);
        $this->assertSame($response, $this->task->listUserTeams('user_1'));
    }

    public function testListUserTeamsError(): void
    {
        $error = $this->createMock(Error::class);
        $this->teamsApi->method('listUserTeams')->willReturn($error);
        $this->assertSame($error, $this->task->listUserTeams('user_1'));
    }

    public function testUpdateSuccess(): void
    {
        $team = $this->createMock(Team::class);
        $this->teamsApi->method('updateTeam')->willReturn($team);
        $this->assertSame($team, $this->task->update('team_1', ['name' => 'Updated']));
    }

    public function testUpdateError(): void
    {
        $error = $this->createMock(Error::class);
        $this->teamsApi->method('updateTeam')->willReturn($error);
        $this->assertSame($error, $this->task->update('team_1', ['name' => 'Updated']));
    }

    public function testGetMemberSuccess(): void
    {
        $member = $this->createMock(TeamMember::class);
        $this->teamsApi->method('getTeamMember')->willReturn($member);
        $this->assertSame($member, $this->task->getMember('team_1', 'user_1'));
    }

    public function testGetMemberError(): void
    {
        $error = $this->createMock(Error::class);
        $this->teamsApi->method('getTeamMember')->willReturn($error);
        $this->assertSame($error, $this->task->getMember('team_1', 'user_1'));
    }

    public function testAccessProjectSuccess(): void
    {
        $access = $this->createMock(TeamProjectAccess::class);
        $this->accessApi->method('getProjectTeamAccess')->willReturn($access);
        $this->assertSame($access, $this->task->getProjectTeamAccess('project_1', 'team_1'));
    }

    public function testAccessProjectError(): void
    {
        $error = $this->createMock(Error::class);
        $this->accessApi->method('getProjectTeamAccess')->willReturn($error);
        $this->assertSame($error, $this->task->getProjectTeamAccess('project_1', 'team_1'));
    }

    public function testAccessTeamSuccess(): void
    {
        $access = $this->createMock(TeamProjectAccess::class);
        $this->accessApi->method('getTeamProjectAccess')->willReturn($access);
        $this->assertSame($access, $this->task->getTeamProjectAccess('team_1', 'project_1'));
    }

    public function testAccessTeamError(): void
    {
        $error = $this->createMock(Error::class);
        $this->accessApi->method('getTeamProjectAccess')->willReturn($error);
        $this->assertSame($error, $this->task->getTeamProjectAccess('team_1', 'project_1'));
    }

    public function testListTeamProjectAccessSuccess(): void
    {
        $accessList = $this->createMock(ListTeamProjectAccess200Response::class);
        $this->accessApi->method('listTeamProjectAccess')->willReturn($accessList);
        $this->assertSame($accessList, $this->task->listTeamProjectAccess('team_1'));
    }

    public function testListTeamProjectAccessError(): void
    {
        $error = $this->createMock(Error::class);
        $this->accessApi->method('listTeamProjectAccess')->willReturn($error);
        $this->assertSame($error, $this->task->listTeamProjectAccess('team_1'));
    }
}
