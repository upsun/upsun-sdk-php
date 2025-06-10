<?php

namespace Tests\Unit\Upsun\Core\Tasks;

use GuzzleHttp\Client;
use OpenAPI\Client\ApiException;
use OpenAPI\Client\apisgen\EnvironmentActivityApi;
use OpenAPI\Client\apisgen\ProjectActivityApi;
use OpenAPI\Client\Configuration;
use OpenAPI\Client\Model\AcceptedResponse;
use OpenAPI\Client\Model\Activity;
use PHPUnit\Framework\TestCase;
use Upsun\Core\Tasks\ActivityTask;
use Upsun\UpsunClient;
use Upsun\UpsunConfig;

class ActivityTaskTest extends TestCase
{
    private ActivityTask $activityTask;
    private ProjectActivityApi $projectActivityApiMock;
    private EnvironmentActivityApi $environmentActivityApiMock;

    protected function setUp(): void
    {
        $this->projectActivityApiMock = $this->createMock(ProjectActivityApi::class);
        $this->environmentActivityApiMock = $this->createMock(EnvironmentActivityApi::class);

        $this->activityTask = new class(
            $this->projectActivityApiMock,
            $this->environmentActivityApiMock
        ) extends ActivityTask {
            public function refreshToken(): void {}
        };
    }
    public function testCancelProjectActivity()
    {
        $expectedResponse = new AcceptedResponse();

        $this->projectActivityApiMock->expects($this->once())
            ->method('actionProjectsActivitiesCancel')
            ->with('project-id', 'activity-id')
            ->willReturn($expectedResponse);
        
        $result = $this->activityTask->cancel('project-id', 'activity-id');

        $this->assertSame($expectedResponse, $result);
    }

    public function testCancelEnvironmentActivity()
    {
        $expectedResponse = new AcceptedResponse();

        $this->environmentActivityApiMock->expects($this->once())
            ->method('actionProjectsEnvironmentsActivitiesCancel')
            ->with('project-id', 'env-id', 'activity-id')
            ->willReturn($expectedResponse);

        $result = $this->activityTask->cancel('project-id', 'activity-id', 'env-id');

        $this->assertSame($expectedResponse, $result);
    }
    
    public function testGetProjectActivity()
    {
        $projectId = 'test-project';
        $activityId = 'activity-123';
        $expectedActivity = new Activity();

        $this->projectActivityApiMock->expects($this->once())
            ->method('getProjectsActivities')
            ->with($projectId, $activityId)
            ->willReturn($expectedActivity);

        $result = $this->activityTask->get($projectId, $activityId);

        $this->assertSame($expectedActivity, $result);
    }

    public function testGetEnvironmentActivity()
    {
        $projectId = 'test-project';
        $environmentId = 'env-123';
        $activityId = 'activity-456';
        $expectedActivity = new Activity();
        
        $this->environmentActivityApiMock->expects($this->once())
            ->method('getProjectsEnvironmentsActivities')
            ->with($projectId, $environmentId, $activityId)
            ->willReturn($expectedActivity);

        $result = $this->activityTask->get($projectId, $activityId, $environmentId);

        $this->assertSame($expectedActivity, $result);
    }

    public function testListProjectActivities()
    {
        $projectId = 'test-project';
        $expectedActivities = [new Activity(), new Activity()];

        $this->projectActivityApiMock->expects($this->once())
            ->method('listProjectsActivities')
            ->with($projectId)
            ->willReturn($expectedActivities);
        

        $result = $this->activityTask->list($projectId);

        $this->assertSame($expectedActivities, $result);
    }

    public function testListEnvironmentActivities()
    {
        $projectId = 'test-project';
        $environmentId = 'env-123';
        $expectedActivities = [new Activity()];

        $this->environmentActivityApiMock->expects($this->once())
            ->method('listProjectsEnvironmentsActivities')
            ->with($projectId, $environmentId)
            ->willReturn($expectedActivities);
        
        $result = $this->activityTask->list($projectId, $environmentId);

        $this->assertSame($expectedActivities, $result);
    }
}