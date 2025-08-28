<?php

namespace Upsun\Core\Tasks;

use Exception;
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
use Upsun\Model\StringFilter;
use Upsun\Model\UpdateProfileRequest;
use Upsun\Model\UpdateProjectUserAccessRequest;
use Upsun\Model\UpdateUserRequest;
use Upsun\Model\User;
use Upsun\Model\UserProjectAccess;
use Upsun\Model\VerifyPhoneNumber200Response;
use Upsun\Model\VerifyPhoneNumberRequest;
use Upsun\UpsunClient;

/**
 * UserTask class.
 *
 * @author    Upsun SDK Team
 * @license   Apache-2.0
 * @see       https://docs.upsun.com
 */
class UserTask extends TaskBase
{
    public function __construct(
        public UpsunClient $client,
        private readonly UsersApi $api,
        private readonly UserProfilesApi $profilesApi,
        private readonly UserAccessApi $accessApi,
        private readonly APITokensApi $tokensApi,
        private readonly ConnectionsApi $connectionsApi,
        private readonly GrantsApi $grantsApi,
        private readonly MFAApi $mfaApi,
        private readonly PhoneNumberApi $phoneNumberApi,
    ) {
        parent::__construct($this->client);
    }

    /**
     * Get the current user
     *
     * @throws InvalidArgumentException
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function me(): Error|User
    {
        return $this->api->getCurrentUser();
    }

    /**
     * Checks if phone verification is required
     *
     * @throws InvalidArgumentException
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function getCurrentUserVerificationStatus(): GetCurrentUserVerificationStatus200Response
    {
        return $this->api->getCurrentUserVerificationStatus();
    }

    /**
     * Checks if verification is required
     *
     * @throws InvalidArgumentException
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function getCurrentUserVerificationStatusFull(): GetCurrentUserVerificationStatusFull200Response
    {
        return $this->api->getCurrentUserVerificationStatusFull();
    }

    /**
     * Gets a user
     *
     * @throws InvalidArgumentException
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function get(string $id): Error|User
    {
        return $this->api->getUser($id);
    }

    /**
     * Gets a user by email
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     */
    public function getByEmailAddress(string $email): User|Error
    {
        return $this->api->getUserByEmailAddress($email);
    }

    /**
     * Gets a user by username
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     */
    public function getByUsername(string $username): User|Error
    {
        return $this->api->getUserByUsername($username);
    }

    /**
     * Resets email address
     *
     * @throws InvalidArgumentException
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function resetEmailAddress(
        string $userId,
        ?ResetEmailAddressRequest $resetEmailAddressRequest = null
    ): void {
        $this->api->resetEmailAddress($userId, $resetEmailAddressRequest);
    }

    /**
     * Resets user password
     *
     * @throws InvalidArgumentException
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function resetPassword(string $userId): void
    {
        $this->api->resetPassword($userId);
    }

    /**
     * Updates a user
     *
     * @throws InvalidArgumentException
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function update(string $userId, ?array $update_user_data = []): User|Error
    {
        $update_user_request = new UpdateUserRequest($update_user_data);
        return $this->api->updateUser($userId, $update_user_request);
    }

    /**
     * Gets user access for a project
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function getProjectUserAccess(string $projectId, string $userId): Error|UserProjectAccess
    {
        return $this->accessApi->getProjectUserAccess($projectId, $userId);
    }

    /**
     * Gets project access for a user
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function getUserProjectAccess(string $userId, string $projectId): Error|UserProjectAccess
    {
        return $this->accessApi->getUserProjectAccess($userId, $projectId);
    }

    /**
     * Grants user access to a project
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function grantProjectUserAccess(string $projectId, array $grantProjectUserAccessRequestInner): void
    {
        $this->accessApi->grantProjectUserAccess($projectId, $grantProjectUserAccessRequestInner);
    }

    /**
     * Grants project access to a user
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function grantUserProjectAccess(string $userId, array $grantUserProjectAccessRequest): void
    {
        $this->accessApi->grantUserProjectAccess($userId, $grantUserProjectAccessRequest);
    }

    /**
     * Lists user access for a project
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function listProjectUserAccess(
        string $projectId,
        ?int $pageSize = null,
        ?string $pageBefore = null,
        ?string $pageAfter = null,
        ?string $sort = null
    ): ListProjectUserAccess200Response|Error {
        return $this->accessApi->listProjectUserAccess($projectId, $pageSize, $pageBefore, $pageAfter, $sort);
    }

    /**
     * Lists project access for a user
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function listUserProjectAccess(
        string $userId,
        ?string $filterOrganizationId = null,
        ?int $pageSize = null,
        ?string $pageBefore = null,
        ?string $pageAfter = null,
        ?string $sort = null
    ): ListProjectUserAccess200Response|Error {
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
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function removeProjectUserAccess(string $projectId, string $userId): void
    {
        $this->accessApi->removeProjectUserAccess($projectId, $userId);
    }

    /**
     * Removes project access for a user
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function removeUserProjectAccess(string $userId, string $projectId): void
    {
        $this->accessApi->removeUserProjectAccess($userId, $projectId);
    }

    /**
     * Updates user access for a project
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function updateProjectUserAccess(
        string $projectId,
        string $userId,
        ?array $updateProjectUserAccessRequest = null
    ): void {
        $updateProjectUserAccessRequest = new UpdateProjectUserAccessRequest($updateProjectUserAccessRequest);
        $this->accessApi->updateProjectUserAccess($projectId, $userId, $updateProjectUserAccessRequest);
    }

    /**
     * Updates project access for a user
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function updateUserProjectAccess(
        string $userId,
        string $projectId,
        ?array $updateProjectUserAccessRequest = null
    ): void {
        $updateProjectUserAccessRequest = new UpdateProjectUserAccessRequest($updateProjectUserAccessRequest);
        $this->accessApi->updateUserProjectAccess($projectId, $userId, $updateProjectUserAccessRequest);
    }

    /**
     * Creates a user profile picture
     *
     * @throws \BadMethodCallException Not implemented yet
     */
    public function createProfilePicture(string $uuid)
    {
        throw new \BadMethodCallException("Not implemented yet");
    }

