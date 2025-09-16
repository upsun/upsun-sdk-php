<?php

namespace Upsun\Test\Core;

use InvalidArgumentException;
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
use Upsun\Model\Address;
use Upsun\Model\APIToken;
use Upsun\Model\ConfirmPhoneNumberRequest;
use Upsun\Model\ConfirmTotpEnrollment200Response;
use Upsun\Model\ConfirmTotpEnrollmentRequest;
use Upsun\Model\Connection;
use Upsun\Model\CreateApiTokenRequest;
use Upsun\Model\Error;
use Upsun\Model\GetAddress200Response;
use Upsun\Model\GetCurrentUserVerificationStatus200Response;
use Upsun\Model\GetCurrentUserVerificationStatusFull200Response;
use Upsun\Model\GetTotpEnrollment200Response;
use Upsun\Model\ListProfiles200Response;
use Upsun\Model\ListProjectUserAccess200Response;
use Upsun\Model\ListUserExtendedAccess200Response;
use Upsun\Model\Profile;
use Upsun\Model\ResetEmailAddressRequest;
use Upsun\Model\UpdateProfileRequest;
use Upsun\Model\UpdateProjectUserAccessRequest;
use Upsun\Model\UpdateUserRequest;
use Upsun\Model\User;
use Upsun\Model\UserProjectAccess;
use Upsun\Model\VerifyPhoneNumber200Response;
use Upsun\Model\VerifyPhoneNumberRequest;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\HttplugClient;
use Upsun\Core\Tasks\UserTask;
use Upsun\UpsunClient;
use Upsun\UpsunConfig;

class UserTaskTest extends TestCase
{
    private $clientMock;
    private $usersApiMock;
    private $profilesApiMock;
    private $accessApiMock;
    private $tokensApiMock;
    private $connectionsApiMock;
    private $grantsApiMock;
    private $mfaApiMock;
    private $phoneNumberApiMock;
    private $userTask;

    protected function setUp(): void
    {
        $this->clientMock = new class() extends UpsunClient {
            public HttplugClient $apiClient;
            public Configuration $apiConfig;

            public UpsunConfig $upsunConfig;

            public function __construct()
            {
            }
        };
        $this->usersApiMock = $this->createMock(UsersApi::class);
        $this->profilesApiMock = $this->createMock(UserProfilesApi::class);
        $this->accessApiMock = $this->createMock(UserAccessApi::class);
        $this->tokensApiMock = $this->createMock(APITokensApi::class);
        $this->connectionsApiMock = $this->createMock(ConnectionsApi::class);
        $this->grantsApiMock = $this->createMock(GrantsApi::class);
        $this->mfaApiMock = $this->createMock(MFAApi::class);
        $this->phoneNumberApiMock = $this->createMock(PhoneNumberApi::class);


        $this->userTask = new class(
            $this->clientMock,
            $this->usersApiMock,
            $this->profilesApiMock,
            $this->accessApiMock,
            $this->tokensApiMock,
            $this->connectionsApiMock,
            $this->grantsApiMock,
            $this->mfaApiMock,
            $this->phoneNumberApiMock
        ) extends UserTask {
            public function refreshToken(): void
            {
            }
        };
    }

    public function testMeSuccess()
    {
        $expectedUser = new User(['id' => '123']);
        $this->usersApiMock->expects($this->once())
            ->method('getCurrentUser')
            ->willReturn($expectedUser);

        $result = $this->userTask->me();
        $this->assertEquals($expectedUser, $result);
    }

    public function testMeError()
    {
        $this->expectException(ApiException::class);

        $this->usersApiMock->expects($this->once())
            ->method('getCurrentUser')
            ->willThrowException($this->createMock(ApiException::class));

        $result = $this->userTask->me();
    }

    public function testGetCurrentUserVerificationStatusSuccess()
    {
        $expectedResponse = new GetCurrentUserVerificationStatus200Response();
        $this->usersApiMock->expects($this->once())
            ->method('getCurrentUserVerificationStatus')
            ->willReturn($expectedResponse);

        $result = $this->userTask->getCurrentUserVerificationStatus();
        $this->assertEquals($expectedResponse, $result);
    }

    public function testGetCurrentUserVerificationStatusFullSuccess()
    {
        $expectedResponse = new GetCurrentUserVerificationStatusFull200Response();
        $this->usersApiMock->expects($this->once())
            ->method('getCurrentUserVerificationStatusFull')
            ->willReturn($expectedResponse);

        $result = $this->userTask->getCurrentUserVerificationStatusFull();
        $this->assertEquals($expectedResponse, $result);
    }

