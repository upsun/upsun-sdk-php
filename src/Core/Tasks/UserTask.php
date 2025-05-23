<?php

namespace Upsun\Core\Tasks;

use GuzzleHttp\Promise\PromiseInterface;
use InvalidArgumentException;
use OpenAPI\Client\ApiException;
use OpenAPI\Client\apisgen\UsersApi;
use OpenAPI\Client\Model\Error;
use OpenAPI\Client\Model\GetCurrentUserVerificationStatus200Response;
use OpenAPI\Client\Model\ResetEmailAddressRequest;
use OpenAPI\Client\Model\UpdateUserRequest;
use OpenAPI\Client\Model\User;
use Upsun\UpsunClient;

class UserTask extends TaskBase
{

  public readonly UsersApi $api;

  public function __construct(
    public readonly UpsunClient $client,
  )
  {
    $this->api = new UsersApi($this->client->apiClient, $this->client->apiConfig);
  }

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
   * Operation meAsync
   *
   * Get the current user Asynchronously
   *
   * @return PromiseInterface
   * @throws InvalidArgumentException
   */
  public function meAsync(): PromiseInterface
  {
    $this->refreshToken();
    return $this->api->getCurrentUserAsync();
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
   * Operation getCurrentUserVerificationStatusAsync
   *
   * Check if phone verification is required
   *
   * @return PromiseInterface
   * @throws InvalidArgumentException
   * @throws ApiException on non-2xx response or if the response body is not in the expected format
   */
  public function getCurrentUserVerificationStatusAsync(): PromiseInterface
  {
    $this->refreshToken();
    return $this->api->getCurrentUserVerificationStatusAsync();
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
    //TODO create UpdateUserRequest here
    $update_user_request = new UpdateUserRequest();
//    dd($update_user_data);
    return $this->api->updateUser($user_id, $update_user_request);
  }

  /**
   * Operation updateUserAsync
   *
   * Update a user
   *
   * @param string $user_id The ID of the user. (required)
   * @param array $update_user_data update_user_request (optional)
   *
   * @return PromiseInterface
   * @throws InvalidArgumentException
   * @throws ApiException on non-2xx response or if the response body is not in the expected format
   */
  public function updateUserAsync(string $user_id, array $update_user_data = []): PromiseInterface
  {
    $this->refreshToken();
    //TODO create UpdateUserRequest here
    $update_user_request = new UpdateUserRequest();
    return $this->api->updateUserAsync($user_id, $update_user_request);
  }

  /** Custom functions */
  //fixme Custom function
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
   * @param string $id
   * @return string
   * @throws ApiException
   */
  public function getUserEmail(string $id)
  {
    $this->refreshToken();
    $user = $this->api->getUser($id);
    return trim($user->getEmail());
  }
}