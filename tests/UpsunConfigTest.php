<?php

namespace Upsun\Tests;

use PHPUnit\Framework\TestCase;
use ReflectionClass;
use Upsun\UpsunConfig;

/**
 * Test suite for UpsunConfig.
 *
 * @covers \Upsun\UpsunConfig
 */
class UpsunConfigTest extends TestCase
{
    public function testConstructorWithDefaultValues()
    {
        $config = new UpsunConfig();

        $this->assertEquals('https://api.upsun.com', $config->base_url);
        $this->assertEquals('https://auth.upsun.com', $config->auth_url);
        $this->assertEquals('UPSUN_API_TOKEN is not defined!', $config->apiToken);
        $this->assertEquals('oauth2/token', $config->token_endpoint);
        $this->assertEquals('oauth2/token', $config->refresh_endpoint);
        $this->assertEquals('sdk-php-client-id', $config->clientId);
    }

    public function testConstructorWithCustomValues()
    {
        $config = new UpsunConfig(
            base_url: 'https://custom.api.com',
            auth_url: 'https://custom.auth.com',
            apiToken: 'custom-api-token-123',
            token_endpoint: 'custom/token',
            refresh_endpoint: 'custom/refresh',
            clientId: 'custom-client-id'
        );

        $this->assertEquals('https://custom.api.com', $config->base_url);
        $this->assertEquals('https://custom.auth.com', $config->auth_url);
        $this->assertEquals('custom-api-token-123', $config->apiToken);
        $this->assertEquals('custom/token', $config->token_endpoint);
        $this->assertEquals('custom/refresh', $config->refresh_endpoint);
        $this->assertEquals('custom-client-id', $config->clientId);
    }

    public function testConstructorWithPartialCustomValues()
    {
        $config = new UpsunConfig(
            apiToken: 'my-secret-token',
            clientId: 'my-client-id'
        );

        // Custom values
        $this->assertEquals('my-secret-token', $config->apiToken);
        $this->assertEquals('my-client-id', $config->clientId);

        // Default values
        $this->assertEquals('https://api.upsun.com', $config->base_url);
        $this->assertEquals('https://auth.upsun.com', $config->auth_url);
        $this->assertEquals('oauth2/token', $config->token_endpoint);
        $this->assertEquals('oauth2/token', $config->refresh_endpoint);
    }

    public function testPropertiesAreReadonly()
    {
        $config = new UpsunConfig(apiToken: 'test-token');

        $reflection = new ReflectionClass(UpsunConfig::class);

        $properties = [
            'base_url',
            'auth_url',
            'apiToken',
            'token_endpoint',
            'refresh_endpoint',
            'clientId',
        ];

        foreach ($properties as $propertyName) {
            $property = $reflection->getProperty($propertyName);
            $this->assertTrue(
                $property->isReadOnly(),
                sprintf('Property %s should be readonly', $propertyName)
            );
        }
    }

    public function testPropertiesArePublic()
    {
        $config = new UpsunConfig();

        $reflection = new ReflectionClass(UpsunConfig::class);

        $properties = [
            'base_url',
            'auth_url',
            'apiToken',
            'token_endpoint',
            'refresh_endpoint',
            'clientId',
        ];

        foreach ($properties as $propertyName) {
            $property = $reflection->getProperty($propertyName);
            $this->assertTrue(
                $property->isPublic(),
                sprintf('Property %s should be public', $propertyName)
            );
        }
    }

    public function testClassIsFinal()
    {
        $reflection = new ReflectionClass(UpsunConfig::class);

        $this->assertTrue(
            $reflection->isFinal(),
            'UpsunConfig class should be final'
        );
    }

    public function testConstructorWithOnlyApiToken()
    {
        $config = new UpsunConfig(apiToken: 'only-token');

        $this->assertEquals('only-token', $config->apiToken);
        $this->assertEquals('https://api.upsun.com', $config->base_url);
    }

    public function testConstructorWithEmptyApiToken()
    {
        $config = new UpsunConfig(apiToken: '');

        $this->assertEquals('', $config->apiToken);
    }

    public function testConstructorNamedParametersOrder()
    {
        // Test that named parameters work in any order
        $config = new UpsunConfig(
            clientId: 'client-123',
            apiToken: 'token-456',
            auth_url: 'https://auth.custom.com',
            base_url: 'https://api.custom.com',
            refresh_endpoint: 'refresh/endpoint',
            token_endpoint: 'token/endpoint'
        );

        $this->assertEquals('https://api.custom.com', $config->base_url);
        $this->assertEquals('https://auth.custom.com', $config->auth_url);
        $this->assertEquals('token-456', $config->apiToken);
        $this->assertEquals('token/endpoint', $config->token_endpoint);
        $this->assertEquals('refresh/endpoint', $config->refresh_endpoint);
        $this->assertEquals('client-123', $config->clientId);
    }

    public function testDefaultTokenEndpointAndRefreshEndpointAreSame()
    {
        $config = new UpsunConfig();

        $this->assertEquals(
            $config->token_endpoint,
            $config->refresh_endpoint,
            'Default token_endpoint and refresh_endpoint should be the same'
        );
    }

    public function testConfigurationForProduction()
    {
        $config = new UpsunConfig(
            apiToken: getenv('UPSUN_API_TOKEN') ?: 'test-token'
        );

        $this->assertNotEmpty($config->base_url);
        $this->assertNotEmpty($config->auth_url);
        $this->assertNotEmpty($config->apiToken);
        $this->assertStringStartsWith('https://', $config->base_url);
        $this->assertStringStartsWith('https://', $config->auth_url);
    }

    public function testAllPropertiesAreStrings()
    {
        $config = new UpsunConfig();

        $this->assertIsString($config->base_url);
        $this->assertIsString($config->auth_url);
        $this->assertIsString($config->apiToken);
        $this->assertIsString($config->token_endpoint);
        $this->assertIsString($config->refresh_endpoint);
        $this->assertIsString($config->clientId);
    }
}
