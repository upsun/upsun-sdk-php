<?php

namespace Tests\Unit\Upsun\Core;

use Upsun\ApiException;
use Upsun\Api\OrganizationInvitationsApi;
use Upsun\Api\ProjectInvitationsApi;
use Upsun\Configuration;
use Upsun\Model\CreateOrgInviteRequest;
use Upsun\Model\CreateProjectInviteRequest;
use Upsun\Model\Error;
use Upsun\Model\OrganizationInvitation;
use Upsun\Model\ProjectInvitation;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\HttplugClient;
use Upsun\Core\Tasks\InvitationTask;
use Upsun\UpsunClient;
use Upsun\UpsunConfig;

class InvitationTaskTest extends TestCase
{
    private readonly InvitationTask $invitationTask;
    private OrganizationInvitationsApi $organizationInvitationsApiMock;
    private ProjectInvitationsApi $projectInvitationsApiMock;
    
    private UpsunClient $clientMock;
    protected function setUp(): void
    {
        $this->organizationInvitationsApiMock = $this->createMock(OrganizationInvitationsApi::class);
        $this->projectInvitationsApiMock = $this->createMock(ProjectInvitationsApi::class);

        $this->clientMock = new class() extends UpsunClient {
            public HttplugClient $apiClient;
            public Configuration $apiConfig;

            public UpsunConfig $upsunConfig;

            public function __construct()
            {
            }
        };
        
        $this->invitationTask = new class(
            $this->clientMock,
            $this->organizationInvitationsApiMock,
            $this->projectInvitationsApiMock
        ) extends InvitationTask {
            public function refreshToken(): void
            {
            }
        };
    }


    // Organization Invitation Tests

    public function testCancelOrgInvite(): void
    {
        $organizationId = 'org-123';
        $invitationId = 'invite-456';

        $this->organizationInvitationsApiMock
            ->expects($this->once())
            ->method('cancelOrgInvite')
            ->with($organizationId, $invitationId);

        $this->invitationTask->cancelOrgInvite($organizationId, $invitationId);
    }

    public function testCancelOrgInviteThrowsApiException(): void
    {
        $organizationId = 'org-123';
        $invitationId = 'invite-456';

        $this->organizationInvitationsApiMock
            ->expects($this->once())
            ->method('cancelOrgInvite')
            ->with($organizationId, $invitationId)
            ->willThrowException($this->createMock(ApiException::class));

        $this->expectException(ApiException::class);
        $this->invitationTask->cancelOrgInvite($organizationId, $invitationId);
    }

    public function testCreateOrgInvite(): void
    {
        $organizationId = 'org-123';
        $email = 'test@example.com';
        $permissions = ['read', 'write'];
        $force = true;

        $expectedInvitation = new OrganizationInvitation();
        $expectedRequest = new CreateOrgInviteRequest([
            'email' => $email,
            'permissions' => $permissions,
            'force' => $force
        ]);

        $this->organizationInvitationsApiMock
            ->expects($this->once())
            ->method('createOrgInvite')
            ->with($organizationId, $this->callback(function ($request) use ($expectedRequest) {
                return $request instanceof CreateOrgInviteRequest &&
                    $request->getEmail() === $expectedRequest->getEmail() &&
                    $request->getPermissions() === $expectedRequest->getPermissions() &&
                    $request->getForce() === $expectedRequest->getForce();
            }))
            ->willReturn($expectedInvitation);

        $result = $this->invitationTask->createOrgInvite($organizationId, $email, $permissions, $force);

        $this->assertSame($expectedInvitation, $result);
    }

    public function testCreateOrgInviteWithDefaultForce(): void
    {
        $organizationId = 'org-123';
        $email = 'test@example.com';
        $permissions = ['read'];

        $expectedInvitation = new OrganizationInvitation();

        $this->organizationInvitationsApiMock
            ->expects($this->once())
            ->method('createOrgInvite')
            ->with($organizationId, $this->callback(function ($request) {
                return $request instanceof CreateOrgInviteRequest &&
                    $request->getForce() === true; // Default value
            }))
            ->willReturn($expectedInvitation);

        $result = $this->invitationTask->createOrgInvite($organizationId, $email, $permissions);

        $this->assertSame($expectedInvitation, $result);
    }

    public function testCreateOrgInviteReturnsError(): void
    {
        $organizationId = 'org-123';
        $email = 'test@example.com';
        $permissions = ['read'];

        $expectedError = new Error();

        $this->organizationInvitationsApiMock
            ->expects($this->once())
            ->method('createOrgInvite')
            ->willReturn($expectedError);

        $result = $this->invitationTask->createOrgInvite($organizationId, $email, $permissions);

        $this->assertSame($expectedError, $result);
    }

    public function testListOrgInvites(): void
    {
        $organizationId = 'org-123';
        $expectedInvitations = [new OrganizationInvitation(), new OrganizationInvitation()];

        $this->organizationInvitationsApiMock
            ->expects($this->once())
            ->method('listOrgInvites')
            ->with($organizationId, null, null, null, null, null)
            ->willReturn($expectedInvitations);

        $result = $this->invitationTask->listOrgInvites($organizationId);

        $this->assertSame($expectedInvitations, $result);
    }

