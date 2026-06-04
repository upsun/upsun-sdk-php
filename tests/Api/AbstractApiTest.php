<?php

namespace Upsun\Tests\Api;

use Exception;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Upsun\Api\AbstractApi;
use Upsun\Api\ApiException;

/**
 * Test suite for AbstractApi — focuses on sendAuthenticatedRequest() logic (FIX 1: 401 retry).
 *
 * @covers \Upsun\Api\AbstractApi
 */
class AbstractApiTest extends TestCase
{
    /**
     * Concrete subclass that exposes sendAuthenticatedRequest() for testing.
     */
    private AbstractApi $api;

    /** @var ClientInterface&\PHPUnit\Framework\MockObject\MockObject */
    private ClientInterface $httpClient;

    private int $tokenCallCount = 0;
    private int $forceRefreshCount = 0;

    private Psr17Factory $psr17Factory;

    protected function setUp(): void
    {
        $this->httpClient        = $this->createMock(ClientInterface::class);
        $this->psr17Factory      = new Psr17Factory();
        $this->tokenCallCount    = 0;
        $this->forceRefreshCount = 0;

        // Closure-based tokenProvider: tracks call count and force-refresh requests.
        $tokenProvider = function (bool $force = false): string {
            $this->tokenCallCount++;
            if ($force) {
                $this->forceRefreshCount++;
            }
            return 'Bearer test-token';
        };

        $this->api = new class (
            $tokenProvider,
            $this->httpClient,
            $this->psr17Factory,
            'https://api.upsun.com',
            $this->psr17Factory,
        ) extends AbstractApi {
            /**
             * Expose the protected method publicly for testing.
             *
             * @throws ApiException
             * @throws Exception
             */
            public function callSendAuthenticatedRequest(
                string $method,
                string $uri,
                array $headers = [],
                string|StreamInterface|null $body = null
            ): ResponseInterface {
                return $this->sendAuthenticatedRequest($method, $uri, $headers, $body);
            }

            /**
             * Expose refreshToken() publicly for testing.
             *
             * @throws Exception
             */
            public function callRefreshToken(): void
            {
                $this->refreshToken();
            }
        };
    }

    /**
     * FIX 1 — 200 response is returned as-is (no retry).
     *
     * @throws Exception
     */
    public function testSendAuthenticatedRequestReturns200(): void
    {
        $expectedResponse = new Response(200, ['Content-Type' => 'application/json'], '{"ok":true}');

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn($expectedResponse);

        $response = $this->api->callSendAuthenticatedRequest('GET', '/v1/organizations');

        $this->assertSame(200, $response->getStatusCode());
    }

    /**
     * FIX 1 — On 401, forceRefresh() is called and the request is retried exactly once.
     * If the retry succeeds (200), the successful response is returned.
     *
     * @throws Exception
     */
    public function testSendAuthenticatedRequestRetries401WithForceRefresh(): void
    {
        $this->httpClient
            ->expects($this->exactly(2))
            ->method('sendRequest')
            ->willReturnOnConsecutiveCalls(
                new Response(401, [], 'Unauthorized'),
                new Response(200, ['Content-Type' => 'application/json'], '{"ok":true}'),
            );

        $response = $this->api->callSendAuthenticatedRequest('GET', '/v1/organizations');

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame(1, $this->forceRefreshCount, 'tokenProvider(force=true) should be called once on 401');
    }

    /**
     * FIX 1 — On 401, retry is attempted. If retry also returns 401, ApiException is thrown.
     *
     * @throws Exception
     */
    public function testSendAuthenticatedRequestThrowsApiExceptionIfRetryAlso401(): void
    {
        $this->httpClient
            ->expects($this->exactly(2))
            ->method('sendRequest')
            ->willReturnOnConsecutiveCalls(
                new Response(401, [], 'Unauthorized'),
                new Response(401, [], 'Unauthorized'),
            );

        try {
            $this->api->callSendAuthenticatedRequest('GET', '/v1/organizations');
            $this->fail('Expected ApiException was not thrown');
        } catch (ApiException) {
            // expected — $_retried guard prevents a second forceRefresh on the already-retried call
        }

        $this->assertSame(1, $this->forceRefreshCount, '$_retried guard: tokenProvider(force=true) called exactly once even on double-401');
    }

