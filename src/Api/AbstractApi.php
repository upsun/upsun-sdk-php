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

    /**
     * Automatically refresh token and get authorization header
     * This method is called before every API request
     */
    protected function getAuthorizationHeader(): string
    {
        // Automatic token refresh is handled inside OAuthProvider::getAuthorization()
        return $this->oauthProvider->getAuthorization();
    }

    /**
     * Create a request with proper authentication
     * Automatically handles token refresh before each request
     */
    protected function createAuthenticatedRequest(string $method, string $uri, array $headers = []): RequestInterface
    {
        // Construct full URI
        $fullUri = $this->baseUri . '/' . ltrim($uri, '/');

        // Get fresh authorization header (includes automatic token refresh)
        $headers['Authorization'] = $this->getAuthorizationHeader();

        // Create request
        $request = $this->requestFactory->createRequest($method, $fullUri);

        // Add headers
        foreach ($headers as $name => $value) {
            $request = $request->withHeader($name, $value);
        }

        return $request;
    }

    /**
     * Send an authenticated request with automatic token refresh
     *
     * @throws ClientExceptionInterface
     */
    protected function sendAuthenticatedRequest(
        string $method,
        string $uri,
        array $headers = [],
        ?string $body = null
    ): ResponseInterface {

        // Create authenticated request (automatically refreshes token if needed)
        $request = $this->createAuthenticatedRequest($method, $uri, $headers);

        // Add body if provided
        if ($body !== null) {
            $request = $request->withBody(\Nyholm\Psr7\Stream::create($body));
        }

        try {
            return $this->httpClient->sendRequest($request);
        } catch (ClientExceptionInterface $e) {
            // If we get a 401, try to force refresh the token and retry once
            if ($this->isUnauthorizedError($e)) {
                // Force token refresh and retry once
                $this->forceTokenRefresh();
                $request = $this->createAuthenticatedRequest($method, $uri, $headers);
                if ($body !== null) {
                    $request = $request->withBody(\Nyholm\Psr7\Stream::create($body));
                }
                return $this->httpClient->sendRequest($request);
            }

            throw $e;
        }
    }

    /**
     * Check if the exception indicates an unauthorized error (401)
     */
    protected function isUnauthorizedError(ClientExceptionInterface $exception): bool
    {
        // This depends on your HTTP client implementation
        // You might need to adjust this based on your specific client
        if (method_exists($exception, 'getResponse')) {
            $response = $exception->getResponse();
            return $response && $response->getStatusCode() === 401;
        }

        return false;
    }

    /**
     * Force token refresh - useful for retry logic
     *
     * @throws Exception
     */
    protected function forceTokenRefresh(): void
    {
        // You might need to add this method to your OAuthProvider
        if (method_exists($this->oauthProvider, 'forceRefresh')) {
            $this->oauthProvider->forceRefresh();
        }
    }

    /**
     * Send a GET request
     *
     * @throws ClientExceptionInterface
     */
    protected function get(string $uri, array $headers = []): ResponseInterface
    {
        return $this->sendAuthenticatedRequest('GET', $uri, $headers);
    }

    /**
     * Send a POST request
     *
     * @throws ClientExceptionInterface
     */
    protected function post(string $uri, ?string $body = null, array $headers = []): ResponseInterface
    {
        if ($body !== null && !isset($headers['Content-Type'])) {
            $headers['Content-Type'] = 'application/json';
        }

        return $this->sendAuthenticatedRequest('POST', $uri, $headers, $body);
    }

    /**
     * Send a PUT request
     *
     * @throws ClientExceptionInterface
     */
    protected function put(string $uri, ?string $body = null, array $headers = []): ResponseInterface
    {
        if ($body !== null && !isset($headers['Content-Type'])) {
            $headers['Content-Type'] = 'application/json';
        }

        return $this->sendAuthenticatedRequest('PUT', $uri, $headers, $body);
    }

    /**
     * Send a PATCH request
     *
     * @throws ClientExceptionInterface
     */
    protected function patch(string $uri, ?string $body = null, array $headers = []): ResponseInterface
    {
        if ($body !== null && !isset($headers['Content-Type'])) {
            $headers['Content-Type'] = 'application/json';
        }

        return $this->sendAuthenticatedRequest('PATCH', $uri, $headers, $body);
    }

    /**
     * Send a DELETE request
     *
     * @throws ClientExceptionInterface
     */
    protected function delete(string $uri, array $headers = []): ResponseInterface
    {
        return $this->sendAuthenticatedRequest('DELETE', $uri, $headers);
    }

    /**
     * Decode JSON response
     *
     * @throws \InvalidArgumentException
     */
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
