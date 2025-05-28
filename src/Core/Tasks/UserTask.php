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
use OpenAPI\Client\Model\CreateProfilePicture200Response;
use OpenAPI\Client\Model\DomainPatch;
use OpenAPI\Client\Model\Error;
use OpenAPI\Client\Model\GetAddress200Response;
use OpenAPI\Client\Model\GetCurrentUserVerificationStatus200Response;
use OpenAPI\Client\Model\GetCurrentUserVerificationStatusFull200Response;
use OpenAPI\Client\Model\GetTotpEnrollment200Response;
use OpenAPI\Client\Model\GrantProjectUserAccessRequestInner;
use OpenAPI\Client\Model\GrantUserProjectAccessRequestInner;
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

  public readonly UsersApi $api;
  public readonly UserProfilesApi $profilesApi;
  public readonly UserAccessApi $accessApi;
  public readonly APITokensApi $tokensApi;
  public readonly ConnectionsApi $connectionsApi;
  public readonly GrantsApi $grantsApi;
  public readonly MFAApi $mfaApi;
  public readonly PhoneNumberApi $phoneNumberApi;

  public function __construct(
    public readonly UpsunClient $client,
  )
  {
    $this->api = new UsersApi($this->client->apiClient, $this->client->apiConfig);
    $this->profilesApi = new UserProfilesApi($this->client->apiClient, $this->client->apiConfig);
    $this->accessApi = new UserAccessApi($this->client->apiClient, $this->client->apiConfig);
    $this->tokensApi = new APITokensApi($this->client->apiClient, $this->client->apiConfig);
    $this->connectionsApi = new ConnectionsApi($this->client->apiClient, $this->client->apiConfig);
    $this->grantsApi = new GrantsApi($this->client->apiClient, $this->client->apiConfig);
    $this->mfaApi = new MFAApi($this->client->apiClient, $this->client->apiConfig);
    $this->phoneNumberApi = new PhoneNumberApi($this->client->apiClient, $this->client->apiConfig);
  }

  /************** ********************/
  /********* UsersApi ****************/
  /************** ********************/

  /**
   * Operation me
   *
   * Get the current user
   *
   * @return User|Error
   * @throws InvalidArgumentException
   * @throws ApiException on non-2xx response or if the response body is not in the expected format
   */
  public function me(): Error|User
  {
    $this->refreshToken();
    return $this->api->getCurrentUser();
  }

  /**
   * Operation getCurrentUserVerificationStatus
   *
   * Check if phone verification is required
   *
   * @return GetCurrentUserVerificationStatus200Response
   * @throws InvalidArgumentException
   * @throws ApiException on non-2xx response or if the response body is not in the expected format
   */
  public function getCurrentUserVerificationStatus(): GetCurrentUserVerificationStatus200Response
  {
    $this->refreshToken();
    return $this->api->getCurrentUserVerificationStatus();
  }

  /**
   * Operation getCurrentUserVerificationStatusFull
   *
   * Check if verification is required
   *
   * @return GetCurrentUserVerificationStatusFull200Response
   * @throws InvalidArgumentException
   * @throws ApiException on non-2xx response or if the response body is not in the expected format
   */
  public function getCurrentUserVerificationStatusFull(): GetCurrentUserVerificationStatusFull200Response
  {
    $this->refreshToken();
    return $this->api->getCurrentUserVerificationStatusFull();
  }

  /**
   * Operation getUser
   *
   * Get a user
   *
   * @param string $id The ID of the user. (required)
   *
   * @return User|Error
   * @throws InvalidArgumentException
   * @throws ApiException on non-2xx response or if the response body is not in the expected format
   */
  public function getUser(string $id): Error|User
  {
    $this->refreshToken();
    return $this->api->getUser($id);
  }

  /**
   * Operation getUserByEmailAddress
   *
   * Get a user by email
   *
   * @param string $email The user&#39;s email address. (required)
   *
   * @throws ApiException on non-2xx response or if the response body is not in the expected format
   * @throws InvalidArgumentException
   * @return User|Error
   */
  public function getUserByEmailAddress(string $email): User|Error
  {
    $this->refreshToken();
    return $this->api->getUserByEmailAddress($email);
  }

  /**
   * Operation getUserByUsername
   *
   * Get a user by username
   *
   * @param string $username The user&#39;s username. (required)
   *
   * @throws ApiException on non-2xx response or if the response body is not in the expected format
   * @throws InvalidArgumentException
   * @return User|Error
   */
  public function getUserByUsername(string $username): User|Error
  {
    $this->refreshToken();
    return $this->api->getUserByUsername($username);
  }

  /**
   * Operation resetEmailAddress
   *
   * Reset email address
   *
   * @param string $user_id The ID of the user. (required)
   * @param ResetEmailAddressRequest|null $reset_email_address_request (optional)
   *
   * @return void
   * @throws InvalidArgumentException
   * @throws ApiException on non-2xx response or if the response body is not in the expected format
   */
  public function resetEmailAddress(string $user_id, ResetEmailAddressRequest $reset_email_address_request = null): void
  {
    $this->refreshToken();
    $this->api->resetEmailAddress($user_id, $reset_email_address_request);
  }

  /**
   * Operation resetPassword
   *
   * Reset user password
   *
   * @param string $user_id The ID of the user. (required)
   *
   * @return void
   * @throws InvalidArgumentException
   * @throws ApiException on non-2xx response or if the response body is not in the expected format
   */
  public function resetPassword(string $user_id): void
  {
    $this->refreshToken();
    $this->api->resetPassword($user_id);
  }

  /**
   * Operation updateUser
   *
   * Update a user
   *
   * @param string $user_id The ID of the user. (required)
   * @param array $update_user_data update_user_request (optional)
   *
   * @return User|Error
   * @throws InvalidArgumentException
   * @throws ApiException on non-2xx response or if the response body is not in the expected format
   */
  public function updateUser(string $user_id, array $update_user_data = []): User|Error
  {
    $this->refreshToken();
    $update_user_request = new UpdateUserRequest();
    return $this->api->updateUser($user_id, $update_user_request);
  }

  /************** ****************************/
  /********* UsersAccessApi ****************/
  /************** ****************************/

  /**
   * Operation getProjectUserAccess
   *
   * Get user access for a project
   *
   * @param string $project_id The ID of the project. (required)
   * @param string $user_id The ID of the user. (required)
   * @return UserProjectAccess|Error
   * @throws ApiException on non-2xx response or if the response body is not in the expected format
   */
  public function getProjectUserAccess(string $project_id, string $user_id): Error|UserProjectAccess
  {
    $this->refreshToken();
    return $this->accessApi->getProjectUserAccess($project_id, $user_id);
  }

  /**
   * Operation getUserProjectAccess
   *
   * Get project access for a user
   *
   * @param string $user_id The ID of the user. (required)
   * @param string $project_id The ID of the project. (required)
   * @return UserProjectAccess|Error
   * @throws ApiException on non-2xx response or if the response body is not in the expected format
   */
  public function getUserProjectAccess(string $user_id, string $project_id): Error|UserProjectAccess
  {
    $this->refreshToken();
    return $this->accessApi->getUserProjectAccess($user_id, $project_id);
  }

  /**
   * Operation grantProjectUserAccess
   *
   * Grant user access to a project
   *
   * @param string $project_id The ID of the project. (required)
   * @param GrantProjectUserAccessRequestInner[] $grant_project_user_access_request_inner grant_project_user_access_request_inner (required)
   * @return void
   * @throws ApiException on non-2xx response or if the response body is not in the expected format
   */
  public function grantProjectUserAccess(string $project_id, array $grant_project_user_access_request_inner): void
  {
    $this->refreshToken();
    $this->accessApi->grantProjectUserAccess($project_id, $grant_project_user_access_request_inner);
  }

  /**
   * Operation grantUserProjectAccess
   *
   * Grant project access to a user
   *
   * @param string $user_id The ID of the user. (required)
   * @param GrantUserProjectAccessRequestInner[] $grant_user_project_access_request_inner grant_user_project_access_request_inner (required)
   * @return void
   * @throws ApiException on non-2xx response or if the response body is not in the expected format
   */
  public function grantUserProjectAccess(string $user_id, array $grant_user_project_access_request_inner): void
  {
    $this->refreshToken();
    $this->accessApi->grantUserProjectAccess($user_id, $grant_user_project_access_request_inner);
  }

  /**
   * Operation listProjectUserAccess
   *
   * List user access for a project
   *
   * @param string $project_id The ID of the project. (required)
   * @param int|null $page_size Determines the number of items to show. (optional)
   * @param string|null $page_before Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
   * @param string|null $page_after Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
   * @param string|null $sort Allows sorting by a single field.&lt;br&gt; Use a dash (\&quot;-\&quot;) to sort descending.&lt;br&gt; Supported fields: &#x60;granted_at&#x60;, &#x60;updated_at&#x60;. (optional)
   * @return ListProjectUserAccess200Response|Error
   * @throws ApiException on non-2xx response or if the response body is not in the expected format
   */
  public function listProjectUserAccess(string $project_id, int $page_size = null, string $page_before = null, string $page_after = null, string $sort = null): ListProjectUserAccess200Response|Error
  {
    $this->refreshToken();
    return $this->accessApi->listProjectUserAccess($project_id, $page_size, $page_before, $page_after, $sort);
  }

  /**
   * Operation listUserProjectAccess
   *
   * List project access for a user
   *
   * @param string $user_id The ID of the user. (required)
   * @param string|null $filter_organization_id Allows filtering by &#x60;organization_id&#x60;. (optional)
   * @param int|null $page_size Determines the number of items to show. (optional)
   * @param string|null $page_before Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
   * @param string|null $page_after Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)
   * @param string|null $sort Allows sorting by a single field.&lt;br&gt; Use a dash (\&quot;-\&quot;) to sort descending.&lt;br&gt; Supported fields: &#x60;project_title&#x60;, &#x60;granted_at&#x60;, &#x60;updated_at&#x60;. (optional)
   * @return ListProjectUserAccess200Response|Error
   * @throws ApiException on non-2xx response or if the response body is not in the expected format
   */
  public function listUserProjectAccess(string $user_id, string $filter_organization_id = null, int $page_size = null, string $page_before = null, string $page_after = null, string $sort = null): ListProjectUserAccess200Response|Error
  {
    $this->refreshToken();
    return $this->accessApi->listUserProjectAccess($user_id, $filter_organization_id, $page_size, $page_before, $page_after, $sort);
  }

  /**
   * Operation removeProjectUserAccess
   *
   * Remove user access for a project
   *
   * @param string $project_id The ID of the project. (required)
   * @param string $user_id The ID of the user. (required)
   * @return void
   * @throws ApiException on non-2xx response or if the response body is not in the expected format
   */
  public function removeProjectUserAccess(string $project_id, string $user_id): void
  {
    $this->refreshToken();
    $this->accessApi->removeProjectUserAccess($project_id, $user_id);
  }

  /**
   * Operation removeUserProjectAccess
   *
   * Remove project access for a user
   *
   * @param string $user_id The ID of the user. (required)
   * @param string $project_id The ID of the project. (required)
   * @return void
   * @throws ApiException on non-2xx response or if the response body is not in the expected format
   */
  public function removeUserProjectAccess(string $user_id, string $project_id): void
  {
    $this->refreshToken();
    $this->accessApi->removeUserProjectAccess($user_id, $project_id);
  }

  /**
   * Operation updateProjectUserAccess
   *
   * Update user access for a project
   *
   * @param string $project_id The ID of the project. (required)
   * @param string $user_id The ID of the user. (required)
   * @param array|null $update_project_user_access_request update_project_user_access_request (optional)
   * @return void
   * @throws ApiException on non-2xx response or if the response body is not in the expected format
   */
  public function updateProjectUserAccess(string $project_id, string $user_id, array $update_project_user_access_request = null): void
  {
    $this->refreshToken();
    $update_project_user_access_request = new UpdateProjectUserAccessRequest($update_project_user_access_request);
    $this->accessApi->updateProjectUserAccess($project_id, $user_id, $update_project_user_access_request);
  }

  /**
   * Operation updateUserProjectAccess
   *
   * Update project access for a user
   *
   * @param string $user_id The ID of the user. (required)
   * @param string $project_id The ID of the project. (required)
   * @param array|null $update_project_user_access_request update_project_user_access_request (optional)
   * @return void
   * @throws ApiException on non-2xx response or if the response body is not in the expected format
   */
  public function updateUserProjectAccess(string $user_id, string $project_id, array $update_project_user_access_request = null): void
  {
    $this->refreshToken();
    $update_project_user_access_request = new UpdateProjectUserAccessRequest($update_project_user_access_request);
    $this->accessApi->updateUserProjectAccess($project_id, $user_id, $update_project_user_access_request);
  }
  
  /************** ****************************/
  /********* UsersProfilesApi ****************/
  /************** ****************************/

  /**
   * Operation createProfilePicture
   *
   * Create a user profile picture
   *
   * @param string $uuid The uuid of the user (required)
   * @param string $contentType The value for the Content-Type header. Check self::contentTypes['createProfilePicture'] to see the possible values for this operation
   *
   * @return CreateProfilePicture200Response
   * @throws InvalidArgumentException
   * @throws ApiException on non-2xx response or if the response body is not in the expected format
   */
  public function createProfilePicture(string $uuid, string $contentType = UserProfilesApi::contentTypes['createProfilePicture'][0])
  {
    throw new UpsunException("Not implemented (missing params on apisgen side");
  }

  /**
   * Operation deleteProfilePicture
   *
   * Delete a user profile picture
   *
   * @param string $uuid The uuid of the user (required)
   *
   * @return void
   * @throws InvalidArgumentException
   * @throws ApiException on non-2xx response or if the response body is not in the expected format
   */
  public function deleteProfilePicture(string $uuid): void
  {
    $this->refreshToken();
    $this->profilesApi->deleteProfilePicture($uuid);
  }

  /**
   * Operation getAddress
   *
   * Get a user address
   *
   * @param string $user_id The UUID of the user (required)
   *
   * @return GetAddress200Response
   * @throws InvalidArgumentException
   * @throws ApiException on non-2xx response or if the response body is not in the expected format
   */
  public function getAddress(string $user_id): GetAddress200Response
  {
    $this->refreshToken();
    return $this->profilesApi->getAddress($user_id);
  }

  /**
   * Operation getProfile
   *
   * Get a single user profile
   *
   * @param string $user_id The UUID of the user (required)
   *
   * @return Profile
   * @throws InvalidArgumentException
   * @throws ApiException on non-2xx response or if the response body is not in the expected format
   */
  public function getProfile(string $user_id): Profile
  {
    $this->refreshToken();
    return $this->profilesApi->getProfile($user_id);
  }

  /**
   * Operation listProfiles
   *
   * List current user profiles
   *
   * @return ListProfiles200Response
   * @throws InvalidArgumentException
   * @throws ApiException on non-2xx response or if the response body is not in the expected format
   */
  public function listProfiles(): ListProfiles200Response
  {
    $this->refreshToken();
    return $this->profilesApi->listProfiles();
  }

  /**
   * Operation updateAddress
   *
   * Update a user address
   *
   * @param string $user_id The UUID of the user (required)
   * @param Address|null $address address (optional)
   *
   * @return GetAddress200Response
   * @throws InvalidArgumentException
   * @throws ApiException on non-2xx response or if the response body is not in the expected format
   */
  public function updateAddress(string $user_id, Address $address = null): GetAddress200Response
  {
    $this->refreshToken();
    return $this->profilesApi->updateAddress($user_id, $address);
  }

  /**
   * Operation updateProfile
   *
   * Update a user profile
   *
   * @param string $user_id The UUID of the user (required)
   * @param array $update_profile_data update_profile_request (optional)
   *
   * @return Profile
   * @throws InvalidArgumentException
   * @throws ApiException on non-2xx response or if the response body is not in the expected format
   */
  public function updateProfile(string $user_id, array $update_profile_data = []): Profile
  {
    $this->refreshToken();
    $update_profile_request = new UpdateProfileRequest($update_profile_data);
    return $this->profilesApi->updateProfile($user_id, $update_profile_request);
  }

  /************** ************************/
  /********* APITokensApi ****************/
  /************** ************************/

  /**
   * Operation createApiToken
   *
   * Create an API token
   *
   * @param string $user_id The ID of the user. (required)
   * @param array|null $create_api_token_request create_api_token_request (optional)
   * @return APIToken|Error
   * @throws ApiException on non-2xx response or if the response body is not in the expected format
   */
  public function createApiToken(string $user_id, array $create_api_token_request = null): Error|APIToken
  {
    $this->refreshToken();
    $create_api_token_request = new CreateApiTokenRequest($create_api_token_request);
    return $this->tokensApi->createApiToken($user_id, $create_api_token_request); 
  }

  /**
   * Operation deleteApiToken
   *
   * Delete an API token
   *
   * @param string $user_id The ID of the user. (required)
   * @param string $token_id The ID of the token. (required)
   * @return void
   * @throws ApiException on non-2xx response or if the response body is not in the expected format
   */
  public function deleteApiToken(string $user_id, string $token_id): void
  {
    $this->refreshToken();
    $this->tokensApi->deleteApiToken($user_id, $token_id);
  }

  /**
   * Operation getApiToken
   *
   * Get an API token
   *
   * @param string $user_id The ID of the user. (required)
   * @param string $token_id The ID of the token. (required)
   * @return APIToken|Error
   * @throws ApiException on non-2xx response or if the response body is not in the expected format
   */
  public function getApiToken(string $user_id, string $token_id): Error|APIToken
  {
    $this->refreshToken();
    return $this->tokensApi->getApiToken($user_id, $token_id);
  }

  /**
   * Operation listApiTokens
   *
   * List a user&#39;s API tokens
   *
   * @param string $user_id The ID of the user. (required)
   * @return APIToken[]|Error
   * @throws ApiException on non-2xx response or if the response body is not in the expected format
   */
  public function listApiTokens(string $user_id): Error|array
  {
    $this->refreshToken();
    return $this->tokensApi->createApiToken($user_id);
  }
  
  /************** **************************/
  /********* ConnectionsApi ****************/
  /************** **************************/

  /**
   * Operation deleteLoginConnection
   *
   * Delete a federated login connection
   *
   * @param string $provider The name of the federation provider. (required)
   * @param string $user_id The ID of the user. (required)
   * @return void
   * @throws ApiException on non-2xx response or if the response body is not in the expected format
   */
  public function deleteLoginConnection(string $provider, string $user_id): void
  {
    $this->refreshToken();
    $this->connectionsApi->deleteLoginConnection($provider, $user_id);
  }

  /**
   * Operation getLoginConnection
   *
   * Get a federated login connection
   *
   * @param string $provider The name of the federation provider. (required)
   * @param string $user_id The ID of the user. (required)
   * @return Connection|Error
   * @throws ApiException on non-2xx response or if the response body is not in the expected format
   */
  public function getLoginConnection(string $provider, string $user_id): Error|Connection
  {
    $this->refreshToken();
    return $this->connectionsApi->getLoginConnection($provider, $user_id);
  }

  /**
   * Operation listLoginConnections
   *
   * List federated login connections
   *
   * @param string $user_id The ID of the user. (required)
   * @return Connection[]|Error
   * @throws ApiException on non-2xx response or if the response body is not in the expected format
   */
  public function listLoginConnections(string $user_id): array|Error
  {
    $this->refreshToken();
    return $this->connectionsApi->listLoginConnections($user_id);
  }

  /************** *********************/
  /********* GrantsApi ****************/
  /************** *********************/

  /**
   * Operation listUserExtendedAccess
   *
   * List extended access of a user
   *
   * @param string $user_id The ID of the user. (required)
   * @param array|null $filter_resource_type Allows filtering by &#x60;resource_type&#x60; (project or organization) using one or more operators. (optional)
   * @param array|null $filter_organization_id Allows filtering by &#x60;organization_id&#x60; using one or more operators. (optional)
   * @param array|null $filter_permissions Allows filtering by &#x60;permissions&#x60; using one or more operators. (optional)
   * @return ListUserExtendedAccess200Response|Error
   * @throws ApiException on non-2xx response or if the response body is not in the expected format
   */
  public function listUserExtendedAccess(string $user_id, array $filter_resource_type = null, array $filter_organization_id = null, array $filter_permissions = null): ListUserExtendedAccess200Response|Error
  {
    $this->refreshToken();
    return $this->grantsApi->listUserExtendedAccess($user_id, $filter_resource_type, $filter_organization_id, $filter_permissions);
  }

  /************** ******************/
  /********* MFAApi ****************/
  /************** ******************/

  /**
   * Operation confirmTotpEnrollment
   *
   * Confirm TOTP enrollment
   *
   * @param string $user_id The ID of the user. (required)
   * @param array|null $confirm_totp_enrollment_request (optional)
   * @return ConfirmTotpEnrollment200Response|Error
   * @throws ApiException on non-2xx response or if the response body is not in the expected format
   */
  public function confirmTotpEnrollment(string $user_id, array $confirm_totp_enrollment_request = null): ConfirmTotpEnrollment200Response|Error
  {
    $this->refreshToken();
    $confirm_totp_enrollment_request = new ConfirmTotpEnrollmentRequest($confirm_totp_enrollment_request);
    return $this->mfaApi->confirmTotpEnrollment($user_id, $confirm_totp_enrollment_request);
  }

  /**
   * Operation getTotpEnrollment
   *
   * Get information about TOTP enrollment
   *
   * @param string $user_id The ID of the user. (required)
   * @return GetTotpEnrollment200Response|Error
   * @throws ApiException on non-2xx response or if the response body is not in the expected format
   */
  public function getTotpEnrollment(string $user_id): GetTotpEnrollment200Response|Error
  {
    $this->refreshToken();
    return $this->mfaApi->getTotpEnrollment($user_id);
  }
  
  /**
   * Operation recreateRecoveryCodes
   *
   * Re-create recovery codes
   *
   * @param string $user_id The ID of the user. (required)
   * @return ConfirmTotpEnrollment200Response|Error
   * @throws ApiException on non-2xx response or if the response body is not in the expected format
   */
  public function recreateRecoveryCodes(string $user_id): ConfirmTotpEnrollment200Response|Error
  {
    $this->refreshToken();
    return $this->mfaApi->recreateRecoveryCodes($user_id);
  }

  /**
   * Operation withdrawTotpEnrollment
   *
   * Withdraw TOTP enrollment
   *
   * @param string $user_id The ID of the user. (required)
   * @return void
   * @throws ApiException on non-2xx response or if the response body is not in the expected format
   */
  public function withdrawTotpEnrollment(string $user_id): void
  {
    $this->refreshToken();
    $this->mfaApi->withdrawTotpEnrollment($user_id);
  }
  
  /************** **************************/
  /********* PhoneNumberApi ****************/
  /************** **************************/

  /**
   * Operation confirmPhoneNumber
   *
   * Confirm phone number
   *
   * @param string $sid The session ID obtained from &#x60;POST /users/{user_id}/phonenumber&#x60;. (required)
   * @param string $user_id The ID of the user. (required)
   * @param array|null $confirm_phone_number_request confirm_phone_number_request (optional)
   * @return void
   * @throws ApiException on non-2xx response or if the response body is not in the expected format
   */
  public function confirmPhoneNumber(string $sid, string $user_id, array $confirm_phone_number_request = null): void
  {
    $this->refreshToken();
    $confirm_phone_number_request = new ConfirmPhoneNumberRequest($confirm_phone_number_request);
    $this->phoneNumberApi->confirmPhoneNumber($sid, $user_id, $confirm_phone_number_request);
  }

  /**
   * Operation verifyPhoneNumber
   *
   * Verify phone number
   *
   * @param string $user_id The ID of the user. (required)
   * @param array|null $verify_phone_number_request verify_phone_number_request (optional)
   * @return VerifyPhoneNumber200Response|Error|Error|Error
   * @throws ApiException on non-2xx response or if the response body is not in the expected format
   */
  public function verifyPhoneNumber(string $user_id, array $verify_phone_number_request = null): VerifyPhoneNumber200Response|Error
  {
    $this->refreshToken();
    $verify_phone_number_request = new VerifyPhoneNumberRequest($verify_phone_number_request);
    return $this->phoneNumberApi->verifyPhoneNumber($user_id, $verify_phone_number_request);
  }
  
  /************** ***************************/
  /********* Custom function ****************/
  /************** ***************************/

  /**
   * Get User FullName
   * @param string $id
   * @return string
   */
  public function getUserFullName(string $id): string
  {
    try {
      $this->refreshToken();
      $user = $this->api->getUser($id);
      return trim($user->getFirstName() . ' ' . $user->getLastName());
    } catch (\Exception $e) {
      // Log something?
      return '';
    }
  }


  /**
   * Get specific User Email
   *
   * @param string $id
   * @return string
   * @throws ApiException
   */
  public function getUserEmail(string $id): string
  {
    $this->refreshToken();
    $user = $this->api->getUser($id);
    return trim($user->getEmail());
  }
}