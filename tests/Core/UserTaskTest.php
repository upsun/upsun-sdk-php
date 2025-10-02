<?php

namespace Upsun\Test\Core;

use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use Psr\Http\Client\ClientInterface;
use Upsun\ApiException;
use Upsun\Api\APITokensApi;
use Upsun\Api\ConnectionsApi;
use Upsun\Api\GrantsApi;
use Upsun\Api\MFAApi;
use Upsun\Api\PhoneNumberApi;
use Upsun\Api\UserAccessApi;
use Upsun\Api\UserProfilesApi;
use Upsun\Api\UsersApi;
use Upsun\Configuration;
use Upsun\Core\OAuthProvider;
use Upsun\Model\APIToken;
use Upsun\Model\ConfirmTotpEnrollment200Response;
use Upsun\Model\Connection;
use Upsun\Model\GetAddress200Response;
use Upsun\Model\GetCurrentUserVerificationStatus200Response;
use Upsun\Model\GetTotpEnrollment200Response;
use Upsun\Model\ListProfiles200Response;
use Upsun\Model\ListProjectUserAccess200Response;
use Upsun\Model\ListUserExtendedAccess200Response;
use Upsun\Model\ListUserExtendedAccess200ResponseItemsInner;
use Upsun\Model\Profile;
use Upsun\Model\User;
use Upsun\Model\UserProjectAccess;
use Upsun\Model\VerifyPhoneNumber200Response;
use Upsun\Core\Tasks\UserTask;
use Upsun\UpsunClient;

class UserTaskTest extends BaseTestCase
{
    private UserTask $userTask;

    private ClientInterface $httpClient;

    protected function setUp(): void
    {
        $psr17Factory = new Psr17Factory();

        $this->httpClient = $this->createMock(ClientInterface::class);

        $oauthProvider = $this->createMock(OAuthProvider::class);

        $upsunClient = $this->createMock(UpsunClient::class);

        $this->userTask = new class (
            $upsunClient,
            new UsersApi($oauthProvider, $this->httpClient, $psr17Factory, new Configuration()),
            new UserProfilesApi($oauthProvider, $this->httpClient, $psr17Factory, new Configuration()),
            new UserAccessApi($oauthProvider, $this->httpClient, $psr17Factory, new Configuration()),
            new APITokensApi($oauthProvider, $this->httpClient, $psr17Factory, new Configuration()),
            new ConnectionsApi($oauthProvider, $this->httpClient, $psr17Factory, new Configuration()),
            new GrantsApi($oauthProvider, $this->httpClient, $psr17Factory, new Configuration()),
            new MFAApi($oauthProvider, $this->httpClient, $psr17Factory, new Configuration()),
            new PhoneNumberApi($oauthProvider, $this->httpClient, $psr17Factory, new Configuration()),
        ) extends UserTask {
        };
    }

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

