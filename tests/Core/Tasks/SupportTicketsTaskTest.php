<?php

namespace Upsun\Tests\Core\Tasks;

use DateTime;
use Exception;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Upsun\Api\ApiConfiguration;
use Upsun\Api\DefaultApi;
use Upsun\Api\DeploymentTargetApi;
use Upsun\Api\OrganizationProjectsApi;
use Upsun\Api\ProjectApi;
use Upsun\Api\ProjectSettingsApi;
use Upsun\Api\RepositoryApi;
use Upsun\Api\SubscriptionsApi;
use Upsun\Api\SupportApi;
use Upsun\Api\SystemInformationApi;
use Upsun\Api\ThirdPartyIntegrationsApi;
use Upsun\Core\OAuthProvider;
use Upsun\Core\Tasks\ProjectsTask;
use Upsun\Core\Tasks\SupportTicketsTask;
use Upsun\Model\ListTicketCategories200ResponseInner;
use Upsun\Model\ListTicketPriorities200ResponseInner;
use Upsun\Model\ListTickets200Response;
use Upsun\Model\Ticket;
use Upsun\UpsunClient;

class SupportTicketsTaskTest extends BaseTestCase
{
    private SupportTicketsTask $task;

    /**
     * @var ClientInterface&\PHPUnit\Framework\MockObject\MockObject
     */
    private ClientInterface $httpClient;

    protected function setUp(): void
    {
        $this->httpClient = $this->createMock(ClientInterface::class);

        $upsunClient = $this->createMock(UpsunClient::class);

        $apiClassParams = [
            $this->createMock(OAuthProvider::class),
            $this->httpClient,
            new Psr17Factory(),
            new ApiConfiguration()
        ];

        $upsunClient->projects = new class (
            $upsunClient,
            new ProjectApi(...$apiClassParams),
            new OrganizationProjectsApi(...$apiClassParams),
            new ProjectSettingsApi(...$apiClassParams),
            new DeploymentTargetApi(...$apiClassParams),
            new RepositoryApi(...$apiClassParams),
            new SystemInformationApi(...$apiClassParams),
            new ThirdPartyIntegrationsApi(...$apiClassParams),
            new SubscriptionsApi(...$apiClassParams),
        ) extends ProjectsTask {
        };

        $this->task = new class (
            $upsunClient,
            new DefaultApi(...$apiClassParams),
            new SupportApi(...$apiClassParams),
        ) extends SupportTicketsTask {
        };
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testList(): void
    {
        $filterTicketId = 123;
        $filterCreated = new DateTime('2025-09-01T00:00:00Z');
        $filterUpdated = new DateTime('2025-09-24T12:00:00Z');
        $filterType = 'bug';
        $filterPriority = 'high';
        $filterStatus = 'open';
        $filterRequesterId = 'user-456';
        $filterSubmitterId = 'user-789';
        $filterAssigneeId = 'user-101';
        $filterHasIncidents = true;
        $filterDue = new DateTime('2025-10-01T00:00:00Z');
        $search = 'urgent';
        $page = 1;


        $listTickets = [
            'count' => 2,
            'tickets' => [
                [
                    'ticketId' => 101,
                    'created' => '2025-09-01T10:00:00Z',
                    'updated' => '2025-09-24T12:00:00Z',
                    'type' => 'bug',
                    'subject' => 'Ticket 101 subject',
                    'description' => 'Description for ticket 101',
                    'priority' => 'high',
                    'status' => 'open',
                    'requesterId' => 'user-001',
                    'submitterId' => 'user-002',
                    'assigneeId' => 'user-003',
                    'hasIncidents' => true,
                    'due' => '2025-10-01T00:00:00Z',
                    'tags' => ['urgent', 'frontend'],
                    'jira' => [
                        [
                            'id' => 1,
                            'ticketId' => 101,
                            'issueId' => 1001,
                            'issueKey' => 'PROJ-101',
                            'createdAt' => '2025.0',
                            'updatedAt' => '2025.0',
                        ]
                    ],
                ],
                [
                    'ticketId' => 102,
                    'created' => '2025-09-05T11:30:00Z',
                    'updated' => '2025-09-24T13:45:00Z',
                    'type' => 'feature',
                    'subject' => 'Ticket 102 subject',
                    'description' => 'Description for ticket 102',
                    'priority' => 'medium',
                    'status' => 'closed',
                    'requesterId' => 'user-004',
                    'submitterId' => 'user-005',
                    'assigneeId' => 'user-006',
                    'hasIncidents' => false,
                    'due' => '2025-10-15T00:00:00Z',
                    'tags' => ['backend'],
                    'jira' => [],
                ],
            ],
            'links' => [
                'self' => [
                    'title' => 'Current Page',
                    'href' => 'https://api.example.com/tickets?page=1',
                ],
                'previous' => [
                    'title' => 'Previous Page',
                    'href' => 'https://api.example.com/tickets?page=0',
                ],
                'next' => [
                    'title' => 'Next Page',
                    'href' => 'https://api.example.com/tickets?page=2',
                ],
            ],
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($listTickets)
            ));

        $result = $this->task->list(
            filterTicketId: $filterTicketId,
            filterCreated: $filterCreated,
            filterUpdated: $filterUpdated,
            filterType: $filterType,
            filterPriority: $filterPriority,
            filterStatus: $filterStatus,
            filterRequesterId: $filterRequesterId,
            filterSubmitterId: $filterSubmitterId,
            filterAssigneeId: $filterAssigneeId,
            filterHasIncidents: $filterHasIncidents,
            filterDue: $filterDue,
            search: $search,
            page: $page
        );

        $this->assertInstanceOf(ListTickets200Response::class, $result);
        $this->assertContainsOnlyInstancesOf(Ticket::class, $result->getTickets());
        $this->assertObjectMatchesArray($result->getTickets(), $listTickets['tickets']);
    }

