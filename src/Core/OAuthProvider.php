<?php

namespace Upsun\Core;

use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Symfony\Component\HttpClient\HttpClient as Client;
use Symfony\Component\HttpClient\HttplugClient;
use Http\Client\Exception\RequestException;

class OAuthProvider
{

    private ?string $typeToken = null;
    private ?string $accessToken = null;
    private ?string $refreshToken = null;
    private int $tokenExpiry = 0;
    
    public function __construct(
        private RequestFactoryInterface $requestFactory,
        private StreamFactoryInterface $streamFactory,
        private Client $httpClient,
        private HttplugClient $httpPlugClient,
        private readonly string $tokenEndpoint,
        private readonly string $clientId,
        private readonly string $clientSecret
    ) {
    }

    public function exchangeCodeForToken(): bool
    {
        try {
            $request = $this->requestFactory->createRequest('POST', $this->tokenEndpoint)
                ->withHeader('Authorization', 'Basic ' . base64_encode('platform-api-user:'))
                ->withHeader('Content-Type', 'application/x-www-form-urlencoded');
            $body = http_build_query([
                'grant_type' => 'api_token',
                'api_token' => $this->clientSecret,
            ]);
            $request = $request->withBody($this->streamFactory->createStream($body));
            $response = $this->httpPlugClient->sendRequest($request);

            $data = json_decode($response->getBody()->getContents(), true);
            $this->storeTokenData($data);
            return true;
        } catch (RequestException $e) {
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
//            $response = $this->httpClient->post($this->tokenEndpoint, [
//                'headers' => [
//                    'Content-Type' => 'application/x-www-form-urlencoded',
//                ],
//                'form_params' => [
//                    'grant_type' => 'refresh_token',
//                    'refresh_token' => $this->refreshToken,
//                    'client_id' => $this->clientId,
//                ],
//            ]);
            $request = $this->requestFactory->createRequest('POST', $this->tokenEndpoint)
                ->withHeader('Content-Type', 'application/x-www-form-urlencoded');
            $body = http_build_query([
                'grant_type' => 'refresh_token',
                'refresh_token' => $this->refreshToken,
                'client_id' => $this->clientId,
            ]);
            $request = $request->withBody($this->streamFactory->createStream($body));
            
            $response = $this->httpPlugClient->sendRequest($request);

            $data = json_decode($response->getBody()->getContents(), true);
            $this->storeTokenData($data);
        } catch (RequestException $e) {
            throw new \Exception('Token refresh failed: ' . $e->getMessage());
        }
    }

    private function ensureValidToken(): void
    {
        $buffer = 60;
        if (!$this->accessToken || time() > ($this->tokenExpiry - $buffer)) {
            $this->exchangeCodeForToken();
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