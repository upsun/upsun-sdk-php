<?php

namespace Upsun\Core\Tasks;

use BadMethodCallException;
use Psr\Http\Client\ClientExceptionInterface;
use Upsun\Api\ApiException;
use Upsun\Api\ApiTokensApi;
use Upsun\Api\ConnectionsApi;
use Upsun\Api\GrantsApi;
use Upsun\Api\MfaApi;
use Upsun\Api\PhoneNumberApi;
use Upsun\Api\UserAccessApi;
use Upsun\Api\UserProfilesApi;
use Upsun\Api\UsersApi;
use Upsun\Model\Address;
use Upsun\Model\ApiToken;
use Upsun\Model\ConfirmPhoneNumberRequest;
use Upsun\Model\ConfirmTotpEnrollment200Response;
use Upsun\Model\ConfirmTotpEnrollmentRequest;
use Upsun\Model\Connection;
use Upsun\Model\CreateApiTokenRequest;
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
 * @author    Upsun Advocacy Team
 * @license   MIT
 * @see       https://docs.upsun.com
 */
class UsersTask extends TaskBase
{
    public function __construct(
        UpsunClient $client,
        private readonly UsersApi $api,
        private readonly UserProfilesApi $profilesApi,
        private readonly UserAccessApi $accessApi,
        private readonly ApiTokensApi $tokensApi,
        private readonly ConnectionsApi $connectionsApi,
        private readonly GrantsApi $grantsApi,
        private readonly MfaApi $mfaApi,
        private readonly PhoneNumberApi $phoneNumberApi,
    ) {
        parent::__construct($client);
    }

    /**
     * Get the current user
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function me(): User
    {
        return $this->api->getCurrentUser();
    }

    /**
     * Checks if phone verification is required
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getCurrentUserVerificationStatus(): GetCurrentUserVerificationStatus200Response
    {
        return $this->api->getCurrentUserVerificationStatus();
    }

    /**
     * Checks if verification is required
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getCurrentUserVerificationStatusFull(): GetCurrentUserVerificationStatusFull200Response
    {
        return $this->api->getCurrentUserVerificationStatusFull();
    }

    /**
     * Gets a user
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function get(string $id): User
    {
        return $this->api->getUser(userId: $id);
    }

    /**
     * Gets a user by email
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getByEmailAddress(string $email): User
    {
        return $this->api->getUserByEmailAddress(email: $email);
    }

    /**
     * Gets a user by username
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getByUsername(string $username): User
    {
        return $this->api->getUserByUsername(username: $username);
    }

    /**
     * Resets email address
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function resetEmailAddress(
        string $userId,
        ?string $emailAddress = null
    ): void {
        $resetEmailAddressRequest = $emailAddress ? new ResetEmailAddressRequest(
            emailAddress: $emailAddress
        ) : null;
        $this->api->resetEmailAddress(userId: $userId, resetEmailAddressRequest: $resetEmailAddressRequest);
    }

    /**
     * Resets user password
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function resetPassword(string $userId): void
    {
        $this->api->resetPassword(userId: $userId);
    }

    /**
     * Updates a user
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function update(
        string $userId,
        ?string $username = null,
        ?string $firstName = null,
        ?string $lastName = null,
        ?string $picture = null,
        ?string $company = null,
        ?string $website = null,
        ?string $country = null,
    ): User {
        $updateUserRequest = new UpdateUserRequest(
            username: $username,
            firstName: $firstName,
            lastName: $lastName,
            picture: $picture,
            company: $company,
            website: $website,
            country: $country
        );
        return $this->api->updateUser(userId: $userId, updateUserRequest: $updateUserRequest);
    }

    /**
     * Gets user access for a project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getProjectUserAccess(string $projectId, string $userId): UserProjectAccess
    {
        return $this->accessApi->getProjectUserAccess(projectId: $projectId, userId: $userId);
    }

    /**
     * Gets project access for a user
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getUserProjectAccess(string $userId, string $projectId): UserProjectAccess
    {
        return $this->accessApi->getUserProjectAccess(userId: $userId, projectId: $projectId);
    }

    /**
     * Grants user access to a project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function grantProjectUserAccess(string $projectId, array $grantProjectUserAccessRequestInner): void
    {
        $this->accessApi->grantProjectUserAccess(
            projectId: $projectId,
            grantProjectUserAccessRequestInner: $grantProjectUserAccessRequestInner
        );
    }

    /**
     * Grants project access to a user
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function grantUserProjectAccess(string $userId, array $data): void
    {
        $this->accessApi->grantUserProjectAccess(userId: $userId, grantUserProjectAccessRequestInner: $data);
    }

    /**
     * Lists user access for a project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function listProjectUserAccess(
        string $projectId,
        ?int $pageSize = null,
        ?string $pageBefore = null,
        ?string $pageAfter = null,
        ?string $sort = null
    ): ListProjectUserAccess200Response {
        return $this->accessApi->listProjectUserAccess(
            projectId: $projectId,
            pageSize: $pageSize,
            pageBefore: $pageBefore,
            pageAfter: $pageAfter,
            sort: $sort
        );
    }

    /**
     * Lists project access for a user
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function listUserProjectAccess(
        string $userId,
        ?string $filterOrganizationId = null,
        ?int $pageSize = null,
        ?string $pageBefore = null,
        ?string $pageAfter = null,
        ?string $sort = null
    ): ListProjectUserAccess200Response {
        return $this->accessApi->listUserProjectAccess(
            userId: $userId,
            filterOrganizationId: $filterOrganizationId,
            pageSize: $pageSize,
            pageBefore: $pageBefore,
            pageAfter: $pageAfter,
            sort: $sort
        );
    }

    /**
     * Removes user access for a project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function removeProjectUserAccess(string $projectId, string $userId): void
    {
        $this->accessApi->removeProjectUserAccess(projectId: $projectId, userId: $userId);
    }

    /**
     * Removes project access for a user
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function removeUserProjectAccess(string $userId, string $projectId): void
    {
        $this->accessApi->removeUserProjectAccess(userId: $userId, projectId: $projectId);
    }

    /**
     * Updates user access for a project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function updateProjectUserAccess(
        string $projectId,
        string $userId,
        ?array $permissions = null
    ): void {
        $updateProjectUserAccessRequest = new UpdateProjectUserAccessRequest(
            permissions: $permissions
        );
        $this->accessApi->updateProjectUserAccess(
            projectId: $projectId,
            userId: $userId,
            updateProjectUserAccessRequest: $updateProjectUserAccessRequest
        );
    }

    /**
     * Updates project access for a user
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function updateUserProjectAccess(
        string $userId,
        string $projectId,
        ?array $permissions = null
    ): void {
        $updateProjectUserAccessRequest = new UpdateProjectUserAccessRequest(
            permissions: $permissions
        );
        $this->accessApi->updateUserProjectAccess(
            userId: $userId,
            projectId: $projectId,
            updateProjectUserAccessRequest: $updateProjectUserAccessRequest
        );
    }

    /**
     * Creates a user profile picture
     *
     * @throws BadMethodCallException Not implemented yet
     */
    public function createProfilePicture(string $uuid)
    {
        throw new BadMethodCallException("Not implemented yet, use function updateProfile instead");
    }

