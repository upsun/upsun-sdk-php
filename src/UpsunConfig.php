<?php

namespace Upsun;

use Upsun\Core\OAuthProvider;

/**
 * Upsun Configuration class.
 *
 * Holds the default API and authentication endpoints, as well as the API token
 * used for authenticating with the Upsun API.
 *
 * Authentication modes:
 * - api_token (default): set apiToken to an Upsun API token.
 * - client_credentials: set grantType to OAuthProvider::GRANT_CLIENT_CREDENTIALS,
 *   clientId to the OAuth2 client id, apiToken to the client secret, and
 *   optionally scope.
 *
 * @author    Upsun Advocacy Team
 * @license   MIT
 * @see       https://docs.upsun.com
 */
final class UpsunConfig
{
    public function __construct(
        public readonly string $base_url = "https://api.upsun.com",
        public readonly string $auth_url = "https://auth.upsun.com",
        public readonly string $apiToken = "UPSUN_API_TOKEN is not defined!",
        public readonly string $token_endpoint = "oauth2/token",
        public readonly string $refresh_endpoint = "oauth2/token",
        public readonly string $clientId = "sdk-php-client-id",
        public readonly string $grantType = OAuthProvider::GRANT_API_TOKEN,
        public readonly string $scope = "",
    ) {
    }
}
