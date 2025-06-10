<?php

namespace Upsun\Core\Tasks;

use InvalidArgumentException;
use OpenAPI\Client\ApiException;
use OpenAPI\Client\apisgen\APITokensApi;
use OpenAPI\Client\apisgen\ConnectionsApi;
use OpenAPI\Client\apisgen\GrantsApi;
use OpenAPI\Client\apisgen\MFAApi;
use OpenAPI\Client\apisgen\PhoneNumberApi;
use OpenAPI\Client\apisgen\UserAccessApi;
use OpenAPI\Client\apisgen\UserProfilesApi;
use OpenAPI\Client\apisgen\UsersApi;
use OpenAPI\Client\Model\Address;
use OpenAPI\Client\Model\APIToken;
use OpenAPI\Client\Model\ConfirmPhoneNumberRequest;
use OpenAPI\Client\Model\ConfirmTotpEnrollment200Response;
use OpenAPI\Client\Model\ConfirmTotpEnrollmentRequest;
use OpenAPI\Client\Model\Connection;
use OpenAPI\Client\Model\CreateApiTokenRequest;
use OpenAPI\Client\Model\Error;
use OpenAPI\Client\Model\GetAddress200Response;
use OpenAPI\Client\Model\GetCurrentUserVerificationStatus200Response;
use OpenAPI\Client\Model\GetCurrentUserVerificationStatusFull200Response;
use OpenAPI\Client\Model\GetTotpEnrollment200Response;
use OpenAPI\Client\Model\ListProfiles200Response;
use OpenAPI\Client\Model\ListProjectUserAccess200Response;
use OpenAPI\Client\Model\ListUserExtendedAccess200Response;
use OpenAPI\Client\Model\Profile;
use OpenAPI\Client\Model\ResetEmailAddressRequest;
use OpenAPI\Client\Model\UpdateProfileRequest;
use OpenAPI\Client\Model\UpdateProjectUserAccessRequest;
use OpenAPI\Client\Model\UpdateUserRequest;
use OpenAPI\Client\Model\User;
use OpenAPI\Client\Model\UserProjectAccess;
use OpenAPI\Client\Model\VerifyPhoneNumber200Response;
use OpenAPI\Client\Model\VerifyPhoneNumberRequest;
use Upsun\Exception\UpsunException;
use Upsun\UpsunClient;

class UserTask extends TaskBase
{

    public function __construct(
        private readonly UpsunClient     $client, // used in the TaskBase class
        private readonly UsersApi        $api,
        private readonly UserProfilesApi $profilesApi,
        private readonly UserAccessApi   $accessApi,
        private readonly APITokensApi    $tokensApi,
        private readonly ConnectionsApi  $connectionsApi,
        private readonly GrantsApi       $grantsApi,
        private readonly MFAApi          $mfaApi,
        private readonly PhoneNumberApi  $phoneNumberApi,
    )
    {
    }

    /**
     * Get the current user
     *
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function me(): Error|User
    {
        $this->refreshToken();
        return $this->api->getCurrentUser();
    }

    /**
     * Checks if phone verification is required
     *
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getCurrentUserVerificationStatus(): GetCurrentUserVerificationStatus200Response
    {
        $this->refreshToken();
        return $this->api->getCurrentUserVerificationStatus();
    }

    /**
     * Checks if verification is required
     *
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getCurrentUserVerificationStatusFull(): GetCurrentUserVerificationStatusFull200Response
    {
        $this->refreshToken();
        return $this->api->getCurrentUserVerificationStatusFull();
    }

    /**
     * Gets a user
     *
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function get(string $id): Error|User
    {
        $this->refreshToken();
        return $this->api->getUser($id);
    }

    /**
     * Gets a user by email
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     */
    public function getByEmailAddress(string $email): User|Error
    {
        $this->refreshToken();
        return $this->api->getUserByEmailAddress($email);
    }

    /**
     * Gets a user by username
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     */
    public function getByUsername(string $username): User|Error
    {
        $this->refreshToken();
        return $this->api->getUserByUsername($username);
    }

