<?php

namespace Upsun\Tests\Core;

use Exception;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Upsun\Core\OAuthProvider;

/**
 * Test suite for OAuthProvider.
 *
 * @covers \Upsun\Core\OAuthProvider
 */
class OAuthProviderTest extends TestCase
{
    private ClientInterface $httpClient;

    private RequestFactoryInterface $requestFactory;

    private OAuthProvider $oauthProvider;

    private string $tokenEndpoint = 'https://auth.upsun.com/oauth2/token';

    private string $clientId = 'test-client-id';

    private string $clientSecret = 'test-api-token';

    protected function setUp(): void
    {
        $this->httpClient = $this->createMock(ClientInterface::class);
        $this->requestFactory = new Psr17Factory();

        $this->oauthProvider = new OAuthProvider(
            $this->httpClient,
            $this->requestFactory,
            $this->tokenEndpoint,
            $this->clientId,
            $this->clientSecret
        );
    }

    public function testExchangeCodeForTokenSuccess()
    {
        $responseBody = json_encode([
            'access_token' => 'test-access-token-123',
            'expires_in' => 3600,
            'token_type' => 'Bearer'
        ]);

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->with($this->callback(function (RequestInterface $request) {
                $this->assertEquals('POST', $request->getMethod());
                $this->assertEquals($this->tokenEndpoint, (string)$request->getUri());
                $this->assertStringContainsString(
                    'application/x-www-form-urlencoded',
                    $request->getHeaderLine('Content-Type')
                );
                $this->assertStringStartsWith('Basic ', $request->getHeaderLine('Authorization'));

                $body = (string)$request->getBody();
                $this->assertStringContainsString('grant_type=api_token', $body);
                $this->assertStringContainsString('api_token=' . $this->clientSecret, $body);
                $this->assertStringContainsString('client_id=' . $this->clientId, $body);

                return true;
            }))
            ->willReturn(new Response(200, ['Content-Type' => 'application/json'], $responseBody));

        $result = $this->oauthProvider->exchangeCodeForToken();

        $this->assertTrue($result);
    }

    public function testExchangeCodeForTokenFailsWithNon200Status()
    {
        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(401, [], 'Unauthorized'));

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Token exchange failed with status: 401');

