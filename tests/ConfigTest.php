<?php

use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{
    protected $config;

    protected function setUp(): void
    {
        $this->config = new Config();
    }

    public function testSetAndGetApiKey()
    {
        $apiKey = 'test_api_key';
        $this->config->setApiKey($apiKey);
        $this->assertEquals($apiKey, $this->config->getApiKey());
    }

    public function testSetAndGetConnectionUrl()
    {
        $url = 'https://api.example.com';
        $this->config->setConnectionUrl($url);
        $this->assertEquals($url, $this->config->getConnectionUrl());
    }

    public function testDefaultValues()
    {
        $this->assertNull($this->config->getApiKey());
        $this->assertNull($this->config->getConnectionUrl());
    }
}