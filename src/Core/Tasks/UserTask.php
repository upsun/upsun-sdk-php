<?php

namespace Upsun\Core\Tasks;

use InvalidArgumentException;
use OpenAPI\Client\ApiException;
use OpenAPI\Client\apisgen\UserProfilesApi;
use OpenAPI\Client\apisgen\UsersApi;
use OpenAPI\Client\Model\Address;
use OpenAPI\Client\Model\CreateProfilePicture200Response;
use OpenAPI\Client\Model\Error;
use OpenAPI\Client\Model\GetAddress200Response;
use OpenAPI\Client\Model\GetCurrentUserVerificationStatus200Response;
use OpenAPI\Client\Model\GetCurrentUserVerificationStatusFull200Response;
use OpenAPI\Client\Model\ListProfiles200Response;
use OpenAPI\Client\Model\Profile;
use OpenAPI\Client\Model\ResetEmailAddressRequest;
use OpenAPI\Client\Model\UpdateProfileRequest;
use OpenAPI\Client\Model\UpdateUserRequest;
use OpenAPI\Client\Model\User;
use Upsun\Exception\UpsunException;
use Upsun\UpsunClient;

class UserTask extends TaskBase
{

  public readonly UsersApi $api;
  public readonly UserProfilesApi $profilesApi;

  public function __construct(
    public readonly UpsunClient $client,
  )
  {
    $this->api = new UsersApi($this->client->apiClient, $this->client->apiConfig);
    $this->profilesApi = new UserProfilesApi($this->client->apiClient, $this->client->apiConfig);
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
    throw new UpsunException("Not implemented");
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