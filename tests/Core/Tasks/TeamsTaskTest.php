<?php

namespace Upsun\Tests\Core\Tasks;

use Exception;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Upsun\Api\ApiConfiguration;
use Upsun\Api\ApiException;
use Upsun\Api\TeamAccessApi;
use Upsun\Api\TeamsApi;
use Upsun\Core\OAuthProvider;
use Upsun\Core\Tasks\TeamsTask;
use Upsun\Model\{ListProjectTeamAccess200Response,
    ListTeamMembers200Response,
    ListTeams200Response,
    Team,
    TeamMember,
    TeamProjectAccess};
use Upsun\UpsunClient;

class TeamsTaskTest extends BaseTestCase
{
    private TeamsTask $task;

    private ClientInterface $httpClient;

    protected function setUp(): void
    {
        $psr17Factory = new Psr17Factory();

        $this->httpClient = $this->createMock(ClientInterface::class);

        $oauthProvider = $this->createMock(OAuthProvider::class);

        $upsunClient = $this->createMock(UpsunClient::class);

        $this->task = new class (
            $upsunClient,
            new TeamsApi($oauthProvider, $this->httpClient, $psr17Factory, new ApiConfiguration()),
            new TeamAccessApi($oauthProvider, $this->httpClient, $psr17Factory, new ApiConfiguration()),
        ) extends TeamsTask {
        };
    }

    public function testCreate(): void
    {
        $orgId = 'org_123456';
        $label = 'Dev Team Alpha';
        $projectPermissions = [
            [
                'projectId' => 'proj_001',
                'role' => 'admin',
            ],
            [
                'projectId' => 'proj_002',
                'role' => 'viewer',
            ],
        ];

        $teamFake = [
            'id' => 'team_001',
            'organizationId' => 'org_123456',
            'label' => 'Dev Team Alpha',
            'projectPermissions' => [
                [
                    'projectId' => 'proj_001',
                    'role' => 'admin',
                ],
                [
                    'projectId' => 'proj_002',
                    'role' => 'viewer',
                ],
            ],
            'counts' => [
                'memberCount' => 5,
                'projectCount' => 2,
            ],
            'createdAt' => '2025-01-10T08:30:00Z',
            'updatedAt' => '2025-09-20T14:15:00Z',
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($teamFake)
            ));