    /**
     * Deletes a user profile picture
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function deleteProfilePicture(string $uuid): void
    {
        $this->profilesApi->deleteProfilePicture(uuid: $uuid);
    }

    /**
     * Gets a user address
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getAddress(string $userId): GetAddress200Response
    {
        return $this->profilesApi->getAddress(userId: $userId);
    }

    /**
     * Gets a single user profile
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getProfile(string $userId): Profile
    {
        return $this->profilesApi->getProfile(userId: $userId);
    }

    /**
     * Lists current user profiles
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function listProfiles(): ListProfiles200Response
    {
        return $this->profilesApi->listProfiles();
    }

    /**
     * Updates a user address
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function updateAddress(
        string $userId,
        ?string $country = null,
        ?string $nameLine = null,
        ?string $premise = null,
        ?string $subPremise = null,
        ?string $thoroughfare = null,
        ?string $administrativeArea = null,
        ?string $subAdministrativeArea = null,
        ?string $locality = null,
        ?string $dependentLocality = null,
        ?string $postalCode = null,
    ): GetAddress200Response {
        $address = new Address(
            country: $country,
            nameLine: $nameLine,
            premise: $premise,
            subPremise: $subPremise,
            thoroughfare: $thoroughfare,
            administrativeArea: $administrativeArea,
            subAdministrativeArea: $subAdministrativeArea,
            locality: $locality,
            dependentLocality: $dependentLocality,
            postalCode: $postalCode
        );
        return $this->profilesApi->updateAddress(userId: $userId, address: $address);
    }

    /**
     * Updates a user profile
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function updateProfile(
        string $userId,
        ?string $displayName = null,
        ?string $username = null,
        ?string $currentPassword = null,
        ?string $password = null,
        ?string $companyType = null,
        ?string $companyName = null,
        ?string $vatNumber = null,
        ?string $companyRole = null,
        ?bool $marketing = null,
        ?string $uiColorscheme = null,
        ?string $defaultCatalog = null,
        ?string $projectOptionsUrl = null,
        ?string $picture = null,
    ): Profile {
        $updateProfileRequest = new UpdateProfileRequest(
            displayName: $displayName,
            username: $username,
            currentPassword: $currentPassword,
            password: $password,
            companyType: $companyType,
            companyName: $companyName,
            vatNumber: $vatNumber,
            companyRole: $companyRole,
            marketing: $marketing,
            uiColorscheme: $uiColorscheme,
            defaultCatalog: $defaultCatalog,
            projectOptionsUrl: $projectOptionsUrl,
            picture: $picture
        );
        return $this->profilesApi->updateProfile(userId: $userId, updateProfileRequest: $updateProfileRequest);
    }

    /**
     * Creates an API token
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function createApiToken(string $userId, string $name): ApiToken
    {
        $createApiTokenRequest = new CreateApiTokenRequest(name: $name);
        return $this->tokensApi->createApiToken(userId: $userId, createApiTokenRequest: $createApiTokenRequest);
    }

    /**
     * Deletes an API token
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function deleteApiToken(string $userId, string $tokenId): void
    {
        $this->tokensApi->deleteApiToken(userId: $userId, tokenId: $tokenId);
    }

    /**
     * Gets an API token
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getApiToken(string $userId, string $tokenId): ApiToken
    {
        return $this->tokensApi->getApiToken(userId: $userId, tokenId: $tokenId);
    }

    /**
     * Lists a user's API tokens
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @return ApiToken[]
     */
    public function listApiTokens(string $userId): array
    {
        return $this->tokensApi->listApiTokens(userId: $userId);
    }

