<?php

namespace Upsun\Tests\Core\Tasks;

use Exception;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Upsun\Api\ApiConfiguration;
use Upsun\Api\ApiException;
use Upsun\Api\ReferencesApi;
use Upsun\Api\TeamAccessApi;
use Upsun\Api\TeamsApi;
use Upsun\Core\Tasks\TeamsTask;
use Upsun\Model\{ListProjectTeamAccess200Response,
    ListTeamMembers200Response,
    ListTeams200Response,
    Team,
    TeamMember};
use Upsun\UpsunClient;

class TeamsTaskTest extends BaseTestCase
{
    private TeamsTask $task;

    /**
     * @var ClientInterface&\PHPUnit\Framework\MockObject\MockObject
     */
    private ClientInterface $httpClient;

    protected function setUp(): void
    {
        $this->httpClient = $this->createMock(ClientInterface::class);

        $upsunClient = $this->createMock(UpsunClient::class);

        $apiClassParams = [
            static fn (bool $force = false): string => 'Bearer test-token',
            $this->httpClient,
            new Psr17Factory(),
            new ApiConfiguration()
        ];

        $this->task = new class (
            $upsunClient,
            new TeamsApi(...$apiClassParams),
            new TeamAccessApi(...$apiClassParams),
            new ReferencesApi(...$apiClassParams),
        ) extends TeamsTask {
        };
    }

    /**
     * @throws ClientExceptionInterface
     */
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

        $result = $this->task->create(organizationId: $orgId, label: $label, projectPermissions: $projectPermissions);
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

