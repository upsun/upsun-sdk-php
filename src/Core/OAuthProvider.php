<?php

namespace Upsun\Core;

use Exception;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Client\ClientExceptionInterface;
use Nyholm\Psr7\Stream;

class OAuthProvider
{
    private ?string $typeToken = null;
    private ?string $accessToken = null;
    private ?string $refreshToken = null;
    private int $tokenExpiry = 0;
    private bool $hasInitialToken = false;

    public function __construct(
        private ClientInterface $httpClient,
        private RequestFactoryInterface $requestFactory,
        private readonly string $tokenEndpoint,
        private readonly string $clientId,
        private readonly string $clientSecret
    ) {
    }

    /**
     * Exchange API token for access token
     *
     * @throws Exception
     */
    public function exchangeCodeForToken(): bool
    {
        try {
            $body = http_build_query([
                'grant_type' => 'api_token',
                'api_token' => $this->clientSecret,
            ]);

            $request = $this->requestFactory->createRequest('POST', $this->tokenEndpoint)
                ->withHeader('Authorization', 'Basic ' . base64_encode('platform-api-user:'))
                ->withHeader('Content-Type', 'application/x-www-form-urlencoded')
                ->withBody(Stream::create($body));

            $response = $this->httpClient->sendRequest($request);
            
            // Check response status
            if ($response->getStatusCode() !== 200) {
                throw new Exception('Token exchange failed with status: ' . $response->getStatusCode());
            }
            
            $responseBody = (string)$response->getBody();
            $data = json_decode($responseBody, true);

            // Validate JSON response
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception('Invalid JSON response: ' . json_last_error_msg());
            }

            // Validate response structure
            if (!is_array($data)) {
                throw new Exception('Invalid token response format. Response: ' . $responseBody);
            }

            if (!isset($data['access_token']) || empty($data['access_token'])) {
                throw new Exception('No access token in response. Response: ' . $responseBody);
            }

            $this->storeTokenData($data);
            $this->hasInitialToken = true;
            
            return true;
        } catch (ClientExceptionInterface $e) {
            throw new Exception('Token exchange failed: ' . $e->getMessage());
        }
    }

    private function storeTokenData(array $data): void
    {
        $this->typeToken = $data['token_type'] ?? null;
        $this->accessToken = $data['access_token'] ?? null;
        $this->refreshToken = $data['refresh_token'] ?? null;
        $this->tokenExpiry = time() + ($data['expires_in'] ?? 0);
    }

    /**
     * Refresh access token using refresh token
     *
     * @throws Exception
     */
    private function refreshAccessToken(): void
    {
        // If no refresh token, try to get a new access token with API token
        if (!$this->refreshToken) {
            $this->exchangeCodeForToken();
            return;
        }

        try {
            $body = http_build_query([
                'grant_type' => 'refresh_token',
                'refresh_token' => $this->refreshToken,
                'client_id' => $this->clientId,
            ]);

            $request = $this->requestFactory->createRequest('POST', $this->tokenEndpoint)
                ->withHeader('Content-Type', 'application/x-www-form-urlencoded')
                ->withBody(Stream::create($body));

            $response = $this->httpClient->sendRequest($request);
            
            // Check response status
            if ($response->getStatusCode() !== 200) {
                throw new Exception('Token refresh failed with status: ' . $response->getStatusCode());
            }
            
            $responseBody = (string)$response->getBody();
            $data = json_decode($responseBody, true);

            // Validate JSON response
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception('Invalid JSON response during refresh: ' . json_last_error_msg());
            }

            // Validate response structure
            if (!is_array($data)) {
                throw new Exception('Invalid refresh token response format. Response: ' . $responseBody);
            }

            if (!isset($data['access_token']) || empty($data['access_token'])) {
                throw new Exception('No access token in refresh response. Response: ' . $responseBody);
            }

            $this->storeTokenData($data);
        } catch (ClientExceptionInterface $e) {
            throw new Exception('Token refresh failed: ' . $e->getMessage());
        }
    }

    private function ensureValidToken(): void
    {
        $buffer = 60;

        // No token at all - get initial token
        if (!$this->accessToken) {
            $this->exchangeCodeForToken();
            return;
        }

        // Token is expired or about to expire
        if (time() > ($this->tokenExpiry - $buffer)) {
            if ($this->refreshToken) {
                // We have a refresh token, use it
                $this->refreshAccessToken();
            } else {
                // No refresh token - API tokens are typically long-lived
                // Try to get a new token with the same API token
                $this->exchangeCodeForToken();
            }
        }
    }

    public function getAuthorization(): string
    {
        $this->ensureValidToken();
        return 'Bearer ' . $this->accessToken;
    }

    public function getAccessToken(): ?string
    {
        $this->ensureValidToken();
        return $this->accessToken;
    }

    /**
     * Force token refresh, bypassing expiry check
     *
     * @throws Exception
     */
    public function forceRefresh(): void
    {
        $this->tokenExpiry = 0;
        $this->ensureValidToken();
    }

    /**
     * Check if we have a valid token without triggering refresh
     */
    public function hasValidToken(): bool
    {
        return $this->accessToken && time() < ($this->tokenExpiry - 60);
    }

    /**
     * Get token information for debugging
     */
    public function getTokenInfo(): array
    {
        return [
            'has_access_token' => !empty($this->accessToken),
            'has_refresh_token' => !empty($this->refreshToken),
            'expires_at' => $this->tokenExpiry,
            'expires_in' => max(0, $this->tokenExpiry - time()),
            'is_expired' => time() > $this->tokenExpiry,
            'has_initial_token' => $this->hasInitialToken,
        ];
    }

    /**
     * Debug token status
     */
    public function debugTokenStatus(): void
    {
        $info = $this->getTokenInfo();
        error_log('OAuthProvider Token Status: ' . json_encode($info));
    }
}