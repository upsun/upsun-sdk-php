<?php

namespace Upsun\Core;

use Exception;
use Nyholm\Psr7\Stream;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Client\ClientExceptionInterface;

class OAuthProvider_old
{
    private ?string $typeToken = null;
    private ?string $accessToken = null;
    private ?string $refreshToken = null;
    private int $tokenExpiry = 0;

    public function __construct(
        private ClientInterface $httpClient,
        private RequestFactoryInterface $requestFactory,
        private readonly string $tokenEndpoint,
        private readonly string $clientId,
        private readonly string $clientSecret
    ) {
    }

    /**
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
            $data = json_decode((string)$response->getBody(), true);

            $this->storeTokenData($data);
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
     * @throws Exception
     */
    private function refreshAccessToken(): void
    {
        if (!$this->refreshToken) {
            throw new Exception('No refresh token available');
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
            $data = json_decode((string)$response->getBody(), true);

            $this->storeTokenData($data);
        } catch (ClientExceptionInterface $e) {
            throw new Exception('Token refresh failed: ' . $e->getMessage());
        }
    }

    private function ensureValidToken(): void
    {
        $buffer = 60;
        if (!$this->accessToken || time() > ($this->tokenExpiry - $buffer)) {
            if ($this->refreshToken) {
                $this->refreshAccessToken();
            } else {
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
     * Force token refresh - bypasses the normal expiry check
     * Useful for retry logic when we get a 401 error
     *
     * @throws Exception
     */
    public function forceRefresh(): void
    {
        // Force token expiry to trigger refresh
        $this->tokenExpiry = 0;

        // Get fresh token (this will trigger ensureValidToken -> refreshAccessToken)
        $this->getAccessToken();
    }
}
