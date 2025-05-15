<?php

use PHPUnit\Framework\TestCase;

class UpsunTest extends TestCase
{
    protected $upsun;

    protected function setUp(): void
    {
        $this->upsun = new Upsun('https://api.example.com', 'your_api_key');
    }

    public function testProjectList()
    {
        $organizationId = 'org_123';
        $projects = $this->upsun->project->list($organizationId);
        $this->assertIsArray($projects);
    }

    public function testOrganizationList()
    {
        $organizations = $this->upsun->organization->list();
        $this->assertIsArray($organizations);
    }

    public function testVariablesList()
    {
        $variables = $this->upsun->variables->list();
        $this->assertIsArray($variables);
    }
}