    public function testGetSuccess()
    {
        $userId = '123';
        $expectedUser = new User(['id' => $userId]);
        $this->usersApiMock->expects($this->once())
            ->method('getUser')
            ->with($userId)
            ->willReturn($expectedUser);

        $result = $this->userTask->get($userId);
        $this->assertEquals($expectedUser, $result);
    }

    public function testGetError()
    {
        $userId = '123';
        $error = new Error(['message' => 'Not found']);
        $this->usersApiMock->expects($this->once())
            ->method('getUser')
            ->with($userId)
            ->willReturn($error);

        $result = $this->userTask->get($userId);
        $this->assertEquals($error, $result);
    }

    public function testGetByEmailAddressSuccess()
    {
        $email = 'test@example.com';
        $expectedUser = new User(['email' => $email]);
        $this->usersApiMock->expects($this->once())
            ->method('getUserByEmailAddress')
            ->with($email)
            ->willReturn($expectedUser);

        $result = $this->userTask->getByEmailAddress($email);
        $this->assertEquals($expectedUser, $result);
    }

    public function testGetByUsernameSuccess()
    {
        $username = 'testuser';
        $expectedUser = new User(['username' => $username]);
        $this->usersApiMock->expects($this->once())
            ->method('getUserByUsername')
            ->with($username)
            ->willReturn($expectedUser);

        $result = $this->userTask->getByUsername($username);
        $this->assertEquals($expectedUser, $result);
    }

    public function testResetEmailAddressSuccess()
    {
        $userId = '123';
        $request = new ResetEmailAddressRequest();

        $this->usersApiMock->expects($this->once())
            ->method('resetEmailAddress')
            ->with($userId, $request);

        $this->userTask->resetEmailAddress($userId, $request);
    }

    public function testResetPasswordSuccess()
    {
        $userId = '123';

        $this->usersApiMock->expects($this->once())
            ->method('resetPassword')
            ->with($userId);

        $this->userTask->resetPassword($userId);
    }

    public function testUpdateSuccess()
    {
        $userId = '123';
        $updateData = ['name' => 'New Name'];
        $expectedUser = new User(['id' => $userId, 'name' => 'New Name']);

        $this->usersApiMock->expects($this->once())
            ->method('updateUser')
            ->with($userId, $this->isInstanceOf(UpdateUserRequest::class))
            ->willReturn($expectedUser);

        $result = $this->userTask->update($userId, $updateData);
        $this->assertEquals($expectedUser, $result);
    }

    public function testGetProjectUserAccessSuccess()
    {
        $projectId = 'project123';
        $userId = 'user123';
        $expectedAccess = new UserProjectAccess();

        $this->accessApiMock->expects($this->once())
            ->method('getProjectUserAccess')
            ->with($projectId, $userId)
            ->willReturn($expectedAccess);

        $result = $this->userTask->getProjectUserAccess($projectId, $userId);
        $this->assertEquals($expectedAccess, $result);
    }

    public function testGetUserProjectAccessSuccess()
    {
        $userId = 'user123';
        $projectId = 'project123';
        $expectedAccess = new UserProjectAccess();

        $this->accessApiMock->expects($this->once())
            ->method('getUserProjectAccess')
            ->with($userId, $projectId)
            ->willReturn($expectedAccess);

        $result = $this->userTask->getUserProjectAccess($userId, $projectId);
        $this->assertEquals($expectedAccess, $result);
    }

    public function testGrantProjectUserAccessSuccess()
    {
        $projectId = 'project123';
        $request = [['userId' => 'user123', 'role' => 'admin']];

        $this->accessApiMock->expects($this->once())
            ->method('grantProjectUserAccess')
            ->with($projectId, $request);

        $this->userTask->grantProjectUserAccess($projectId, $request);
    }

    public function testListProjectUserAccessSuccess()
    {
        $projectId = 'project123';
        $expectedResponse = new ListProjectUserAccess200Response();

        $this->accessApiMock->expects($this->once())
            ->method('listProjectUserAccess')
            ->with($projectId, null, null, null, null)
            ->willReturn($expectedResponse);

        $result = $this->userTask->listProjectUserAccess($projectId);
        $this->assertEquals($expectedResponse, $result);
    }

    public function testListUserProjectAccessSuccess()
    {
        $userId = 'user123';
        $expectedResponse = new ListProjectUserAccess200Response();

        $this->accessApiMock->expects($this->once())
            ->method('listUserProjectAccess')
            ->with($userId, null, null, null, null, null)
            ->willReturn($expectedResponse);

        $result = $this->userTask->listUserProjectAccess($userId);
        $this->assertEquals($expectedResponse, $result);
    }