        $result = $this->task->create($orgId, $label, $projectPermissions);
        $this->assertEquals($orgId, $result->getOrganizationId());
        $this->assertEquals($label, $result->getLabel());
        $this->assertEquals(
            $projectPermissions,
            json_decode(json_encode($result->getProjectPermissions()), true)
        );
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testCreateError(): void
    {
        $orgId = 'org_123456';
        $label = 'Dev Team Alpha';
        $projectPermissions = [
            [
                'projectId' => 'proj_001',
                'role' => 'admin',
            ],
            [
                'projectId' => 'proj_002',
                'role' => 'viewer',
            ],
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                403,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'unauthorized',
                    'code' => 403
                ])
            ));

        $this->expectException(ApiException::class);

        $this->task->create($orgId, $label, $projectPermissions);
    }

    /**
     * @throws Exception
     */
    public function testCreateMember(): void
    {
        $userId = 'user-123';
        $teamId = 'team-123';

        $teamMemberFake = [
            'teamId' => $teamId,
            'userId' => $userId,
            'createdAt' => '2025-01-15T08:00:00Z',
            'updatedAt' => '2025-09-20T10:30:00Z',
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($teamMemberFake)
            ));

        $result = $this->task->createMember($teamId, $userId);
        $this->assertSame($teamId, $result->getTeamId());
        $this->assertSame($userId, $result->getUserId());
    }

    public function testCreateMemberError(): void
    {
        $userId = 'user-123';
        $teamId = 'team-123';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                403,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'unauthorized',
                    'code' => 403
                ])
            ));

        $this->expectException(ApiException::class);

        $this->task->createMember($teamId, $userId);
    }

    /**
     * @throws Exception
     */
    public function testDeleteMember(): void
    {
        $userId = 'user-123';
        $teamId = 'team-123';

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                204,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'No content',
                    'code' => 204
                ])
            ));

        $this->task->deleteMember($teamId, $userId);
    }

    /**
     * @throws Exception
     */
    public function testDeleteMemberError(): void
    {
        $userId = 'user-123';
        $teamId = 'team-123';


        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                403,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'unauthorized',
                    'code' => 403
                ])
            ));

        $this->expectException(ApiException::class);

        $this->task->deleteMember($teamId, $userId);
    }

    public function testGet(): void
    {
        $teamId = 'team-123';
        $teamFake = [
            'id' => $teamId,
            'organizationId' => 'org_123456',
            'label' => 'Dev Team Alpha',
            'projectPermissions' => [
                [
                    'projectId' => 'proj_001',
                    'role' => 'admin',
                ],
                [
                    'projectId' => 'proj_002',
                    'role' => 'viewer',
                ],
            ],
            'counts' => [
                'memberCount' => 5,
                'projectCount' => 2,
            ],
            'createdAt' => '2025-01-10T08:30:00Z',
            'updatedAt' => '2025-09-20T14:15:00Z',
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($teamFake)
            ));

        $result = $this->task->get($teamId);
        $this->assertInstanceOf(Team::class, $result);
        $this->assertObjectProperties($result, $teamFake);
    }

    public function testGetError(): void
    {
        $teamId = 'team-123';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                403,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'unauthorized',
                    'code' => 403
                ])
            ));

        $this->expectException(ApiException::class);

        $this->task->get($teamId);
    }

    public function testList(): void
    {
        $list = [
            'items' => [
                [
                    'id' => 'team_001',
                    'organizationId' => 'org_123',
                    'label' => 'Dev Team Alpha',
                    'projectPermissions' => [
                        [
                            'projectId' => 'proj_001',
                            'role' => 'admin',
                        ],
                        [
                            'projectId' => 'proj_002',
                            'role' => 'viewer',
                        ],
                    ],
                    'counts' => [
                        'memberCount' => 5,
                        'projectCount' => 2,
                    ],
                    'createdAt' => '2025-01-10T08:30:00Z',
                    'updatedAt' => '2025-09-20T14:15:00Z',
                ],
                [
                    'id' => 'team_002',
                    'organizationId' => 'org_456',
                    'label' => 'Dev Team Beta',
                    'projectPermissions' => [
                        [
                            'projectId' => 'proj_001',
                            'role' => 'admin',
                        ],
                        [
                            'projectId' => 'proj_002',
                            'role' => 'viewer',
                        ],
                    ],
                    'counts' => [
                        'memberCount' => 5,
                        'projectCount' => 2,
                    ],
                    'createdAt' => '2025-01-10T08:30:00Z',
                    'updatedAt' => '2025-09-20T14:15:00Z',
                ]
            ],
            'count' => 2,
            '_links' => [
                'self' => [
                    'href' => 'https://api.example.com/teams?page=1',
                ],
                'previous' => [
                    'href' => 'https://api.example.com/teams?page=0',
                ],
                'next' => [
                    'href' => 'https://api.example.com/teams?page=2',
                ],
            ]
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($list)
            ));

        $filterOrganizationId = ['org_123', 'org_456'];
        $filterId = ['team_001', 'team_002'];
        $filterUpdatedAt = ['2025-09-01T00:00:00Z', '2025-09-15T00:00:00Z'];
        $pageSize = 10;
        $pageBefore = null;
        $pageAfter = 'cursor_abc123';
        $sort = 'createdAt:desc';

        $result = $this->task->list(
            $filterOrganizationId,
            $filterId,
            $filterUpdatedAt,
            $pageSize,
            $pageBefore,
            $pageAfter,
            $sort
        );
        $this->assertInstanceOf(ListTeams200Response::class, $result);
        $this->assertContainsOnlyInstancesOf(Team::class, $result->getItems());
        $this->assertObjectMatchesArray($result->getItems(), $list['items']);
    }

    public function testListError(): void
    {
        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                403,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'unauthorized',
                    'code' => 403
                ])
            ));

        $this->expectException(ApiException::class);

        $filterOrganizationId = ['org_123', 'org_456'];
        $filterId = ['team_001', 'team_002'];
        $filterUpdatedAt = ['2025-09-01T00:00:00Z', '2025-09-15T00:00:00Z'];
        $pageSize = 10;
        $pageBefore = null;
        $pageAfter = 'cursor_abc123';
        $sort = 'createdAt:desc';

        $this->task->list(
            $filterOrganizationId,
            $filterId,
            $filterUpdatedAt,
            $pageSize,
            $pageBefore,
            $pageAfter,
            $sort
        );
    }

    public function testListMembers(): void
    {
        $teamId = 'team_001';
        $pageBefore = '2';
        $pageAfter = '2';
        $sort = 'teamId';

        $fakeResponse = [
            'items' => [
                [
                    'teamId' => 'team_001',
                    'userId' => 'user_123',
                    'createdAt' => '2025-09-01T10:00:00Z',
                    'updatedAt' => '2025-09-24T12:00:00Z',
                ],
                [
                    'teamId' => 'team_001',
                    'userId' => 'user_456',
                    'createdAt' => '2025-09-05T11:30:00Z',
                    'updatedAt' => '2025-09-24T13:45:00Z',
                ],
            ],
            'links' => [
                'self' => [
                    'href' => 'https://api.example.com/team-members?page=1',
                ],
                'previous' => [
                    'href' => 'https://api.example.com/team-members?page=0',
                ],
                'next' => [
                    'href' => 'https://api.example.com/team-members?page=2',
                ],
            ],
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($fakeResponse)
            ));

        $result = $this->task->listMembers($teamId, $pageBefore, $pageAfter, $sort);

        $this->assertInstanceOf(ListTeamMembers200Response::class, $result);
        $this->assertContainsOnlyInstancesOf(TeamMember::class, $result->getItems());
        $this->assertObjectMatchesArray($result->getItems(), $fakeResponse['items']);
    }


    public function testListMembersError(): void
    {
        $teamId = 'team_001';
        $pageBefore = '2';
        $pageAfter = '2';
        $sort = 'teamId';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                403,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'unauthorized',
                    'code' => 403
                ])
            ));

        $this->expectException(ApiException::class);

        $this->task->listMembers($teamId, $pageBefore, $pageAfter, $sort);
    }

    public function testListUserTeams(): void
    {
        $userId = 'user_123';
        $filterOrganizationId = ['org_001', 'org_002'];
        $filterUpdatedAt = ['2025-09-01T00:00:00Z', '2025-09-24T12:00:00Z'];
        $pageSize = 10;
        $pageBefore = null;
        $pageAfter = null;
        $sort = 'createdAt:desc';

        // Fake response
        $fakeResponse = [
            'items' => [
                [
                    'id' => 'team_001',
                    'organizationId' => 'org_001',
                    'label' => 'Dev Team Alpha',
                    'projectPermissions' => [
                        ['projectId' => 'proj_001', 'role' => 'admin']
                    ],
                    'counts' => [
                        'memberCount' => 5,
                        'projectCount' => 2,
                    ],
                    'createdAt' => '2025-01-10T08:30:00Z',
                    'updatedAt' => '2025-09-20T14:15:00Z',
                ],
                [
                    'id' => 'team_002',
                    'organizationId' => 'org_002',
                    'label' => 'QA Team Beta',
                    'projectPermissions' => [
                        ['projectId' => 'proj_002', 'role' => 'viewer']
                    ],
                    'counts' => [
                        'memberCount' => 3,
                        'projectCount' => 1,
                    ],
                    'createdAt' => '2025-02-12T09:45:00Z',
                    'updatedAt' => '2025-09-21T10:00:00Z',
                ],
            ],
            'links' => [
                'self' => ['href' => 'https://api.example.com/user-teams?page=1'],
                'previous' => ['href' => 'https://api.example.com/user-teams?page=0'],
                'next' => ['href' => 'https://api.example.com/user-teams?page=2'],
            ],
        ];

        // Mock the API response
        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($fakeResponse)
            ));

        // Call the method
        $result = $this->task->listUserTeams(
            $userId,
            $filterOrganizationId,
            $filterUpdatedAt,
            $pageSize,
            $pageBefore,
            $pageAfter,
            $sort
        );

        // Assertions
        $this->assertInstanceOf(ListTeams200Response::class, $result);
        $this->assertContainsOnlyInstancesOf(Team::class, $result->getItems());
        $this->assertObjectMatchesArray($result->getItems(), $fakeResponse['items']);
    }


    public function testListUserTeamsError(): void
    {
        $userId = 'user_123';
        $filterOrganizationId = ['org_001', 'org_002'];
        $filterUpdatedAt = ['2025-09-01T00:00:00Z', '2025-09-24T12:00:00Z'];
        $pageSize = 10;
        $pageBefore = null;
        $pageAfter = null;
        $sort = 'createdAt:desc';

        // Mock the API response
        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                403,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'unauthorized',
                    'code' => 403
                ])
            ));

        $this->expectException(ApiException::class);

        // Call the method
        $this->task->listUserTeams(
            $userId,
            $filterOrganizationId,
            $filterUpdatedAt,
            $pageSize,
            $pageBefore,
            $pageAfter,
            $sort
        );
    }

    public function testUpdateTeamSuccess(): void
    {
        $teamId = 'team_001';
        $updateData = [
            'label' => 'Updated Team Label',
            'projectPermissions' => [
                ['projectId' => 'proj_001', 'role' => 'admin'],
                ['projectId' => 'proj_002', 'role' => 'viewer'],
            ]
        ];

        $teamFake = [
            'id' => $teamId,
            'organizationId' => 'org_123',
            'label' => 'Updated Team Label',
            'projectPermissions' => $updateData['projectPermissions'],
            'counts' => [
                'memberCount' => 5,
                'projectCount' => 2,
            ],
            'createdAt' => '2025-01-10T08:30:00Z',
            'updatedAt' => '2025-09-26T14:00:00Z',
        ];

        // Mock API response
        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($teamFake)
            ));

        // Call the method
        $result = $this->task->update($teamId, $updateData);

        // Assertions
        $this->assertInstanceOf(Team::class, $result);
        $this->assertEquals($teamId, $result->getId());
        $this->assertEquals($updateData['label'], $result->getLabel());
        $this->assertSame(
            $updateData['projectPermissions'],
            json_decode(json_encode($result->getProjectPermissions()), true)
        );
    }


    public function testUpdateTeamError(): void
    {
        $teamId = 'team_001';
        $updateData = [
            'label' => 'Updated Team Label',
            'projectPermissions' => [
                ['projectId' => 'proj_001', 'role' => 'admin'],
            ]
        ];

        // Mock API response with error
        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                403,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'unauthorized',
                    'code' => 403
                ])
            ));

        $this->expectException(ApiException::class);

        // Call the method
        $this->task->update($teamId, $updateData);
    }


    public function testGetMemberSuccess(): void
    {
        $teamId = 'team_001';
        $userId = 'user_123';

        // Fake PHP array
        $teamMemberFake = [
            'teamId' => $teamId,
            'userId' => $userId,
            'createdAt' => '2025-01-10T08:30:00Z',
            'updatedAt' => '2025-09-26T14:00:00Z',
        ];

        // Mock API to return JSON
        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($teamMemberFake)
            ));

        // Call the method
        $result = $this->task->getMember($teamId, $userId);

        // Assertions
        $this->assertInstanceOf(TeamMember::class, $result);
        $this->assertEquals($teamId, $result->getTeamId());
        $this->assertEquals($userId, $result->getUserId());
    }

    public function testGetMemberError(): void
    {
        $teamId = 'team_001';
        $userId = 'user_123';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                403,
                ['Content-Type' => 'application/json'],
                json_encode(['status' => 'unauthorized', 'code' => 403])
            ));

        $this->expectException(ApiException::class);

        $this->task->getMember($teamId, $userId);
    }

    public function testGetProjectTeamAccessSuccess(): void
    {
        $projectId = 'proj_001';
        $teamId = 'team_001';

        $teamProjectAccessFake = [
            'teamId' => $teamId,
            'organizationId' => 'org_123',
            'projectId' => $projectId,
            'projectTitle' => 'Awesome Project',
            'grantedAt' => '2025-09-01T10:00:00Z',
            'updatedAt' => '2025-09-24T12:00:00Z',
            'links' => [
                'self' => [
                    'title' => 'Self Link',
                    'href' => 'https://api.example.com/team-project-access/team_001/proj_001',
                ],
                'update' => [
                    'title' => 'Update Link',
                    'href' => 'https://api.example.com/team-project-access/team_001/proj_001/update',
                ],
                'delete' => [
                    'title' => 'Delete Link',
                    'href' => 'https://api.example.com/team-project-access/team_001/proj_001/delete',
                ],
            ],
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($teamProjectAccessFake)
            ));

        $result = $this->task->getProjectTeamAccess($projectId, $teamId);

        $this->assertInstanceOf(TeamProjectAccess::class, $result);
        $this->assertEquals($teamId, $result->getTeamId());
        $this->assertEquals($projectId, $result->getProjectId());
        $this->assertEquals('Awesome Project', $result->getProjectTitle());
    }


    public function testGetProjectTeamAccessError(): void
    {
        $projectId = 'proj_001';
        $teamId = 'team_001';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                403,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'unauthorized',
                    'code' => 403
                ])
            ));

        $this->expectException(ApiException::class);

        $this->task->getProjectTeamAccess($projectId, $teamId);
    }

    public function testGetTeamProjectAccessSuccess(): void
    {
        $teamId = 'team_001';
        $projectId = 'proj_001';

        $teamProjectAccessFake = [
            'teamId' => $teamId,
            'organizationId' => 'org_123',
            'projectId' => $projectId,
            'projectTitle' => 'Awesome Project',
            'grantedAt' => '2025-09-01T10:00:00Z',
            'updatedAt' => '2025-09-24T12:00:00Z',
            'links' => [
                'self' => [
                    'title' => 'Self Link',
                    'href' => 'https://api.example.com/team-project-access/team_001/proj_001',
                ],
                'update' => [
                    'title' => 'Update Link',
                    'href' => 'https://api.example.com/team-project-access/team_001/proj_001/update',
                ],
                'delete' => [
                    'title' => 'Delete Link',
                    'href' => 'https://api.example.com/team-project-access/team_001/proj_001/delete',
                ],
            ],
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($teamProjectAccessFake)
            ));

        $result = $this->task->getTeamProjectAccess($teamId, $projectId);

        $this->assertInstanceOf(TeamProjectAccess::class, $result);
        $this->assertEquals($teamId, $result->getTeamId());
        $this->assertEquals($projectId, $result->getProjectId());
        $this->assertEquals('Awesome Project', $result->getProjectTitle());
        $this->assertEquals(
            'https://api.example.com/team-project-access/team_001/proj_001',
            $result->getLinks()->getSelf()->getHref()
        );
    }

    public function testGetTeamProjectAccessError(): void
    {
        $teamId = 'team_001';
        $projectId = 'proj_001';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                403,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'unauthorized',
                    'code' => 403,
                    'message' => 'User does not have access to this project'
                ])
            ));

        $this->expectException(ApiException::class);

        $this->task->getTeamProjectAccess($teamId, $projectId);
    }

    public function testListTeamProjectAccessSuccess(): void
    {
        $teamId = 'team_001';
        $pageSize = 10;
        $pageBefore = null;
        $pageAfter = null;
        $sort = 'grantedAt:desc';

        $listTeamProjectAccessFake = [
            'items' => [
                [
                    'teamId' => $teamId,
                    'organizationId' => 'org_123',
                    'projectId' => 'proj_001',
                    'projectTitle' => 'Awesome Project',
                    'grantedAt' => '2025-09-01T10:00:00Z',
                    'updatedAt' => '2025-09-24T12:00:00Z',
                    'links' => [
                        'self' => [
                            'title' => 'Self Link',
                            'href' => 'https://api.example.com/team-project-access/team_001/proj_001',
                        ],
                        'update' => [
                            'title' => 'Update Link',
                            'href' => 'https://api.example.com/team-project-access/team_001/proj_001/update',
                        ],
                        'delete' => [
                            'title' => 'Delete Link',
                            'href' => 'https://api.example.com/team-project-access/team_001/proj_001/delete',
                        ],
                    ],
                ],
                [
                    'teamId' => $teamId,
                    'organizationId' => 'org_123',
                    'projectId' => 'proj_002',
                    'projectTitle' => 'Next Project',
                    'grantedAt' => '2025-09-05T11:30:00Z',
                    'updatedAt' => '2025-09-24T13:45:00Z',
                    'links' => [
                        'self' => [
                            'title' => 'Self Link',
                            'href' => 'https://api.example.com/team-project-access/team_001/proj_002',
                        ],
                        'update' => [
                            'title' => 'Update Link',
                            'href' => 'https://api.example.com/team-project-access/team_001/proj_002/update',
                        ],
                        'delete' => [
                            'title' => 'Delete Link',
                            'href' => 'https://api.example.com/team-project-access/team_001/proj_002/delete',
                        ],
                    ],
                ],
            ],
            'links' => [
                'self' => [
                    'href' => 'https://api.example.com/team-project-access?teamId=team_001&page=1',
                ],
                'previous' => [
                    'href' => 'https://api.example.com/team-project-access?teamId=team_001&page=0',
                ],
                'next' => [
                    'href' => 'https://api.example.com/team-project-access?teamId=team_001&page=2',
                ],
            ],
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($listTeamProjectAccessFake)
            ));

        $result = $this->task->listTeamProjectAccess($teamId, $pageSize, $pageBefore, $pageAfter, $sort);

        $this->assertInstanceOf(ListProjectTeamAccess200Response::class, $result);
        $this->assertCount(2, $result->getItems());
        $this->assertEquals($teamId, $result->getItems()[0]->getTeamId());
        $this->assertEquals('proj_001', $result->getItems()[0]->getProjectId());
        $this->assertEquals('Awesome Project', $result->getItems()[0]->getProjectTitle());
    }

    public function testListTeamProjectAccessError(): void
    {
        $teamId = 'team_001';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                403,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'unauthorized',
                    'code' => 403,
                    'message' => 'User does not have permission to list project access'
                ])
            ));

        $this->expectException(ApiException::class);

        $this->task->listTeamProjectAccess($teamId);
    }
}