    /**
     * Resets email address
     *
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function resetEmailAddress(
        string                    $userId,
        ?ResetEmailAddressRequest $resetEmailAddressRequest = null
    ): void
    {
        $this->refreshToken();
        $this->api->resetEmailAddress($userId, $resetEmailAddressRequest);
    }

    /**
     * Resets user password
     *
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function resetPassword(string $userId): void
    {
        $this->refreshToken();
        $this->api->resetPassword($userId);
    }

    /**
     * Updates a user
     *
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function update(string $userId, ?array $update_user_data = []): User|Error
    {
        $this->refreshToken();
        $update_user_request = new UpdateUserRequest($update_user_data);
        return $this->api->updateUser($userId, $update_user_request);
    }

    /**
     * Gets user access for a project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getProjectUserAccess(string $projectId, string $userId): Error|UserProjectAccess
    {
        $this->refreshToken();
        return $this->accessApi->getProjectUserAccess($projectId, $userId);
    }

    /**
     * Gets project access for a user
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getUserProjectAccess(string $userId, string $projectId): Error|UserProjectAccess
    {
        $this->refreshToken();
        return $this->accessApi->getUserProjectAccess($userId, $projectId);
    }

    /**
     * Grants user access to a project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function grantProjectUserAccess(string $projectId, array $grantProjectUserAccessRequestInner): void
    {
        $this->refreshToken();
        $this->accessApi->grantProjectUserAccess($projectId, $grantProjectUserAccessRequestInner);
    }

    /**
     * Grants project access to a user
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function grantUserProjectAccess(string $userId, array $grantUserProjectAccessRequest): void
    {
        $this->refreshToken();
        $this->accessApi->grantUserProjectAccess($userId, $grantUserProjectAccessRequest);
    }

    /**
     * Lists user access for a project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listProjectUserAccess(
        string  $projectId,
        ?int    $pageSize = null,
        ?string $pageBefore = null,
        ?string $pageAfter = null,
        ?string $sort = null
    ): ListProjectUserAccess200Response|Error
    {
        $this->refreshToken();
        return $this->accessApi->listProjectUserAccess($projectId, $pageSize, $pageBefore, $pageAfter, $sort);
    }

    /**
     * Lists project access for a user
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listUserProjectAccess(
        string  $userId,
        ?string $filterOrganizationId = null,
        ?int    $pageSize = null,
        ?string $pageBefore = null,
        ?string $pageAfter = null,
        ?string $sort = null
    ): ListProjectUserAccess200Response|Error
    {
        $this->refreshToken();
        return $this->accessApi->listUserProjectAccess(
            $userId,
            $filterOrganizationId,
            $pageSize,
            $pageBefore,
            $pageAfter,
            $sort
        );
    }

    /**
     * Removes user access for a project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function removeProjectUserAccess(string $projectId, string $userId): void
    {
        $this->refreshToken();
        $this->accessApi->removeProjectUserAccess($projectId, $userId);
    }

    /**
     * Removes project access for a user
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function removeUserProjectAccess(string $userId, string $projectId): void
    {
        $this->refreshToken();
        $this->accessApi->removeUserProjectAccess($userId, $projectId);
    }

    /**
     * Updates user access for a project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function updateProjectUserAccess(
        string $projectId,
        string $userId,
        ?array $updateProjectUserAccessRequest = null
    ): void
    {
        $this->refreshToken();
        $updateProjectUserAccessRequest = new UpdateProjectUserAccessRequest($updateProjectUserAccessRequest);
        $this->accessApi->updateProjectUserAccess($projectId, $userId, $updateProjectUserAccessRequest);
    }

    /**
     * Updates project access for a user
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function updateUserProjectAccess(
        string $userId,
        string $projectId,
        ?array $updateProjectUserAccessRequest = null
    ): void
    {
        $this->refreshToken();
        $updateProjectUserAccessRequest = new UpdateProjectUserAccessRequest($updateProjectUserAccessRequest);
        $this->accessApi->updateUserProjectAccess($projectId, $userId, $updateProjectUserAccessRequest);
    }

    /**
     * Creates a user profile picture
     *
     * @throws UpsunException on non-2xx response or if the response body is not in the expected format
     */
    public function createProfilePicture(string $uuid)
    {
        throw new UpsunException("Not implemented (yet)");
    }