    /**
     * @throws Exception|ClientExceptionInterface
     */
    public function testCreate(): void
    {
        $fakeTicketData = [
            'subject' => 'Bug: Unable to login',
            'description' => 'Users report that login fails with 500 error.',
            'priority' => 'high',
            'subscriptionId' => 'sub-001',
            'requestId' => 'req1',
            'organizationId' => 'org-001',
            'affectedUrl' => 'https://example.com/login',
            'followupTid' => 'ticket-001',
            'category' => 'authentication',
            'attachments' => [
                [
                    'filename' => 'screenshot1.png',
                    'data' => 'base64-content',
                ],
                [
                    'filename' => 'error_log.txt',
                    'data' => 'base64-content',
                ],
            ],
            'collaboratorIds' => ['user-004', 'user-005'],
        ];

        $ticket = [
            'ticketId' => 101,
            'created' => '2025-09-01T10:00:00Z',
            'updated' => '2025-09-24T12:00:00Z',
            'type' => 'bug',
            'subject' => 'Bug: Unable to login',
            'description' => 'Users report that login fails with 500 error.',
            'priority' => 'high',
            'followupTid' => 'ticket-001',
            'status' => 'open',
            'recipient' => 'user-001',
            'requesterId' => 'user-001',
            'submitterId' => 'user-002',
            'assigneeId' => 'user-003',
            'organizationId' => 'org-001',
            'collaboratorIds' => ['user-004', 'user-005'],
            'hasIncidents' => true,
            'due' => '2025-10-01T00:00:00Z',
            'tags' => ['urgent', 'frontend'],
            'subscriptionId' => 'sub-001',
            'ticketGroup' => 'group-001',
            'supportPlan' => 'premium',
            'affectedUrl' => 'https://example.com/login',
            'queue' => 'support',
            'issueType' => 'bug',
            'resolutionTime' => '2025-09-05T10:00:00Z',
            'responseTime' => '2025-09-01T12:00:00Z',
            'projectUrl' => 'https://project.example.com',
            'region' => 'us-east-1',
            'category' => 'authentication',
            'environment' => 'production',
            'ticketSharingStatus' => 'private',
            'applicationTicketUrl' => 'https://app.example.com/ticket/101',
            'infrastructureTicketUrl' => 'https://infra.example.com/ticket/101',
            'jira' => [
                [
                    'id' => 1,
                    'ticketId' => 101,
                    'issueId' => 1001,
                    'issueKey' => 'PROJ-101',
                    'createdAt' => '2025-09-01T10:00:00Z',
                    'updatedAt' => '2025-09-01T11:00:00Z',
                ]
            ],
            'zdTicketUrl' => 'https://zendesk.example.com/tickets/101',
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($ticket)
            ));