        $this->oauthProvider->exchangeCodeForToken();
    }

    public function testExchangeCodeForTokenFailsWithInvalidJson()
    {
        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(200, ['Content-Type' => 'application/json'], 'invalid-json'));

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Invalid JSON response:');

        $this->oauthProvider->exchangeCodeForToken();
    }

    public function testExchangeCodeForTokenFailsWithoutAccessToken()
    {
        $responseBody = json_encode([
            'token_type' => 'Bearer',
            'expires_in' => 3600
        ]);

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(200, ['Content-Type' => 'application/json'], $responseBody));

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('No access token in response');

        $this->oauthProvider->exchangeCodeForToken();
    }

    public function testExchangeCodeForTokenFailsWithEmptyAccessToken()
    {
        $responseBody = json_encode([
            'access_token' => '',
            'expires_in' => 3600
        ]);

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(200, ['Content-Type' => 'application/json'], $responseBody));

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('No access token in response');

        $this->oauthProvider->exchangeCodeForToken();
    }

    public function testExchangeCodeForTokenHandlesClientException()
    {
        $clientException = new class ('Network error') extends Exception implements ClientExceptionInterface {
        };

        $this->httpClient
            ->method('sendRequest')
            ->willThrowException($clientException);

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Token exchange failed: Network error');

        $this->oauthProvider->exchangeCodeForToken();
    }

    public function testGetAuthorizationReturnsValidToken()
    {
        $responseBody = json_encode([
            'access_token' => 'valid-token-abc',
            'expires_in' => 3600
        ]);

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(200, ['Content-Type' => 'application/json'], $responseBody));

        $authorization = $this->oauthProvider->getAuthorization();

        $this->assertEquals('Bearer valid-token-abc', $authorization);
    }

    public function testEnsureValidTokenRequestsNewTokenWhenNoneExists()
    {
        $responseBody = json_encode([
            'access_token' => 'new-token-123',
            'expires_in' => 3600
        ]);

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(200, ['Content-Type' => 'application/json'], $responseBody));

        $this->oauthProvider->ensureValidToken();

        // Verify token is stored by calling getAuthorization without another request
        $this->httpClient
            ->expects($this->never())
            ->method('sendRequest');

        $authorization = $this->oauthProvider->getAuthorization();
        $this->assertEquals('Bearer new-token-123', $authorization);
    }

    public function testEnsureValidTokenRefreshesExpiredToken()
    {
        // First request: get initial token with short expiry
        $firstResponse = json_encode([
            'access_token' => 'short-lived-token',
            'expires_in' => -100 // Already expired
        ]);

        // Second request: get new token
        $secondResponse = json_encode([
            'access_token' => 'refreshed-token',
            'expires_in' => 3600
        ]);

        $this->httpClient
            ->method('sendRequest')
            ->willReturnOnConsecutiveCalls(
                new Response(200, ['Content-Type' => 'application/json'], $firstResponse),
                new Response(200, ['Content-Type' => 'application/json'], $secondResponse)
            );

        // Get first token
        $this->oauthProvider->exchangeCodeForToken();

        // This should trigger a refresh because token is expired
        $authorization = $this->oauthProvider->getAuthorization();

        $this->assertEquals('Bearer refreshed-token', $authorization);
    }

    public function testEnsureValidTokenWithinBufferPeriodRefreshesToken()
    {
        // Token that expires in less than 60 seconds (buffer period)
        $responseBody = json_encode([
            'access_token' => 'expiring-soon-token',
            'expires_in' => 30 // Less than 60 second buffer
        ]);

        $refreshedResponse = json_encode([
            'access_token' => 'fresh-token',
            'expires_in' => 3600
        ]);

        $this->httpClient
            ->method('sendRequest')
            ->willReturnOnConsecutiveCalls(
                new Response(200, ['Content-Type' => 'application/json'], $responseBody),
                new Response(200, ['Content-Type' => 'application/json'], $refreshedResponse)
            );

        $this->oauthProvider->exchangeCodeForToken();

        // Should refresh because within buffer period
        $authorization = $this->oauthProvider->getAuthorization();

        $this->assertEquals('Bearer fresh-token', $authorization);
    }

    public function testGetAuthorizationDoesNotRefreshValidToken()
    {
        $responseBody = json_encode([
            'access_token' => 'long-lived-token',
            'expires_in' => 7200 // 2 hours
        ]);

        $this->httpClient
            ->expects($this->once()) // Only once for initial token
            ->method('sendRequest')
            ->willReturn(new Response(200, ['Content-Type' => 'application/json'], $responseBody));

        // First call to get token
        $auth1 = $this->oauthProvider->getAuthorization();

        // Second call should use cached token
        $auth2 = $this->oauthProvider->getAuthorization();

        $this->assertEquals('Bearer long-lived-token', $auth1);
        $this->assertEquals('Bearer long-lived-token', $auth2);
    }

    public function testConstructorWithDifferentParameters()
    {
        $customProvider = new OAuthProvider(
            $this->httpClient,
            $this->requestFactory,
            'https://custom.auth.com/token',
            'custom-client',
            'custom-secret'
        );

        $responseBody = json_encode([
            'access_token' => 'custom-token',
            'expires_in' => 3600
        ]);

        $this->httpClient
            ->method('sendRequest')
            ->with($this->callback(function (RequestInterface $request) {
                $this->assertEquals('https://custom.auth.com/token', (string)$request->getUri());
                $body = (string)$request->getBody();
                $this->assertStringContainsString('client_id=custom-client', $body);
                $this->assertStringContainsString('api_token=custom-secret', $body);
                return true;
            }))
            ->willReturn(new Response(200, ['Content-Type' => 'application/json'], $responseBody));

        $result = $customProvider->exchangeCodeForToken();

        $this->assertTrue($result);
    }

    public function testAuthorizationHeaderFormat()
    {
        $responseBody = json_encode([
            'access_token' => 'platform-api-user:',
            'expires_in' => 3600
        ]);

        $this->httpClient
            ->method('sendRequest')
            ->with($this->callback(function (RequestInterface $request) {
                $authHeader = $request->getHeaderLine('Authorization');
                $this->assertStringStartsWith('Basic ', $authHeader);

                // Verify base64 encoding of 'platform-api-user:'
                $expectedEncoded = base64_encode('platform-api-user:');
                $this->assertEquals('Basic ' . $expectedEncoded, $authHeader);

                return true;
            }))
            ->willReturn(new Response(200, ['Content-Type' => 'application/json'], $responseBody));

        $this->oauthProvider->exchangeCodeForToken();
    }

    public function testExchangeCodeForTokenWithMissingExpiresIn()
    {
        $firstResponse = json_encode([
            'access_token' => 'token-without-expiry'
        ]);

        $secondResponse = json_encode([
            'access_token' => 'refreshed-token',
            'expires_in' => 3600
        ]);

        $this->httpClient
            ->method('sendRequest')
            ->willReturnOnConsecutiveCalls(
                new Response(200, ['Content-Type' => 'application/json'], $firstResponse),
                new Response(200, ['Content-Type' => 'application/json'], $secondResponse)
            );

        $result = $this->oauthProvider->exchangeCodeForToken();

        $this->assertTrue($result);

        // Token should be immediately expired (0 seconds + time())
        // Next call should trigger a refresh and get new token
        $authorization = $this->oauthProvider->getAuthorization();

        $this->assertEquals('Bearer refreshed-token', $authorization);
    }
}
