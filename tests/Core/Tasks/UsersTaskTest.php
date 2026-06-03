<?php

namespace Upsun\Tests\Core\Tasks;

use BadMethodCallException;
use Exception;
use InvalidArgumentException;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Upsun\Api\ApiConfiguration;
use Upsun\Api\ApiException;
use Upsun\Api\ApiTokensApi;
use Upsun\Api\ConnectionsApi;
use Upsun\Api\GrantsApi;
use Upsun\Api\MfaApi;
use Upsun\Api\PhoneNumberApi;
use Upsun\Api\ReferencesApi;
use Upsun\Api\UserAccessApi;
use Upsun\Api\UserProfilesApi;
use Upsun\Api\UsersApi;
use Upsun\Core\OAuthProvider;
use Upsun\Core\Tasks\UsersTask;
use Upsun\Model\ApiToken;
use Upsun\Model\ConfirmTotpEnrollment200Response;
use Upsun\Model\Connection;
use Upsun\Model\CurrentUser;
use Upsun\Model\CreateProfilePicture200Response;
use Upsun\Model\GetAddress200Response;
use Upsun\Model\GetCurrentUserVerificationStatus200Response;
use Upsun\Model\GetCurrentUserVerificationStatusFull200Response;
use Upsun\Model\GetTotpEnrollment200Response;
use Upsun\Model\ListProfiles200Response;
use Upsun\Model\ListProjectUserAccess200Response;
use Upsun\Model\ListUserExtendedAccess200Response;
use Upsun\Model\ListUserExtendedAccess200ResponseItemsInner;
use Upsun\Model\Profile;
use Upsun\Model\User;
use Upsun\Model\UserProjectAccess;
use Upsun\Model\VerifyPhoneNumber200Response;
use Upsun\UpsunClient;

class UsersTaskTest extends BaseTestCase
{
    private UsersTask $usersTask;

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

        $this->usersTask = new class (
            $upsunClient,
            new UsersApi(...$apiClassParams),
            new UserProfilesApi(...$apiClassParams),
            new UserAccessApi(...$apiClassParams),
            new ApiTokensApi(...$apiClassParams),
            new ConnectionsApi(...$apiClassParams),
            new GrantsApi(...$apiClassParams),
            new MfaApi(...$apiClassParams),
            new PhoneNumberApi(...$apiClassParams),
            new ReferencesApi(...$apiClassParams),
        ) extends UsersTask {
        };
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testMeSuccess()
    {
        $userFake = [
            'id' => 'user_123',
            'deactivated' => false,
            'namespace' => 'exampleNamespace',
            'username' => 'john_doe',
            'email' => 'john.doe@example.com',
            'emailVerified' => true,
            'firstName' => 'John',
            'lastName' => 'Doe',
            'picture' => 'https://example.com/avatar.jpg',
            'company' => 'Example Corp',
            'website' => 'https://example.com',
            'country' => 'US',
            'createdAt' => '2025-01-01T10:00:00Z',
            'updatedAt' => '2025-09-26T12:00:00Z',
            'consentedAt' => '2025-02-01T08:00:00Z',
            'consentMethod' => 'email',
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($userFake)
            ));