    /**
     * FIX 1 — Non-401 4xx/5xx errors throw ApiException immediately without retry.
     *
     * @throws Exception
     */
    public function testSendAuthenticatedRequestThrowsApiExceptionOn403WithoutRetry(): void
    {
        $this->httpClient
            ->expects($this->once()) // Only one request — no retry for non-401
            ->method('sendRequest')
            ->willReturn(new Response(403, [], 'Forbidden'));

        try {
            $this->api->callSendAuthenticatedRequest('GET', '/v1/organizations');
            $this->fail('Expected ApiException was not thrown');
        } catch (ApiException) {
            // expected
        }

        $this->assertSame(0, $this->forceRefreshCount, 'tokenProvider(force=true) should never be called for a 403');
    }

    /**
     * FIX 1 — 500 errors throw ApiException immediately without retry.
     *
     * @throws Exception
     */
    public function testSendAuthenticatedRequestThrowsApiExceptionOn500WithoutRetry(): void
    {
        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(500, [], 'Internal Server Error'));

        try {
            $this->api->callSendAuthenticatedRequest('GET', '/v1/organizations');
            $this->fail('Expected ApiException was not thrown');
        } catch (ApiException) {
            // expected
        }

        $this->assertSame(0, $this->forceRefreshCount, 'tokenProvider(force=true) should never be called for a 500');
    }

    /**
     * FIX 1 — ClientExceptionInterface (network failure) is wrapped in ApiException.
     *
     * @throws Exception
     */
    public function testSendAuthenticatedRequestWrapsClientException(): void
    {
        $networkError = new class ('Connection refused') extends Exception implements ClientExceptionInterface {
        };

        $this->httpClient
            ->method('sendRequest')
            ->willThrowException($networkError);

        $this->expectException(ApiException::class);

        $this->api->callSendAuthenticatedRequest('GET', '/v1/organizations');
    }

    /**
     * Authorization header is set from OAuthProvider::getAuthorization().
     *
     * @throws Exception
     */
    public function testSendAuthenticatedRequestSetsAuthorizationHeader(): void
    {
        $capturedRequest = null;

        $this->httpClient
            ->method('sendRequest')
            ->willReturnCallback(function (RequestInterface $request) use (&$capturedRequest) {
                $capturedRequest = $request;
                return new Response(200, [], '{}');
            });

        $this->api->callSendAuthenticatedRequest('GET', '/v1/organizations');

        $this->assertNotNull($capturedRequest);
        $this->assertEquals('Bearer test-token', $capturedRequest->getHeaderLine('Authorization'));
    }

    /**
     * refreshToken() delegates to OAuthProvider::ensureValidToken().
     *
     * @throws Exception
     */
    public function testRefreshTokenCallsEnsureValidToken(): void
    {
        $this->api->callRefreshToken();

        $this->assertSame(1, $this->tokenCallCount, 'refreshToken() should invoke the tokenProvider closure once');
    }

    /**
     * Extra custom headers are forwarded in the request.
     *
     * @throws Exception
     */
    public function testSendAuthenticatedRequestForwardsCustomHeaders(): void
    {
        $capturedRequest = null;

        $this->httpClient
            ->method('sendRequest')
            ->willReturnCallback(function (RequestInterface $request) use (&$capturedRequest) {
                $capturedRequest = $request;
                return new Response(200, [], '{}');
            });

        $this->api->callSendAuthenticatedRequest(
            'POST',
            '/v1/projects',
            ['X-Custom-Header' => 'custom-value', 'Content-Type' => 'application/json'],
            '{"title":"test"}'
        );

        $this->assertNotNull($capturedRequest);
        $this->assertEquals('custom-value', $capturedRequest->getHeaderLine('X-Custom-Header'));
        $this->assertStringContainsString('application/json', $capturedRequest->getHeaderLine('Content-Type'));
    }

    /**
     * Body is sent with the request.
     *
     * @throws Exception
     */
    public function testSendAuthenticatedRequestSendsBody(): void
    {
        $capturedRequest = null;

        $this->httpClient
            ->method('sendRequest')
            ->willReturnCallback(function (RequestInterface $request) use (&$capturedRequest) {
                $capturedRequest = $request;
                return new Response(200, [], '{}');
            });

        $this->api->callSendAuthenticatedRequest('POST', '/v1/projects', [], '{"title":"my-project"}');

        $this->assertNotNull($capturedRequest);
        $this->assertEquals('{"title":"my-project"}', (string)$capturedRequest->getBody());
    }
}
