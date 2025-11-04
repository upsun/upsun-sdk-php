<?php

namespace Upsun\Tests;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use ReflectionClass;
use ReflectionException;
use Upsun\Api\ApiConfiguration;
use Upsun\Core\OAuthProvider;
use Upsun\Core\Tasks\ActivitiesTask;
use Upsun\Core\Tasks\ApplicationsTask;
use Upsun\Core\Tasks\BackupsTask;
use Upsun\Core\Tasks\CertificatesTask;
use Upsun\Core\Tasks\DomainsTask;
use Upsun\Core\Tasks\EnvironmentsTask;
use Upsun\Core\Tasks\InvitationsTask;
use Upsun\Core\Tasks\MetricsTask;
use Upsun\Core\Tasks\MountsTask;
use Upsun\Core\Tasks\OperationsTask;
use Upsun\Core\Tasks\OrganizationsTask;
use Upsun\Core\Tasks\ProjectsTask;
use Upsun\Core\Tasks\RegionsTask;
use Upsun\Core\Tasks\ResourcesTask;
use Upsun\Core\Tasks\RoutesTask;
use Upsun\Core\Tasks\SourceOperationsTask;
use Upsun\Core\Tasks\SupportTicketsTask;
use Upsun\Core\Tasks\TeamsTask;
use Upsun\Core\Tasks\UsersTask;
use Upsun\Core\Tasks\VariablesTask;
use Upsun\Core\Tasks\WorkersTask;
use Upsun\UpsunClient;
use Upsun\UpsunConfig;

/**
 * Test suite for UpsunClient.
 *
 * @covers \Upsun\UpsunClient
 */
class UpsunClientTest extends TestCase
{
    private UpsunClient $upsunClient;

    private UpsunConfig $upsunConfig;

    private ClientInterface $httpClient;

    protected function setUp(): void
    {
        $this->upsunConfig = new UpsunConfig(
            base_url: 'https://api.upsun.com',
            auth_url: 'https://auth.upsun.com',
            apiToken: 'test-api-token',
            token_endpoint: 'oauth2/token',
            clientId: 'test-client-id'
        );

        $this->httpClient = $this->createMock(ClientInterface::class);

        $this->upsunClient = new UpsunClient($this->upsunConfig);
    }

    public function testConstructorInitializesApiConfiguration()
    {
        $this->assertInstanceOf(ApiConfiguration::class, $this->upsunClient->apiConfig);
        $this->assertEquals('https://api.upsun.com', $this->upsunClient->apiConfig->getHost());
    }

    public function testConstructorInitializesHttpClient()
    {
        $this->assertInstanceOf(ClientInterface::class, $this->upsunClient->apiClient);
    }

    public function testConstructorInitializesOAuthProvider()
    {
        $this->assertInstanceOf(OAuthProvider::class, $this->upsunClient->auth);
    }

    public function testConstructorInitializesActivitiesTask()
    {
        $this->assertInstanceOf(ActivitiesTask::class, $this->upsunClient->activities);
    }

    public function testConstructorInitializesApplicationsTask()
    {
        $this->assertInstanceOf(ApplicationsTask::class, $this->upsunClient->applications);
    }

    public function testConstructorInitializesBackupsTask()
    {
        $this->assertInstanceOf(BackupsTask::class, $this->upsunClient->backups);
    }

    public function testConstructorInitializesCertificatesTask()
    {
        $this->assertInstanceOf(CertificatesTask::class, $this->upsunClient->certificates);
    }

    public function testConstructorInitializesDomainsTask()
    {
        $this->assertInstanceOf(DomainsTask::class, $this->upsunClient->domains);
    }

    public function testConstructorInitializesEnvironmentsTask()
    {
        $this->assertInstanceOf(EnvironmentsTask::class, $this->upsunClient->environments);
    }

    public function testConstructorInitializesInvitationsTask()
    {
        $this->assertInstanceOf(InvitationsTask::class, $this->upsunClient->invitations);
    }

    public function testConstructorInitializesMetricsTask()
    {
        $this->assertInstanceOf(MetricsTask::class, $this->upsunClient->metrics);
    }