    /**
     * Deletes a federated login connection
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function deleteLoginConnection(string $provider, string $userId): void
    {
        $this->connectionsApi->deleteLoginConnection(provider: $provider, userId: $userId);
    }

    /**
     * Gets a federated login connection
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getLoginConnection(string $provider, string $userId): Connection
    {
        return $this->connectionsApi->getLoginConnection(provider: $provider, userId: $userId);
    }

    /**
     * Lists federated login connections
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @return Connection[]
     */
    public function listLoginConnections(string $userId): array
    {
        return $this->connectionsApi->listLoginConnections(userId: $userId);
    }

    /**
     * Lists extended access of a user
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function listExtendedAccess(
        string $userId,
        ?array $filterResourceType = null,
        ?array $filterOrganizationId = null,
        ?array $filterPermissions = null
    ): ListUserExtendedAccess200Response {
        return $this->grantsApi->listUserExtendedAccess(
            userId: $userId,
            filterResourceType: $filterResourceType ?
                new StringFilter(...$this->normalizeFilter($filterResourceType)) : null,
            filterOrganizationId: $filterOrganizationId ?
                new StringFilter(...$this->normalizeFilter($filterOrganizationId)) : null,
            filterPermissions: $filterPermissions ?
                new StringFilter(...$this->normalizeFilter($filterPermissions)) : null,
        );
    }

    /**
     * Confirms TOTP enrollment
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function confirmTotpEnrollment(
        string $userId,
        string $secret,
        string $passCode
    ): ConfirmTotpEnrollment200Response {
        $confirmTotpEnrollmentRequest = new ConfirmTotpEnrollmentRequest(
            secret: $secret,
            passcode: $passCode
        );
        return $this->mfaApi->confirmTotpEnrollment(
            userId: $userId,
            confirmTotpEnrollmentRequest: $confirmTotpEnrollmentRequest
        );
    }

    /**
     * Get information about TOTP enrollment
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function getTotpEnrollment(string $userId): GetTotpEnrollment200Response
    {
        return $this->mfaApi->getTotpEnrollment(userId: $userId);
    }

    /**
     * Re-creates recovery codes
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function recreateRecoveryCodes(string $userId): void
    {
        $this->mfaApi->recreateRecoveryCodes(userId: $userId);
    }

    /**
     * Withdraws TOTP enrollment
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function withdrawTotpEnrollment(string $userId): void
    {
        $this->mfaApi->withdrawTotpEnrollment(userId: $userId);
    }

    /**
     * Confirms phone number
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function confirmPhoneNumber(string $sid, string $userId, string $code): void
    {
        $confirmPhoneNumberRequest = new ConfirmPhoneNumberRequest(code: $code);
        $this->phoneNumberApi->confirmPhoneNumber(
            sid: $sid,
            userId: $userId,
            confirmPhoneNumberRequest: $confirmPhoneNumberRequest
        );
    }

    /**
     * Verifies phone number
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function verifyPhoneNumber(
        string $userId,
        string $channel,
        string $phoneNumber,
    ): VerifyPhoneNumber200Response {
        $verifyPhoneNumberRequest = new VerifyPhoneNumberRequest(
            channel: $channel,
            phoneNumber: $phoneNumber
        );
        return $this->phoneNumberApi->verifyPhoneNumber(
            userId: $userId,
            verifyPhoneNumberRequest: $verifyPhoneNumberRequest
        );
    }
}
