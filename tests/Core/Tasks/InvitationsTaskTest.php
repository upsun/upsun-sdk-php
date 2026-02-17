<?php

namespace Upsun\Tests\Core\Tasks;

use Exception;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Upsun\Api\ApiConfiguration;
use Upsun\Api\ApiException;
use Upsun\Api\OrganizationInvitationsApi;
use Upsun\Api\ProjectInvitationsApi;
use Upsun\Core\OAuthProvider;
use Upsun\Core\Tasks\InvitationsTask;
use Upsun\Model\OrganizationInvitation;
use Upsun\Model\ProjectInvitation;
use Upsun\UpsunClient;

class InvitationsTaskTest extends BaseTestCase
{
    private readonly InvitationsTask $invitationTask;

    /**
     * @var ClientInterface&\PHPUnit\Framework\MockObject\MockObject
     */
    private ClientInterface $httpClient;

    protected function setUp(): void
    {
        $this->httpClient = $this->createMock(ClientInterface::class);

        $upsunClient = $this->createMock(UpsunClient::class);

        $apiClassParams = [
            $this->createMock(OAuthProvider::class),
            $this->httpClient,
            new Psr17Factory(),
            new ApiConfiguration()
        ];

        $this->invitationTask = new class (
            $upsunClient,
            new OrganizationInvitationsApi(...$apiClassParams),
            new ProjectInvitationsApi(...$apiClassParams),
        ) extends InvitationsTask {
        };
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testCancelOrgInvite(): void
    {
        $organizationId = 'org-123';
        $invitationId = 'invite-456';

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                204,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'no-content',
                    'code' => 204
                ])
            ));

        $this->invitationTask->cancelOrgInvite(organizationId: $organizationId, invitationId: $invitationId);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testCancelOrgInviteThrowsApiException(): void
    {
        $this->expectException(ApiException::class);

        $organizationId = 'org-123';
        $invitationId = 'invite-456';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                403,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'forbidden',
                    'code' => 403
                ])
            ));
        $this->expectException(ApiException::class);

        $this->invitationTask->cancelOrgInvite(organizationId: $organizationId, invitationId: $invitationId);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testCreateOrgInvite(): void
    {
        $organizationId = 'org-123';
        $email = 'test@example.com';
        $permissions = ['read', 'write'];
        $force = false;
        $data = [
            'finishedAt'     => '2025-09-16T10:15:30+00:00',
            'id'             => 'invite_123456',
            'state'          => 'pending',
            'organizationId' => 'org_78910',
            'email'          => 'user@example.com',
            'owner'          => [
                'id'    => 'owner_42',
                'name'  => 'Alice Dupont',
                'email' => 'alice.dupont@example.com',
            ],
            'createdAt'      => '2025-09-10T08:00:00+00:00',
            'updatedAt'      => '2025-09-12T09:30:00+00:00',
            'permissions'    => [
                'read',
                'write',
            ],
        ];
        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($data)
            ));

        $response = $this->invitationTask->createOrgInvite(
            organizationId: $organizationId,
            email: $email,
            permissions: $permissions,
            force: $force
        );
        $this->assertInstanceOf(OrganizationInvitation::class, $response);
        $this->assertObjectProperties($response, $data);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testCreateOrgInviteWithDefaultForce(): void
    {
        $organizationId = 'org-123';
        $email = 'test@example.com';
        $permissions = ['read', 'write'];
        $force = true;
        $data = [
            'finishedAt'     => '2025-09-16T10:15:30+00:00',
            'id'             => 'invite_123456',
            'state'          => 'pending',
            'organizationId' => 'org_78910',
            'email'          => 'user@example.com',
            'owner'          => [
                'id'    => 'owner_42',
                'name'  => 'Alice Dupont',
                'email' => 'alice.dupont@example.com',
            ],
            'createdAt'      => '2025-09-10T08:00:00+00:00',
            'updatedAt'      => '2025-09-12T09:30:00+00:00',
            'permissions'    => [
                'read',
                'write',
            ],
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($data)
            ));

        $result = $this->invitationTask->createOrgInvite(
            organizationId: $organizationId,
            email: $email,
            permissions: $permissions,
            force: $force
        );

        $this->assertInstanceOf(OrganizationInvitation::class, $result);
        $this->assertObjectProperties($result, $data);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testCreateOrgInviteReturnsError(): void
    {
        $this->expectException(ApiException::class);

        $organizationId = 'org-123';
        $email = 'test@example.com';
        $permissions = ['read', 'write', 'admin'];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                403,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'Forbidden',
                    'code' => 403
                ])
            ));

        $this->invitationTask->createOrgInvite(
            organizationId: $organizationId,
            email: $email,
            permissions: $permissions
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testListOrgInvites(): void
    {
        $organizationId = 'org-123';
        $list = [
            [
                'finishedAt'     => '2025-09-16T10:15:30+00:00',
                'id'             => 'invite_123456',
                'state'          => 'pending',
                'organizationId' => 'org_78910',
                'email'          => 'user@example.com',
                'owner'          => [
                    'id'    => 'owner_42',
                    'name'  => 'Anne Onyme',
                    'email' => 'anne.onyme@example.com',
                ],
                'createdAt'      => '2025-09-10T08:00:00+00:00',
                'updatedAt'      => '2025-09-12T09:30:00+00:00',
                'permissions'    => [
                    'read',
                    'write',
                ]
            ],
            [
                'finishedAt'     => '2025-09-16T10:15:30+00:00',
                'id'             => 'invite_789123',
                'state'          => 'pending',
                'organizationId' => 'org_78910',
                'email'          => 'user2@example.com',
                'owner'          => [
                    'id'    => 'owner_43',
                    'name'  => 'Alice Dupont',
                    'email' => 'alice.dupont@example.com',
                ],
                'createdAt'      => '2025-09-10T08:00:00+00:00',
                'updatedAt'      => '2025-09-12T09:30:00+00:00',
                'permissions'    => [
                    'read',
                    'write',
                    'admin'
                ]
            ]
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($list)
            ));

        $result = $this->invitationTask->listOrgInvites(organizationId: $organizationId);

        $this->assertIsArray($result);
        $this->assertContainsOnlyInstancesOf(OrganizationInvitation::class, $result);
        $this->assertObjectMatchesArray($result, $list);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testListOrgInvitesWithParameters(): void
    {
        $organizationId = 'org-123';
        $filterState = ['pending'];
        $pageSize = 10;
        $pageBefore = 'cursor-before';
        $pageAfter = 'cursor-after';
        $sort = 'created_at';

        $list = [
            [
                'finishedAt'     => '2025-09-16T10:15:30+00:00',
                'id'             => 'invite_789123',
                'state'          => 'pending',
                'organizationId' => 'org_78910',
                'email'          => 'user2@example.com',
                'owner'          => [
                    'id'    => 'owner_43',
                    'name'  => 'Alice Dupont',
                    'email' => 'alice.dupont@example.com',
                ],
                'createdAt'      => '2025-09-10T07:00:00+00:00',
                'updatedAt'      => '2025-09-12T08:30:00+00:00',
                'permissions'    => [
                    'read',
                    'write',
                    'admin'
                ]
            ],
            [
                'finishedAt'     => '2025-09-16T10:15:30+00:00',
                'id'             => 'invite_123456',
                'state'          => 'pending',
                'organizationId' => 'org_78910',
                'email'          => 'user@example.com',
                'owner'          => [
                    'id'    => 'owner_42',
                    'name'  => 'Anne Onyme',
                    'email' => 'anne.onyme@example.com',
                ],
                'createdAt'      => '2025-09-10T08:00:00+00:00',
                'updatedAt'      => '2025-09-12T09:30:00+00:00',
                'permissions'    => [
                    'read',
                    'write',
                ]
            ]
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($list)
            ));

        $result = $this->invitationTask->listOrgInvites(
            organizationId: $organizationId,
            filterState: $filterState,
            pageSize: $pageSize,
            pageBefore: $pageBefore,
            pageAfter: $pageAfter,
            sort: $sort
        );

        $this->assertIsArray($result);
        $this->assertContainsOnlyInstancesOf(OrganizationInvitation::class, $result);
        $this->assertObjectMatchesArray($result, $list);
    }

    // Project Invitation Tests

    /**
     * @throws ClientExceptionInterface
     */
    public function testCancelProjectInvite(): void
    {
        $projectId = 'project-123';
        $invitationId = 'invite-456';

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                204,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'no-content',
                    'code' => 204
                ])
            ));

        $this->invitationTask->cancelProjectInvite(projectId: $projectId, invitationId: $invitationId);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testCancelProjectInviteThrowsApiException(): void
    {
        $projectId = 'project-123';
        $invitationId = 'invite-456';

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                403,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'forbidden',
                    'code' => 403
                ])
            ));
        $this->expectException(ApiException::class);
        $this->invitationTask->cancelProjectInvite(projectId: $projectId, invitationId: $invitationId);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testCreateProjectInvite(): void
    {
        $projectId = 'project-123';
        $data = [
            'finishedAt'  => '2025-09-16T10:15:30+00:00',
            'id'          => 'invite_987654',
            'state'       => 'pending',
            'projectId'   => 'proj_12345',
            'role'        => 'admin',
            'email'       => 'jane.doe@example.com',
            'owner'       => [
                'id'    => 'owner_001',
                'name'  => 'John Doe',
                'email' => 'john.doe@example.com',
            ],
            'createdAt'   => '2025-09-10T08:00:00+00:00',
            'updatedAt'   => '2025-09-12T09:30:00+00:00',
            'environments' => [
                [
                    'id'   => 'env_001',
                    'name' => 'production',
                    'type' => 'main',
                ],
                [
                    'id'   => 'env_002',
                    'name' => 'staging',
                    'type' => 'preprod',
                ],
            ],
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($data)
            ));

        $result = $this->invitationTask->createProjectInvite(
            projectId: $projectId,
            email: 'jane.doe@example.com',
            role: 'admin',
            permissions: ['read', 'write', 'admin'],
            environments: [
                ['id' => 'env_001', 'name' => 'production'],
                ['id' => 'env_002', 'name' => 'staging'],
            ],
            force: true,
        );

        $this->assertInstanceOf(ProjectInvitation::class, $result);
        $this->assertObjectProperties($result, $data);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testCreateProjectInviteWithException(): void
    {
        $projectId = 'project-123';

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                403,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'forbidden',
                    'code' => 403
                ])
            ));

        $this->expectException(ApiException::class);

        $this->invitationTask->createProjectInvite(
            projectId: $projectId,
            email: 'jane.doe@example.com',
            role: 'admin',
            permissions: ['read', 'write', 'admin'],
            environments: [
                ['id' => 'env_001', 'name' => 'production'],
                ['id' => 'env_002', 'name' => 'staging'],
            ],
            force: true,
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testListProjectInvites(): void
    {
        $projectId = 'project-123';
        $list = [
            [
                'finishedAt'  => '2025-09-16T10:15:30+00:00',
                'id'          => 'invite_987654',
                'state'       => 'pending',
                'projectId'   => 'proj_12345',
                'role'        => 'admin',
                'email'       => 'jane.doe@example.com',
                'owner'       => [
                    'id'    => 'owner_001',
                    'name'  => 'John Doe',
                    'email' => 'john.doe@example.com',
                ],
                'createdAt'   => '2025-09-10T08:00:00+00:00',
                'updatedAt'   => '2025-09-12T09:30:00+00:00',
                'environments' => [
                    [
                        'id'   => 'env_001',
                        'name' => 'production',
                        'type' => 'main',
                    ],
                    [
                        'id'   => 'env_002',
                        'name' => 'staging',
                        'type' => 'preprod',
                    ],
                ],
            ],
            [
                'finishedAt'  => '2025-09-16T10:15:30+00:00',
                'id'          => 'invite_12345',
                'state'       => 'pending',
                'projectId'   => 'proj_12345',
                'role'        => 'contributor',
                'email'       => 'john.test@example.com',
                'owner'       => [
                    'id'    => 'owner_001',
                    'name'  => 'John Doe',
                    'email' => 'john.doe@example.com',
                ],
                'createdAt'   => '2025-09-10T08:00:00+00:00',
                'updatedAt'   => '2025-09-12T09:30:00+00:00',
                'environments' => [
                    [
                        'id'   => 'env_001',
                        'name' => 'production',
                        'type' => 'main',
                    ],
                    [
                        'id'   => 'env_002',
                        'name' => 'staging',
                        'type' => 'preprod',
                    ],
                ],
            ]
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($list)
            ));

        $result = $this->invitationTask->listProjectInvites(projectId: $projectId);
        $this->assertIsArray($result);
        $this->assertContainsOnlyInstancesOf(ProjectInvitation::class, $result);
        $this->assertObjectMatchesArray($result, $list);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testListProjectInvitesWithParameters(): void
    {
        $projectId = 'project-123';
        $filterState = ['pending'];
        $pageSize = 10;
        $pageBefore = 'cursor-before';
        $pageAfter = 'cursor-after';
        $sort = 'created_at';
        $list = [
            [
                'finishedAt'  => '2025-09-16T10:15:30+00:00',
                'id'          => 'invite_987654',
                'state'       => 'pending',
                'projectId'   => 'proj_12345',
                'role'        => 'admin',
                'email'       => 'jane.doe@example.com',
                'owner'       => [
                    'id'    => 'owner_001',
                    'name'  => 'John Doe',
                    'email' => 'john.doe@example.com',
                ],
                'createdAt'   => '2025-09-10T08:00:00+00:00',
                'updatedAt'   => '2025-09-12T09:30:00+00:00',
                'environments' => [
                    [
                        'id'   => 'env_001',
                        'name' => 'production',
                        'type' => 'main',
                    ],
                    [
                        'id'   => 'env_002',
                        'name' => 'staging',
                        'type' => 'preprod',
                    ],
                ],
            ],
            [
                'finishedAt'  => '2025-09-16T10:15:30+00:00',
                'id'          => 'invite_12345',
                'state'       => 'pending',
                'projectId'   => 'proj_12345',
                'role'        => 'contributor',
                'email'       => 'john.test@example.com',
                'owner'       => [
                    'id'    => 'owner_001',
                    'name'  => 'John Doe',
                    'email' => 'john.doe@example.com',
                ],
                'createdAt'   => '2025-09-10T08:00:00+00:00',
                'updatedAt'   => '2025-09-12T09:30:00+00:00',
                'environments' => [
                    [
                        'id'   => 'env_001',
                        'name' => 'production',
                        'type' => 'main',
                    ],
                    [
                        'id'   => 'env_002',
                        'name' => 'staging',
                        'type' => 'preprod',
                    ],
                ],
            ]
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($list)
            ));

        $result = $this->invitationTask->listProjectInvites(
            projectId: $projectId,
            filterState: $filterState,
            pageSize: $pageSize,
            pageBefore: $pageBefore,
            pageAfter: $pageAfter,
            sort: $sort
        );

        $this->assertIsArray($result);
        $this->assertContainsOnlyInstancesOf(ProjectInvitation::class, $result);
        $this->assertObjectMatchesArray($result, $list);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testListProjectInvitesReturnsError(): void
    {
        $projectId = 'project-123';

        $this->expectException(ApiException::class);

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                403,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'forbidden',
                    'code' => 403
                ])
            ));

        $this->invitationTask->listProjectInvites(projectId: $projectId);
    }
}