        $result = $this->userTask->me();
        $this->assertInstanceOf(User::class, $result);
        $this->assertObjectProperties($result, $userFake);
    }

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

        $this->userTask->me();
    }

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

        $result = $this->userTask->get('user_123');
        $this->assertInstanceOf(User::class, $result);
        $this->assertObjectProperties($result, $userFake);
    }

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

        $this->userTask->get('invalid_user');
    }

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

        $result = $this->userTask->getByEmailAddress('john.doe@example.com');
        $this->assertInstanceOf(User::class, $result);
        $this->assertObjectProperties($result, $userFake);
    }

    public function testUpdateSuccess()
    {
        $updateData = ['firstName' => 'Jane', 'lastName' => 'Smith'];
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

        $result = $this->userTask->update('user_123', $updateData);
        $this->assertInstanceOf(User::class, $result);
        $this->assertObjectProperties($result, $userFake);
    }

    public function testResetPasswordSuccess()
    {
        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(204));

        $this->userTask->resetPassword('user_123');
        $this->assertTrue(true); // Just ensures no exception is thrown
    }

    public function testResetEmailAddressSuccess()
    {
        $email = 'new@example.com';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(204));

        $this->userTask->resetEmailAddress('user_123', $email);
        $this->assertTrue(true);
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

        $result = $this->userTask->getCurrentUserVerificationStatus();
        $this->assertInstanceOf(GetCurrentUserVerificationStatus200Response::class, $result);
        $this->assertObjectProperties($result, $responseFake);
    }

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

        $this->userTask->getCurrentUserVerificationStatus();
    }


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

        $result = $this->userTask->getByUsername($username);
        $this->assertInstanceOf(User::class, $result);
        $this->assertObjectProperties($result, $userFake);
    }

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

        $this->userTask->getByUsername($username);
    }

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

        $result = $this->userTask->getProjectUserAccess($projectId, $userId);
        $this->assertInstanceOf(UserProjectAccess::class, $result);
        $this->assertObjectProperties($result, $accessFake);
    }

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

        $this->userTask->getProjectUserAccess($projectId, $userId);
    }

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
                'self' => ['href' => "/users/{$userId}/projects/{$projectId}"],
                'update' => ['href' => "/users/{$userId}/projects/{$projectId}/update"],
                'delete' => ['href' => "/users/{$userId}/projects/{$projectId}/delete"],
            ],
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($accessFake)
            ));

        $result = $this->userTask->getUserProjectAccess($userId, $projectId);
        $this->assertInstanceOf(UserProjectAccess::class, $result);
        $this->assertObjectProperties($result, $accessFake);
    }

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

        $this->userTask->getUserProjectAccess($userId, $projectId);
    }

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
        $this->userTask->grantProjectUserAccess($projectId, $grantRequestFake);

        // If no exception, the test is successful
        $this->assertTrue(true);
    }

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

        $this->userTask->grantProjectUserAccess($projectId, $grantRequestFake);
    }

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

        $result = $this->userTask->listProjectUserAccess($projectId);
        $this->assertInstanceOf(ListProjectUserAccess200Response::class, $result);
        $this->assertObjectProperties($result, $responseFake);
    }

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

        $this->userTask->listProjectUserAccess($projectId);
    }

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

        $result = $this->userTask->listUserProjectAccess($userId);
        $this->assertInstanceOf(ListProjectUserAccess200Response::class, $result);
        $this->assertObjectProperties($result, $responseFake);
    }

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

        $this->userTask->listUserProjectAccess($userId);
    }

    public function testRemoveProjectUserAccessSuccess()
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

        $this->userTask->removeProjectUserAccess($projectId, $userId);

        $this->assertTrue(true);
    }

    public function testRemoveProjectUserAccessError()
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

        $this->userTask->removeProjectUserAccess($projectId, $userId);
    }


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

        $this->userTask->updateProjectUserAccess($projectId, $userId, $permissions);

        $this->assertTrue(true);
    }

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

        $this->userTask->updateProjectUserAccess($projectId, $userId, $permissions);
    }

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

        $this->userTask->deleteProfilePicture($uuid);

        $this->assertTrue(true);
    }

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

        $this->userTask->deleteProfilePicture($uuid);
    }


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
        $result = $this->userTask->getAddress($userId);
        $this->assertInstanceOf(GetAddress200Response::class, $result);
        $this->assertObjectProperties($result, $addressFake);
    }

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
        $this->userTask->getAddress($userId);
    }


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
            'securityContact' => 'security@example.com',
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

        $result = $this->userTask->getProfile($userId);
        $this->assertInstanceOf(Profile::class, $result);
        $this->assertObjectProperties($result, $profileFake);
    }

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

        $this->userTask->getProfile($userId);
    }


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

        $result = $this->userTask->listProfiles();
        $this->assertInstanceOf(ListProfiles200Response::class, $result);
        $this->assertObjectProperties($result, $responseFake);
    }

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

        $this->userTask->listProfiles();
    }

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
        $result = $this->userTask->updateAddress($userId, $addressFake);
        $this->assertInstanceOf(GetAddress200Response::class, $result);
        $this->assertObjectProperties($result, $addressFake);
    }

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
        $addressFake = [
            'country' => 'US',
            'nameLine' => 'John Doe'
        ];
        $this->userTask->updateAddress($userId, $addressFake);
    }


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
        $result = $this->userTask->updateProfile($userId, $profileFake);
        $this->assertInstanceOf(Profile::class, $result);
        $this->assertObjectProperties($result, $profileFake);
    }

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
        $profileFake = [
            'displayName' => 'John Doe',
            'username' => 'john_doe'
        ];
        $this->userTask->updateProfile($userId, $profileFake);
    }


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
        $result = $this->userTask->createApiToken($userId, $name);
        $this->assertInstanceOf(APIToken::class, $result);
        $this->assertObjectProperties($result, $tokenFake);
    }

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
        $this->userTask->createApiToken($userId, $name);
    }


    public function testDeleteApiTokenSuccess()
    {
        $userId = 'user_123';
        $tokenId = 'token_123';

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(204));

        $this->userTask->deleteApiToken($userId, $tokenId);
    }

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
        $this->userTask->deleteApiToken($userId, $tokenId);
    }

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

        $result = $this->userTask->getApiToken($userId, $tokenId);
        $this->assertInstanceOf(APIToken::class, $result);
        $this->assertObjectProperties($result, $tokenFake);
    }

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
        $this->userTask->getApiToken($userId, $tokenId);
    }


    public function testDeleteLoginConnectionSuccess()
    {
        $provider = 'google';
        $userId = 'user_123';

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(204));

        $this->userTask->deleteLoginConnection($provider, $userId);
    }

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

        $this->userTask->deleteLoginConnection($provider, $userId);
    }

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

        $result = $this->userTask->getLoginConnection($provider, $userId);
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

        $this->userTask->getLoginConnection($provider, $userId);
    }


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

        $result = $this->userTask->listLoginConnections($userId);
        $this->assertIsArray($result);
        foreach ($result as $i => $connection) {
            $this->assertInstanceOf(Connection::class, $connection);
            $this->assertObjectProperties($connection, $connectionsFake[$i]);
        }
    }

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

        $this->userTask->listLoginConnections($userId);
    }


    public function testListExtendedAccessSuccess()
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

        $result = $this->userTask->listExtendedAccess($userId);
        $this->assertInstanceOf(ListUserExtendedAccess200Response::class, $result);
        $this->assertContainsOnlyInstancesOf(
            ListUserExtendedAccess200ResponseItemsInner::class,
            $result->getItems()
        );
        $this->assertObjectMatchesArray($result->getItems(), $extendedAccessFake['items']);
    }

    public function testListExtendedAccessError()
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

        $this->userTask->listExtendedAccess($userId);
    }
    
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

        $result = $this->userTask->confirmTotpEnrollment($userId, $requestData);
        $this->assertInstanceOf(ConfirmTotpEnrollment200Response::class, $result);
        $this->assertObjectProperties($result, $responseFake);
    }

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

        $this->userTask->confirmTotpEnrollment($userId, $requestData);
    }

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

        $result = $this->userTask->getTotpEnrollment($userId);

        $this->assertInstanceOf(GetTotpEnrollment200Response::class, $result);
        $this->assertObjectProperties($result, $totpFake);
    }

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

        $this->userTask->getTotpEnrollment($userId);
    }

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

        $this->userTask->recreateRecoveryCodes($userId);

        $this->assertTrue(true);
    }

    public function testRecreateRecoveryCodesError()
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

        $this->userTask->recreateRecoveryCodes($userId);
    }


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

        $this->userTask->withdrawTotpEnrollment($userId);

        $this->assertTrue(true);
    }

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

        $this->userTask->withdrawTotpEnrollment($userId);
    }


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

        $this->userTask->confirmPhoneNumber($sid, $userId, $code);

        $this->assertTrue(true);
    }

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

        $this->userTask->confirmPhoneNumber($sid, $userId, $code);
    }

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

        $result = $this->userTask->verifyPhoneNumber($userId, $data);
        $this->assertInstanceOf(VerifyPhoneNumber200Response::class, $result);
        $this->assertObjectProperties($result, $verifyPhoneNumberFake);
    }

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

        $this->userTask->verifyPhoneNumber($userId, $data);
    }


    public function testCreateProfilePictureNotImplemented()
    {
        $this->expectException(\BadMethodCallException::class);
        $this->expectExceptionMessage('Not implemented yet');

        $this->userTask->createProfilePicture('123');
    }
    
}