    /**
     * Deletes a user profile picture
     *
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function deleteProfilePicture(string $uuid): void
    {
        $this->refreshToken();
        $this->profilesApi->deleteProfilePicture($uuid);
    }

    /**
     * Gets a user address
     *
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getAddress(string $userId): GetAddress200Response
    {
        $this->refreshToken();
        return $this->profilesApi->getAddress($userId);
    }

    /**
     * Gets a single user profile
     *
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getProfile(string $userId): Profile
    {
        $this->refreshToken();
        return $this->profilesApi->getProfile($userId);
    }

    /**
     * Lists current user profiles
     *
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listProfiles(): ListProfiles200Response
    {
        $this->refreshToken();
        return $this->profilesApi->listProfiles();
    }

    /**
     * Updates a user address
     *
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function updateAddress(string $userId, ?Address $address = null): GetAddress200Response
    {
        $this->refreshToken();
        return $this->profilesApi->updateAddress($userId, $address);
    }

    /**
     * Updates a user profile
     *
     * @throws InvalidArgumentException
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function updateProfile(string $userId, ?array $updateProfileData = []): Profile
    {
        $this->refreshToken();
        $update_profile_request = new UpdateProfileRequest($updateProfileData);
        return $this->profilesApi->updateProfile($userId, $update_profile_request);
    }

    /**
     * Creates an API token
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function createApiToken(string $userId, ?array $createApiTokenRequest = null): Error|APIToken
    {
        $this->refreshToken();
        $createApiTokenRequest = new CreateApiTokenRequest($createApiTokenRequest);
        return $this->tokensApi->createApiToken($userId, $createApiTokenRequest);
    }

    /**
     * Deletes an API token
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function deleteApiToken(string $userId, string $token_id): void
    {
        $this->refreshToken();
        $this->tokensApi->deleteApiToken($userId, $token_id);
    }

    /**
     * Gets an API token
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getApiToken(string $userId, string $token_id): Error|APIToken
    {
        $this->refreshToken();
        return $this->tokensApi->getApiToken($userId, $token_id);
    }

    /**
     * Lists a user's API tokens
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listApiTokens(string $userId): Error|array
    {
        $this->refreshToken();
        return $this->tokensApi->createApiToken($userId);
    }

    /**
     * Deletes a federated login connection
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function deleteLoginConnection(string $provider, string $userId): void
    {
        $this->refreshToken();
        $this->connectionsApi->deleteLoginConnection($provider, $userId);
    }

    /**
     * Gets a federated login connection
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getLoginConnection(string $provider, string $userId): Error|Connection
    {
        $this->refreshToken();
        return $this->connectionsApi->getLoginConnection($provider, $userId);
    }

    /**
     * Lists federated login connections
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listLoginConnections(string $userId): array|Error
    {
        $this->refreshToken();
        return $this->connectionsApi->listLoginConnections($userId);
    }

    /**
     * Lists extended access of a user
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listExtendedAccess(
        string $userId,
        ?array $filterResourceType = null,
        ?array $filterOrganizationId = null,
        ?array $filterPermissions = null
    ): ListUserExtendedAccess200Response|Error
    {
        $this->refreshToken();
        return $this->grantsApi->listUserExtendedAccess(
            $userId,
            $filterResourceType,
            $filterOrganizationId,
            $filterPermissions
        );
    }

    /**
     * Confirms TOTP enrollment
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function confirmTotpEnrollment(
        string $userId,
        ?array  $confirmTotpEnrollmentRequest = null
    ): ConfirmTotpEnrollment200Response|Error
    {
        $this->refreshToken();
        $confirmTotpEnrollmentRequest = new ConfirmTotpEnrollmentRequest($confirmTotpEnrollmentRequest);
        return $this->mfaApi->confirmTotpEnrollment($userId, $confirmTotpEnrollmentRequest);
    }

    /**
     * Operation getTotpEnrollment
     *
     * Get information about TOTP enrollment
     *
     * @param string $userId The ID of the user. (required)
     * @return GetTotpEnrollment200Response|Error
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function getTotpEnrollment(string $userId): GetTotpEnrollment200Response|Error
    {
        $this->refreshToken();
        return $this->mfaApi->getTotpEnrollment($userId);
    }

    /**
     * Re-creates recovery codes
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function recreateRecoveryCodes(string $userId): ConfirmTotpEnrollment200Response|Error
    {
        $this->refreshToken();
        return $this->mfaApi->recreateRecoveryCodes($userId);
    }

    /**
     * Withdraws TOTP enrollment
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function withdrawTotpEnrollment(string $userId): void
    {
        $this->refreshToken();
        $this->mfaApi->withdrawTotpEnrollment($userId);
    }
    
    /**
     * Confirms phone number
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function confirmPhoneNumber(string $sid, string $userId, ?array $confirmPhoneNumberRequest = null): void
    {
        $this->refreshToken();
        $confirmPhoneNumberRequest = new ConfirmPhoneNumberRequest($confirmPhoneNumberRequest);
        $this->phoneNumberApi->confirmPhoneNumber($sid, $userId, $confirmPhoneNumberRequest);
    }

    /**
     * Verifies phone number
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function verifyPhoneNumber(
        string $userId,
        ?array  $verifyPhoneNumberRequest = null
    ): VerifyPhoneNumber200Response|Error
    {
        $this->refreshToken();
        $verifyPhoneNumberRequest = new VerifyPhoneNumberRequest($verifyPhoneNumberRequest);
        return $this->phoneNumberApi->verifyPhoneNumber($userId, $verifyPhoneNumberRequest);
    }
}
