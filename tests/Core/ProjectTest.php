<?php

use PHPUnit\Framework\TestCase;
use Upsun\Core\Project;

class ProjectTest extends TestCase
{
    protected $upsun;

    protected function setUp(): void
    {
        $this->upsun = new Upsun();
        $this->upsun->setConfig('https://api.example.com', 'your_api_key');
    }

    public function testListProjects()
    {
        $organizationId = 1; // Example organization ID
        $projects = $this->upsun->project->list($organizationId);
        
        $this->assertIsArray($projects);
        // Additional assertions can be added based on expected project structure
    }

    public function testListProjectsWithInvalidOrganizationId()
    {
        $this->expectException(UpsunException::class);
        $this->upsun->project->list(-1); // Invalid organization ID
    }
}