    public function testListOrgInvitesWithParameters(): void
    {
        $organizationId = 'org-123';
        $filterState = ['pending'];
        $pageSize = 10;
        $pageBefore = 'cursor-before';
        $pageAfter = 'cursor-after';
        $sort = 'created_at';

        $expectedInvitations = [new OrganizationInvitation()];

        $this->organizationInvitationsApiMock
            ->expects($this->once())
            ->method('listOrgInvites')
            ->with($organizationId, $filterState, $pageSize, $pageBefore, $pageAfter, $sort)
            ->willReturn($expectedInvitations);

        $result = $this->invitationTask->listOrgInvites(
            $organizationId,
            $filterState,
            $pageSize,
            $pageBefore,
            $pageAfter,
            $sort
        );

        $this->assertSame($expectedInvitations, $result);
    }

    // Project Invitation Tests

    public function testCancelProjectInvite(): void
    {
        $projectId = 'project-123';
        $invitationId = 'invite-456';

        $this->projectInvitationsApiMock
            ->expects($this->once())
            ->method('cancelProjectInvite')
            ->with($projectId, $invitationId);

        $this->invitationTask->cancelProjectInvite($projectId, $invitationId);
    }

    public function testCancelProjectInviteThrowsApiException(): void
    {
        $projectId = 'project-123';
        $invitationId = 'invite-456';

        $this->projectInvitationsApiMock
            ->expects($this->once())
            ->method('cancelProjectInvite')
            ->with($projectId, $invitationId)
            ->willThrowException($this->createMock(ApiException::class));

        $this->expectException(ApiException::class);
        $this->invitationTask->cancelProjectInvite($projectId, $invitationId);
    }

    public function testCreateProjectInvite(): void
    {
        $projectId = 'project-123';
        $request = ['email' => 'test@test.fr'];
        $expectedInvitation = new ProjectInvitation();

        $this->projectInvitationsApiMock
            ->expects($this->once())
            ->method('createProjectInvite')
            ->with($projectId)
            ->willReturn($expectedInvitation);

        $result = $this->invitationTask->createProjectInvite($projectId, $request);

        $this->assertSame($expectedInvitation, $result);
    }

    public function testCreateProjectInviteWithNullRequest(): void
    {
        $projectId = 'project-123';
        $expectedInvitation = new ProjectInvitation();

        $this->projectInvitationsApiMock
            ->expects($this->once())
            ->method('createProjectInvite')
            ->with($projectId)
            ->willReturn($expectedInvitation);

        $result = $this->invitationTask->createProjectInvite($projectId);

        $this->assertSame($expectedInvitation, $result);
    }

    public function testCreateProjectInviteReturnsError(): void
    {
        $projectId = 'project-123';
        $request = ['email' => 'test2@test.fr'];
        $expectedError = new Error();

        $this->projectInvitationsApiMock
            ->expects($this->once())
            ->method('createProjectInvite')
            ->with($projectId)
            ->willReturn($expectedError);

        $result = $this->invitationTask->createProjectInvite($projectId, $request);

        $this->assertSame($expectedError, $result);
    }

    public function testListProjectInvites(): void
    {
        $projectId = 'project-123';
        $expectedInvitations = [new ProjectInvitation(), new ProjectInvitation()];

        $this->projectInvitationsApiMock
            ->expects($this->once())
            ->method('listProjectInvites')
            ->with($projectId, null, null, null, null, null)
            ->willReturn($expectedInvitations);

        $result = $this->invitationTask->listProjectInvites($projectId);

        $this->assertSame($expectedInvitations, $result);
    }

    public function testListProjectInvitesWithParameters(): void
    {
        $projectId = 'project-123';
        $filterState = ['pending'];
        $pageSize = 10;
        $pageBefore = 'cursor-before';
        $pageAfter = 'cursor-after';
        $sort = 'created_at';

        $expectedInvitations = [new ProjectInvitation()];

        $this->projectInvitationsApiMock
            ->expects($this->once())
            ->method('listProjectInvites')
            ->with($projectId, $filterState, $pageSize, $pageBefore, $pageAfter, $sort)
            ->willReturn($expectedInvitations);

        $result = $this->invitationTask->listProjectInvites(
            $projectId,
            $filterState,
            $pageSize,
            $pageBefore,
            $pageAfter,
            $sort
        );

        $this->assertSame($expectedInvitations, $result);
    }

    public function testListProjectInvitesReturnsError(): void
    {
        $projectId = 'project-123';
        $expectedError = new Error();

        $this->projectInvitationsApiMock
            ->expects($this->once())
            ->method('listProjectInvites')
            ->with($projectId, null, null, null, null, null)
            ->willReturn($expectedError);

        $result = $this->invitationTask->listProjectInvites($projectId);

        $this->assertSame($expectedError, $result);
    }
}