<?php

namespace Upsun\Core;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\ExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class OAuthProvider
{
    private ?string $typeToken = null;
    private ?string $accessToken = null;
    private ?string $refreshToken = null;
    private int $tokenExpiry = 0;

    public function __construct(
        private HttpClientInterface $httpClient,
        private readonly string $tokenEndpoint,
        private readonly string $clientId,
        private readonly string $clientSecret
    ) {
    }

    public function exchangeCodeForToken(): bool
    {
        try {
            $response = $this->httpClient->request('POST', $this->tokenEndpoint, [
                'headers' => [
                    'Authorization' => 'Basic ' . base64_encode('platform-api-user:'),
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ],
                'body' => http_build_query([
                    'grant_type' => 'api_token',
                    'api_token' => $this->clientSecret,
                ]),
            ]);

            $data = $response->toArray();
            $this->storeTokenData($data);
            return true;
        } catch (ExceptionInterface $e) {
            throw new \Exception('Token exchange failed: ' . $e->getMessage());
        }
    }

    private function storeTokenData(array $data): void
    {
        $this->typeToken = $data['token_type'] ?? null;
        $this->accessToken = $data['access_token'] ?? null;
        $this->refreshToken = $data['refresh_token'] ?? null;
        $this->tokenExpiry = time() + ($data['expires_in'] ?? 0);
    }

    private function refreshAccessToken(): void
    {
        if (!$this->refreshToken) {
            throw new \Exception('No refresh token available');
        }

        try {
            $response = $this->httpClient->request('POST', $this->tokenEndpoint, [
                'headers' => [
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ],
                'body' => http_build_query([
                    'grant_type' => 'refresh_token',
                    'refresh_token' => $this->refreshToken,
                    'client_id' => $this->clientId,
                ]),
            ]);

            $data = $response->toArray();
            $this->storeTokenData($data);
        } catch (ExceptionInterface $e) {
            throw new \Exception('Token refresh failed: ' . $e->getMessage());
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
}