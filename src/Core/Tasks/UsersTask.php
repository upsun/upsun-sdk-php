<?php

namespace Upsun\Core\Tasks;

use BadMethodCallException;
use InvalidArgumentException;
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
use Upsun\Model\GrantProjectUserAccessRequestInner;
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
        private readonly UserAccessApi $userAccessApi,
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
     * Note that user creation is not supported through the API, and this method will throw an error if called.
     * Use `upsun.invitations.createOrgInvite()` to invite users to your organization instead,
     * or `upsun.invitations.createProjectInvite()` to invite users to specific projects.
     * Inviting users to your organization or projects will send them an email invitation,
     * which will allow them to create their own accounts and join your organization with the appropriate permissions.
     * @throws BadMethodCallException Always, as user creation is not supported through the API
     */
    public function create(): void
    {
        throw new BadMethodCallException(
            'User creation is not supported through the API, invite users to your organization or project instead.',
        );
    }

    /**
     * Adds users to a project with specified permissions.
     * This method allows you to grant access to a project for one or more users, specifying their access levels
     * and permissions within the project.
     * @return void
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the project ID is invalid, or if permissions are not properly specified
     */
    public function addToProject(
        string $projectId, 
        array $permissions
    ): void {
        $this->checkProjectId($projectId);

        if(empty($permissions)) {
            throw new InvalidArgumentException('At least one user permission is required to add a user to a project');
        }

        $this->userAccessApi->grantProjectUserAccess(
            projectId: $projectId,
            grantProjectUserAccessRequestInner: $permissions
        );
    }

    /**
     * Removes a user's access to a project.
     * Note that this does not delete the user from the system, but simply revokes their access to the specified project.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the project ID or user ID is invalid
     */
    public function removeFromProject(string $userId, string $projectId): void
    {
        $this->checkProjectId($projectId);
        $this->checkUserId($userId);
        
        $this->userAccessApi->removeProjectUserAccess(projectId: $projectId, userId: $userId);
    }

    /**
     * Retrieves information about a specific user by their ID.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the user ID is invalid
     */
    public function get(string $userId): User
    {
        $this->checkUserId($userId);

        return $this->api->getUser(userId: $userId);
    }    

    /**
     * Lists all users who have access to a specific project, along with their access levels and permissions.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the project ID is invalid
     */
    public function listProjectUserAccesses(
        string $projectId,
        ?int $pageSize = null,
        ?string $pageBefore = null,
        ?string $pageAfter = null,
        ?string $sort = null
    ): ListProjectUserAccess200Response {
        $this->checkProjectId($projectId);

        return $this->userAccessApi->listProjectUserAccess(
            projectId: $projectId,
            pageSize: $pageSize,
            pageBefore: $pageBefore,
            pageAfter: $pageAfter,
            sort: $sort
        );
    }

    /**
     * Updates a user
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the user ID is invalid
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
        $this->checkUserId($userId);
        
        return $this->api->updateUser(
            userId: $userId, 
            updateUserRequest: new UpdateUserRequest(
                username: $username,
                firstName: $firstName,
                lastName: $lastName,
                picture: $picture,
                company: $company,
                website: $website,
                country: $country
            )
        );
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
     * Gets a user by email
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the email is invalid
     */
    public function getByEmailAddress(string $email): User
    {
        $this->checkEmail($email);
        
        return $this->api->getUserByEmailAddress(email: $email);
    }

    /**
     * Gets a user by username
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the username is invalid
     */
    public function getByUsername(string $username): User
    {
        $this->checkUsername($username);
        
        return $this->api->getUserByUsername(username: $username);
    }

    /**
     * Resets email address
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the user ID is invalid, or if the email address is invalid
     */
    public function resetEmailAddress(
        string $userId,
        ?string $emailAddress = null
    ): void {
        $this->checkUserId($userId);
        if ($emailAddress) { $this->checkEmail($emailAddress); }

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
     * @throws InvalidArgumentException if the user ID is invalid
     */
    public function resetPassword(string $userId): void
    {
        $this->checkUserId($userId);

        $this->api->resetPassword(userId: $userId);
    }

    /**
     * Gets user access for a project
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the project ID or user ID is invalid
     */
    public function getUserProjectAccessByProject(string $projectId, string $userId): UserProjectAccess
    {
        $this->checkProjectId($projectId);
        $this->checkUserId($userId);

        return $this->userAccessApi->getProjectUserAccess(projectId: $projectId, userId: $userId);
    }

    /**
     * Gets user access for a project
     *
     * @deprecated use getUserProjectAccessByProject instead
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the project ID or user ID is invalid
     */
    public function getProjectUserAccess(string $projectId, string $userId): UserProjectAccess
    {
        return $this->getUserProjectAccessByProject(projectId: $projectId, userId: $userId);
    }

    /**
     * Gets project access for a user
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the user ID or project ID is invalid
     */
    public function getUserProjectAccessByUser(string $userId, string $projectId): UserProjectAccess
    {
        $this->checkUserId($userId);
        $this->checkProjectId($projectId);

        return $this->userAccessApi->getUserProjectAccess(userId: $userId, projectId: $projectId);
    }

    /**
     * Gets project access for a user
     *
     * @deprecated use getUserProjectAccessByUser instead
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the user ID or project ID is invalid
     */
    public function getUserProjectAccess(string $userId, string $projectId): UserProjectAccess
    {
        $this->checkUserId($userId);
        $this->checkProjectId($projectId);

        return $this->userAccessApi->getUserProjectAccess(userId: $userId, projectId: $projectId);
    }

    /**
     * Grants user access to a project
     *
     * @deprecated use addToProject instead
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the project ID is invalid
     */
    public function grantProjectUserAccess(string $projectId, array $grantProjectUserAccessRequestInner): void
    {
        $this->addToProject($projectId, $grantProjectUserAccessRequestInner);
    }

    /**
     * Grants project access to a user
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the user ID is invalid
     */
    public function grantUserProjectAccessByUser(string $userId, array $data): void
    {
        $this->checkUserId($userId);

        $this->userAccessApi->grantUserProjectAccess(userId: $userId, grantUserProjectAccessRequestInner: $data);
    }

    /**
     * Grants project access to a user
     *
     * @deprecated use grantUserProjectAccessByUser instead
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the user ID is invalid
     */
    public function grantUserProjectAccess(string $userId, array $data): void
    {
        $this->grantUserProjectAccessByUser(userId: $userId, data: $data);
    }

    /**
     * Lists user access for a project
     *
     * @deprecated use listProjectUserAccesses instead
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the project ID is invalid
     */
    public function listProjectUserAccess(
        string $projectId,
        ?int $pageSize = null,
        ?string $pageBefore = null,
        ?string $pageAfter = null,
        ?string $sort = null
    ): ListProjectUserAccess200Response {
        return $this->listProjectUserAccesses(
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
     * @throws InvalidArgumentException if the user ID is invalid
     */
    public function listUserProjectAccessByUser(
        string $userId,
        ?string $filterOrganizationId = null,
        ?int $pageSize = null,
        ?string $pageBefore = null,
        ?string $pageAfter = null,
        ?string $sort = null
    ): ListProjectUserAccess200Response {
        $this->checkUserId($userId);

        return $this->userAccessApi->listUserProjectAccess(
            userId: $userId,
            filterOrganizationId: $filterOrganizationId,
            pageSize: $pageSize,
            pageBefore: $pageBefore,
            pageAfter: $pageAfter,
            sort: $sort
        );
    }

    /**
     * Lists project access for a user
     *
     * @deprecated use listUserProjectAccessByUser instead
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the user ID is invalid
     */
    public function listUserProjectAccess(
        string $userId,
        ?string $filterOrganizationId = null,
        ?int $pageSize = null,
        ?string $pageBefore = null,
        ?string $pageAfter = null,
        ?string $sort = null
    ): ListProjectUserAccess200Response {
        return $this->listUserProjectAccessByUser(
            userId: $userId,
            filterOrganizationId: $filterOrganizationId,
            pageSize: $pageSize,
            pageBefore: $pageBefore,
            pageAfter: $pageAfter,
            sort: $sort
        );
    }    

    /**
     * Retrieves a list of all projects that a user has access to, along with their access levels and permissions for 
     * each project. This method provides an extended view of the user's access, which may include additional details 
     * about the projects and the user's permissions within those projects, making it easier to manage and review user 
     * access across multiple projects.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the user ID is invalid
     */
    public function listExtendedAccess(
        string $userId,
        ?array $filterResourceType = null,
        ?array $filterOrganizationId = null,
        ?array $filterPermissions = null
    ): ListUserExtendedAccess200Response {
        $this->checkUserId($userId);

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
     * Revokes a user's access to a project. This method revokes the user's permissions for the specified project,
     * effectively preventing them from accessing or collaborating on the project. Note that this does not delete the user
     * from the system, but simply removes their access to the specified project.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the project ID or user ID is invalid
     */
    public function revokeUserProjectAccessByUser(string $userId, string $projectId): void
    {
        $this->checkProjectId($projectId);
        $this->checkUserId($userId);

        $this->userAccessApi->removeUserProjectAccess(userId: $userId, projectId: $projectId);
    }

    /**
     * Removes user access for a project
     *
     * @deprecated use revokeUserProjectAccessByUser instead
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the project ID or user ID is invalid
     */
    public function removeProjectUserAccess(string $projectId, string $userId): void
    {
        $this->revokeUserProjectAccessByUser($userId, $projectId);
    }

    /**
     * Removes project access for a user
     *
     * @deprecated use removeUserProjectAccessByUser instead
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the user ID or project ID is invalid
     */
    public function removeUserProjectAccess(string $userId, string $projectId): void
    {
        $this->revokeUserProjectAccessByUser($userId, $projectId);
    }    

    /**
     * Updates a user's access level and permissions for a specific project. This method allows you to modify the access
     * permissions of a user for a project, which can be useful for managing user roles and ensuring that users have the
     * appropriate level of access to perform their tasks within the project. By updating a user's project access, you 
     * can grant them additional permissions or restrict their access as needed.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the project ID or user ID is invalid, or if permissions are empty.
     */
    public function updateProjectUserAccessByProject(
        string $projectId,
        string $userId,
        ?array $permissions = null
    ): void {
        $this->checkProjectId($projectId);
        $this->checkUserId($userId);
        
        if (empty($permissions)) {
            throw new InvalidArgumentException(
                'Permissions array cannot be empty when updating project user access'
            );
        }

        $this->userAccessApi->updateProjectUserAccess(
            projectId: $projectId,
            userId: $userId,
            updateProjectUserAccessRequest: new UpdateProjectUserAccessRequest(
                permissions: $permissions
            )
        );
    }

    /**
     * Updates a user's access level and permissions for a specific project. This method allows you to modify the access
     * permissions of a user for a project, which can be useful for managing user roles and ensuring that users have the
     * appropriate level of access to perform their tasks within the project. By updating a user's project access, you 
     * can grant them additional permissions or restrict their access as needed.
     *
     * @deprecated use updateProjectUserAccessByProject instead
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the project ID or user ID is invalid, or if permissions are empty.
     */
    public function updateProjectUserAccess(
        string $projectId,
        string $userId,
        ?array $permissions = null
    ): void {
        $this->updateProjectUserAccessByProject( projectId: $projectId, userId: $userId, permissions: $permissions );
    }

    /**
     * Updates a user's access level and permissions for a specific project. This method allows you to modify the access
     * permissions of a user for a project, which can be useful for managing user roles and ensuring that users have the
     * appropriate level of access to perform their tasks within the project. By updating a user's project access, you
     * can grant them additional permissions or restrict their access as needed.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the project ID or user ID is invalid, or if permissions are empty.
     */
    public function updateUserProjectAccessByUser(
        string $userId,
        string $projectId,
        ?array $permissions = null
    ): void {
        $this->checkUserId($userId);
        $this->checkProjectId($projectId);

        if (empty($permissions)) {
            throw new InvalidArgumentException(
                'Permissions array cannot be empty when updating user project access'
            );
        }

        $this->userAccessApi->updateUserProjectAccess(
            userId: $userId,
            projectId: $projectId,
            updateProjectUserAccessRequest: new UpdateProjectUserAccessRequest(
                permissions: $permissions
            )
        );
    }

    /**
     * Updates project access for a user
     *
     * @deprecated use updateUserProjectAccessByUser instead
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the project ID or user ID is invalid, or if permissions are empty.
     */
    public function updateUserProjectAccess(
        string $userId,
        string $projectId,
        ?array $permissions = null
    ): void {
        $this->updateUserProjectAccessByUser(userId: $userId, projectId: $projectId, permissions: $permissions);
    }    

    /**
     * Deletes a user profile picture
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the user ID is invalid
     */
    public function deleteProfilePicture(string $userId): void
    {
        $this->checkUserId($userId);

        $this->profilesApi->deleteProfilePicture(uuid: $userId);
    }

    /**
     * Gets a user address
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the user ID is invalid
     */
    public function getAddress(string $userId): GetAddress200Response
    {
        $this->checkUserId($userId);

        return $this->profilesApi->getAddress(userId: $userId);
    }    

    /**
     * Gets a single user profile
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the user ID is invalid
     */
    public function getProfile(string $userId): Profile
    {
        $this->checkUserId($userId);

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
     * @throws InvalidArgumentException if the user ID is invalid
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
        $this->checkUserId($userId);

        return $this->profilesApi->updateAddress(
            userId: $userId, 
            address: new Address(
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
            )
        );
    }

    /**
     * Updates a user profile
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the user ID is invalid
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
        $this->checkUserId($userId);

        return $this->profilesApi->updateProfile(
            userId: $userId, 
            updateProfileRequest: new UpdateProfileRequest(
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
            )
        );
    }

    /**
     * Creates an API token
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the user ID is invalid, or if the token name is empty
     */
    public function createApiToken(string $userId, string $name): ApiToken
    {
        $this->checkUserId($userId);
        if (empty($name)) {
            throw new InvalidArgumentException('API token name cannot be empty');
        }
        
        return $this->tokensApi->createApiToken(
            userId: $userId, 
            createApiTokenRequest: new CreateApiTokenRequest(name: $name)
        );
    }

    /**
     * Deletes an API token
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the user ID is invalid, or if the token ID is empty
     */
    public function deleteApiToken(string $userId, string $tokenId): void
    {
        $this->checkUserId($userId);
        if (empty($tokenId)) {
            throw new InvalidArgumentException('API token ID cannot be empty');
        }

        $this->tokensApi->deleteApiToken(userId: $userId, tokenId: $tokenId);
    }

    /**
     * Gets an API token
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the user ID is invalid, or if the token ID is empty
     */
    public function getApiToken(string $userId, string $tokenId): ApiToken
    {
        $this->checkUserId($userId);
        $this->checkApiTokenId($tokenId);

        return $this->tokensApi->getApiToken(userId: $userId, tokenId: $tokenId);
    }

    /**
     * Lists a user's API tokens
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the user ID is invalid
     * @return ApiToken[]
     */
    public function listApiTokens(string $userId): array
    {
        $this->checkUserId($userId);

        return $this->tokensApi->listApiTokens(userId: $userId);
    }

    /**
     * Deletes a federated login connection
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the user ID is invalid, or if the provider name is empty
     */
    public function deleteLoginConnection(string $provider, string $userId): void
    {
        $this->checkUserId($userId);
        if (empty($provider)) {
            throw new InvalidArgumentException('Provider name cannot be empty');
        }

        $this->connectionsApi->deleteLoginConnection(provider: $provider, userId: $userId);
    }

    /**
     * Gets a federated login connection
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the user ID is invalid, or if the provider name is empty
     */
    public function getLoginConnection(string $provider, string $userId): Connection
    {
        $this->checkUserId($userId);
        if (empty($provider)) {
            throw new InvalidArgumentException('Provider name cannot be empty');
        }

        return $this->connectionsApi->getLoginConnection(provider: $provider, userId: $userId);
    }

    /**
     * Lists federated login connections
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the user ID is invalid
     * @return Connection[]
     */
    public function listLoginConnections(string $userId): array
    {
        $this->checkUserId($userId);

        return $this->connectionsApi->listLoginConnections(userId: $userId);
    }

    /**
     * Confirms a user's TOTP enrollment by verifying the provided TOTP secret and pass code. This method is used to
     * complete the TOTP enrollment process for a user, ensuring that they have successfully set up their TOTP
     * authentication method. By confirming the TOTP enrollment, the user can then use TOTP for
     * two-factor authentication when logging in.
     * 
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the user ID is invalid, or if the TOTP secret or passcode are empty
     */
    public function confirmTotpEnrollment(
        string $userId,
        string $secret,
        string $passCode
    ): ConfirmTotpEnrollment200Response {
        $this->checkUserId($userId);
        if (empty($secret)) { throw new InvalidArgumentException('TOTP secret cannot be empty'); }
        if (empty($passCode)) { throw new InvalidArgumentException('TOTP passcode cannot be empty'); }

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
     * @throws InvalidArgumentException if the user ID is invalid
     */
    public function getTotpEnrollment(string $userId): GetTotpEnrollment200Response
    {
        $this->checkUserId($userId);

        return $this->mfaApi->getTotpEnrollment(userId: $userId);
    }

    /**
     * Withdraws a user's TOTP enrollment. This method allows you to revoke a user's TOTP enrollment.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the user ID is invalid
     */
    public function withdrawTotpEnrollment(string $userId): void
    {
        $this->checkUserId($userId);

        $this->mfaApi->withdrawTotpEnrollment(userId: $userId);
    }

    /**
     * Re-creates recovery codes
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the user ID is invalid
     */
    public function recreateMfaRecoveryCodes(string $userId): void
    {
        $this->checkUserId($userId);
        
        $this->mfaApi->recreateRecoveryCodes(userId: $userId);
    }

    /**
     * Re-creates recovery codes
     *
     * @deprecated use recreateMfaRecoveryCodes instead
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the user ID is invalid
     */
    public function recreateRecoveryCodes(string $userId): void
    {
        $this->recreateMfaRecoveryCodes(userId: $userId);
    }

    /**
     * Confirms phone number
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the user ID is invalid, or if the SID or confirmation code are empty
     */
    public function confirmPhoneNumber(string $sid, string $userId, string $code): void
    {
        $this->checkUserId($userId);
        if (empty($sid)) { throw new InvalidArgumentException('SID cannot be empty'); }
        if (empty($code)) { throw new InvalidArgumentException('Confirmation code cannot be empty'); }

        $this->phoneNumberApi->confirmPhoneNumber(
            sid: $sid,
            userId: $userId,
            confirmPhoneNumberRequest: new ConfirmPhoneNumberRequest(code: $code)
        );
    }

    /**
     * Sends a verification code to a user's phone number via the specified channel (e.g., SMS, voice call)
     * for phone number verification.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the user ID is invalid, or if the channel or phone number are empty
     */
    public function verifyPhoneNumber(
        string $userId,
        string $channel,
        string $phoneNumber,
    ): VerifyPhoneNumber200Response {
        $this->checkUserId($userId);
        if (empty($channel)) { throw new InvalidArgumentException('Channel cannot be empty'); }
        if (empty($phoneNumber)) { throw new InvalidArgumentException('Phone number cannot be empty'); }

        return $this->phoneNumberApi->verifyPhoneNumber(
            userId: $userId,
            verifyPhoneNumberRequest: new VerifyPhoneNumberRequest(
                channel: $channel,
                phoneNumber: $phoneNumber
            )
        );
    }
}
