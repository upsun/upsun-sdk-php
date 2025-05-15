<?php

use PHPUnit\Framework\TestCase;
use Upsun\Core\Organization;

class OrganizationTest extends TestCase
{
    protected $upsun;

    protected function setUp(): void
    {
        $this->upsun = new Upsun();
        $this->upsun->config->setUrl('https://api.example.com');
        $this->upsun->config->setApiKey('your_api_key');
    }

    public function testListOrganizations()
    {
        $organizations = $this->upsun->organization->list();
        $this->assertIsArray($organizations);
        // Additional assertions can be added here based on expected structure
    }

    public function testListOrganizationsWithInvalidApiKey()
    {
        $this->upsun->config->setApiKey('invalid_api_key');
        $this->expectException(UpsunException::class);
        $this->upsun->organization->list();
    }

    // Additional tests for other organization-related methods can be added here
}