        $result = $this->usersTask->me();
        $this->assertInstanceOf(User::class, $result);
        $this->assertObjectProperties($result, $userFake);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testMeError()
    {
        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                403,
                ['Content-Type' => 'application/json'],
                json_encode(['status' => 'unauthorized', 'code' => 403])
            ));

        $this->expectException(ApiException::class);

        $this->usersTask->me();
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testGetSuccess()
    {
        $userFake = [
            'id' => 'user_123',
            'deactivated' => false,
            'namespace' => 'exampleNamespace',
            'username' => 'john_doe',
            'email' => 'john.doe@example.com',
            'emailVerified' => true,
            'firstName' => 'John',
            'lastName' => 'Doe',
            'picture' => 'https://example.com/avatar.jpg',
            'company' => 'Example Corp',
            'website' => 'https://example.com',
            'country' => 'US',
            'createdAt' => '2025-01-01T10:00:00Z',
            'updatedAt' => '2025-09-26T12:00:00Z',
            'consentedAt' => '2025-02-01T08:00:00Z',
            'consentMethod' => 'email',
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($userFake)
            ));

        $result = $this->usersTask->get(userId: 'user_123');
        $this->assertInstanceOf(User::class, $result);
        $this->assertObjectProperties($result, $userFake);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testGetError()
    {
        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                404,
                ['Content-Type' => 'application/json'],
                json_encode(['message' => 'Not Found'])
            ));

        $this->expectException(ApiException::class);

        $this->usersTask->get(userId: 'invalid_user');
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testGetByEmailAddressSuccess()
    {
        $userFake = [
            'id' => 'user_123',
            'deactivated' => false,
            'namespace' => 'exampleNamespace',
            'username' => 'john_doe',
            'email' => 'john.doe@example.com',
            'emailVerified' => true,
            'firstName' => 'John',
            'lastName' => 'Doe',
            'picture' => 'https://example.com/avatar.jpg',
            'company' => 'Example Corp',
            'website' => 'https://example.com',
            'country' => 'US',
            'createdAt' => '2025-01-01T10:00:00Z',
            'updatedAt' => '2025-09-26T12:00:00Z',
            'consentedAt' => '2025-02-01T08:00:00Z',
            'consentMethod' => 'email',
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($userFake)
            ));

        $result = $this->usersTask->getByEmailAddress(email: 'john.doe@example.com');
        $this->assertInstanceOf(User::class, $result);
        $this->assertObjectProperties($result, $userFake);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testUpdateSuccess()
    {
        $userFake = [
            'id' => 'user_123',
            'deactivated' => false,
            'namespace' => 'exampleNamespace',
            'username' => 'john_doe',
            'email' => 'john.doe@example.com',
            'emailVerified' => true,
            'firstName' => 'Jane',
            'lastName' => 'Smith',
            'picture' => 'https://example.com/avatar.jpg',
            'company' => 'Example Corp',
            'website' => 'https://example.com',
            'country' => 'US',
            'createdAt' => '2025-01-01T10:00:00Z',
            'updatedAt' => '2025-09-26T12:00:00Z',
            'consentedAt' => '2025-02-01T08:00:00Z',
            'consentMethod' => 'email',
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($userFake)
            ));

        $result = $this->usersTask->update(
            userId: 'user_123',
            username: $userFake['username'],
            firstName: $userFake['firstName'],
            lastName: $userFake['lastName'],
            picture: $userFake['picture'],
            company: $userFake['company'],
            website: $userFake['website'],
            country: $userFake['country'],
        );
        $this->assertInstanceOf(User::class, $result);
        $this->assertObjectProperties($result, $userFake);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testResetPasswordSuccess()
    {
        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(204));

        $this->usersTask->resetPassword(userId: 'user_123');
        $this->assertTrue(true); // Just ensures no exception is thrown
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testResetEmailAddressSuccess()
    {
        $email = 'new@example.com';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(204));

        $this->usersTask->resetEmailAddress(userId: 'user_123', emailAddress: $email);
        $this->assertTrue(true);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testGetCurrentUserDeprecatedSuccess(): void
    {
        $userFake = [
            'id' => 'user_123',
            'uuid' => 'user_123',
            'username' => 'john_doe',
            'displayName' => 'John Doe',
            'status' => 1,
            'mail' => 'john.doe@example.com',
            'sshKeys' => [],
            'hasKey' => true,
            'projects' => [],
            'sequence' => 1,
            'roles' => ['user'],
            'picture' => 'https://example.com/avatar.jpg',
            'tickets' => (object) ['open' => 1],
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($userFake)
            ));

        $result = $this->usersTask->getCurrentUserDeprecated();

        $this->assertInstanceOf(CurrentUser::class, $result);
        $this->assertObjectProperties($result, $userFake);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testCreateProfilePictureSuccess(): void
    {
        $response = ['url' => 'https://example.com/avatar.png'];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($response)
            ));

        $result = $this->usersTask->createProfilePicture(userId: 'user_123');

        $this->assertInstanceOf(CreateProfilePicture200Response::class, $result);
        $this->assertObjectProperties($result, $response);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testGetAccessDocumentSuccess(): void
    {
        $response = ['document' => 'granted', 'scope' => 'project'];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($response)
            ));

        $result = $this->usersTask->getAccessDocument('access_123');

        $this->assertIsObject($result);
        $this->assertEquals('granted', $result->document);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testListReferencedUsersSuccess(): void
    {
        $response = [
            'user-1' => [
                'id' => 'user-1',
                'username' => 'john',
                'email' => 'john@example.com',
                'firstName' => 'John',
                'lastName' => 'Doe',
                'picture' => 'https://example.com/john.png',
                'mfaEnabled' => true,
                'ssoEnabled' => false,
            ],
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($response)
            ));

        $result = $this->usersTask->listReferencedUsers('abc', 'sig123');

        $this->assertIsArray($result);
        $this->assertArrayHasKey('user-1', $result);
        $this->assertEquals('john', $result['user-1']->getUsername());
    }

    public function testListReferencedUsersWithEmptySig(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->usersTask->listReferencedUsers('abc', '');
    }

    public function testGetCurrentUserVerificationStatusSuccess()
    {
        $responseFake = [
            'verifyPhone' => true,
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($responseFake)
            ));

        $result = $this->usersTask->getCurrentUserVerificationStatus();
        $this->assertInstanceOf(GetCurrentUserVerificationStatus200Response::class, $result);
        $this->assertObjectProperties($result, $responseFake);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testGetCurrentUserVerificationStatusError()
    {
        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                403,
                ['Content-Type' => 'application/json'],
                json_encode(['status' => 'unauthorized', 'code' => 403])
            ));

        $this->expectException(ApiException::class);

        $this->usersTask->getCurrentUserVerificationStatus();
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testGetByUsernameSuccess()
    {
        $username = 'john_doe';

        $userFake = [
            'id' => 'user_123',
            'deactivated' => false,
            'namespace' => 'exampleNamespace',
            'username' => $username,
            'email' => 'john.doe@example.com',
            'emailVerified' => true,
            'firstName' => 'John',
            'lastName' => 'Doe',
            'picture' => 'https://example.com/avatar.jpg',
            'company' => 'Example Corp',
            'website' => 'https://example.com',
            'country' => 'US',
            'createdAt' => '2025-01-01T10:00:00Z',
            'updatedAt' => '2025-09-26T12:00:00Z',
            'consentedAt' => '2025-02-01T08:00:00Z',
            'consentMethod' => 'email',
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($userFake)
            ));

        $result = $this->usersTask->getByUsername(username: $username);
        $this->assertInstanceOf(User::class, $result);
        $this->assertObjectProperties($result, $userFake);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testGetByUsernameError()
    {
        $username = 'john_doe';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                404,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'not_found',
                    'code' => 404,
                    'message' => 'User not found',
                ])
            ));

        $this->expectException(ApiException::class);

        $this->usersTask->getByUsername(username: $username);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testGetProjectUserAccessSuccess()
    {
        $projectId = 'proj_123';
        $userId = 'user_123';

        $accessFake = [
            'userId' => $userId,
            'organizationId' => 'org_123',
            'projectId' => $projectId,
            'projectTitle' => 'Example Project',
            'permissions' => ['admin', 'viewer'],
            'grantedAt' => '2025-01-10T08:30:00Z',
            'updatedAt' => '2025-09-20T14:15:00Z',
            'links' => [
                'self' => ['href' => '/projects/proj_123/users/user_123'],
                'update' => ['href' => '/projects/proj_123/users/user_123/update'],
                'delete' => ['href' => '/projects/proj_123/users/user_123/delete'],
            ],
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($accessFake)
            ));

        $result = $this->usersTask->getUserProjectAccessByProject(projectId: $projectId, userId: $userId);
        $this->assertInstanceOf(UserProjectAccess::class, $result);
        $this->assertObjectProperties($result, $accessFake);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testGetProjectUserAccessError()
    {
        $projectId = 'proj_123';
        $userId = 'user_123';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                403,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'unauthorized',
                    'code' => 403,
                    'message' => 'Access denied',
                ])
            ));

        $this->expectException(ApiException::class);

        $this->usersTask->getUserProjectAccessByProject(projectId: $projectId, userId: $userId);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testGetUserProjectAccessSuccess()
    {
        $userId = 'user_123';
        $projectId = 'proj_123';

        $accessFake = [
            'userId' => $userId,
            'organizationId' => 'org_123',
            'projectId' => $projectId,
            'projectTitle' => 'Example Project',
            'permissions' => ['admin', 'editor'],
            'grantedAt' => '2025-01-10T08:30:00Z',
            'updatedAt' => '2025-09-20T14:15:00Z',
            'links' => [
                'self' => ['href' => sprintf('/users/%s/projects/%s', $userId, $projectId)],
                'update' => ['href' => sprintf('/users/%s/projects/%s/update', $userId, $projectId)],
                'delete' => ['href' => sprintf('/users/%s/projects/%s/delete', $userId, $projectId)],
            ],
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($accessFake)
            ));

        $result = $this->usersTask->getUserProjectAccessByUser(userId: $userId, projectId: $projectId);
        $this->assertInstanceOf(UserProjectAccess::class, $result);
        $this->assertObjectProperties($result, $accessFake);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testGetUserProjectAccessError()
    {
        $userId = 'user_123';
        $projectId = 'proj_123';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                403,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'unauthorized',
                    'code' => 403,
                    'message' => 'Access denied',
                ])
            ));

        $this->expectException(ApiException::class);

        $this->usersTask->getUserProjectAccessByUser(userId: $userId, projectId: $projectId);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testGrantProjectUserAccessSuccess()
    {
        $projectId = 'proj_123';
        $grantRequestFake = [
            [
                'userId' => 'user_001',
                'role' => 'admin',
            ],
            [
                'userId' => 'user_002',
                'role' => 'viewer',
            ],
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                204, // No Content
                ['Content-Type' => 'application/json']
            ));

        // Call the method
        $this->usersTask->addToProject(
            projectId: $projectId,
            userPermissions: $grantRequestFake
        );

        // If no exception, the test is successful
        $this->assertTrue(true);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testGrantProjectUserAccessError()
    {
        $projectId = 'proj_123';
        $grantRequestFake = [
            [
                'userId' => 'user_001',
                'role' => 'admin',
            ],
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                403,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'unauthorized',
                    'code' => 403,
                    'message' => 'Access denied',
                ])
            ));

        $this->expectException(ApiException::class);

        $this->usersTask->addToProject(
            projectId: $projectId,
            userPermissions: $grantRequestFake
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testListProjectUserAccessSuccess()
    {
        $projectId = 'proj_123';
        $itemsFake = [
            [
                'userId' => 'user_001',
                'organizationId' => 'org_001',
                'projectId' => $projectId,
                'projectTitle' => 'Project Alpha',
                'permissions' => ['admin', 'editor'],
                'grantedAt' => '2025-01-01T10:00:00Z',
                'updatedAt' => '2025-09-26T12:00:00Z',
                'links' => [],
            ],
            [
                'userId' => 'user_002',
                'organizationId' => 'org_001',
                'projectId' => $projectId,
                'projectTitle' => 'Project Alpha',
                'permissions' => ['viewer'],
                'grantedAt' => '2025-02-01T08:00:00Z',
                'updatedAt' => '2025-09-20T14:15:00Z',
                'links' => [],
            ],
        ];

        $responseFake = [
            'items' => $itemsFake,
            'links' => [
                'self' => ['href' => 'https://api.example.com/projects/' . $projectId . '/users'],
                'previous' => null,
                'next' => null,
            ],
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($responseFake)
            ));

        $result = $this->usersTask->listProjectUserAccesses(projectId: $projectId);
        $this->assertInstanceOf(ListProjectUserAccess200Response::class, $result);
        $this->assertObjectProperties($result, $responseFake);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testListProjectUserAccessError()
    {
        $projectId = 'proj_123';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                403,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'unauthorized',
                    'code' => 403,
                    'message' => 'Access denied',
                ])
            ));

        $this->expectException(ApiException::class);

        $this->usersTask->listProjectUserAccesses(projectId: $projectId);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testListUserProjectAccessSuccess()
    {
        $userId = 'user_123';
        $itemsFake = [
            [
                'userId' => $userId,
                'organizationId' => 'org_001',
                'projectId' => 'proj_001',
                'projectTitle' => 'Project Alpha',
                'permissions' => ['admin', 'editor'],
                'grantedAt' => '2025-01-01T10:00:00Z',
                'updatedAt' => '2025-09-26T12:00:00Z',
                'links' => [],
            ],
            [
                'userId' => $userId,
                'organizationId' => 'org_001',
                'projectId' => 'proj_002',
                'projectTitle' => 'Project Beta',
                'permissions' => ['viewer'],
                'grantedAt' => '2025-02-01T08:00:00Z',
                'updatedAt' => '2025-09-20T14:15:00Z',
                'links' => [],
            ],
        ];

        $responseFake = [
            'items' => $itemsFake,
            'links' => [
                'self' => ['href' => 'https://api.example.com/users/' . $userId . '/projects'],
                'previous' => null,
                'next' => null,
            ],
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($responseFake)
            ));

        $result = $this->usersTask->listUserProjectAccessByUser(userId: $userId);
        $this->assertInstanceOf(ListProjectUserAccess200Response::class, $result);
        $this->assertObjectProperties($result, $responseFake);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testListUserProjectAccessError()
    {
        $userId = 'user_123';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                403,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'unauthorized',
                    'code' => 403,
                    'message' => 'Access denied',
                ])
            ));

        $this->expectException(ApiException::class);

        $this->usersTask->listUserProjectAccessByUser(userId: $userId);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testRevokeUserProjectAccessByUserSuccess()
    {
        $projectId = 'proj_123';
        $userId = 'user_123';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                204,
                ['Content-Type' => 'application/json'],
                null
            ));

        $this->usersTask->revokeUserProjectAccessByUser(projectId: $projectId, userId: $userId);

        $this->assertTrue(true);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testRevokeUserProjectAccessByUserError()
    {
        $projectId = 'proj_123';
        $userId = 'user_123';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                403,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'unauthorized',
                    'code' => 403,
                    'message' => 'Access denied',
                ])
            ));

        $this->expectException(ApiException::class);

        $this->usersTask->revokeUserProjectAccessByUser(projectId: $projectId, userId: $userId);
    }


    /**
     * @throws ClientExceptionInterface
     */
    public function testUpdateProjectUserAccessSuccess()
    {
        $projectId = 'proj_123';
        $userId = 'user_123';
        $permissions = ['read', 'write'];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                204,
                ['Content-Type' => 'application/json'],
                null
            ));

        $this->usersTask->updateUserProjectAccessByProject(projectId: $projectId, userId: $userId, permissions: $permissions);

        $this->assertTrue(true);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testUpdateProjectUserAccessError()
    {
        $projectId = 'proj_123';
        $userId = 'user_123';
        $permissions = ['read', 'write'];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                403,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'unauthorized',
                    'code' => 403,
                    'message' => 'Access denied',
                ])
            ));

        $this->expectException(ApiException::class);

        $this->usersTask->updateUserProjectAccessByProject(projectId: $projectId, userId: $userId, permissions: $permissions);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testDeleteProfilePictureSuccess()
    {
        $uuid = 'uuid_123';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                204,
                ['Content-Type' => 'application/json'],
                null
            ));

        $this->usersTask->deleteProfilePicture(userId: $uuid);

        $this->assertTrue(true);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testDeleteProfilePictureError()
    {
        $uuid = 'uuid_123';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                403,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'unauthorized',
                    'code' => 403,
                    'message' => 'Access denied',
                ])
            ));

        $this->expectException(ApiException::class);

        $this->usersTask->deleteProfilePicture(userId: $uuid);
    }


    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testGetAddressSuccess()
    {
        $addressFake = [
            'country' => 'US',
            'nameLine' => 'John Doe',
            'premise' => '123',
            'subPremise' => 'Apt 4',
            'thoroughfare' => 'Main St',
            'administrativeArea' => 'CA',
            'subAdministrativeArea' => 'Santa Clara',
            'locality' => 'San Jose',
            'dependentLocality' => null,
            'postalCode' => '95131',
            'metadata' => [
                'requiredFields' => ['country', 'postalCode'],
                'fieldLabels' => (object)['country' => 'Country', 'postalCode' => 'ZIP Code'],
                'showVat' => false,
            ],
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($addressFake)
            ));

        $userId = 'user_123';
        $result = $this->usersTask->getAddress(userId: $userId);
        $this->assertInstanceOf(GetAddress200Response::class, $result);
        $this->assertObjectProperties($result, $addressFake);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testGetAddressError()
    {
        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                404,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'not_found',
                    'code' => 404
                ])
            ));

        $this->expectException(ApiException::class);

        $userId = 'user_123';
        $this->usersTask->getAddress(userId: $userId);
    }


    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testGetProfileSuccess()
    {
        $userId = 'user_123';
        $profileFake = [
            'id' => 'profile_001',
            'displayName' => 'John Doe',
            'email' => 'john.doe@example.com',
            'username' => 'john_doe',
            'type' => 'user',
            'picture' => 'https://example.com/avatar.jpg',
            'companyType' => 'private',
            'companyName' => 'Example Corp',
            'currency' => 'USD',
            'vatNumber' => 'VAT123456',
            'companyRole' => 'admin',
            'websiteUrl' => 'https://example.com',
            'newUi' => true,
            'uiColorscheme' => 'dark',
            'defaultCatalog' => 'standard',
            'projectOptionsUrl' => 'https://example.com/projects',
            'marketing' => false,
            'createdAt' => '2025-01-01T10:00:00Z',
            'updatedAt' => '2025-09-26T12:00:00Z',
            'billingContact' => 'billing@example.com',
            'currentTrial' => [
                'pendingVerification' => 'none',
                'active' => true,
                'created' => '2025-01-10T08:00:00Z',
                'description' => 'Trial description',
                'expiration' => '2025-12-31T23:59:59Z',
                'current' => [
                    'formatted' => '$10.00',
                    'amount' => '10.00',
                    'currency' => 'USD',
                    'currencySymbol' => '$',
                ],
                'spendRemaining' => [
                    'formatted' => '$5.00',
                    'amount' => '5.00',
                    'currency' => 'USD',
                    'currencySymbol' => '$',
                    'unlimited' => false,
                ],
                'projects' => [
                    'id' => 'proj_001',
                    'name' => 'Project One',
                    'total' => [
                        'formatted' => '10',
                        'amount' => '10',
                        'currency' => 'USD',
                        'currencySymbol' => '$',
                    ],
                ],
                'model' => 'trial_model',
                'daysRemaining' => 30,
            ],
            'invoiced' => true,
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($profileFake)
            ));

        $result = $this->usersTask->getProfile(userId: $userId);
        $this->assertInstanceOf(Profile::class, $result);
        $this->assertObjectProperties($result, $profileFake);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testGetProfileError()
    {
        $userId = 'user_123';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                404,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'not_found',
                    'code' => 404
                ])
            ));

        $this->expectException(ApiException::class);

        $this->usersTask->getProfile(userId: $userId);
    }


    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testListProfilesSuccess()
    {
        $profilesFake = [
            [
                'id' => 'profile_001',
                'displayName' => 'John Doe',
                'email' => 'john.doe@example.com',
                'username' => 'john_doe',
            ],
            [
                'id' => 'profile_002',
                'displayName' => 'Jane Smith',
                'email' => 'jane.smith@example.com',
                'username' => 'jane_smith',
            ],
        ];

        $responseFake = [
            'count' => 2,
            'profiles' => $profilesFake,
            'links' => [
                'self' => ['href' => '/profiles'],
                'next' => ['href' => '/profiles?page=2'],
                'previous' => ['href' => '/profiles?page=0'],
            ],
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($responseFake)
            ));

        $result = $this->usersTask->listProfiles();
        $this->assertInstanceOf(ListProfiles200Response::class, $result);
        $this->assertObjectProperties($result, $responseFake);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testListProfilesError()
    {
        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                500,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'server_error',
                    'code' => 500
                ])
            ));

        $this->expectException(ApiException::class);

        $this->usersTask->listProfiles();
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testUpdateAddressSuccess()
    {
        $addressFake = [
            'country' => 'US',
            'nameLine' => 'John Doe',
            'premise' => '123',
            'subPremise' => 'Apt 4',
            'thoroughfare' => 'Main St',
            'administrativeArea' => 'CA',
            'subAdministrativeArea' => 'Santa Clara',
            'locality' => 'San Jose',
            'dependentLocality' => null,
            'postalCode' => '95131',
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($addressFake)
            ));

        $userId = 'user_123';
        $result = $this->usersTask->updateAddress(
            userId: $userId,
            country: 'US',
            nameLine: 'John Doe',
            premise: '123',
            subPremise: 'Apt 4',
            thoroughfare: 'Main St',
            administrativeArea: 'CA',
            subAdministrativeArea: 'Santa Clara',
            locality: 'San Jose',
            dependentLocality: null,
            postalCode: '95131',
        );
        $this->assertInstanceOf(GetAddress200Response::class, $result);
        $this->assertObjectProperties($result, $addressFake);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testUpdateAddressError()
    {
        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                400,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'bad_request',
                    'code' => 400
                ])
            ));

        $this->expectException(ApiException::class);

        $userId = 'user_123';
        $this->usersTask->updateAddress(userId: $userId, country: 'US', nameLine: 'John Doe');
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testUpdateProfileSuccess()
    {
        $profileFake = [
            'displayName' => 'John Doe',
            'username' => 'john_doe',
            'currentPassword' => null,
            'password' => null,
            'companyType' => 'LLC',
            'companyName' => 'Example Corp',
            'vatNumber' => 'US123456789',
            'companyRole' => 'Admin',
            'marketing' => true,
            'uiColorscheme' => 'dark',
            'defaultCatalog' => 'default',
            'projectOptionsUrl' => 'https://example.com/projects',
            'picture' => 'https://example.com/avatar.jpg',
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($profileFake)
            ));

        $userId = 'user_123';
        $result = $this->usersTask->updateProfile(
            userId: $userId,
            displayName: $profileFake['displayName'],
            username: $profileFake['username'],
            currentPassword: $profileFake['currentPassword'],
            password: $profileFake['password'],
            companyType: $profileFake['companyType'],
            companyName: $profileFake['companyName'],
            vatNumber: $profileFake['vatNumber'],
            companyRole: $profileFake['companyRole'],
            marketing: $profileFake['marketing'],
            uiColorscheme: $profileFake['uiColorscheme'],
            defaultCatalog: $profileFake['defaultCatalog'],
            projectOptionsUrl: $profileFake['projectOptionsUrl'],
            picture: $profileFake['picture'],
        );
        $this->assertInstanceOf(Profile::class, $result);
        $this->assertObjectProperties($result, $profileFake);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testUpdateProfileError()
    {
        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                400,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'bad_request',
                    'code' => 400
                ])
            ));

        $this->expectException(ApiException::class);

        $userId = 'user_123';

        $this->usersTask->updateProfile(userId: $userId, displayName: 'John Doe', username: 'john_doe');
    }


    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testCreateApiTokenSuccess()
    {
        $tokenFake = [
            'id' => 'token_123',
            'name' => 'My Token',
            'token' => 'abcdef123456',
            'mfaOnCreation' => true,
            'lastUsedAt' => '2025-09-26T10:00:00Z',
            'createdAt' => '2025-09-26T09:00:00Z',
            'updatedAt' => '2025-09-26T09:30:00Z',
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($tokenFake)
            ));

        $userId = 'user_123';
        $name = 'My Token';
        $result = $this->usersTask->createApiToken(userId: $userId, name: $name);
        $this->assertInstanceOf(ApiToken::class, $result);
        $this->assertObjectProperties($result, $tokenFake);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testCreateApiTokenError()
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

        $userId = 'user_123';
        $name = 'My Token';
        $this->usersTask->createApiToken(userId: $userId, name: $name);
    }


    public function testDeleteApiTokenSuccess()
    {
        $userId = 'user_123';
        $tokenId = 'token_123';

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(204));

        $this->usersTask->deleteApiToken(userId: $userId, tokenId: $tokenId);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testDeleteApiTokenError()
    {
        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                403,
                ['Content-Type' => 'application/json'],
                json_encode(['status' => 'unauthorized', 'code' => 403])
            ));

        $this->expectException(ApiException::class);

        $userId = 'user_123';
        $tokenId = 'token_123';
        $this->usersTask->deleteApiToken(userId: $userId, tokenId: $tokenId);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testGetApiTokenSuccess()
    {
        $userId = 'user_123';
        $tokenId = 'token_123';
        $tokenFake = [
            'id' => 'token_123',
            'name' => 'My API Token',
            'mfaOnCreation' => false,
            'token' => 'abcd1234',
            'lastUsedAt' => '2025-09-26T10:00:00Z',
            'createdAt' => '2025-01-01T08:00:00Z',
            'updatedAt' => '2025-09-20T12:00:00Z',
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($tokenFake)
            ));

        $result = $this->usersTask->getApiToken(userId: $userId, tokenId: $tokenId);
        $this->assertInstanceOf(ApiToken::class, $result);
        $this->assertObjectProperties($result, $tokenFake);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testGetApiTokenError()
    {
        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                404,
                ['Content-Type' => 'application/json'],
                json_encode(['status' => 'not_found', 'code' => 404])
            ));

        $this->expectException(ApiException::class);

        $userId = 'user_123';
        $tokenId = 'token_123';
        $this->usersTask->getApiToken(userId: $userId, tokenId: $tokenId);
    }


    /**
     * @throws ClientExceptionInterface
     */
    public function testDeleteLoginConnectionSuccess()
    {
        $provider = 'google';
        $userId = 'user_123';

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(204));

        $this->usersTask->deleteLoginConnection(provider: $provider, userId: $userId);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testDeleteLoginConnectionError()
    {
        $provider = 'google';
        $userId = 'user_123';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                403,
                ['Content-Type' => 'application/json'],
                json_encode(['status' => 'forbidden', 'code' => 403])
            ));

        $this->expectException(ApiException::class);

        $this->usersTask->deleteLoginConnection(provider: $provider, userId: $userId);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testGetLoginConnectionSuccess()
    {
        $provider = 'google';
        $userId = 'user_123';
        $connectionFake = [
            'provider' => $provider,
            'providerType' => 'oauth',
            'isMandatory' => true,
            'subject' => 'sub_123',
            'emailAddress' => 'john.doe@example.com',
            'createdAt' => '2025-01-01T10:00:00Z',
            'updatedAt' => '2025-09-26T12:00:00Z',
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($connectionFake)
            ));

        $result = $this->usersTask->getLoginConnection(provider: $provider, userId: $userId);
        $this->assertInstanceOf(Connection::class, $result);
        $this->assertObjectProperties($result, $connectionFake);
    }

    public function testGetLoginConnectionError()
    {
        $provider = 'google';
        $userId = 'user_123';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                403,
                ['Content-Type' => 'application/json'],
                json_encode(['status' => 'forbidden', 'code' => 403])
            ));

        $this->expectException(ApiException::class);

        $this->usersTask->getLoginConnection(provider: $provider, userId: $userId);
    }


    /**
     * @throws ClientExceptionInterface
     */
    public function testListLoginConnectionsSuccess()
    {
        $userId = 'user_123';
        $connectionsFake = [
            [
                'provider' => 'google',
                'providerType' => 'oauth',
                'isMandatory' => true,
                'subject' => 'sub_123',
                'emailAddress' => 'john.doe@example.com',
                'createdAt' => '2025-01-01T10:00:00Z',
                'updatedAt' => '2025-09-26T12:00:00Z',
            ],
            [
                'provider' => 'github',
                'providerType' => 'oauth',
                'isMandatory' => false,
                'subject' => 'sub_456',
                'emailAddress' => 'jane.doe@example.com',
                'createdAt' => '2025-01-05T11:00:00Z',
                'updatedAt' => '2025-09-20T08:00:00Z',
            ],
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($connectionsFake)
            ));

        $result = $this->usersTask->listLoginConnections(userId: $userId);
        $this->assertIsArray($result);
        foreach ($result as $i => $connection) {
            $this->assertInstanceOf(Connection::class, $connection);
            $this->assertObjectProperties($connection, $connectionsFake[$i]);
        }
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testListLoginConnectionsError()
    {
        $userId = 'user_123';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                403,
                ['Content-Type' => 'application/json'],
                json_encode(['status' => 'forbidden', 'code' => 403])
            ));

        $this->expectException(ApiException::class);

        $this->usersTask->listLoginConnections(userId: $userId);
    }


    /**
     * @throws ClientExceptionInterface
     */
    public function testListExtendedUserProjectAccessSuccess()
    {
        $userId = 'user_123';
        $extendedAccessFake = [
            'items' => [
                [
                    'userId' => $userId,
                    'resourceId' => 'res_001',
                    'resourceType' => 'project',
                    'organizationId' => 'org_123',
                    'permissions' => ['read', 'write'],
                    'grantedAt' => '2025-01-01T10:00:00Z',
                    'updatedAt' => '2025-09-26T12:00:00Z',
                ],
                [
                    'userId' => $userId,
                    'resourceId' => 'res_002',
                    'resourceType' => 'team',
                    'organizationId' => 'org_456',
                    'permissions' => ['admin'],
                    'grantedAt' => '2025-02-01T08:00:00Z',
                    'updatedAt' => '2025-09-20T08:00:00Z',
                ],
            ]
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($extendedAccessFake)
            ));

        $result = $this->usersTask->listExtendedUserProjectAccess(userId: $userId);
        $this->assertInstanceOf(ListUserExtendedAccess200Response::class, $result);
        $this->assertContainsOnlyInstancesOf(
            ListUserExtendedAccess200ResponseItemsInner::class,
            $result->getItems()
        );
        $this->assertObjectMatchesArray($result->getItems(), $extendedAccessFake['items']);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testConfirmTotpEnrollmentSuccess()
    {
        $userId = 'user_123';
        $requestData = [
            'secret' => 'ABC123SECRET',
            'passcode' => '123456',
        ];
        $responseFake = [
            'recoveryCodes' => ['code1', 'code2', 'code3'],
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($responseFake)
            ));

        $result = $this->usersTask->confirmTotpEnrollment(
            userId: $userId,
            secret: $requestData['secret'],
            passCode: $requestData['passcode']
        );
        $this->assertInstanceOf(ConfirmTotpEnrollment200Response::class, $result);
        $this->assertObjectProperties($result, $responseFake);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testConfirmTotpEnrollmentError()
    {
        $userId = 'user_123';
        $requestData = [
            'secret' => 'ABC123SECRET',
            'passcode' => '123456',
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                400,
                ['Content-Type' => 'application/json'],
                json_encode(['status' => 'invalid_request', 'code' => 400])
            ));

        $this->expectException(ApiException::class);

        $this->usersTask->confirmTotpEnrollment(
            userId: $userId,
            secret: $requestData['secret'],
            passCode: $requestData['passcode']
        );
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testGetTotpEnrollmentSuccess()
    {
        $userId = 'user_123';
        $totpFake = [
            'issuer' => 'ExampleIssuer',
            'accountName' => 'john_doe@example.com',
            'secret' => 'ABC123SECRET',
            'qrCode' => 'data:image/png;base64,iVBORw0KGgoAAAANS...',
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($totpFake)
            ));

        $result = $this->usersTask->getTotpEnrollment(userId: $userId);

        $this->assertInstanceOf(GetTotpEnrollment200Response::class, $result);
        $this->assertObjectProperties($result, $totpFake);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testGetTotpEnrollmentError()
    {
        $userId = 'user_123';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                404,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'not_found',
                    'code' => 404
                ])
            ));

        $this->expectException(ApiException::class);

        $this->usersTask->getTotpEnrollment(userId: $userId);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testRecreateRecoveryCodesSuccess()
    {
        $userId = 'user_123';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                204,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'no content',
                    'code' => 204
                ])
            ));

        $this->usersTask->recreateMfaRecoveryCodes(userId: $userId);

        $this->assertTrue(true);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testRecreateMfaRecoveryCodesError()
    {
        $userId = 'user_123';

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

        $this->usersTask->recreateMfaRecoveryCodes(userId: $userId);
    }


    /**
     * @throws ClientExceptionInterface
     */
    public function testWithdrawTotpEnrollmentSuccess()
    {
        $userId = 'user_123';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                204,
                ['Content-Type' => 'application/json'],
                null
            ));

        $this->usersTask->withdrawTotpEnrollment(userId: $userId);

        $this->assertTrue(true);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testWithdrawTotpEnrollmentError()
    {
        $userId = 'user_123';

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

        $this->usersTask->withdrawTotpEnrollment(userId: $userId);
    }


    /**
     * @throws ClientExceptionInterface
     */
    public function testConfirmPhoneNumberSuccess()
    {
        $sid = 'sid_123';
        $userId = 'user_123';
        $code = '1234';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                204,
                ['Content-Type' => 'application/json'],
                null
            ));

        $this->usersTask->confirmPhoneNumber(sid: $sid, userId: $userId, code: $code);

        $this->assertTrue(true);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testConfirmPhoneNumberError()
    {
        $sid = 'sid_123';
        $userId = 'user_123';
        $code = '1234';

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

        $this->usersTask->confirmPhoneNumber(sid: $sid, userId: $userId, code: $code);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testVerifyPhoneNumberSuccess()
    {
        $userId = 'user_123';
        $data = [
            'channel' => 'sms',
            'phoneNumber' => '+1234567890'
        ];
        $verifyPhoneNumberFake = [
            'sid' => 'sid_123'
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($verifyPhoneNumberFake)
            ));

        $result = $this->usersTask->verifyPhoneNumber(
            userId: $userId,
            channel: $data['channel'],
            phoneNumber: $data['phoneNumber']
        );
        $this->assertInstanceOf(VerifyPhoneNumber200Response::class, $result);
        $this->assertObjectProperties($result, $verifyPhoneNumberFake);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testVerifyPhoneNumberError()
    {
        $userId = 'user_123';
        $data = [
            'channel' => 'sms',
            'phoneNumber' => '+1234567890'
        ];

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

        $this->usersTask->verifyPhoneNumber(
            userId: $userId,
            channel: $data['channel'],
            phoneNumber: $data['phoneNumber']
        );
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testGetCurrentUserVerificationStatusFullSuccess(): void
    {
        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'state' => true,
                    'type' => 'email'
                ])
            ));

        $result = $this->usersTask->getCurrentUserVerificationStatusFull();

        $this->assertEquals(
            new GetCurrentUserVerificationStatusFull200Response(true, 'email'),
            $result
        );
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testGetCurrentUserVerificationStatusFullError(): void
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

        $this->usersTask->getCurrentUserVerificationStatusFull();
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testGrantUserProjectAccessSuccess(): void
    {
        $userId = 'user123';
        $data = [
            'project_id' => 'project456',
            'role' => 'developer'
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'success' => true,
                    'message' => 'Access granted'
                ])
            ));
        $this->expectNotToPerformAssertions();

        $this->usersTask->grantUserProjectAccessByUser(userId: $userId, access: $data);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testGrantUserProjectAccessError(): void
    {
        $userId = 'user123';
        $data = [
            'project_id' => 'project456',
            'role' => 'developer'
        ];

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
        $this->usersTask->grantUserProjectAccessByUser(userId: $userId, access: $data);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testGrantUserProjectAccessNotFound(): void
    {
        $userId = 'invalidUser';
        $data = [
            'project_id' => 'project456',
            'role' => 'developer'
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                404,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'not_found',
                    'code' => 404,
                    'message' => 'User not found'
                ])
            ));

        $this->expectException(ApiException::class);
        $this->usersTask->grantUserProjectAccessByUser(userId: $userId, access: $data);
    }



















    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testListApiTokensSuccess(): void
    {
        $userId = 'user123';
        $fakeListApiToken = [
            [
                'id' => 'token1',
                'name' => 'Production Token',
                'token' => 'tok_abc123',
                'mfa_on_creation' => true,
                'created_at' => '2024-01-15T10:30:00Z',
                'updated_at' => '2024-01-20T14:45:00Z',
                'last_used_at' => '2024-01-25T08:20:00Z'
            ],
            [
                'id' => 'token2',
                'name' => 'Development Token',
                'token' => 'tok_def456',
                'mfa_on_creation' => false,
                'created_at' => '2024-02-01T09:00:00Z',
                'updated_at' => '2024-02-01T09:00:00Z',
                'last_used_at' => null
            ]
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($fakeListApiToken)
            ));

        $result = $this->usersTask->listApiTokens(userId: $userId);

        $this->assertIsArray($result);
        $this->assertCount(2, $result);
        $this->assertContainsOnlyInstancesOf(ApiToken::class, $result);

        $this->assertContainsOnlyInstancesOf(ApiToken::class, $result);
        $this->assertObjectProperties($result, $fakeListApiToken);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testListApiTokensEmpty(): void
    {
        $userId = 'user123';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([])
            ));

        $result = $this->usersTask->listApiTokens($userId);

        $this->assertIsArray($result);
        $this->assertEmpty($result);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testListApiTokensError(): void
    {
        $userId = 'user123';

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
        $this->usersTask->listApiTokens(userId: $userId);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testListApiTokensUserNotFound(): void
    {
        $userId = 'invalidUser';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                404,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'not_found',
                    'code' => 404,
                    'message' => 'User not found'
                ])
            ));

        $this->expectException(ApiException::class);
        $this->usersTask->listApiTokens(userId: $userId);
    }
}