        $result = $this->task->create(
            subject: $fakeTicketData['subject'],
            description: $fakeTicketData['description'],
            requesterId: $fakeTicketData['requestId'],
            priority: $fakeTicketData['priority'],
            subscriptionId: $fakeTicketData['subscriptionId'],
            organizationId: $fakeTicketData['organizationId'],
            affectedUrl: $fakeTicketData['affectedUrl'],
            followupTid: $fakeTicketData['followupTid'],
            category: $fakeTicketData['category'],
            attachments: $fakeTicketData['attachments'],
            collaboratorIds: $fakeTicketData['collaboratorIds'],
        );
        $this->assertInstanceOf(Ticket::class, $result);
        $this->assertObjectProperties($result, $fakeTicketData);
    }

    /**
     * @throws Exception
     * @throws ClientExceptionInterface
     */
    public function testUpdate(): void
    {
        $fakeTicketData = [
            'status' => 'open',
            'collaboratorIds' => ['user-004', 'user-005'],
            'collaboratorsReplace' => true
        ];

        $ticket = [
            'ticketId' => 101,
            'created' => '2025-09-01T10:00:00Z',
            'updated' => '2025-09-24T12:00:00Z',
            'type' => 'bug',
            'subject' => 'Bug: Unable to login',
            'description' => 'Users report that login fails with 500 error.',
            'priority' => 'high',
            'followupTid' => 'ticket-001',
            'status' => 'open',
            'recipient' => 'user-001',
            'requesterId' => 'user-001',
            'submitterId' => 'user-002',
            'assigneeId' => 'user-003',
            'organizationId' => 'org-001',
            'collaboratorIds' => ['user-004', 'user-005'],
            'hasIncidents' => true,
            'due' => '2025-10-01T00:00:00Z',
            'tags' => ['urgent', 'frontend'],
            'subscriptionId' => 'sub-001',
            'ticketGroup' => 'group-001',
            'supportPlan' => 'premium',
            'affectedUrl' => 'https://example.com/login',
            'queue' => 'support',
            'issueType' => 'bug',
            'resolutionTime' => '2025-09-05T10:00:00Z',
            'responseTime' => '2025-09-01T12:00:00Z',
            'projectUrl' => 'https://project.example.com',
            'region' => 'us-east-1',
            'category' => 'authentication',
            'environment' => 'production',
            'ticketSharingStatus' => 'private',
            'applicationTicketUrl' => 'https://app.example.com/ticket/101',
            'infrastructureTicketUrl' => 'https://infra.example.com/ticket/101',
            'jira' => [
                [
                    'id' => 1,
                    'ticketId' => 101,
                    'issueId' => 1001,
                    'issueKey' => 'PROJ-101',
                    'createdAt' => '2025-09-01T10:00:00Z',
                    'updatedAt' => '2025-09-01T11:00:00Z',
                ]
            ],
            'zdTicketUrl' => 'https://zendesk.example.com/tickets/101',
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($ticket)
            ));

        $result = $this->task->update(
            ticketId: 'ticket-123',
            status: $fakeTicketData['status'],
            collaboratorIds: $fakeTicketData['collaboratorIds'],
            collaboratorsReplace: $fakeTicketData['collaboratorsReplace'],
        );
        $this->assertInstanceOf(Ticket::class, $result);
        $this->assertObjectProperties($result, $fakeTicketData);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testListCategories(): void
    {
        $projId = 'project-123';
        $orgId = 'org-123';

        $ticketCategories = [
            [
                'id' => 'bug',
                'label' => 'Bug Report',
            ],
            [
                'id' => 'feature',
                'label' => 'Feature Request',
            ],
            [
                'id' => 'support',
                'label' => 'Support',
            ],
        ];

        $projectFake = [
            'id' => $projId,
            'attributes' => [
                'language' => 'php',
                'framework' => 'symfony',
            ],
            'title' => 'My Student Project',
            'description' => 'This is a fake project for testing.',
            'owner' => 'user_123',
            'status' => [
                'code' => 'active',
                'message' => 'All systems operational',
            ],
            'timezone' => 'Europe/Paris',
            'region' => 'eu-west-1',
            'repository' => [
                'url' => 'git@github.com:student/project.git',
                'clientSshKey' => 'ssh-rsa AAAAB3Nza...fake',
            ],
            'subscription' => [
                'licenseUri' => 'https://upsun.com/licenses/123',
                'storage' => 10240,
                'includedUsers' => 5,
                'subscriptionManagementUri' => 'https://upsun.com/manage/123',
                'restricted' => false,
                'suspended' => false,
                'userLicenses' => 10,
                'id' => 'sub_123456',
                'plan' => 'pro',
                'environments' => 3,
                'resources' => [
                    'containerProfiles' => true,
                    'production' => [
                        'legacyDevelopment' => false,
                        'maxCpu' => 2.0,
                        'maxMemory' => 4096,
                        'maxEnvironments' => 5,
                    ],
                    'development' => [
                        'legacyDevelopment' => true,
                        'maxCpu' => 1.0,
                        'maxMemory' => 2048,
                        'maxEnvironments' => 10,
                    ],
                ],
                'resourceValidationUrl' => 'https://upsun.com/resources/validate',
                'imageTypes' => [
                    'only' => ['php:8.2', 'node:18'],
                    'exclude' => ['java:11'],
                ],
            ],
            'createdAt' => '2025-01-01T10:00:00Z',
            'updatedAt' => '2025-09-01T12:00:00Z',
            'namespace' => 'student-namespace',
            'organization' => 'org_987',
            'defaultBranch' => 'main',
            'defaultDomain' => 'student-project.upsun.dev',
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturnOnConsecutiveCalls(
                new Response(
                    200,
                    ['Content-Type' => 'application/json'],
                    json_encode($projectFake)
                ),
                new Response(
                    200,
                    ['Content-Type' => 'application/json'],
                    json_encode($ticketCategories)
                )
            );

        $result = $this->task->listCategories(organizationId: $orgId, projectId: $projId);
        $this->assertContainsOnlyInstancesOf(ListTicketCategories200ResponseInner::class, $result);
        $this->assertObjectMatchesArray($result, $ticketCategories);
    }

    /**
     * @throws Exception
     * @throws ClientExceptionInterface
     */
    public function testListPriorities(): void
    {
        $projId = 'project-123';
        $priority = null;

        $ticketPriorities = [
            [
                'id' => 'low',
                'label' => 'Low',
                'shortDescription' => 'Low priority',
                'description' => 'Tickets that are not urgent and can be resolved later.',
            ],
            [
                'id' => 'medium',
                'label' => 'Medium',
                'shortDescription' => 'Medium priority',
                'description' => 'Tickets that should be addressed soon but are not critical.',
            ],
            [
                'id' => 'high',
                'label' => 'High',
                'shortDescription' => 'High priority',
                'description' => 'Tickets that require immediate attention.',
            ],
            [
                'id' => 'critical',
                'label' => 'Critical',
                'shortDescription' => 'Critical priority',
                'description' => 'Tickets that must be resolved immediately to prevent major impact.',
            ],
        ];

        $projectFake = [
            'id' => $projId,
            'attributes' => [
                'language' => 'php',
                'framework' => 'symfony',
            ],
            'title' => 'My Student Project',
            'description' => 'This is a fake project for testing.',
            'owner' => 'user_123',
            'status' => [
                'code' => 'active',
                'message' => 'All systems operational',
            ],
            'timezone' => 'Europe/Paris',
            'region' => 'eu-west-1',
            'repository' => [
                'url' => 'git@github.com:student/project.git',
                'clientSshKey' => 'ssh-rsa AAAAB3Nza...fake',
            ],
            'subscription' => [
                'licenseUri' => 'https://upsun.com/licenses/123',
                'storage' => 10240,
                'includedUsers' => 5,
                'subscriptionManagementUri' => 'https://upsun.com/manage/123',
                'restricted' => false,
                'suspended' => false,
                'userLicenses' => 10,
                'id' => 'sub_123456',
                'plan' => 'pro',
                'environments' => 3,
                'resources' => [
                    'containerProfiles' => true,
                    'production' => [
                        'legacyDevelopment' => false,
                        'maxCpu' => 2.0,
                        'maxMemory' => 4096,
                        'maxEnvironments' => 5,
                    ],
                    'development' => [
                        'legacyDevelopment' => true,
                        'maxCpu' => 1.0,
                        'maxMemory' => 2048,
                        'maxEnvironments' => 10,
                    ],
                ],
                'resourceValidationUrl' => 'https://upsun.com/resources/validate',
                'imageTypes' => [
                    'only' => ['php:8.2', 'node:18'],
                    'exclude' => ['java:11'],
                ],
            ],
            'createdAt' => '2025-01-01T10:00:00Z',
            'updatedAt' => '2025-09-01T12:00:00Z',
            'namespace' => 'student-namespace',
            'organization' => 'org_987',
            'defaultBranch' => 'main',
            'defaultDomain' => 'student-project.upsun.dev',
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturnOnConsecutiveCalls(
                new Response(
                    200,
                    ['Content-Type' => 'application/json'],
                    json_encode($projectFake)
                ),
                new Response(
                    200,
                    ['Content-Type' => 'application/json'],
                    json_encode($ticketPriorities)
                )
            );

        $result = $this->task->listPriorities(projectId: $projId, category: $priority);
        $this->assertContainsOnlyInstancesOf(ListTicketPriorities200ResponseInner::class, $result);
        $this->assertObjectMatchesArray($result, $ticketPriorities);
    }
}
