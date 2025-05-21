<?php

namespace Upsun\Core\Tasks;

use OpenAPI\Client\apisgen\UsersApi;
use OpenAPI\Client\Model\Error;
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

  public function me(): Error|User
  {
    $this->refreshToken();
    return $this->api->getCurrentUser();
  }

  public function getUser(string $id): Error|User
  {
    $this->refreshToken();
    return $this->api->getUser($id);
  }

  public function getUserByEmailAddress(string $email, string $contentType = ''): ?User
  {
    try {
      $this->refreshToken();
      return $this->api->getUserByEmailAddress($email, $contentType);
    } catch (\Exception $e) {
      // Log something?
      return null;
    }
  }

  /** Custom functions */
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

  public function getUserEmail(string $id)
  {
    $this->refreshToken();
    $user = $this->api->getUser($id);
    return trim($user->getEmail());
  }
}