    /**
     * Deletes a user profile picture
     *
     * @throws InvalidArgumentException
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function deleteProfilePicture(string $uuid): void
    {
        $this->profilesApi->deleteProfilePicture($uuid);
    }

    /**
     * Gets a user address
     *
     * @throws InvalidArgumentException
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function getAddress(string $userId): GetAddress200Response
    {
        return $this->profilesApi->getAddress($userId);
    }

    /**
     * Gets a single user profile
     *
     * @throws InvalidArgumentException
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function getProfile(string $userId): Profile
    {
        return $this->profilesApi->getProfile($userId);
    }

    /**
     * Lists current user profiles
     *
     * @throws InvalidArgumentException
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function listProfiles(): ListProfiles200Response
    {
        return $this->profilesApi->listProfiles();
    }

    /**
     * Updates a user address
     *
     * @throws InvalidArgumentException
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function updateAddress(string $userId, ?Address $address = null): GetAddress200Response
    {
        return $this->profilesApi->updateAddress($userId, $address);
    }

    /**
     * Updates a user profile
     *
     * @throws InvalidArgumentException
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function updateProfile(string $userId, ?array $updateProfileData = []): Profile
    {
        $update_profile_request = new UpdateProfileRequest($updateProfileData);
        return $this->profilesApi->updateProfile($userId, $update_profile_request);
    }

    /**
     * Creates an API token
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function createApiToken(string $userId, ?array $createApiTokenRequest = null): Error|APIToken
    {
        $createApiTokenRequest = new CreateApiTokenRequest($createApiTokenRequest);
        return $this->tokensApi->createApiToken($userId, $createApiTokenRequest);
    }

    /**
     * Deletes an API token
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function deleteApiToken(string $userId, string $token_id): void
    {
        $this->tokensApi->deleteApiToken($userId, $token_id);
    }

    /**
     * Gets an API token
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function getApiToken(string $userId, string $token_id): Error|APIToken
    {
        return $this->tokensApi->getApiToken($userId, $token_id);
    }

    /**
     * Lists a user's API tokens
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function listApiTokens(string $userId): APIToken
    {
        return $this->tokensApi->createApiToken($userId);
    }

    /**
     * Deletes a federated login connection
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function deleteLoginConnection(string $provider, string $userId): void
    {
        $this->connectionsApi->deleteLoginConnection($provider, $userId);
    }

    /**
     * Gets a federated login connection
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function getLoginConnection(string $provider, string $userId): Error|Connection
    {
        return $this->connectionsApi->getLoginConnection($provider, $userId);
    }

    /**
     * Lists federated login connections
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function listLoginConnections(string $userId): array|Error
    {
        return $this->connectionsApi->listLoginConnections($userId);
    }

    /**
     * Lists extended access of a user
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function listExtendedAccess(
        string $userId,
        ?array $filterResourceType = null,
        ?array $filterOrganizationId = null,
        ?array $filterPermissions = null
    ): ListUserExtendedAccess200Response|Error {
        return $this->grantsApi->listUserExtendedAccess(
            $userId,
            new StringFilter($filterResourceType),
            new StringFilter($filterOrganizationId),
            new StringFilter($filterPermissions)
        );
    }

    /**
     * Confirms TOTP enrollment
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function confirmTotpEnrollment(
        string $userId,
        ?array $confirmTotpEnrollmentRequest = null
    ): ConfirmTotpEnrollment200Response|Error {
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
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function getTotpEnrollment(string $userId): GetTotpEnrollment200Response|Error
    {
        return $this->mfaApi->getTotpEnrollment($userId);
    }

    /**
     * Re-creates recovery codes
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function recreateRecoveryCodes(string $userId): ConfirmTotpEnrollment200Response|Error
    {
        return $this->mfaApi->recreateRecoveryCodes($userId);
    }

    /**
     * Withdraws TOTP enrollment
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function withdrawTotpEnrollment(string $userId): void
    {
        $this->mfaApi->withdrawTotpEnrollment($userId);
    }

    /**
     * Confirms phone number
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function confirmPhoneNumber(string $sid, string $userId, ?array $confirmPhoneNumberRequest = null): void
    {
        $confirmPhoneNumberRequest = new ConfirmPhoneNumberRequest($confirmPhoneNumberRequest);
        $this->phoneNumberApi->confirmPhoneNumber($sid, $userId, $confirmPhoneNumberRequest);
    }

    /**
     * Verifies phone number
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function verifyPhoneNumber(
        string $userId,
        ?array $verifyPhoneNumberRequest = null
    ): VerifyPhoneNumber200Response|Error {
        $verifyPhoneNumberRequest = new VerifyPhoneNumberRequest($verifyPhoneNumberRequest);
        return $this->phoneNumberApi->verifyPhoneNumber($userId, $verifyPhoneNumberRequest);
    }
}