    public function testConstructorInitializesMountsTask()
    {
        $this->assertInstanceOf(MountsTask::class, $this->upsunClient->mounts);
    }

    public function testConstructorInitializesOperationsTask()
    {
        $this->assertInstanceOf(OperationsTask::class, $this->upsunClient->operations);
    }

    public function testConstructorInitializesOrganizationsTask()
    {
        $this->assertInstanceOf(OrganizationsTask::class, $this->upsunClient->organizations);
    }

    public function testConstructorInitializesProjectsTask()
    {
        $this->assertInstanceOf(ProjectsTask::class, $this->upsunClient->projects);
    }

    public function testConstructorInitializesRegionsTask()
    {
        $this->assertInstanceOf(RegionsTask::class, $this->upsunClient->regions);
    }

    public function testConstructorInitializesResourcesTask()
    {
        $this->assertInstanceOf(ResourcesTask::class, $this->upsunClient->resources);
    }

    public function testConstructorInitializesRoutesTask()
    {
        $this->assertInstanceOf(RoutesTask::class, $this->upsunClient->routes);
    }

    public function testConstructorInitializesSourceOperationsTask()
    {
        $this->assertInstanceOf(SourceOperationsTask::class, $this->upsunClient->sourceOperations);
    }

    public function testConstructorInitializesTeamsTask()
    {
        $this->assertInstanceOf(TeamsTask::class, $this->upsunClient->teams);
    }

    public function testConstructorInitializesSupportTicketsTask()
    {
        $this->assertInstanceOf(SupportTicketsTask::class, $this->upsunClient->supportTickets);
    }

    public function testConstructorInitializesUsersTask()
    {
        $this->assertInstanceOf(UsersTask::class, $this->upsunClient->users);
    }

    public function testConstructorInitializesVariablesTask()
    {
        $this->assertInstanceOf(VariablesTask::class, $this->upsunClient->variables);
    }

    public function testConstructorInitializesWorkersTask()
    {
        $this->assertInstanceOf(WorkersTask::class, $this->upsunClient->workers);
    }

    public function testGetTokenReturnsApiToken()
    {
        $token = $this->upsunClient->getToken();

        $this->assertEquals('test-api-token', $token);
    }

    public function testUserIdIsNullByDefault()
    {
        $this->assertNull($this->upsunClient->userId);
    }

    public function testUserIdCanBeSet()
    {
        $this->upsunClient->userId = 'user-123';

        $this->assertEquals('user-123', $this->upsunClient->userId);
    }

    public function testConstructorWithDifferentConfiguration()
    {
        $customConfig = new UpsunConfig(
            base_url: 'https://custom.api.com',
            auth_url: 'https://custom.auth.com',
            apiToken: 'custom-token',
            token_endpoint: 'custom/token',
            clientId: 'custom-client'
        );

        $customClient = new UpsunClient($customConfig);

        $this->assertEquals('https://custom.api.com', $customClient->apiConfig->getHost());
        $this->assertEquals('custom-token', $customClient->getToken());
    }

    /**
     * @throws ReflectionException
     */
    public function testAllTasksArePubliclyAccessible()
    {
        $reflection = new ReflectionClass(UpsunClient::class);

        $expectedPublicProperties = [
            'apiClient',
            'apiConfig',
            'auth',
            'userId',
            'activities',
            'applications',
            'backups',
            'certificates',
            'domains',
            'environments',
            'invitations',
            'metrics',
            'mounts',
            'operations',
            'organizations',
            'projects',
            'regions',
            'resources',
            'routes',
            'sourceOperations',
            'teams',
            'supportTickets',
            'users',
            'variables',
            'workers',
        ];

        foreach ($expectedPublicProperties as $propertyName) {
            $this->assertTrue(
                $reflection->hasProperty($propertyName),
                sprintf('Property %s should exist', $propertyName)
            );

            $property = $reflection->getProperty($propertyName);
            $this->assertTrue(
                $property->isPublic(),
                sprintf('Property %s should be public', $propertyName)
            );
        }
    }
}
