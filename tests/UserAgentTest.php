<?php

namespace Upsun\Tests;

use PHPUnit\Framework\TestCase;
use Upsun\Api\ApiConfiguration;
use Upsun\UserAgent;

/**
 * @covers \Upsun\UserAgent
 */
class UserAgentTest extends TestCase
{
    public function testGetReturnsExpectedSegments()
    {
        $userAgent = UserAgent::get();
        $clientMetadata = UserAgent::getClientMetadata();

        $this->assertMatchesRegularExpression('/^upsun-sdk-php@.+/', $userAgent);
        $this->assertMatchesRegularExpression('/^php\/.+/', $clientMetadata);
        $this->assertStringContainsString(strtolower(PHP_OS_FAMILY), $clientMetadata);
    }

    public function testApiConfigurationUsesDynamicUserAgent()
    {
        $config = new ApiConfiguration();

        $this->assertSame(UserAgent::get(), $config->getUserAgent());
        $this->assertSame(UserAgent::getClientMetadata(), $config->getUpsunClientHeader());
    }
}
