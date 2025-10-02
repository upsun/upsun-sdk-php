<?php

namespace Upsun\Test\Core;

use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use Psr\Http\Client\ClientInterface;
use Upsun\ApiException;
use Upsun\Api\OrganizationInvitationsApi;
use Upsun\Api\ProjectInvitationsApi;
use Upsun\Configuration;
use Upsun\Core\OAuthProvider;
use Upsun\Model\OrganizationInvitation;
use Upsun\Model\ProjectInvitation;
use PHPUnit\Framework\TestCase;
use Upsun\Core\Tasks\InvitationsTask;
use Upsun\UpsunClient;

class InvitationsTaskTest extends BaseTestCase
{
    private readonly InvitationsTask $invitationTask;
    private ClientInterface $httpClient;

    protected function setUp(): void
    {
        $psr17Factory = new Psr17Factory();

        $this->httpClient = $this->createMock(ClientInterface::class);

        $oauthProvider = $this->createMock(OAuthProvider::class);

        $orgInvitationApi = new OrganizationInvitationsApi(
            $oauthProvider,
            $this->httpClient,
            $psr17Factory,
            new Configuration()
        );

        $projectInvitationApi = new ProjectInvitationsApi(
            $oauthProvider,
            $this->httpClient,
            $psr17Factory,
            new Configuration()
        );

        $upsunClient = $this->createMock(UpsunClient::class);

        $this->invitationTask = new class (
            $upsunClient,
            $orgInvitationApi,
            $projectInvitationApi
        ) extends InvitationsTask {
        };
    }


    // Organization Invitation Tests

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

