<?php

namespace Upsun\Tests\Core\Tasks;

use InvalidArgumentException;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Upsun\Api\ApiConfiguration;
use Upsun\Api\ApiException;
use Upsun\Api\OrganizationInvitationsApi;
use Upsun\Api\ProjectInvitationsApi;
use Upsun\Core\Tasks\UsersInvitationsTask;
use Upsun\Model\OrganizationInvitation;
use Upsun\Model\ProjectInvitation;
use Upsun\UpsunClient;

class UsersInvitationsTaskTest extends BaseTestCase
{
    private UsersInvitationsTask $usersInvitationsTask;

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

        $this->usersInvitationsTask = new class (
            $upsunClient,
            new OrganizationInvitationsApi(...$apiClassParams),
            new ProjectInvitationsApi(...$apiClassParams)
        ) extends UsersInvitationsTask {
        };
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testCreateOrgInvite(): void
    {
        $organizationId = 'org-123';
        $email = 'user@example.com';
        $permissions = ['read', 'write'];

        $expectedData = [
            'id' => 'inv-123',
            'email' => $email,
            'permissions' => $permissions,
            'organization_id' => $organizationId,
            'state' => 'pending',
            'created_at' => '2024-01-01T00:00:00+00:00',
            'updated_at' => '2024-01-01T00:00:00+00:00',
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                201,
                ['Content-Type' => 'application/json'],
                json_encode($expectedData)
            ));

        $result = $this->usersInvitationsTask->createOrgInvite(
            organizationId: $organizationId,
            email: $email,
            permissions: $permissions
        );