        $this->task->create(organizationId: $orgId, label: $label, projectPermissions: $projectPermissions);
    }



    /**
     * @throws Exception
     * @throws ClientExceptionInterface
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

        $this->task->deleteMember(teamId: $teamId, userId: $userId);
    }

    /**
     * @throws Exception
     * @throws ClientExceptionInterface
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

        $this->task->deleteMember(teamId: $teamId, userId: $userId);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testListReferencedTeams(): void
    {
        $expected = [
            'team-1' => [
                'id' => 'team-1',
                'organizationId' => 'org-1',
                'label' => 'Team One',
                'projectPermissions' => [],
                'counts' => [
                    'memberCount' => 2,
                    'projectCount' => 1,
                ],
                'createdAt' => '2025-01-01T00:00:00+00:00',
                'updatedAt' => '2025-01-02T00:00:00+00:00',
            ],
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($expected)
            ));

        $result = $this->task->listReferencedTeams('abc', 'sig123');

        $this->assertIsArray($result);
        $this->assertArrayHasKey('team-1', $result);
        $this->assertEquals('Team One', $result['team-1']->getLabel());
    }

    public function testListReferencedTeamsWithEmptySig(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->task->listReferencedTeams('abc', '');
    }

    public function testListReferencedTeamsWithEmptyIn(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->task->listReferencedTeams('', 'sig123');
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
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

        $result = $this->task->get(teamId: $teamId);
        $this->assertInstanceOf(Team::class, $result);
        $this->assertObjectProperties($result, $teamFake);
    }

    /**
     * @throws ClientExceptionInterface
     */
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

        $this->task->get(teamId: $teamId);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
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
            filterOrganizationId: $filterOrganizationId,
            filterId: $filterId,
            filterUpdatedAt: $filterUpdatedAt,
            pageSize: $pageSize,
            pageBefore: $pageBefore,
            pageAfter: $pageAfter,
            sort: $sort
        );
        $this->assertInstanceOf(ListTeams200Response::class, $result);
        $this->assertContainsOnlyInstancesOf(Team::class, $result->getItems());
        $this->assertObjectMatchesArray($result->getItems(), $list['items']);
    }

    /**
     * @throws ClientExceptionInterface
     */
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
            filterOrganizationId: $filterOrganizationId,
            filterId: $filterId,
            filterUpdatedAt: $filterUpdatedAt,
            pageSize: $pageSize,
            pageBefore: $pageBefore,
            pageAfter: $pageAfter,
            sort: $sort
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
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

        $result = $this->task->listMembers(
            teamId: $teamId,
            pageBefore: $pageBefore,
            pageAfter: $pageAfter,
            sort: $sort
        );

        $this->assertInstanceOf(ListTeamMembers200Response::class, $result);
        $this->assertContainsOnlyInstancesOf(TeamMember::class, $result->getItems());
        $this->assertObjectMatchesArray($result->getItems(), $fakeResponse['items']);
    }

    /**
     * @throws ClientExceptionInterface
     */
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

        $this->task->listMembers(
            teamId: $teamId,
            pageBefore: $pageBefore,
            pageAfter: $pageAfter,
            sort: $sort
        );
    }



    /**
     * @throws ClientExceptionInterface
     */
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
        $result = $this->task->update(
            teamId: $teamId,
            label: 'Updated Team Label',
            projectPermissions: [
                ['projectId' => 'proj_001', 'role' => 'admin'],
                ['projectId' => 'proj_002', 'role' => 'viewer'],
            ]
        );

        // Assertions
        $this->assertInstanceOf(Team::class, $result);
        $this->assertEquals($teamId, $result->getId());
        $this->assertEquals($updateData['label'], $result->getLabel());
        $this->assertSame(
            $updateData['projectPermissions'],
            json_decode(json_encode($result->getProjectPermissions()), true)
        );
    }


    /**
     * @throws ClientExceptionInterface
     */
    public function testUpdateTeamError(): void
    {
        $teamId = 'team_001';

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
        $this->task->update(
            teamId: $teamId,
            label: 'Updated Team Label',
            projectPermissions: [
                ['projectId' => 'proj_001', 'role' => 'admin'],
                ['projectId' => 'proj_002', 'role' => 'viewer'],
            ]
        );
    }


    /**
     * @throws ClientExceptionInterface
     */
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
        $result = $this->task->getMember(teamId: $teamId, userId: $userId);

        // Assertions
        $this->assertInstanceOf(TeamMember::class, $result);
        $this->assertEquals($teamId, $result->getTeamId());
        $this->assertEquals($userId, $result->getUserId());
    }

    /**
     * @throws ClientExceptionInterface
     */
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

        $this->task->getMember(teamId: $teamId, userId: $userId);
    }





    /**
     * @throws ClientExceptionInterface
     */
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

        $result = $this->task->listTeamProjectAccess(
            teamId: $teamId,
            pageSize: $pageSize,
            pageBefore: $pageBefore,
            pageAfter: $pageAfter,
            sort: $sort
        );

        $this->assertInstanceOf(ListProjectTeamAccess200Response::class, $result);
        $this->assertCount(2, $result->getItems());
        $this->assertEquals($teamId, $result->getItems()[0]->getTeamId());
        $this->assertEquals('proj_001', $result->getItems()[0]->getProjectId());
        $this->assertEquals('Awesome Project', $result->getItems()[0]->getProjectTitle());
    }

    /**
     * @throws ClientExceptionInterface
     */
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

        $this->task->listTeamProjectAccess(teamId: $teamId);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testDeleteSuccess(): void
    {
        $teamId = 'team123';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                204,
                ['Content-Type' => 'application/json'],
                ''
            ));

        $this->expectNotToPerformAssertions();

        $this->task->delete(teamId: $teamId);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testDeleteError(): void
    {
        $teamId = 'team123';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                403,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'forbidden',
                    'code' => 403,
                    'message' => 'Access denied'
                ])
            ));

        $this->expectException(ApiException::class);
        $this->task->delete(teamId: $teamId);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testDeleteNotFound(): void
    {
        $teamId = 'invalidTeam';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                404,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'not_found',
                    'code' => 404,
                    'message' => 'Team not found'
                ])
            ));

        $this->expectException(ApiException::class);
        $this->task->delete(teamId: $teamId);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testDeleteConflict(): void
    {
        $teamId = 'team123';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                409,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'conflict',
                    'code' => 409,
                    'message' => 'Team cannot be deleted because it has active members or projects'
                ])
            ));

        $this->expectException(ApiException::class);
        $this->task->delete(teamId: $teamId);
    }
}