        $this->invitationTask->cancelOrgInvite($organizationId, $invitationId);
    }

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

        $this->invitationTask->cancelOrgInvite($organizationId, $invitationId);
    }

    /**
     * @throws \Exception
     */
    public function testCreateOrgInvite(): void
    {
        $organizationId = 'org-123';
        $email = 'test@example.com';
        $permissions = ['read', 'write'];
        $force = false;

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
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
                ])
            ));

        $response = $this->invitationTask->createOrgInvite($organizationId, $email, $permissions, $force);
        $this->assertInstanceOf(OrganizationInvitation::class, $response);
    }

    /**
     * @throws \Exception
     */
    public function testCreateOrgInviteWithDefaultForce(): void
    {
        $organizationId = 'org-123';
        $email = 'test@example.com';
        $permissions = ['read', 'write'];
        $force = true;

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
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
                ])
            ));

        $this->invitationTask->createOrgInvite($organizationId, $email, $permissions, $force);
    }

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

        $this->invitationTask->createOrgInvite($organizationId, $email, $permissions);
    }

    /**
     * @throws \Exception
     */
    public function testListOrgInvites(): void
    {
        $organizationId = 'org-123';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
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
                ])
            ));

        $result = $this->invitationTask->listOrgInvites($organizationId);

        $this->assertIsArray($result);
        $this->assertContainsOnlyInstancesOf(OrganizationInvitation::class, $result);

        $this->assertEquals("invite_123456", $result[0]->getId());
        $this->assertEquals("org_78910", $result[0]->getOrganizationId());
        $this->assertEquals("user@example.com", $result[0]->getEmail());
        $this->assertEquals(['read', 'write'], $result[0]->getPermissions());

        $this->assertEquals("invite_789123", $result[1]->getId());
        $this->assertEquals("org_78910", $result[1]->getOrganizationId());
        $this->assertEquals("user2@example.com", $result[1]->getEmail());
        $this->assertEquals(['read', 'write', 'admin'], $result[1]->getPermissions());
    }

    public function testListOrgInvitesWithParameters(): void
    {
        $organizationId = 'org-123';
        $filterState = ['pending'];
        $pageSize = 10;
        $pageBefore = 'cursor-before';
        $pageAfter = 'cursor-after';
        $sort = 'created_at';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
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
                ])
            ));

        $result = $this->invitationTask->listOrgInvites(
            $organizationId,
            $filterState,
            $pageSize,
            $pageBefore,
            $pageAfter,
            $sort
        );

        $this->assertIsArray($result);
        $this->assertContainsOnlyInstancesOf(OrganizationInvitation::class, $result);

        $this->assertEquals("invite_789123", $result[0]->getId());
        $this->assertEquals("org_78910", $result[0]->getOrganizationId());
        $this->assertEquals("user2@example.com", $result[0]->getEmail());
        $this->assertEquals(['read', 'write', 'admin'], $result[0]->getPermissions());

        $this->assertEquals("invite_123456", $result[1]->getId());
        $this->assertEquals("org_78910", $result[1]->getOrganizationId());
        $this->assertEquals("user@example.com", $result[1]->getEmail());
        $this->assertEquals(['read', 'write'], $result[1]->getPermissions());
    }

    // Project Invitation Tests

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

        $this->invitationTask->cancelProjectInvite($projectId, $invitationId);
    }

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
        $this->invitationTask->cancelProjectInvite($projectId, $invitationId);
    }

    /**
     * @throws \Exception
     */
    public function testCreateProjectInvite(): void
    {
        $projectId = 'project-123';

        $userInvitationData = [
            'email'       => 'jane.doe@example.com',
            'role'        => 'admin',
            'permissions' => ['read', 'write', 'admin'],
            'environments' => [
                ['id' => 'env_001', 'name' => 'production'],
                ['id' => 'env_002', 'name' => 'staging'],
            ],
            'force'       => true,
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
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
                ])
            ));

        $result = $this->invitationTask->createProjectInvite($projectId, $userInvitationData);
        $this->assertInstanceOf(ProjectInvitation::class, $result);
        $this->assertEquals("invite_987654", $result->getId());
        $this->assertEquals("proj_12345", $result->getProjectId());
        $this->assertEquals("jane.doe@example.com", $result->getEmail());
    }

    public function testCreateProjectInviteWithException(): void
    {
        $projectId = 'project-123';
        $this->expectException(ApiException::class);

        $userInvitationData = [
            'email'       => 'jane.doe@example.com',
            'role'        => 'admin',
            'permissions' => ['read', 'write', 'admin'],
            'environments' => [
                ['id' => 'env_001', 'name' => 'production'],
                ['id' => 'env_002', 'name' => 'staging'],
            ],
            'force'       => true,
        ];

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

        $this->invitationTask->createProjectInvite($projectId, $userInvitationData);
    }

    public function testListProjectInvites(): void
    {
        $projectId = 'project-123';

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
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
                ])
            ));

        $result = $this->invitationTask->listProjectInvites($projectId);
        $this->assertIsArray($result);
        $this->assertContainsOnlyInstancesOf(ProjectInvitation::class, $result);

        $this->assertEquals("invite_987654", $result[0]->getId());
        $this->assertEquals("proj_12345", $result[0]->getProjectId());
        $this->assertEquals("jane.doe@example.com", $result[0]->getEmail());

        $this->assertEquals("invite_12345", $result[1]->getId());
        $this->assertEquals("proj_12345", $result[1]->getProjectId());
        $this->assertEquals("john.test@example.com", $result[1]->getEmail());
    }

    public function testListProjectInvitesWithParameters(): void
    {
        $projectId = 'project-123';
        $filterState = ['pending'];
        $pageSize = 10;
        $pageBefore = 'cursor-before';
        $pageAfter = 'cursor-after';
        $sort = 'created_at';

        $projectId = 'project-123';

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
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
                ])
            ));

        $result = $this->invitationTask->listProjectInvites(
            $projectId,
            $filterState,
            $pageSize,
            $pageBefore,
            $pageAfter,
            $sort
        );
        $this->assertIsArray($result);
        $this->assertContainsOnlyInstancesOf(ProjectInvitation::class, $result);

        $this->assertEquals("invite_987654", $result[0]->getId());
        $this->assertEquals("proj_12345", $result[0]->getProjectId());
        $this->assertEquals("jane.doe@example.com", $result[0]->getEmail());

        $this->assertEquals("invite_12345", $result[1]->getId());
        $this->assertEquals("proj_12345", $result[1]->getProjectId());
        $this->assertEquals("john.test@example.com", $result[1]->getEmail());
    }

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

        $result = $this->invitationTask->listProjectInvites($projectId);
    }
}
