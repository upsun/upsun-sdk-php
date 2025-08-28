<?php

namespace Upsun\Api;

use Exception;
use Upsun\Core\OAuthProvider;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Client\ClientExceptionInterface;

/**
 * AbstractApi
 *
 * Abstract class for all API classes with automatic token refresh
 *
 * @package Upsun\Api
 */
abstract class AbstractApi
{
    public function __construct(
        private readonly OAuthProvider $oauthProvider,
        private readonly ClientInterface $httpClient,
        private readonly RequestFactoryInterface $requestFactory,
        private string $baseUri
    ) {
        $this->baseUri = rtrim($baseUri, '/');
    }

    protected function getAuthorizationHeader(): string
    {
        return $this->oauthProvider->getAuthorization();
    }

    protected function createAuthenticatedRequest(
        string $method,
        string $uri,
        array $headers = []
    ): RequestInterface {
        $fullUri = $this->baseUri . '/' . ltrim($uri, '/');
        $headers['Authorization'] = $this->getAuthorizationHeader();

        $request = $this->requestFactory->createRequest($method, $fullUri);


        return $request;
    }

    protected function sendAuthenticatedRequest(
        string $method,
        string $uri,
        array $headers = [],
        ?string $body = null
    ): ResponseInterface {
        $request = $this->createAuthenticatedRequest($method, $uri, $headers);

        var_dump($request->getUri(), $request->getBody(), $request->getHeaders());
        try {
            return $this->httpClient->sendRequest($request);
        } catch (ClientExceptionInterface $e) {
            throw $e;
        }
    }

    protected function isUnauthorizedError(ClientExceptionInterface $exception): bool
    {
        if (method_exists($exception, 'getResponse')) {
            $response = $exception->getResponse();
            return $response && $response->getStatusCode() === 401;
        }
        return false;
    }

    protected function forceTokenRefresh(): void
    {
        if (method_exists($this->oauthProvider, 'forceRefresh')) {
            $this->oauthProvider->forceRefresh();
        }
    }


    protected function decodeJsonResponse(ResponseInterface $response, bool $assoc = true): mixed
    {
        $content = (string) $response->getBody();
        $data = json_decode($content, $assoc);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \InvalidArgumentException('Invalid JSON response: ' . json_last_error_msg());
        }

        return $data;
    }

    public function refreshToken(): void
    {
        $this->oauthProvider->forceRefresh();
    }
}