    public function testRemoveProjectUserAccessSuccess()
    {
        $projectId = 'project123';
        $userId = 'user123';

        $this->accessApiMock->expects($this->once())
            ->method('removeProjectUserAccess')
            ->with($projectId, $userId);

        $this->userTask->removeProjectUserAccess($projectId, $userId);
    }

    public function testUpdateProjectUserAccessSuccess()
    {
        $projectId = 'project123';
        $userId = 'user123';
        $updateData = ['role' => 'admin'];

        $this->accessApiMock->expects($this->once())
            ->method('updateProjectUserAccess')
            ->with($projectId, $userId, $this->isInstanceOf(UpdateProjectUserAccessRequest::class));

        $this->userTask->updateProjectUserAccess($projectId, $userId, $updateData);
    }

    public function testDeleteProfilePictureSuccess()
    {
        $uuid = '12345';

        $this->profilesApiMock->expects($this->once())
            ->method('deleteProfilePicture')
            ->with($uuid);

        $this->userTask->deleteProfilePicture($uuid);
    }

    public function testGetAddressSuccess()
    {
        $userId = '123';
        $expectedResponse = new GetAddress200Response();

        $this->profilesApiMock->expects($this->once())
            ->method('getAddress')
            ->with($userId)
            ->willReturn($expectedResponse);

        $result = $this->userTask->getAddress($userId);
        $this->assertEquals($expectedResponse, $result);
    }

    public function testGetProfileSuccess()
    {
        $userId = '123';
        $expectedProfile = new Profile();

        $this->profilesApiMock->expects($this->once())
            ->method('getProfile')
            ->with($userId)
            ->willReturn($expectedProfile);

        $result = $this->userTask->getProfile($userId);
        $this->assertEquals($expectedProfile, $result);
    }

    public function testListProfilesSuccess()
    {
        $expectedResponse = new ListProfiles200Response();

        $this->profilesApiMock->expects($this->once())
            ->method('listProfiles')
            ->willReturn($expectedResponse);

        $result = $this->userTask->listProfiles();
        $this->assertEquals($expectedResponse, $result);
    }

    public function testUpdateAddressSuccess()
    {
        $userId = '123';
        $address = new Address();
        $expectedResponse = new GetAddress200Response();

        $this->profilesApiMock->expects($this->once())
            ->method('updateAddress')
            ->with($userId, $address)
            ->willReturn($expectedResponse);

        $result = $this->userTask->updateAddress($userId, $address);
        $this->assertEquals($expectedResponse, $result);
    }

    public function testUpdateProfileSuccess()
    {
        $userId = '123';
        $updateData = ['bio' => 'New bio'];
        $expectedProfile = new Profile();

        $this->profilesApiMock->expects($this->once())
            ->method('updateProfile')
            ->with($userId, $this->isInstanceOf(UpdateProfileRequest::class))
            ->willReturn($expectedProfile);

        $result = $this->userTask->updateProfile($userId, $updateData);
        $this->assertEquals($expectedProfile, $result);
    }

    public function testCreateApiTokenSuccess()
    {
        $userId = '123';
        $tokenData = ['name' => 'New Token'];
        $expectedToken = new APIToken();

        $this->tokensApiMock->expects($this->once())
            ->method('createApiToken')
            ->with($userId, $this->isInstanceOf(CreateApiTokenRequest::class))
            ->willReturn($expectedToken);

        $result = $this->userTask->createApiToken($userId, $tokenData);
        $this->assertEquals($expectedToken, $result);
    }

    public function testDeleteApiTokenSuccess()
    {
        $userId = '123';
        $tokenId = 'token123';

        $this->tokensApiMock->expects($this->once())
            ->method('deleteApiToken')
            ->with($userId, $tokenId);

        $this->userTask->deleteApiToken($userId, $tokenId);
    }

    public function testGetApiTokenSuccess()
    {
        $userId = '123';
        $tokenId = 'token123';
        $expectedToken = new APIToken();

        $this->tokensApiMock->expects($this->once())
            ->method('getApiToken')
            ->with($userId, $tokenId)
            ->willReturn($expectedToken);

        $result = $this->userTask->getApiToken($userId, $tokenId);
        $this->assertEquals($expectedToken, $result);
    }

    public function testDeleteLoginConnectionSuccess()
    {
        $provider = 'google';
        $userId = '123';

        $this->connectionsApiMock->expects($this->once())
            ->method('deleteLoginConnection')
            ->with($provider, $userId);

        $this->userTask->deleteLoginConnection($provider, $userId);
    }