        $this->assertInstanceOf(OrganizationInvitation::class, $result);
    }

    public function testCreateOrgInviteWithInvalidOrganizationId(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->usersInvitationsTask->createOrgInvite(
            organizationId: '',
            email: 'user@example.com',
            permissions: ['read']
        );
    }

    public function testCreateOrgInviteWithInvalidEmail(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->usersInvitationsTask->createOrgInvite(
            organizationId: 'org-123',
            email: '',
            permissions: ['read']
        );
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testListOrgInvites(): void
    {
        $organizationId = 'org-123';
        $expectedData = [
            [
                'id' => 'inv-1',
                'email' => 'user1@example.com',
                'permissions' => ['read'],
                'organization_id' => $organizationId,
                'state' => 'pending',
                'created_at' => '2024-01-01T00:00:00+00:00',
                'updated_at' => '2024-01-01T00:00:00+00:00',
            ],
            [
                'id' => 'inv-2',
                'email' => 'user2@example.com',
                'permissions' => ['read', 'write'],
                'organization_id' => $organizationId,
                'state' => 'accepted',
                'created_at' => '2024-01-02T00:00:00+00:00',
                'updated_at' => '2024-01-02T00:00:00+00:00',
            ]
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($expectedData)
            ));

        $result = $this->usersInvitationsTask->listOrgInvites(organizationId: $organizationId);

        $this->assertIsArray($result);
        $this->assertCount(2, $result);
        $this->assertContainsOnlyInstancesOf(OrganizationInvitation::class, $result);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testListOrgInvitesWithFilters(): void
    {
        $organizationId = 'org-123';
        $expectedData = [
            [
                'id' => 'inv-1',
                'email' => 'user1@example.com',
                'permissions' => ['read'],
                'organization_id' => $organizationId,
                'state' => 'pending',
                'created_at' => '2024-01-01T00:00:00+00:00',
                'updated_at' => '2024-01-01T00:00:00+00:00',
            ]
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($expectedData)
            ));

        $result = $this->usersInvitationsTask->listOrgInvites(
            organizationId: $organizationId,
            filterState: ['pending'],
            pageSize: 10
        );

        $this->assertIsArray($result);
        $this->assertCount(1, $result);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testCancelOrgInvite(): void
    {
        $organizationId = 'org-123';
        $invitationId = 'inv-456';

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(204));

        $this->usersInvitationsTask->cancelOrgInvite(
            organizationId: $organizationId,
            invitationId: $invitationId
        );

        $this->assertTrue(true); // Assert no exception thrown
    }

    public function testCancelOrgInviteWithInvalidOrganizationId(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->usersInvitationsTask->cancelOrgInvite(
            organizationId: '',
            invitationId: 'inv-123'
        );
    }

    public function testCancelOrgInviteWithInvalidInvitationId(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->usersInvitationsTask->cancelOrgInvite(
            organizationId: 'org-123',
            invitationId: ''
        );
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testCreateProjectInvite(): void
    {
        $projectId = 'proj-123';
        $email = 'user@example.com';
        $role = 'viewer';

        $expectedData = [
            'id' => 'inv-789',
            'email' => $email,
            'role' => $role,
            'project' => $projectId,
            'state' => 'pending',
            'created_at' => '2024-01-01T00:00:00+00:00',
            'updated_at' => '2024-01-01T00:00:00+00:00',
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                201,
                ['Content-Type' => 'application/json'],
                json_encode($expectedData)
            ));

        $result = $this->usersInvitationsTask->createProjectInvite(
            projectId: $projectId,
            email: $email,
            role: $role
        );

        $this->assertInstanceOf(ProjectInvitation::class, $result);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testCreateProjectInviteWithPermissionsAndEnvironments(): void
    {
        $projectId = 'proj-123';
        $email = 'user@example.com';
        $permissions = ['read', 'write'];
        $environments = [
            ['id' => 'env-1', 'name' => 'main'],
            ['id' => 'env-2', 'name' => 'staging']
        ];

        $expectedData = [
            'id' => 'inv-789',
            'email' => $email,
            'permissions' => $permissions,
            'environments' => $environments,
            'project' => $projectId,
            'state' => 'pending',
            'created_at' => '2024-01-01T00:00:00+00:00',
            'updated_at' => '2024-01-01T00:00:00+00:00',
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                201,
                ['Content-Type' => 'application/json'],
                json_encode($expectedData)
            ));

        $result = $this->usersInvitationsTask->createProjectInvite(
            projectId: $projectId,
            email: $email,
            permissions: $permissions,
            environments: $environments
        );

        $this->assertInstanceOf(ProjectInvitation::class, $result);
    }

    public function testCreateProjectInviteWithInvalidProjectId(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->usersInvitationsTask->createProjectInvite(
            projectId: '',
            email: 'user@example.com'
        );
    }

    public function testCreateProjectInviteWithInvalidEmail(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->usersInvitationsTask->createProjectInvite(
            projectId: 'proj-123',
            email: '   '
        );
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testListProjectInvites(): void
    {
        $projectId = 'proj-123';
        $expectedData = [
            [
                'id' => 'inv-1',
                'email' => 'user1@example.com',
                'role' => 'admin',
                'project' => $projectId,
                'state' => 'pending',
                'created_at' => '2024-01-01T00:00:00+00:00',
                'updated_at' => '2024-01-01T00:00:00+00:00',
            ],
            [
                'id' => 'inv-2',
                'email' => 'user2@example.com',
                'role' => 'viewer',
                'project' => $projectId,
                'state' => 'accepted',
                'created_at' => '2024-01-02T00:00:00+00:00',
                'updated_at' => '2024-01-02T00:00:00+00:00',
            ]
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($expectedData)
            ));

        $result = $this->usersInvitationsTask->listProjectInvites(projectId: $projectId);

        $this->assertIsArray($result);
        $this->assertCount(2, $result);
        $this->assertContainsOnlyInstancesOf(ProjectInvitation::class, $result);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testListProjectInvitesReturnsEmptyArray(): void
    {
        $projectId = 'proj-123';

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([])
            ));

        $result = $this->usersInvitationsTask->listProjectInvites(projectId: $projectId);

        $this->assertIsArray($result);
        $this->assertCount(0, $result);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testCancelProjectInvite(): void
    {
        $projectId = 'proj-123';
        $invitationId = 'inv-456';

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(204));

        $this->usersInvitationsTask->cancelProjectInvite(
            projectId: $projectId,
            invitationId: $invitationId
        );

        $this->assertTrue(true); // Assert no exception thrown
    }

    public function testCancelProjectInviteWithInvalidProjectId(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->usersInvitationsTask->cancelProjectInvite(
            projectId: '',
            invitationId: 'inv-123'
        );
    }

    public function testCancelProjectInviteWithInvalidInvitationId(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->usersInvitationsTask->cancelProjectInvite(
            projectId: 'proj-123',
            invitationId: ''
        );
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testCreateOrgInviteError(): void
    {
        $this->expectException(ApiException::class);

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                400,
                ['Content-Type' => 'application/json'],
                json_encode(['message' => 'Email already invited'])
            ));

        $this->usersInvitationsTask->createOrgInvite(
            organizationId: 'org-123',
            email: 'user@example.com',
            permissions: ['read']
        );
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testCreateProjectInviteError(): void
    {
        $this->expectException(ApiException::class);

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                403,
                ['Content-Type' => 'application/json'],
                json_encode(['message' => 'Insufficient permissions'])
            ));

        $this->usersInvitationsTask->createProjectInvite(
            projectId: 'proj-123',
            email: 'user@example.com'
        );
    }
}