    public function testGetLoginConnectionSuccess()
    {
        $provider = 'google';
        $userId = '123';
        $expectedConnection = new Connection();

        $this->connectionsApiMock->expects($this->once())
            ->method('getLoginConnection')
            ->with($provider, $userId)
            ->willReturn($expectedConnection);

        $result = $this->userTask->getLoginConnection($provider, $userId);
        $this->assertEquals($expectedConnection, $result);
    }

    public function testListLoginConnectionsSuccess()
    {
        $userId = '123';
        $expectedConnections = [new Connection()];

        $this->connectionsApiMock->expects($this->once())
            ->method('listLoginConnections')
            ->with($userId)
            ->willReturn($expectedConnections);

        $result = $this->userTask->listLoginConnections($userId);
        $this->assertEquals($expectedConnections, $result);
    }

    public function testListExtendedAccessSuccess()
    {
        $userId = '123';
        $expectedResponse = new ListUserExtendedAccess200Response();

        $this->grantsApiMock->expects($this->once())
            ->method('listUserExtendedAccess')
            ->with($userId, null, null, null)
            ->willReturn($expectedResponse);

        $result = $this->userTask->listExtendedAccess($userId);
        $this->assertEquals($expectedResponse, $result);
    }

    public function testConfirmTotpEnrollmentSuccess()
    {
        $userId = '123';
        $requestData = ['code' => '123456'];
        $expectedResponse = new ConfirmTotpEnrollment200Response();

        $this->mfaApiMock->expects($this->once())
            ->method('confirmTotpEnrollment')
            ->with($userId, $this->isInstanceOf(ConfirmTotpEnrollmentRequest::class))
            ->willReturn($expectedResponse);

        $result = $this->userTask->confirmTotpEnrollment($userId, $requestData);
        $this->assertEquals($expectedResponse, $result);
    }

    public function testGetTotpEnrollmentSuccess()
    {
        $userId = '123';
        $expectedResponse = new GetTotpEnrollment200Response();

        $this->mfaApiMock->expects($this->once())
            ->method('getTotpEnrollment')
            ->with($userId)
            ->willReturn($expectedResponse);

        $result = $this->userTask->getTotpEnrollment($userId);
        $this->assertEquals($expectedResponse, $result);
    }

    public function testRecreateRecoveryCodesSuccess()
    {
        $userId = '123';
        $expectedResponse = new ConfirmTotpEnrollment200Response();

        $this->mfaApiMock->expects($this->once())
            ->method('recreateRecoveryCodes')
            ->with($userId)
            ->willReturn($expectedResponse);

        $result = $this->userTask->recreateRecoveryCodes($userId);
        $this->assertEquals($expectedResponse, $result);
    }

    public function testWithdrawTotpEnrollmentSuccess()
    {
        $userId = '123';

        $this->mfaApiMock->expects($this->once())
            ->method('withdrawTotpEnrollment')
            ->with($userId);

        $this->userTask->withdrawTotpEnrollment($userId);
    }

    public function testConfirmPhoneNumberSuccess()
    {
        $sid = 'sid123';
        $userId = '123';
        $requestData = ['code' => '1234'];

        $this->phoneNumberApiMock->expects($this->once())
            ->method('confirmPhoneNumber')
            ->with($sid, $userId, $this->isInstanceOf(ConfirmPhoneNumberRequest::class));

        $this->userTask->confirmPhoneNumber($sid, $userId, $requestData);
    }

    public function testVerifyPhoneNumberSuccess()
    {
        $userId = '123';
        $requestData = ['phoneNumber' => '+1234567890'];
        $expectedResponse = new VerifyPhoneNumber200Response();

        $this->phoneNumberApiMock->expects($this->once())
            ->method('verifyPhoneNumber')
            ->with($userId, $this->isInstanceOf(VerifyPhoneNumberRequest::class))
            ->willReturn($expectedResponse);

        $result = $this->userTask->verifyPhoneNumber($userId, $requestData);
        $this->assertEquals($expectedResponse, $result);
    }

    public function testCreateProfilePictureNotImplemented()
    {
        $this->expectException(\BadMethodCallException::class);
        $this->expectExceptionMessage('Not implemented yet');

        $this->userTask->createProfilePicture('123');
    }

    public function testMeApiException()
    {
        $this->expectException(ApiException::class);
        $this->usersApiMock->expects($this->once())
            ->method('getCurrentUser')
            ->willThrowException($this->createMock(ApiException::class));

        $this->userTask->me();
    }

    public function testGetInvalidArgumentException()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->usersApiMock->expects($this->once())
            ->method('getUser')
            ->willThrowException(new InvalidArgumentException());

        $this->userTask->get('invalid-id');
    }
}