<?php

namespace Upsun\Tests\Core\Tasks;

use Upsun\Core\TokenProvider;
use Exception;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Upsun\Api\AddOnsApi;
use Upsun\Api\ApiConfiguration;
use Upsun\Api\ApiException;
use Upsun\Api\ApiTokensApi;
use Upsun\Api\ConnectionsApi;
use Upsun\Api\GrantsApi;
use Upsun\Api\InvoicesApi;
use Upsun\Api\MfaApi;
use Upsun\Api\OrdersApi;
use Upsun\Api\OrganizationMembersApi;
use Upsun\Api\OrganizationProjectsApi;
use Upsun\Api\OrganizationsApi;
use Upsun\Api\PhoneNumberApi;
use Upsun\Api\ProfilesApi;
use Upsun\Api\ProjectApi;
use Upsun\Api\ProjectSettingsApi;
use Upsun\Api\RecordsApi;
use Upsun\Api\SubscriptionsApi;
use Upsun\Api\TeamAccessApi;
use Upsun\Api\TeamsApi;
use Upsun\Api\UserAccessApi;
use Upsun\Api\UserProfilesApi;
use Upsun\Api\UsersApi;
use Upsun\Api\VouchersApi;
use Upsun\Core\Tasks\OrganizationsTask;
use Upsun\Core\Tasks\ProjectsTask;
use Upsun\Core\Tasks\TeamsTask;
use Upsun\Core\Tasks\UsersTask;
use Upsun\Model\AcceptedResponse;
use Upsun\Model\Address;
use Upsun\Model\CanCreateNewOrgSubscription200Response;
use Upsun\Model\CreateAuthorizationCredentials200Response;
use Upsun\Model\EstimationObject;
use Upsun\Model\Invoice;
use Upsun\Model\ListOrgInvoices200Response;
use Upsun\Model\ListOrgOrders200Response;
use Upsun\Model\ListOrgPlanRecords200Response;
use Upsun\Model\ListOrgUsageRecords200Response;
use Upsun\Model\Order;
use Upsun\Model\Organization;
use Upsun\Model\OrganizationAddonsObject;
use Upsun\Model\OrganizationMember;
use Upsun\Model\OrganizationMFAEnforcement;
use Upsun\Model\OrganizationProject;
use Upsun\Model\PlanRecords;
use Upsun\Model\Profile;
use Upsun\Model\Project;
use Upsun\Model\SendOrgMfaReminders200ResponseValue;
use Upsun\Model\Subscription;
use Upsun\Model\SubscriptionCurrentUsageObject;
use Upsun\Model\Team;
use Upsun\Model\Vouchers;
use Upsun\UpsunClient;

class OrganizationsTaskTest extends BaseTestCase
{
    protected OrganizationsTask $organizationsTask;

    /**
     * @var ClientInterface&\PHPUnit\Framework\MockObject\MockObject
     */
    private ClientInterface $httpClient;

    protected function setUp(): void
    {
        $this->httpClient = $this->createMock(ClientInterface::class);

        $upsunClient = $this->createMock(UpsunClient::class);

        $apiClassParams = [
            new class implements TokenProvider
            {
                public function __invoke(bool $force = false): string
                {
                    return 'Bearer test-token';
                }
            },
            $this->httpClient,
            new Psr17Factory(),
            new ApiConfiguration()
        ];

        // UserTask init
        $usersTask = new class (
            $upsunClient,
            new UsersApi(...$apiClassParams),
            new UserProfilesApi(...$apiClassParams),
            new UserAccessApi(...$apiClassParams),
            new ApiTokensApi(...$apiClassParams),
            new ConnectionsApi(...$apiClassParams),
            new GrantsApi(...$apiClassParams),
            new MfaApi(...$apiClassParams),
            new PhoneNumberApi(...$apiClassParams)
        ) extends UsersTask {
        };
        $upsunClient->users = $usersTask;

        // ProjectTask init
        $projectsTask = new class (
            $upsunClient,
            new ProjectApi(...$apiClassParams),
            new OrganizationProjectsApi(...$apiClassParams),
            new ProjectSettingsApi(...$apiClassParams),
            new SubscriptionsApi(...$apiClassParams),
        ) extends ProjectsTask {
        };

        $upsunClient->projects = $projectsTask;

        // TeamTask init
        $teamsTask = new class (
            $upsunClient,
            new TeamsApi(...$apiClassParams),
            new TeamAccessApi(...$apiClassParams)
        ) extends TeamsTask {
        };

        $upsunClient->teams = $teamsTask;

        // init organizationsTask
        $this->organizationsTask = new class (
            $upsunClient,
            new OrganizationsApi(...$apiClassParams),
            new OrganizationProjectsApi(...$apiClassParams),
            new OrganizationMembersApi(...$apiClassParams),
            new SubscriptionsApi(...$apiClassParams),
            new InvoicesApi(...$apiClassParams),
            new MfaApi(...$apiClassParams),
            new OrdersApi(...$apiClassParams),
            new ProfilesApi(...$apiClassParams),
            new RecordsApi(...$apiClassParams),
            new VouchersApi(...$apiClassParams),
            new AddOnsApi(...$apiClassParams)
        ) extends OrganizationsTask {
        };
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testCreateOrganization()
    {
        $data = [
            'id' => 'org_' . bin2hex(random_bytes(8)),
            'type' => 'enterprise',
            'ownerId' => 'user_' . bin2hex(random_bytes(8)),
            'namespace' => 'acme-corp',
            'name' => 'ACME Corporation',
            'label' => 'ACME Corp - Innovation Division',
            'country' => 'FR',
            'capabilities' => [
                'api_access',
                'advanced_analytics',
                'custom_branding',
                'sso_integration',
                'priority_support'
            ],
            'vendor' => 'stripe',
            'billingAccountId' => 'ba_' . bin2hex(random_bytes(12)),
            'billingLegacy' => false,
            'status' => 'active',
            'createdAt' => '2023-06-15 10:30:00',
            'updatedAt' => '2025-11-01 14:22:33',
            'links' => [
                'self' => ['href' => 'https://api.example.com/v1/organizations/org_abc123'],
                'update' => ['href' => 'https://api.example.com/v1/organizations/org_abc123', 'method' => 'PUT'],
                'delete' => ['href' => 'https://api.example.com/v1/organizations/org_abc123', 'method' => 'DELETE'],
                'members' => ['href' => 'https://api.example.com/v1/organizations/org_abc123/members'],
                'createMember' => ['href' => 'https://api.example.com/v1/org/org_abc123/members', 'method' => 'POST'],
                'address' => ['href' => 'https://api.example.com/v1/organizations/org_abc123/address'],
                'profile' => ['href' => 'https://api.example.com/v1/organizations/org_abc123/profile'],
                'paymentSource' => ['href' => 'https://api.example.com/v1/organizations/org_abc123/payment-source'],
                'orders' => ['href' => 'https://api.example.com/v1/organizations/org_abc123/orders'],
                'vouchers' => ['href' => 'https://api.example.com/v1/organizations/org_abc123/vouchers'],
                'applyVoucher' => [
                    'href' => 'https://api.example.com/v1/org/abc123/vouchers/apply', 'method' => 'POST'],
                'subscriptions' => ['href' => 'https://api.example.com/v1/organizations/org_abc123/subscriptions'],
                'createSubscription' => [
                    'href' => 'https://api.example.com/v1/organizations/org_abc123/subscriptions', 'method' => 'POST'],
                'estimateSubscription' => [
                    'href' => 'https://api.example.com/v1/organizations/org_abc123/subscriptions/estimate',
                    'method' => 'POST'
                ],
                'mfaEnforcement' => ['href' => 'https://api.example.com/v1/organizations/org_abc123/mfa-enforcement'],
            ]
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($data)
            ));

        $result = $this->organizationsTask->create(
            label: 'My Org Label',
            type: 'flex',
            ownerId: 'user_7890',
            name: 'My Organization',
            country: 'FR',
        );

        $this->assertInstanceOf(Organization::class, $result);
        $this->assertObjectProperties($result, $data);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testDeleteOrganization()
    {
        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'OK',
                    'code' => 200
                ])
            ));
        $this->organizationsTask->delete(organizationId: 'org_123');
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testGetOrganization()
    {
        $orgId = 'org_123';
        $data = [
            'id' => 'org_' . bin2hex(random_bytes(8)),
            'type' => 'enterprise',
            'ownerId' => 'user_' . bin2hex(random_bytes(8)),
            'namespace' => 'acme-corp',
            'name' => 'ACME Corporation',
            'label' => 'ACME Corp - Innovation Division',
            'country' => 'FR',
            'capabilities' => [
                'api_access',
                'advanced_analytics',
                'custom_branding',
                'sso_integration',
                'priority_support'
            ],
            'vendor' => 'stripe',
            'billingAccountId' => 'ba_' . bin2hex(random_bytes(12)),
            'billingLegacy' => false,
            'status' => 'active',
            'createdAt' => '2023-06-15 10:30:00',
            'updatedAt' => '2025-11-01 14:22:33',
            'links' => [
                'self' => ['href' => 'https://api.example.com/v1/organizations/org_abc123'],
                'update' => ['href' => 'https://api.example.com/v1/organizations/org_abc123', 'method' => 'PUT'],
                'delete' => ['href' => 'https://api.example.com/v1/organizations/org_abc123', 'method' => 'DELETE'],
                'members' => ['href' => 'https://api.example.com/v1/organizations/org_abc123/members'],
                'createMember' => ['href' => 'https://api.example.com/v1/org/org_abc123/members', 'method' => 'POST'],
                'address' => ['href' => 'https://api.example.com/v1/organizations/org_abc123/address'],
                'profile' => ['href' => 'https://api.example.com/v1/organizations/org_abc123/profile'],
                'paymentSource' => ['href' => 'https://api.example.com/v1/organizations/org_abc123/payment-source'],
                'orders' => ['href' => 'https://api.example.com/v1/organizations/org_abc123/orders'],
                'vouchers' => ['href' => 'https://api.example.com/v1/organizations/org_abc123/vouchers'],
                'applyVoucher' => [
                    'href' => 'https://api.example.com/v1/org/abc123/vouchers/apply', 'method' => 'POST'],
                'subscriptions' => ['href' => 'https://api.example.com/v1/organizations/org_abc123/subscriptions'],
                'createSubscription' => [
                    'href' => 'https://api.example.com/v1/organizations/org_abc123/subscriptions', 'method' => 'POST'],
                'estimateSubscription' => [
                    'href' => 'https://api.example.com/v1/organizations/org_abc123/subscriptions/estimate',
                    'method' => 'POST'
                ],
                'mfaEnforcement' => ['href' => 'https://api.example.com/v1/organizations/org_abc123/mfa-enforcement'],
            ]
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($data)
            ));

        $result = $this->organizationsTask->get(organizationId: $orgId);
        $this->assertInstanceOf(Organization::class, $result);
        $this->assertObjectProperties($result, $data);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testListOrganizations()
    {
        $organizations = [
            'count' => 2,
            'links' => [
                'self' => ['href' => 'href'],
                'previous' => ['href' => 'href'],
                'next' => ['href' => 'href'],
            ],
            'items' => [
                [
                    'id' => 'org_' . bin2hex(random_bytes(8)),
                    'type' => 'enterprise',
                    'ownerId' => 'user_' . bin2hex(random_bytes(8)),
                    'namespace' => 'acme-corp',
                    'name' => 'ACME Corporation',
                    'label' => 'ACME Corp - Innovation Division',
                    'country' => 'FR',
                    'capabilities' => [
                        'api_access',
                        'advanced_analytics',
                        'custom_branding',
                        'sso_integration',
                        'priority_support'
                    ],
                    'vendor' => 'stripe',
                    'billingAccountId' => 'ba_' . bin2hex(random_bytes(12)),
                    'billingLegacy' => false,
                    'status' => 'active',
                    'createdAt' => '2023-06-15 10:30:00',
                    'updatedAt' => '2025-11-01 14:22:33',
                    'links' => [
                        'self' => ['href' => 'https://api.example.com/v1/organizations/org_abc123'],
                        'update' => ['href' => 'https://api.example.com/v1/organizations/org_abc123',
                            'method' => 'PUT'],
                        'delete' => ['href' => 'https://api.example.com/v1/organizations/org_abc123',
                            'method' => 'DELETE'],
                        'members' => ['href' => 'https://api.example.com/v1/organizations/org_abc123/members'],
                        'createMember' => ['href' => 'https://api.example.com/v1/org/org_abc123/members',
                            'method' => 'POST'],
                        'address' => ['href' => 'https://api.example.com/v1/organizations/org_abc123/address'],
                        'profile' => ['href' => 'https://api.example.com/v1/organizations/org_abc123/profile'],
                        'paymentSource' => [
                            'href' => 'https://api.example.com/v1/organizations/org_abc123/payment-source'
                        ],
                        'orders' => ['href' => 'https://api.example.com/v1/organizations/org_abc123/orders'],
                        'vouchers' => ['href' => 'https://api.example.com/v1/organizations/org_abc123/vouchers'],
                        'applyVoucher' => [
                            'href' => 'https://api.example.com/v1/org/abc123/vouchers/apply', 'method' => 'POST'],
                        'subscriptions' => [
                            'href' => 'https://api.example.com/v1/organizations/org_abc123/subscriptions'
                        ],
                        'createSubscription' => [
                            'href' => 'https://api.example.com/v1/organizations/org_abc123/subscriptions',
                            'method' => 'POST'
                        ],
                        'estimateSubscription' => [
                            'href' => 'https://api.example.com/v1/organizations/org_abc123/subscriptions/estimate',
                            'method' => 'POST'
                        ],
                        'mfaEnforcement' => [
                            'href' => 'https://api.example.com/v1/organizations/org_abc123/mfa-enforcement'
                        ],
                    ]
                ],
                [
                    'id' => 'org_' . bin2hex(random_bytes(8)),
                    'type' => 'enterprise',
                    'ownerId' => 'user_' . bin2hex(random_bytes(8)),
                    'namespace' => 'acme-corp',
                    'name' => 'ACME Corporation',
                    'label' => 'ACME Corp - Innovation Division',
                    'country' => 'FR',
                    'capabilities' => [
                        'api_access',
                        'advanced_analytics',
                        'custom_branding',
                        'sso_integration',
                        'priority_support'
                    ],
                    'vendor' => 'stripe',
                    'billingAccountId' => 'ba_' . bin2hex(random_bytes(12)),
                    'billingLegacy' => false,
                    'status' => 'active',
                    'createdAt' => '2023-06-15 10:30:00',
                    'updatedAt' => '2025-11-01 14:22:33',
                    'links' => [
                        'self' => ['href' => 'https://api.example.com/v1/organizations/org_abc123'],
                        'update' => ['href' => 'https://api.example.com/v1/organizations/org_abc123',
                            'method' => 'PUT'],
                        'delete' => ['href' => 'https://api.example.com/v1/organizations/org_abc123',
                            'method' => 'DELETE'],
                        'members' => ['href' => 'https://api.example.com/v1/organizations/org_abc123/members'],
                        'createMember' => ['href' => 'https://api.example.com/v1/org/org_abc123/members',
                            'method' => 'POST'],
                        'address' => ['href' => 'https://api.example.com/v1/organizations/org_abc123/address'],
                        'profile' => ['href' => 'https://api.example.com/v1/organizations/org_abc123/profile'],
                        'paymentSource' => [
                            'href' => 'https://api.example.com/v1/organizations/org_abc123/payment-source'],
                        'orders' => ['href' => 'https://api.example.com/v1/organizations/org_abc123/orders'],
                        'vouchers' => ['href' => 'https://api.example.com/v1/organizations/org_abc123/vouchers'],
                        'applyVoucher' => [
                            'href' => 'https://api.example.com/v1/org/abc123/vouchers/apply', 'method' => 'POST'],
                        'subscriptions' => [
                            'href' => 'https://api.example.com/v1/organizations/org_abc123/subscriptions'],
                        'createSubscription' => [
                            'href' => 'https://api.example.com/v1/organizations/org_abc123/subscriptions',
                            'method' => 'POST'],
                        'estimateSubscription' => [
                            'href' => 'https://api.example.com/v1/organizations/org_abc123/subscriptions/estimate',
                            'method' => 'POST'
                        ],
                        'mfaEnforcement' => [
                            'href' => 'https://api.example.com/v1/organizations/org_abc123/mfa-enforcement'],
                    ]
                ]
            ],
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($organizations)
            ));

        $result = $this->organizationsTask->list();
        $this->assertIsArray($result->getItems());
        $this->assertContainsOnlyInstancesOf(Organization::class, $result->getItems());
        $this->assertObjectMatchesArray($result->getItems(), $organizations['items']);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testListUserOrganizations()
    {
        $organizations = [
            'count' => 2,
            'links' => [
                'self' => ['href' => 'href'],
                'previous' => ['href' => 'href'],
                'next' => ['href' => 'href'],
            ],
            'items' => [
                [
                    'id' => 'org_' . bin2hex(random_bytes(8)),
                    'type' => 'enterprise',
                    'ownerId' => 'user_' . bin2hex(random_bytes(8)),
                    'namespace' => 'acme-corp',
                    'name' => 'ACME Corporation',
                    'label' => 'ACME Corp - Innovation Division',
                    'country' => 'FR',
                    'capabilities' => [
                        'api_access',
                        'advanced_analytics',
                        'custom_branding',
                        'sso_integration',
                        'priority_support'
                    ],
                    'vendor' => 'stripe',
                    'billingAccountId' => 'ba_' . bin2hex(random_bytes(12)),
                    'billingLegacy' => false,
                    'status' => 'active',
                    'createdAt' => '2023-06-15 10:30:00',
                    'updatedAt' => '2025-11-01 14:22:33',
                    'links' => [
                        'self' => ['href' => 'https://api.example.com/v1/organizations/org_abc123'],
                        'update' => ['href' => 'https://api.example.com/v1/organizations/org_abc123',
                            'method' => 'PUT'],
                        'delete' => ['href' => 'https://api.example.com/v1/organizations/org_abc123',
                            'method' => 'DELETE'],
                        'members' => ['href' => 'https://api.example.com/v1/organizations/org_abc123/members'],
                        'createMember' => ['href' => 'https://api.example.com/v1/org/org_abc123/members',
                            'method' => 'POST'],
                        'address' => ['href' => 'https://api.example.com/v1/organizations/org_abc123/address'],
                        'profile' => ['href' => 'https://api.example.com/v1/organizations/org_abc123/profile'],
                        'paymentSource' => [
                            'href' => 'https://api.example.com/v1/organizations/org_abc123/payment-source'
                        ],
                        'orders' => ['href' => 'https://api.example.com/v1/organizations/org_abc123/orders'],
                        'vouchers' => ['href' => 'https://api.example.com/v1/organizations/org_abc123/vouchers'],
                        'applyVoucher' => [
                            'href' => 'https://api.example.com/v1/org/abc123/vouchers/apply', 'method' => 'POST'],
                        'subscriptions' => [
                            'href' => 'https://api.example.com/v1/organizations/org_abc123/subscriptions'
                        ],
                        'createSubscription' => [
                            'href' => 'https://api.example.com/v1/organizations/org_abc123/subscriptions',
                            'method' => 'POST'
                        ],
                        'estimateSubscription' => [
                            'href' => 'https://api.example.com/v1/organizations/org_abc123/subscriptions/estimate',
                            'method' => 'POST'
                        ],
                        'mfaEnforcement' => [
                            'href' => 'https://api.example.com/v1/organizations/org_abc123/mfa-enforcement'
                        ],
                    ]
                ],
                [
                    'id' => 'org_' . bin2hex(random_bytes(8)),
                    'type' => 'enterprise',
                    'ownerId' => 'user_' . bin2hex(random_bytes(8)),
                    'namespace' => 'acme-corp',
                    'name' => 'ACME Corporation',
                    'label' => 'ACME Corp - Innovation Division',
                    'country' => 'FR',
                    'capabilities' => [
                        'api_access',
                        'advanced_analytics',
                        'custom_branding',
                        'sso_integration',
                        'priority_support'
                    ],
                    'vendor' => 'stripe',
                    'billingAccountId' => 'ba_' . bin2hex(random_bytes(12)),
                    'billingLegacy' => false,
                    'status' => 'active',
                    'createdAt' => '2023-06-15 10:30:00',
                    'updatedAt' => '2025-11-01 14:22:33',
                    'links' => [
                        'self' => ['href' => 'https://api.example.com/v1/organizations/org_abc123'],
                        'update' => ['href' => 'https://api.example.com/v1/organizations/org_abc123',
                            'method' => 'PUT'],
                        'delete' => ['href' => 'https://api.example.com/v1/organizations/org_abc123',
                            'method' => 'DELETE'],
                        'members' => ['href' => 'https://api.example.com/v1/organizations/org_abc123/members'],
                        'createMember' => ['href' => 'https://api.example.com/v1/org/org_abc123/members',
                            'method' => 'POST'],
                        'address' => ['href' => 'https://api.example.com/v1/organizations/org_abc123/address'],
                        'profile' => ['href' => 'https://api.example.com/v1/organizations/org_abc123/profile'],
                        'paymentSource' => [
                            'href' => 'https://api.example.com/v1/organizations/org_abc123/payment-source'],
                        'orders' => ['href' => 'https://api.example.com/v1/organizations/org_abc123/orders'],
                        'vouchers' => ['href' => 'https://api.example.com/v1/organizations/org_abc123/vouchers'],
                        'applyVoucher' => [
                            'href' => 'https://api.example.com/v1/org/abc123/vouchers/apply', 'method' => 'POST'],
                        'subscriptions' => [
                            'href' => 'https://api.example.com/v1/organizations/org_abc123/subscriptions'],
                        'createSubscription' => [
                            'href' => 'https://api.example.com/v1/organizations/org_abc123/subscriptions',
                            'method' => 'POST'],
                        'estimateSubscription' => [
                            'href' => 'https://api.example.com/v1/organizations/org_abc123/subscriptions/estimate',
                            'method' => 'POST'
                        ],
                        'mfaEnforcement' => [
                            'href' => 'https://api.example.com/v1/organizations/org_abc123/mfa-enforcement'],
                    ]
                ]
            ],
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($organizations)
            ));

        $ownerId = 'user_9876';
        $result = $this->organizationsTask->listUserOrgs(userId: $ownerId);
        $this->assertIsArray($result->getItems());
        $this->assertContainsOnlyInstancesOf(Organization::class, $result->getItems());
        $this->assertObjectMatchesArray($result->getItems(), $organizations['items']);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testListCurrentUserOrganizations()
    {
        $organizations = [
            'count' => 2,
            'links' => [
                'self' => ['href' => 'href'],
                'previous' => ['href' => 'href'],
                'next' => ['href' => 'href'],
            ],
            'items' => [
                [
                    'id' => 'org_' . bin2hex(random_bytes(8)),
                    'type' => 'enterprise',
                    'ownerId' => 'user_' . bin2hex(random_bytes(8)),
                    'namespace' => 'acme-corp',
                    'name' => 'ACME Corporation',
                    'label' => 'ACME Corp - Innovation Division',
                    'country' => 'FR',
                    'capabilities' => [
                        'api_access',
                        'advanced_analytics',
                        'custom_branding',
                        'sso_integration',
                        'priority_support'
                    ],
                    'vendor' => 'stripe',
                    'billingAccountId' => 'ba_' . bin2hex(random_bytes(12)),
                    'billingLegacy' => false,
                    'status' => 'active',
                    'createdAt' => '2023-06-15 10:30:00',
                    'updatedAt' => '2025-11-01 14:22:33',
                    'links' => [
                        'self' => ['href' => 'https://api.example.com/v1/organizations/org_abc123'],
                        'update' => ['href' => 'https://api.example.com/v1/organizations/org_abc123',
                            'method' => 'PUT'],
                        'delete' => ['href' => 'https://api.example.com/v1/organizations/org_abc123',
                            'method' => 'DELETE'],
                        'members' => ['href' => 'https://api.example.com/v1/organizations/org_abc123/members'],
                        'createMember' => ['href' => 'https://api.example.com/v1/org/org_abc123/members',
                            'method' => 'POST'],
                        'address' => ['href' => 'https://api.example.com/v1/organizations/org_abc123/address'],
                        'profile' => ['href' => 'https://api.example.com/v1/organizations/org_abc123/profile'],
                        'paymentSource' => [
                            'href' => 'https://api.example.com/v1/organizations/org_abc123/payment-source'
                        ],
                        'orders' => ['href' => 'https://api.example.com/v1/organizations/org_abc123/orders'],
                        'vouchers' => ['href' => 'https://api.example.com/v1/organizations/org_abc123/vouchers'],
                        'applyVoucher' => [
                            'href' => 'https://api.example.com/v1/org/abc123/vouchers/apply', 'method' => 'POST'],
                        'subscriptions' => [
                            'href' => 'https://api.example.com/v1/organizations/org_abc123/subscriptions'
                        ],
                        'createSubscription' => [
                            'href' => 'https://api.example.com/v1/organizations/org_abc123/subscriptions',
                            'method' => 'POST'
                        ],
                        'estimateSubscription' => [
                            'href' => 'https://api.example.com/v1/organizations/org_abc123/subscriptions/estimate',
                            'method' => 'POST'
                        ],
                        'mfaEnforcement' => [
                            'href' => 'https://api.example.com/v1/organizations/org_abc123/mfa-enforcement'
                        ],
                    ]
                ],
                [
                    'id' => 'org_' . bin2hex(random_bytes(8)),
                    'type' => 'enterprise',
                    'ownerId' => 'user_' . bin2hex(random_bytes(8)),
                    'namespace' => 'acme-corp',
                    'name' => 'ACME Corporation',
                    'label' => 'ACME Corp - Innovation Division',
                    'country' => 'FR',
                    'capabilities' => [
                        'api_access',
                        'advanced_analytics',
                        'custom_branding',
                        'sso_integration',
                        'priority_support'
                    ],
                    'vendor' => 'stripe',
                    'billingAccountId' => 'ba_' . bin2hex(random_bytes(12)),
                    'billingLegacy' => false,
                    'status' => 'active',
                    'createdAt' => '2023-06-15 10:30:00',
                    'updatedAt' => '2025-11-01 14:22:33',
                    'links' => [
                        'self' => ['href' => 'https://api.example.com/v1/organizations/org_abc123'],
                        'update' => ['href' => 'https://api.example.com/v1/organizations/org_abc123',
                            'method' => 'PUT'],
                        'delete' => ['href' => 'https://api.example.com/v1/organizations/org_abc123',
                            'method' => 'DELETE'],
                        'members' => ['href' => 'https://api.example.com/v1/organizations/org_abc123/members'],
                        'createMember' => ['href' => 'https://api.example.com/v1/org/org_abc123/members',
                            'method' => 'POST'],
                        'address' => ['href' => 'https://api.example.com/v1/organizations/org_abc123/address'],
                        'profile' => ['href' => 'https://api.example.com/v1/organizations/org_abc123/profile'],
                        'paymentSource' => [
                            'href' => 'https://api.example.com/v1/organizations/org_abc123/payment-source'],
                        'orders' => ['href' => 'https://api.example.com/v1/organizations/org_abc123/orders'],
                        'vouchers' => ['href' => 'https://api.example.com/v1/organizations/org_abc123/vouchers'],
                        'applyVoucher' => [
                            'href' => 'https://api.example.com/v1/org/abc123/vouchers/apply', 'method' => 'POST'],
                        'subscriptions' => [
                            'href' => 'https://api.example.com/v1/organizations/org_abc123/subscriptions'],
                        'createSubscription' => [
                            'href' => 'https://api.example.com/v1/organizations/org_abc123/subscriptions',
                            'method' => 'POST'],
                        'estimateSubscription' => [
                            'href' => 'https://api.example.com/v1/organizations/org_abc123/subscriptions/estimate',
                            'method' => 'POST'
                        ],
                        'mfaEnforcement' => [
                            'href' => 'https://api.example.com/v1/organizations/org_abc123/mfa-enforcement'],
                    ]
                ]
            ],
        ];

        $this->httpClient
            ->expects($this->exactly(2))
            ->method('sendRequest')
            ->willReturnOnConsecutiveCalls(
                new Response(
                    200,
                    ['Content-Type' => 'application/json'],
                    json_encode([
                        'id' => 'user_9876',
                        'deactivated' => false,
                        'namespace' => 'upsun',
                        'username' => 'jdoe',
                        'email' => 'jdoe@example.com',
                        'emailVerified' => true,
                        'firstName' => 'John',
                        'lastName' => 'Doe',
                        'picture' => 'https://example.com/avatar/jdoe.png',
                        'company' => 'Upsun Inc.',
                        'website' => 'https://jdoe.dev',
                        'country' => 'FR',
                        'createdAt' => '2025-01-10T08:00:00+00:00',
                        'updatedAt' => '2025-09-12T09:30:00+00:00',
                        'consentedAt' => '2025-01-11T08:30:00+00:00',
                        'consentMethod' => 'email',
                    ])
                ),
                new Response(
                    200,
                    ['Content-Type' => 'application/json'],
                    json_encode($organizations)
                )
            );

        $ownerId = 'user_9876';
        $result = $this->organizationsTask->listCurrentUserOrgs();
        $this->assertIsArray($result->getItems());
        $this->assertContainsOnlyInstancesOf(Organization::class, $result->getItems());
        $this->assertObjectMatchesArray($result->getItems(), $organizations['items']);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testUpdateOrganization()
    {

        $orgId = 'project-123';
        $data = [
            'id' => 'org_' . bin2hex(random_bytes(8)),
            'type' => 'enterprise',
            'ownerId' => 'user_' . bin2hex(random_bytes(8)),
            'namespace' => 'acme-corp',
            'name' => 'ACME Corporation',
            'label' => 'ACME Corp - Innovation Division',
            'country' => 'FR',
            'capabilities' => [
                'api_access',
                'advanced_analytics',
                'custom_branding',
                'sso_integration',
                'priority_support'
            ],
            'vendor' => 'stripe',
            'billingAccountId' => 'ba_' . bin2hex(random_bytes(12)),
            'billingLegacy' => false,
            'status' => 'active',
            'createdAt' => '2023-06-15 10:30:00',
            'updatedAt' => '2025-11-01 14:22:33',
            'securityContact' => 'security@example.com',
            'links' => [
                'self' => ['href' => 'https://api.example.com/v1/organizations/org_abc123'],
                'update' => ['href' => 'https://api.example.com/v1/organizations/org_abc123',
                    'method' => 'PUT'],
                'delete' => ['href' => 'https://api.example.com/v1/organizations/org_abc123',
                    'method' => 'DELETE'],
                'members' => ['href' => 'https://api.example.com/v1/organizations/org_abc123/members'],
                'createMember' => ['href' => 'https://api.example.com/v1/org/org_abc123/members',
                    'method' => 'POST'],
                'address' => ['href' => 'https://api.example.com/v1/organizations/org_abc123/address'],
                'profile' => ['href' => 'https://api.example.com/v1/organizations/org_abc123/profile'],
                'paymentSource' => [
                    'href' => 'https://api.example.com/v1/organizations/org_abc123/payment-source'],
                'orders' => ['href' => 'https://api.example.com/v1/organizations/org_abc123/orders'],
                'vouchers' => ['href' => 'https://api.example.com/v1/organizations/org_abc123/vouchers'],
                'applyVoucher' => [
                    'href' => 'https://api.example.com/v1/org/abc123/vouchers/apply', 'method' => 'POST'],
                'subscriptions' => [
                    'href' => 'https://api.example.com/v1/organizations/org_abc123/subscriptions'],
                'createSubscription' => [
                    'href' => 'https://api.example.com/v1/organizations/org_abc123/subscriptions',
                    'method' => 'POST'],
                'estimateSubscription' => [
                    'href' => 'https://api.example.com/v1/organizations/org_abc123/subscriptions/estimate',
                    'method' => 'POST'
                ],
                'mfaEnforcement' => [
                    'href' => 'https://api.example.com/v1/organizations/org_abc123/mfa-enforcement'],
            ]
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($data)
            ));

        $result = $this->organizationsTask->update(
            organizationId: $orgId,
            name: $data['name'],
            label: $data['label'],
            country: $data['country'],
            securityContact: $data['securityContact'],
        );

        $this->assertInstanceOf(Organization::class, $result);
        $this->assertObjectProperties($result, $data);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testCreateMember()
    {
        $orgId = 'org_98765';
        $userId = 'user_54321';
        $permissions = ['read', 'write', 'admin'];

        $organizationMemberData = [
            'id' => 'mem_' . bin2hex(random_bytes(8)),
            'organizationId' => 'org_' . bin2hex(random_bytes(8)),
            'userId' => 'user_' . bin2hex(random_bytes(8)),
            'permissions' => [
                'organization.read',
                'organization.write',
                'members.read',
                'members.invite',
                'billing.read',
                'subscriptions.manage',
                'projects.create',
                'projects.delete'
            ],
            'level' => 'admin',
            'owner' => false,
            'createdAt' => '2024-03-20 09:15:42',
            'updatedAt' => '2025-10-28 16:45:18',
            'links' => [
                'self' => [
                    'href' => 'https://api.example.com/v1/organizations/org_abc123/members/mem_xyz789'
                ],
                'update' => [
                    'href' => 'https://api.example.com/v1/organizations/org_abc123/members/mem_xyz789',
                    'method' => 'PATCH'
                ],
                'delete' => [
                    'href' => 'https://api.example.com/v1/organizations/org_abc123/members/mem_xyz789',
                    'method' => 'DELETE'
                ],
            ]
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($organizationMemberData)
            ));

        $result = $this->organizationsTask->createMember(
            organizationId: $orgId,
            userId: $userId,
            permissions: $permissions
        );
        $this->assertInstanceOf(OrganizationMember::class, $result);
        $this->assertObjectProperties($result, $organizationMemberData);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testUpdateMember()
    {
        $permissions = ['read', 'write', 'admin'];

        $organizationMemberData = [
            'id' => 'mem_' . bin2hex(random_bytes(8)),
            'organizationId' => 'org_' . bin2hex(random_bytes(8)),
            'userId' => 'user_' . bin2hex(random_bytes(8)),
            'permissions' => [
                'organization.read',
                'organization.write',
                'members.read',
                'members.invite',
                'billing.read',
                'subscriptions.manage',
                'projects.create',
                'projects.delete'
            ],
            'level' => 'admin',
            'owner' => false,
            'createdAt' => '2024-03-20 09:15:42',
            'updatedAt' => '2025-10-28 16:45:18',
            'links' => [
                'self' => [
                    'href' => 'https://api.example.com/v1/organizations/org_abc123/members/mem_xyz789'
                ],
                'update' => [
                    'href' => 'https://api.example.com/v1/organizations/org_abc123/members/mem_xyz789',
                    'method' => 'PATCH'
                ],
                'delete' => [
                    'href' => 'https://api.example.com/v1/organizations/org_abc123/members/mem_xyz789',
                    'method' => 'DELETE'
                ],
            ]
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($organizationMemberData)
            ));

        $response = $this->organizationsTask->updateMember(
            organizationId: 'org_123',
            userId: 'user_1',
            permissions: $permissions
        );
        $this->assertInstanceOf(OrganizationMember::class, $response);
        $this->assertObjectProperties($response, $organizationMemberData);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testGetMember()
    {
        $orgId = 'org_98765';
        $userId = 'user_54321';

        $organizationMemberData = [
            'id' => 'mem_' . bin2hex(random_bytes(8)),
            'organizationId' => 'org_' . bin2hex(random_bytes(8)),
            'userId' => 'user_' . bin2hex(random_bytes(8)),
            'permissions' => [
                'organization.read',
                'organization.write',
                'members.read',
                'members.invite',
                'billing.read',
                'subscriptions.manage',
                'projects.create',
                'projects.delete'
            ],
            'level' => 'admin',
            'owner' => false,
            'createdAt' => '2024-03-20 09:15:42',
            'updatedAt' => '2025-10-28 16:45:18',
            'links' => [
                'self' => [
                    'href' => 'https://api.example.com/v1/organizations/org_abc123/members/mem_xyz789'
                ],
                'update' => [
                    'href' => 'https://api.example.com/v1/organizations/org_abc123/members/mem_xyz789',
                    'method' => 'PATCH'
                ],
                'delete' => [
                    'href' => 'https://api.example.com/v1/organizations/org_abc123/members/mem_xyz789',
                    'method' => 'DELETE'
                ],
            ]
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($organizationMemberData)
            ));

        $result = $this->organizationsTask->getMember(organizationId: $orgId, userId: $userId);
        $this->assertInstanceOf(OrganizationMember::class, $result);
        $this->assertObjectProperties($result, $organizationMemberData);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testListMembers()
    {
        $orgId = 'org_98765';

        $organizationMembersData = [
            "count" => 1,
            "items" => [
                [
                    'id' => 'mem_' . bin2hex(random_bytes(8)),
                    'organizationId' => 'org_' . bin2hex(random_bytes(8)),
                    'userId' => 'user_' . bin2hex(random_bytes(8)),
                    'permissions' => [
                        'organization.read',
                        'organization.write',
                        'members.read',
                        'members.invite',
                        'billing.read',
                        'subscriptions.manage',
                        'projects.create',
                        'projects.delete'
                    ],
                    'level' => 'admin',
                    'owner' => false,
                    'createdAt' => '2024-03-20 09:15:42',
                    'updatedAt' => '2025-10-28 16:45:18',
                    'links' => [
                        'self' => [
                            'href' => 'https://api.example.com/v1/organizations/org_abc123/members/mem_xyz789'
                        ],
                        'update' => [
                            'href' => 'https://api.example.com/v1/organizations/org_abc123/members/mem_xyz789',
                            'method' => 'PATCH'
                        ],
                        'delete' => [
                            'href' => 'https://api.example.com/v1/organizations/org_abc123/members/mem_xyz789',
                            'method' => 'DELETE'
                        ],
                    ]
                ],
                [
                    'id' => 'mem_' . bin2hex(random_bytes(8)),
                    'organizationId' => 'org_' . bin2hex(random_bytes(8)),
                    'userId' => 'user_' . bin2hex(random_bytes(8)),
                    'permissions' => [
                        'organization.read',
                        'organization.write',
                        'members.read',
                        'members.invite',
                        'billing.read',
                        'subscriptions.manage',
                        'projects.create',
                        'projects.delete'
                    ],
                    'level' => 'admin',
                    'owner' => false,
                    'createdAt' => '2024-03-20 09:15:42',
                    'updatedAt' => '2025-10-28 16:45:18',
                    'links' => [
                        'self' => [
                            'href' => 'https://api.example.com/v1/organizations/org_abc123/members/mem_xyz789'
                        ],
                        'update' => [
                            'href' => 'https://api.example.com/v1/organizations/org_abc123/members/mem_xyz789',
                            'method' => 'PATCH'
                        ],
                        'delete' => [
                            'href' => 'https://api.example.com/v1/organizations/org_abc123/members/mem_xyz789',
                            'method' => 'DELETE'
                        ],
                    ]
                ]
            ],
            "_links" => [
                "ref:users:0" => ["href" => "href"],
                "self" => ["href" => "href"]
            ]
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($organizationMembersData)
            ));

        $result = $this->organizationsTask->listMembers(organizationId: $orgId);
        $this->assertIsArray($result->getItems());
        $this->assertContainsOnlyInstancesOf(OrganizationMember::class, $result->getItems());
        $this->assertObjectMatchesArray($result->getItems(), $organizationMembersData['items']);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testDeleteMember()
    {
        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                204,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'no-content',
                    'code' => 204
                ])
            ));
        $this->organizationsTask->deleteMember(organizationId: 'org_123', userId: 'user_1');
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testListTeams()
    {
        $orgId = 'fake-org-id-5678';
        $list = [
            "count" => 1,
            "items" => [
                [
                    "_links" => [
                        "self" => [
                            "href" => "/teams/fake-team-id-1234"
                        ]
                    ],
                    "counts" => [
                        "member_count" => 5,
                        "project_count" => 12
                    ],
                    "id" => "fake-team-id-1234",
                    "label" => "Observability Team",
                    "organization_id" => "fake-org-id-5678",
                    "project_permissions" => [
                        "admin",
                        "production:admin",
                        "staging:contributor",
                        "development:viewer"
                    ],
                    "created_at" => "2023-10-05T13:30:43.073757Z",
                    "updated_at" => "2023-11-15T09:22:18.451321Z"
                ],
                [
                    "_links" => ["self" => ["href" => "/teams/fake-team-id-5678"]],
                    "counts" => [
                        "member_count" => 5,
                        "project_count" => 12
                    ],
                    "id" => "fake-team-id-5678",
                    "label" => "Observability Team",
                    "organization_id" => "fake-org-id-5678",
                    "project_permissions" => [
                        "admin",
                    ],
                    "created_at" => "2023-10-05T13:30:43.073757Z",
                    "updated_at" => "2023-11-15T09:22:18.451321Z"
                ]
            ],
            "_links" => [
                "next" => ["href" => "href"],
                "ref:organizations:0" => ["href" => "href"],
                "self" => ["href" => "href"]
            ]
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($list)
            ));

        $result = $this->organizationsTask->listTeams($orgId);
        $this->assertIsArray($result->getItems());
        $this->assertContainsOnlyInstancesOf(Team::class, $result->getItems());
        $this->assertObjectMatchesArray($result->getItems(), $list['items']);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testGetProject()
    {
        $projectId = 'fake-proj-1234';
        $data = $this->getFakeProject($projectId);

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($data)
            ));

        $result = $this->organizationsTask->getProject(projectId: $projectId);
        $this->assertInstanceOf(Project::class, $result);
        $this->assertObjectProperties($result, $data);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testListProjects()
    {
        $orgId = 'fake-org-5678';

        $orgProjectList = [
            "count" => 1,
            "items" => [
                [
                    "id" => "fake-proj-1234",
                    "organization_id" => "fake-org-5678",
                    "subscription_id" => "999999",
                    "vendor" => "upsun",
                    "region" => "us.platform.sh",
                    "title" => "Demo Project",
                    "plan" => "upsun/flexible",
                    "default_branch" => "main",
                    "status" => "active",
                    "timezone" => "America/New_York",
                    "options_url" => "",
                    "agency_site" => false,
                    "support_tier" => "upsun_standard",
                    "options_custom" => [
                        "initialize" => [
                            "profile" => "demo",
                            "repository" => "https://github.com/platformsh/demo-cmd.git"
                        ]
                    ],
                    "trial_plan" => false,
                    "project_ui" => "https://console.upsun.com/fake-org-5678/fake-proj-1234",
                    "created_at" => "2023-10-24T16:34:45Z",
                    "updated_at" => "2025-04-08T11:12:55.802313Z",
                    "_links" => [
                        "activities" => [
                            "href" => "/organizations/fake-org-5678/projects/fake-proj-1234/activities"
                        ],
                        "addons" => [
                            "href" => "/organizations/fake-org-5678/projects/fake-proj-1234/addons"
                        ],
                        "api" => [
                            "href" => "/projects/fake-proj-1234"
                        ],
                        "self" => [
                            "href" => "/organizations/fake-org-5678/projects/fake-proj-1234"
                        ],
                        "subscription" => [
                            "href" => "/organizations/fake-org-5678/subscriptions/999999"
                        ]
                    ],
                    "type" => "grid",
                    "locked" => false,
                    "cse_notes" => "",
                    "fastly_service_ids" => [],
                    "edgee_org_id" => "",
                    "edgee_project_id" => ""
                ],
                [
                    "id" => "fake-proj-5678",
                    "organization_id" => "fake-org-5678",
                    "subscription_id" => "999999",
                    "vendor" => "upsun",
                    "region" => "us.platform.sh",
                    "title" => "Demo Project",
                    "plan" => "upsun/flexible",
                    "default_branch" => "main",
                    "status" => "active",
                    "timezone" => "America/New_York",
                    "options_url" => "",
                    "agency_site" => false,
                    "support_tier" => "upsun_standard",
                    "options_custom" => [
                        "initialize" => [
                            "profile" => "demo",
                            "repository" => "https://github.com/platformsh/demo-cmd.git"
                        ]
                    ],
                    "trial_plan" => false,
                    "project_ui" => "https://console.upsun.com/fake-org-5678/fake-proj-5678",
                    "created_at" => "2023-10-24T16:34:45Z",
                    "updated_at" => "2025-04-08T11:12:55.802313Z",
                    "_links" => [
                        "activities" => [
                            "href" => "/organizations/fake-org-5678/projects/fake-proj-5678/activities"
                        ],
                        "addons" => [
                            "href" => "/organizations/fake-org-5678/projects/fake-proj-5678/addons"
                        ],
                        "api" => [
                            "href" => "/projects/fake-proj-5678"
                        ],
                        "self" => [
                            "href" => "/organizations/fake-org-5678/projects/fake-proj-5678"
                        ],
                        "subscription" => [
                            "href" => "/organizations/fake-org-5678/subscriptions/999999"
                        ]
                    ],
                    "type" => "grid",
                    "locked" => false,
                    "cse_notes" => "",
                    "fastly_service_ids" => [],
                    "edgee_org_id" => "",
                    "edgee_project_id" => ""
                ]
            ],
            "_links" => [
                "self" => [
                    "href" => "/organizations/fake-org-5678/projects"
                ]
            ],
            "facets" => [
                "plans" => [
                    "upsun/flexible" => "Project fee"
                ]
            ]
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($orgProjectList)
            ));

        $response = $this->organizationsTask->listProjects(organizationId: $orgId);
        $projects = $response->getItems();
        $this->assertIsArray($projects);
        $this->assertContainsOnlyInstancesOf(OrganizationProject::class, $projects);
        $this->assertObjectMatchesArray($projects, $projects);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testCanCreateProject()
    {
        $orgId = 'org_123';

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode(
                    [
                        "can_create" => true,
                        "message" => "",
                        "required_action" => null,
                    ]
                )
            ));

        $result = $this->organizationsTask->canCreateProject(organizationId: $orgId);
        $this->assertInstanceOf(CanCreateNewOrgSubscription200Response::class, $result);
        $this->assertTrue($result->getCanCreate());
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testCreateProject()
    {
        $orgId = 'org-123';
        $data = [
            "projectRegion" => "us.platform.sh",
            "plan" => "upsun/flexible",
            "projectTitle" => "Fake Project for Testing",
            "optionsUrl" => "https://example.com/project/options",
            "defaultBranch" => "main",
            "environments" => 3,
            "storage" => 10240, // Mo
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode(
                    [
                        "id" => "sub_fake_123456",
                        "status" => "active",
                        "createdAt" => "2024-10-01T10:00:00Z",
                        "updatedAt" => "2025-09-17T12:00:00Z",
                        "owner" => "owner_fake_789",
                        "ownerInfo" => [
                            "type" => "user",
                            "username" => "jdoe",
                            "displayName" => "John Doe",
                        ],
                        "vendor" => "upsun",
                        "plan" => "upsun/flexible",
                        "environments" => 3,
                        "storage" => 10240,
                        "userLicenses" => 10,
                        "projectId" => "proj_fake_456",
                        "projectEndpoint" => "https://api.upsun.com/projects/proj_fake_456",
                        "projectTitle" => "Fake Project for Testing",
                        "projectRegion" => "us.platform.sh",
                        "projectRegionLabel" => "US East",
                        "projectUi" => "https://console.upsun.com/org_fake_123/proj_fake_456",
                        "projectOptions" => [
                            "defaults" => null,
                            "enforced" => null,
                            "regions" => ["us.platform.sh"],
                            "plans" => ["upsun/flexible"],
                            "billing" => [
                                "cycle" => "monthly",
                                "currency" => "USD",
                            ],
                        ],
                        "agencySite" => false,
                        "invoiced" => true,
                        "hipaa" => false,
                        "isTrialPlan" => false,
                        "services" => ["mysql", "redis"],
                        "green" => true,
                    ]
                )
            ));

        $response = $this->organizationsTask->createProject(
            organizationId: $orgId,
            projectRegion: $data['projectRegion'],
            plan: $data['plan'],
            title: $data['projectTitle'],
            optionsUrl: $data['optionsUrl'],
            defaultBranch: $data['defaultBranch'],
            environments: $data['environments'],
            storage: $data['storage'],
        );
        $this->assertInstanceOf(Subscription::class, $response);
        $this->assertEquals($data['projectRegion'], $response->getProjectRegion());
        $this->assertEquals($data['plan'], $response->getPlan());
        $this->assertEquals($data['projectTitle'], $response->getProjectTitle());
        $this->assertEquals($data['environments'], $response->getEnvironments());
        $this->assertEquals($data['storage'], $response->getStorage());
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testDeleteProject()
    {
        $projectId = 'proj-1';

        $fakeProject = [
            'id' => $projectId,
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
            ->expects($this->atMost(2))
            ->method('sendRequest')
            ->willReturnOnConsecutiveCalls(
                new Response(
                    200,
                    ['Content-Type' => 'application/json'],
                    json_encode($fakeProject)
                ),
                new Response(
                    204,
                    ['Content-Type' => 'application/json'],
                    json_encode([
                        'status' => 'no-content',
                        'code' => 204
                    ])
                )
            );

        $this->organizationsTask->deleteProject(projectId: $projectId);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testUpdateProject()
    {
        $prjId = 'proj_1';
        $projectFake = $this->getFakeProject($prjId);
        $data = [
            'title' => 'Projet Fake',
            'timezone' => 'America/New_York',
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
                    json_encode([])
                )
            );

        $response = $this->organizationsTask->updateProject(
            projectId: $prjId,
            title: $data['title'],
            timezone: $data['timezone'],
        );

        $this->assertEquals(new AcceptedResponse('accepted', 200), $response);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testEstimateNewProject()
    {
        $orgId = 'org_1';

        $estimationObject = [
            'plan' => 'upsun/flexible',
            'userLicenses' => 10,
            'environments' => 3,
            'storage' => 10240,
            'options' => (object)[
                'supportTier' => 'upsun_standard',
                'hipaa' => false,
                'agencySite' => false,
            ],
            'format' => 'format'
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($estimationObject)
            ));

        $response = $this->organizationsTask->estimateNewProject(
            organizationId: $orgId,
            environments: $estimationObject['environments'],
            storage: $estimationObject['storage'],
            userLicenses: $estimationObject['userLicenses'],
            format: $estimationObject['format'],
        );
        $this->assertInstanceOf(EstimationObject::class, $response);
        $this->assertEquals($estimationObject['plan'], $response->getPlan());
        $this->assertEquals($estimationObject['userLicenses'], $response->getUserLicenses());
        $this->assertEquals($estimationObject['environments'], $response->getEnvironments());
        $this->assertEquals($estimationObject['storage'], $response->getStorage());
        $this->assertEquals((object)$estimationObject['options'], $response->getOptions());
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testEstimateProject()
    {
        $orgId = 'org_1';
        $prjId = 'prj_1';
        $estimationObject = [
            'plan' => 'upsun/flexible',
            'userLicenses' => '10',
            'environments' => 3,
            'storage' => '10240',
            'total' => '123',
            'options' => [
                'supportTier' => 'upsun_standard',
                'hipaa' => false,
                'agencySite' => false,
            ],
            'format' => 'format'
        ];


        $fakeOrganizationProject = [
            'id' => $prjId,
            'attributes' => [
                'language' => 'php',
                'framework' => 'symfony',
            ],
            'title' => 'My Test Project',
            'description' => 'This is a fake project for testing.',
            'owner' => 'user_123',
            'status' => [
                'code' => 'active',
                'message' => 'All systems operational',
            ],
            'timezone' => 'Europe/Paris',
            'region' => 'eu-west-1',
            'repository' => [
                'url' => 'git@github.com:test/project.git',
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
            'namespace' => 'namespace',
            'organization' => 'org_987',
            'defaultBranch' => 'main',
            'defaultDomain' => 'project.upsun.dev',
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturnOnConsecutiveCalls(
                new Response(
                    200,
                    ['Content-Type' => 'application/json'],
                    json_encode($fakeOrganizationProject)
                ),
                new Response(
                    200,
                    ['Content-Type' => 'application/json'],
                    json_encode($estimationObject)
                )
            );

        $response = $this->organizationsTask->estimateProject(
            organizationId: $orgId,
            projectId: $prjId,
            environments: $estimationObject['environments'],
            storage: $estimationObject['storage'],
            userLicenses: $estimationObject['userLicenses'],
            format: $estimationObject['format'],
        );
        $this->assertInstanceOf(EstimationObject::class, $response);
        $this->assertObjectProperties($response, $estimationObject);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testGetProjectUsage()
    {
        $orgId = 'org_1';
        $prjId = 'prj_1';

        $currentUsageData = [
            'cpuApp' => [
                'title' => 'CPU App',
                'type' => true,
                'currentUsage' => 120,
                'currentUsageFormatted' => '120 vCPU-h',
                'notCharged' => false,
                'freeQuantity' => 50,
                'freeQuantityFormatted' => '50 vCPU-h',
                'dailyAverage' => 10,
                'dailyAverageFormatted' => '10 vCPU-h/day',
            ],
            'storageAppServices' => [
                'title' => 'Storage App Services',
                'type' => false,
                'currentUsage' => 20480,
                'currentUsageFormatted' => '20 GB',
                'notCharged' => false,
                'freeQuantity' => 10240,
                'freeQuantityFormatted' => '10 GB',
                'dailyAverage' => 500,
                'dailyAverageFormatted' => '500 MB/day',
            ],
            'memoryApp' => [
                'title' => 'Memory App',
                'type' => true,
                'currentUsage' => 4096,
                'currentUsageFormatted' => '4 GB',
                'notCharged' => false,
                'freeQuantity' => 2048,
                'freeQuantityFormatted' => '2 GB',
                'dailyAverage' => 200,
                'dailyAverageFormatted' => '200 MB/day',
            ],
            'cpuServices' => [
                'title' => 'CPU Services',
                'type' => true,
                'currentUsage' => 60,
                'currentUsageFormatted' => '60 vCPU-h',
            ],
            'memoryServices' => [
                'title' => 'Memory Services',
                'type' => true,
                'currentUsage' => 1024,
                'currentUsageFormatted' => '1 GB',
            ],
            'backupStorage' => [
                'title' => 'Backup Storage',
                'type' => false,
                'currentUsage' => 5120,
                'currentUsageFormatted' => '5 GB',
            ],
            'buildCpu' => [
                'title' => 'Build CPU',
                'type' => true,
                'currentUsage' => 30,
                'currentUsageFormatted' => '30 vCPU-h',
            ],
            'buildMemory' => [
                'title' => 'Build Memory',
                'type' => true,
                'currentUsage' => 2048,
                'currentUsageFormatted' => '2 GB',
            ],
            'egressBandwidth' => [
                'title' => 'Egress Bandwidth',
                'type' => false,
                'currentUsage' => 1000,
                'currentUsageFormatted' => '1 TB',
            ],
            'ingressRequests' => [
                'title' => 'Ingress Requests',
                'type' => false,
                'currentUsage' => 500000,
                'currentUsageFormatted' => '500k req',
            ],
            'logsFwdContentSize' => [
                'title' => 'Logs Forwarded',
                'type' => false,
                'currentUsage' => 10240,
                'currentUsageFormatted' => '10 GB',
            ],
            'fastlyBandwidth' => [
                'title' => 'Fastly Bandwidth',
                'type' => false,
                'currentUsage' => 2048,
                'currentUsageFormatted' => '2 GB',
            ],
            'fastlyRequests' => [
                'title' => 'Fastly Requests',
                'type' => false,
                'currentUsage' => 300000,
                'currentUsageFormatted' => '300k req',
            ],
        ];


        $fakeOrganizationProject = [
            'id' => $prjId,
            'attributes' => [
                'language' => 'php',
                'framework' => 'symfony',
            ],
            'title' => 'My Test Project',
            'description' => 'This is a fake project for testing.',
            'owner' => 'user_123',
            'status' => [
                'code' => 'active',
                'message' => 'All systems operational',
            ],
            'timezone' => 'Europe/Paris',
            'region' => 'eu-west-1',
            'repository' => [
                'url' => 'git@github.com:test/project.git',
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
            'namespace' => 'namespace',
            'organization' => 'org_987',
            'defaultBranch' => 'main',
            'defaultDomain' => 'project.upsun.dev',
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturnOnConsecutiveCalls(
                new Response(
                    200,
                    ['Content-Type' => 'application/json'],
                    json_encode($fakeOrganizationProject)
                ),
                new Response(
                    200,
                    ['Content-Type' => 'application/json'],
                    json_encode($currentUsageData)
                )
            );

        $response = $this->organizationsTask->getProjectUsage(
            organizationId: $orgId,
            projectId: $prjId,
            usageGroups: 'usageGroups',
            includeNotCharged: true
        );
        $this->assertInstanceOf(SubscriptionCurrentUsageObject::class, $response);
        $this->assertObjectProperties($response, $currentUsageData);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testDisableMfaEnforcement(): void
    {
        $orgId = 'org_1';

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                204,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'no-content',
                    'code' => 204
                ])
            ));

        $this->organizationsTask->disableMfaEnforcement(organizationId: $orgId);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testGetInvoice(): void
    {
        $invoiceData = [
            'relatedInvoiceId' => 'inv_related_123',
            'invoiceDate' => '2025-09-01T10:00:00Z',
            'invoiceDue' => '2025-09-30T23:59:59Z',
            'created' => '2025-09-01T09:00:00Z',
            'changed' => '2025-09-10T12:00:00Z',
            'id' => 'inv_456',
            'invoiceNumber' => '2025-0001',
            'type' => 'invoice', // or 'credit_memo'
            'orderId' => 'order_789',
            'status' => 'paid', // ex: paid, pending, canceled
            'owner' => '01J8Y7ZX9ABCDXY1234567PQRS',
            'company' => 'Fake Company Inc.',
            'total' => 199.99,
            'address' => [
                'country' => 'FR',
                'nameLine' => 'Jean Dupont',
                'premise' => '123',
                'subPremise' => 'Apt 45',
                'thoroughfare' => 'Rue de la Paix',
                'administrativeArea' => 'Île-de-France',
                'subAdministrativeArea' => null,
                'locality' => 'Paris',
                'dependentLocality' => null,
                'postalCode' => '75001',
            ],
            'notes' => 'Upsun rocks',
            'invoicePdf' => [
                'url' => 'https://example.com/invoices/inv_456.pdf',
                'status' => 'available',
            ],
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($invoiceData)
            ));

        $result = $this->organizationsTask->getInvoice(
            invoiceId: $invoiceData['id'],
            organizationId: 'org-123'
        );
        $this->assertInstanceOf(Invoice::class, $result);
        $this->assertObjectProperties($result, $invoiceData);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testGetAddress(): void
    {
        $data = [
            'country' => 'FR',
            'nameLine' => 'Jean Dupont',
            'premise' => '123',
            'subPremise' => 'Apt 45',
            'thoroughfare' => 'Rue de la Paix',
            'administrativeArea' => 'Île-de-France',
            'subAdministrativeArea' => null,
            'locality' => 'Paris',
            'dependentLocality' => null,
            'postalCode' => '75001',
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($data)
            ));

        $result = $this->organizationsTask->getAddress(organizationId: 'org-123');
        $this->assertInstanceOf(Address::class, $result);
        $this->assertObjectProperties($result, $data);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testListUsageRecords(): void
    {
        $data = [
            'items' => [
                [
                    'id' => 'usage_1',
                    'subscriptionId' => 'sub_123',
                    'usageGroup' => 'cpuApp',
                    'quantity' => 120.5,
                    'start' => '2025-09-01T00:00:00Z',
                ],
                [
                    'id' => 'usage_2',
                    'subscriptionId' => 'sub_123',
                    'usageGroup' => 'memoryApp',
                    'quantity' => 4096.0,
                    'start' => '2025-09-01T00:00:00Z',
                ],
                [
                    'id' => 'usage_3',
                    'subscriptionId' => 'sub_456',
                    'usageGroup' => 'storageAppServices',
                    'quantity' => 20480.0,
                    'start' => '2025-09-01T00:00:00Z',
                ],
                [
                    'id' => 'usage_4',
                    'subscriptionId' => 'sub_456',
                    'usageGroup' => 'backupStorage',
                    'quantity' => 5120.0,
                    'start' => '2025-09-01T00:00:00Z',
                ],
            ],
            'links' => [
                'self' => '/organizations/org_1/usage-records',
                'next' => '/organizations/org_1/usage-records?page=2',
            ],
        ];

        $fakeOrganizationProject = [
            'id' => '123',
            'attributes' => [
                'language' => 'php',
                'framework' => 'symfony',
            ],
            'title' => 'My Test Project',
            'description' => 'This is a fake project for testing.',
            'owner' => 'user_123',
            'status' => [
                'code' => 'active',
                'message' => 'All systems operational',
            ],
            'timezone' => 'Europe/Paris',
            'region' => 'eu-west-1',
            'repository' => [
                'url' => 'git@github.com:test/project.git',
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
            'namespace' => 'namespace',
            'organization' => 'org_987',
            'defaultBranch' => 'main',
            'defaultDomain' => 'project.upsun.dev',
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturnOnConsecutiveCalls(
                new Response(
                    200,
                    ['Content-Type' => 'application/json'],
                    json_encode($fakeOrganizationProject)
                ),
                new Response(
                    200,
                    ['Content-Type' => 'application/json'],
                    json_encode($data)
                )
            );

        $response = $this->organizationsTask->listUsageRecords(organizationId: 'org-123', filterProjectId: '123');
        $this->assertInstanceOf(ListOrgUsageRecords200Response::class, $response);
        $this->assertObjectProperties($response->getItems(), $data['items']);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testListVouchers(): void
    {
        $data = [
            'uuid' => 'voucher_123',
            'vouchersTotal' => '500.00',
            'vouchersApplied' => '150.00',
            'vouchersRemainingBalance' => '350.00',
            'currency' => 'USD',
            'vouchers' => [
                [
                    'code' => 'DISCOUNT50',
                    'amount' => '50.00',
                    'applied' => true,
                ],
                [
                    'code' => 'SUMMER100',
                    'amount' => '100.00',
                    'applied' => false,
                ],
            ],
            'links' => [
                'self' => [
                    'href' => '/organizations/org_123/vouchers',
                ],
            ],
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($data)
            ));

        $result = $this->organizationsTask->listVouchers(organizationId: 'org-123');
        $this->assertInstanceOf(Vouchers::class, $result);
        $this->assertObjectProperties($result, $data);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testEnableMfaEnforcement(): void
    {
        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                204,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'no-content',
                    'code' => 204
                ])
            ));

        $this->organizationsTask->enableMfaEnforcement(organizationId: 'org-123');
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testGetMfaEnforcement(): void
    {
        $data = [
            'enforceMfa' => true,
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($data)
            ));

        $result = $this->organizationsTask->getMfaEnforcement(organizationId: 'org-123');
        $this->assertInstanceOf(OrganizationMFAEnforcement::class, $result);
        $this->assertObjectProperties($result, $data);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testSendMfaReminders(): void
    {
        $data = [
            'user-123-abc' => [
                'code' => 200,
                'message' => 'MFA reminder sent successfully',
            ],
            'user-456-def' => [
                'code' => 400,
                'message' => 'User email not found',
            ],
            'user-789-ghi' => [
                'code' => 200,
                'message' => 'MFA reminder sent successfully',
            ],
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($data)
            ));

        $result = $this->organizationsTask->sendMfaReminders(
            organizationId: 'org-123',
            userIds: [
                'userIds' => [
                    'user-123-abc',
                    'user-456-def',
                    'user-789-ghi',
                ],
            ]
        );
        $this->assertContainsOnlyInstancesOf(SendOrgMfaReminders200ResponseValue::class, $result);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testListInvoices(): void
    {
        $data = [
            [
                'id' => 'inv_001',
                'invoice_number' => '2025-0001',
                'type' => 'invoice', // or 'credit_memo'
                'order_id' => 'order_123',
                'related_invoice_id' => null,
                'status' => 'paid',
                'owner' => '01J8Y7ZX9ABCDXY1234567PQRS', // ULID
                'invoice_date' => '2025-09-01T10:00:00Z',
                'invoice_due' => '2025-09-30T23:59:59Z',
                'created' => '2025-09-01T09:00:00Z',
                'changed' => '2025-09-10T12:00:00Z',
                'company' => 'Fake Company Inc.',
                'total' => 199.99,
                'address' => [
                    'country' => 'FR',
                    'nameLine' => 'Jean Dupont',
                    'premise' => '123',
                    'subPremise' => 'Apt 45',
                    'thoroughfare' => 'Rue de la Paix',
                    'administrativeArea' => 'Île-de-France',
                    'subAdministrativeArea' => null,
                    'locality' => 'Paris',
                    'dependentLocality' => null,
                    'postalCode' => '75001',
                ],
                'notes' => 'Merci pour votre confiance.',
                'invoice_pdf' => [
                    'url' => 'https://example.com/invoices/inv_001.pdf',
                    'status' => 'available',
                ],
            ],
            [
                'id' => 'inv_002',
                'invoice_number' => '2025-0002',
                'type' => 'invoice',
                'order_id' => 'order_124',
                'related_invoice_id' => null,
                'status' => 'pending',
                'owner' => '01J8Y7ZX9ABCDXY1234567PQRS',
                'invoice_date' => '2025-09-01T10:00:00Z',
                'invoice_due' => '2025-09-30T23:59:59Z',
                'created' => '2025-09-01T09:00:00Z',
                'changed' => '2025-09-10T12:00:00Z',
                'company' => 'Fake Company Inc.',
                'total' => 199.99,
                'address' => [
                    'country' => 'FR',
                    'nameLine' => 'Jean Dupont',
                    'premise' => '123',
                    'subPremise' => 'Apt 45',
                    'thoroughfare' => 'Rue de la Paix',
                    'administrativeArea' => 'Île-de-France',
                    'subAdministrativeArea' => null,
                    'locality' => 'Paris',
                    'dependentLocality' => null,
                    'postalCode' => '75001',
                ],
                'notes' => 'Merci pour votre confiance.',
                'invoice_pdf' => [
                    'url' => 'https://example.com/invoices/inv_001.pdf',
                    'status' => 'available',
                ],
            ]
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode(['items' => $data])
            ));

        $result = $this->organizationsTask->listInvoices(organizationId: 'org-123');
        $this->assertInstanceOf(ListOrgInvoices200Response::class, $result);
        $this->assertContainsOnlyInstancesOf(Invoice::class, $result->getItems());
        $this->assertObjectProperties($result, $data);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testCreateAuthorizationCredentials(): void
    {
        $data = [
            'type' => 'redirect',
            'redirect_to_url' => [
                'return_url' => 'https://example.com/payment/return',
                'url' => 'https://payment-gateway.com/checkout/session/123456',
            ],
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($data)
            ));

        $orgId = 'org-1';
        $orderId = 'order-1';
        $result = $this->organizationsTask->createAuthorizationCredentials(organizationId: $orgId, orderId: $orderId);
        $this->assertInstanceOf(CreateAuthorizationCredentials200Response::class, $result);
        $this->assertObjectProperties($result, $data);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testGetOrder(): void
    {
        $data = [
            'id' => 'order-123-abc',
            'status' => 'completed',
            'owner' => '550e8400-e29b-41d4-a716-446655440000',
            'address' => [
                // objet Address
            ],
            'company' => 'Acme Corp',
            'vat_number' => 'FR12345678901',
            'billing_period_start' => '2024-01-01T00:00:00Z',
            'billing_period_end' => '2024-01-31T23:59:59Z',
            'billing_period_label' => [
                'formatted' => 'January 2024',
                'month' => 'January',
                'year' => '2024',
                'next_month' => 'February'
            ],
            'billing_period_duration' => 2678400,
            'paid_on' => '2024-01-05T10:30:00Z',
            'total' => 9999,
            'total_formatted' => 9999,
            'components' => [
                'voucher/vat/baseprice' => []
            ],
            'currency' => 'EUR',
            'invoice_url' => 'https://api.platform.sh/api/platform/orders/download?token=...',
            'last_refreshed' => '2024-01-20T15:45:00Z',
            'invoiced' => true,
            'line_items' => [
                [
                    'type' => 'project_plan',
                    'license_id' => 12345,
                    'project_id' => 'abcd1234',
                    'product' => 'Development Plan',
                    'sku' => 'DEV-PLAN-SMALL',
                    'total' => 50.00,
                    'total_formatted' => '$50.00',
                    'components' => [
                        'base_price' => [
                            'amount' => 45.00,
                            'amount_formatted' => '$45.00',
                            'display_title' => 'Base Price',
                            'currency' => 'USD'
                        ],
                        'tax' => [
                            'amount' => 5.00,
                            'amount_formatted' => '$5.00',
                            'display_title' => 'Sales Tax',
                            'currency' => 'USD'
                        ]
                    ],
                    'exclude_from_invoice' => false
                ]
            ],
            '_links' => [
                'invoices' => [
                    'href' => '/api/orders/123/invoices'
                ]
            ]
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($data)
            ));

        $result = $this->organizationsTask->getOrder(organizationId: 'org-123', orderId: 'order-001');
        $this->assertInstanceOf(Order::class, $result);
        $this->assertObjectProperties($result, $data);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testListOrders(): void
    {
        $data = [
            'items' => [
                [
                    'id' => 'order-123-abc',
                    'status' => 'completed',
                    'owner' => '550e8400-e29b-41d4-a716-446655440000',
                    'address' => [
                        // objet Address
                    ],
                    'company' => 'Acme Corp',
                    'vat_number' => 'FR12345678901',
                    'billing_period_start' => '2024-01-01T00:00:00Z',
                    'billing_period_end' => '2024-01-31T23:59:59Z',
                    'billing_period_label' => [
                        'formatted' => 'January 2024',
                        'month' => 'January',
                        'year' => '2024',
                        'next_month' => 'February'
                    ],
                    'billing_period_duration' => 2678400,
                    'paid_on' => '2024-01-05T10:30:00Z',
                    'total' => 9999,
                    'total_formatted' => 9999,
                    'components' => [
                        'voucher/vat/baseprice' => []
                    ],
                    'currency' => 'EUR',
                    'invoice_url' => 'https://api.platform.sh/api/platform/orders/download?token=...',
                    'last_refreshed' => '2024-01-20T15:45:00Z',
                    'invoiced' => true,
                    'line_items' => [
                        [
                            'type' => 'project_plan',
                            'license_id' => 12345,
                            'project_id' => 'abcd1234',
                            'product' => 'Development Plan',
                            'sku' => 'DEV-PLAN-SMALL',
                            'total' => 50.00,
                            'total_formatted' => '$50.00',
                            'components' => [
                                'base_price' => [
                                    'amount' => 45.00,
                                    'amount_formatted' => '$45.00',
                                    'display_title' => 'Base Price',
                                    'currency' => 'USD'
                                ],
                                'tax' => [
                                    'amount' => 5.00,
                                    'amount_formatted' => '$5.00',
                                    'display_title' => 'Sales Tax',
                                    'currency' => 'USD'
                                ]
                            ],
                            'exclude_from_invoice' => false
                        ]
                    ],
                    '_links' => [
                        'invoices' => [
                            'href' => '/api/orders/123/invoices'
                        ]
                    ]
                ],
                [
                    'id' => 'order-456-abc',
                    'status' => 'completed',
                    'owner' => '550e8400-e29b-41d4-a716-446655440000',
                    'address' => [
                        // objet Address
                    ],
                    'company' => 'Acme Corp',
                    'vat_number' => 'FR12345678901',
                    'billing_period_start' => '2024-01-01T00:00:00Z',
                    'billing_period_end' => '2024-01-31T23:59:59Z',
                    'billing_period_label' => [
                        'formatted' => 'January 2024',
                        'month' => 'January',
                        'year' => '2024',
                        'next_month' => 'February'
                    ],
                    'billing_period_duration' => 2678400,
                    'paid_on' => '2024-01-05T10:30:00Z',
                    'total' => 9999,
                    'total_formatted' => 9999,
                    'components' => [
                        'voucher/vat/baseprice' => []
                    ],
                    'currency' => 'EUR',
                    'invoice_url' => 'https://api.platform.sh/api/platform/orders/download?token=...',
                    'last_refreshed' => '2024-01-20T15:45:00Z',
                    'invoiced' => true,
                    'line_items' => [
                        [
                            'type' => 'project_plan',
                            'license_id' => 12345,
                            'project_id' => 'abcd1234',
                            'product' => 'Development Plan',
                            'sku' => 'DEV-PLAN-SMALL',
                            'total' => 50.00,
                            'total_formatted' => '$50.00',
                            'components' => [
                                'base_price' => [
                                    'amount' => 45.00,
                                    'amount_formatted' => '$45.00',
                                    'display_title' => 'Base Price',
                                    'currency' => 'USD'
                                ],
                                'tax' => [
                                    'amount' => 5.00,
                                    'amount_formatted' => '$5.00',
                                    'display_title' => 'Sales Tax',
                                    'currency' => 'USD'
                                ]
                            ],
                            'exclude_from_invoice' => false
                        ]
                    ],
                    '_links' => [
                        'invoices' => [
                            'href' => '/api/orders/456/invoices'
                        ]
                    ]
                ]
            ],
            '_links' => [
                'self' => ['href' => 'href'],
                'previous' => ['href' => 'href'],
                'next' => ['href' => 'href'],
            ]
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($data)
            ));

        $result = $this->organizationsTask->listOrders(organizationId: 'org-123', filterStatus: 'completed');
        $this->assertInstanceOf(ListOrgOrders200Response::class, $result);
        $this->assertContainsOnlyInstancesOf(Order::class, $result->getItems());
        $this->assertObjectProperties($result, $data);
    }

    /**
     * @throws Exception
     * @throws ClientExceptionInterface
     */
    public function testGetProfile(): void
    {
        $data = [
            'id' => '12345',
            'displayName' => 'John Doe',
            'email' => 'john.doe@example.com',
            'username' => 'johndoe',
            'type' => 'user',
            'picture' => 'https://example.com/avatar.jpg',
            'companyType' => 'SaaS',
            'companyName' => 'Example Corp',
            'currency' => 'USD',
            'vatNumber' => 'US123456789',
            'companyRole' => 'Developer',
            'websiteUrl' => 'https://www.example.com',
            'newUi' => true,
            'uiColorscheme' => 'dark',
            'defaultCatalog' => 'main',
            'projectOptionsUrl' => 'https://example.com/projects/options',
            'marketing' => false,
            'createdAt' => '2023-01-15T10:20:30+00:00',
            'updatedAt' => '2023-06-20T08:15:00+00:00',
            'billingContact' => 'billing@example.com',
            'currentTrial' => [
                'pendingVerification' => null,
                'active' => true,
                'created' => '2023-06-01T12:00:00+00:00',
                'description' => '30-day free trial',
                'expiration' => '2023-07-01T12:00:00+00:00',
                'current' => [
                    'plan' => 'Pro',
                    'limit' => 10,
                ],
                'spend' => [
                    'amount' => 50,
                    'currency' => 'USD',
                ],
                'spendRemaining' => [
                    'amount' => 150,
                    'currency' => 'USD',
                ],
                'projects' => [
                    'used' => 3,
                    'allowed' => 10,
                ],
                'model' => 'trial-pro',
                'daysRemaining' => 8,
            ],
            'invoiced' => true,
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($data)
            ));

        $result = $this->organizationsTask->getProfile(organizationId: 'org-123');
        $this->assertInstanceOf(Profile::class, $result);
        $this->assertObjectProperties($result, $data);
    }

    public function testUpdateAddress(): void
    {
        $fakeAddressData = [
            'country' => 'FR',
            'nameLine' => 'John Doe',
            'premise' => '10',
            'subPremise' => 'Appartement 25B',
            'thoroughfare' => 'Rue de la Paix',
            'administrativeArea' => 'Île-de-France',
            'subAdministrativeArea' => 'Paris',
            'locality' => 'Paris',
            'dependentLocality' => 'Montmartre',
            'postalCode' => '75002',
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($fakeAddressData)
            ));

        $result = $this->organizationsTask->updateAddress(
            organizationId: 'org-123',
            country: $fakeAddressData['country'],
            nameLine: $fakeAddressData['nameLine'],
            premise: $fakeAddressData['premise'],
            subPremise: $fakeAddressData['subPremise'],
            thoroughfare: $fakeAddressData['thoroughfare'],
            administrativeArea: $fakeAddressData['administrativeArea'],
            subAdministrativeArea: $fakeAddressData['subAdministrativeArea'],
            locality: $fakeAddressData['locality'],
            dependentLocality: $fakeAddressData['dependentLocality'],
            postalCode: $fakeAddressData['postalCode'],
        );
        $this->assertInstanceOf(Address::class, $result);
        $this->assertObjectProperties($result, $fakeAddressData);
    }

    /**
     * @throws Exception
     * @throws ClientExceptionInterface
     */
    public function testUpdateProfile(): void
    {
        $data = [
            'id' => '12345',
            'displayName' => 'John Doe',
            'email' => 'john.doe@example.com',
            'username' => 'johndoe',
            'type' => 'user',
            'picture' => 'https://example.com/avatar.jpg',
            'companyType' => 'SaaS',
            'companyName' => 'Example Corp',
            'currency' => 'USD',
            'vatNumber' => 'FR123456789',
            'companyRole' => 'Developer',
            'websiteUrl' => 'https://www.example.com',
            'newUi' => true,
            'uiColorscheme' => 'dark',
            'defaultCatalog' => 'main',
            'projectOptionsUrl' => 'https://example.com/org/options',
            'marketing' => false,
            'createdAt' => '2023-01-15T10:20:30+00:00',
            'updatedAt' => '2023-06-20T08:15:00+00:00',
            'billingContact' => 'billing@example.com',
            'currentTrial' => [
                'pendingVerification' => null,
                'active' => true,
                'created' => '2023-06-01T12:00:00+00:00',
                'description' => '30-day free trial',
                'expiration' => '2023-07-01T12:00:00+00:00',
                'current' => [
                    'plan' => 'Pro',
                    'limit' => 10,
                ],
                'spend' => [
                    'amount' => 50,
                    'currency' => 'USD',
                ],
                'spendRemaining' => [
                    'amount' => 150,
                    'currency' => 'USD',
                ],
                'projects' => [
                    'used' => 3,
                    'allowed' => 10,
                ],
                'model' => 'trial-pro',
                'daysRemaining' => 8,
            ],
            'invoiced' => true,
        ];


        $fakeUpdateOrgProfileRequestData = [
            'defaultCatalog' => 'main',
            'projectOptionsUrl' => 'https://example.com/org/options',
            'companyName' => 'Example Corp',
            'vatNumber' => 'FR123456789',
            'billingContact' => 'billing@example.com',
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($data)
            ));

        $result = $this->organizationsTask->updateProfile(
            organizationId: 'org-123',
            defaultCatalog: $fakeUpdateOrgProfileRequestData['defaultCatalog'],
            projectOptionsUrl: $fakeUpdateOrgProfileRequestData['projectOptionsUrl'],
            companyName: $fakeUpdateOrgProfileRequestData['companyName'],
            vatNumber: $fakeUpdateOrgProfileRequestData['vatNumber'],
            billingContact: $fakeUpdateOrgProfileRequestData['billingContact'],
        );
        $this->assertInstanceOf(Profile::class, $result);
        $this->assertObjectProperties($result, $data);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testListRecords(): void
    {
        $fakeListOrgPlanRecords200ResponseData = [
            'items' => [
                [
                    'end' => '2024-12-31T23:59:59+00:00',
                    'id' => 'plan_record_001',
                    'owner' => 'org_123',
                    'subscriptionId' => 'sub_abc123',
                    'sku' => 'starter-001',
                    'plan' => 'Starter Plan',
                    'options' => [
                        'users' => 5,
                        'projects' => 2,
                        'support' => 'community',
                    ],
                    'start' => '2024-01-01T00:00:00+00:00',
                    'status' => 'active',
                ],
                [
                    'end' => '2025-06-30T23:59:59+00:00',
                    'id' => 'plan_record_002',
                    'owner' => 'org_123',
                    'subscriptionId' => 'sub_def456',
                    'sku' => 'pro-001',
                    'plan' => 'Pro Plan',
                    'options' => [
                        'users' => 50,
                        'projects' => 10,
                        'support' => 'email',
                    ],
                    'start' => '2024-07-01T00:00:00+00:00',
                    'status' => 'active',
                ],
                [
                    'end' => null,
                    'id' => 'plan_record_003',
                    'owner' => 'org_123',
                    'subscriptionId' => 'sub_ghi789',
                    'sku' => 'enterprise-001',
                    'plan' => 'Enterprise Plan',
                    'options' => [
                        'users' => 500,
                        'projects' => 'unlimited',
                        'support' => 'premium 24/7',
                        'sla' => '99.9%',
                    ],
                    'start' => '2025-01-01T00:00:00+00:00',
                    'status' => 'pending',
                ],
            ],
            'links' => [
                'self' => [
                    'href' => 'https://api.example.com/orgs/123/plans?page=1',
                ],
                'previous' => [
                    'href' => null,
                ],
                'next' => [
                    'href' => 'https://api.example.com/orgs/123/plans?page=2',
                ],
            ],
        ];

        $fakeOrganizationProject = [
            'id' => '123',
            'attributes' => [
                'language' => 'php',
                'framework' => 'symfony',
            ],
            'title' => 'My Test Project',
            'description' => 'This is a fake project for testing.',
            'owner' => 'user_123',
            'status' => [
                'code' => 'active',
                'message' => 'All systems operational',
            ],
            'timezone' => 'Europe/Paris',
            'region' => 'eu-west-1',
            'repository' => [
                'url' => 'git@github.com:test/project.git',
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
            'namespace' => 'namespace',
            'organization' => 'org_987',
            'defaultBranch' => 'main',
            'defaultDomain' => 'project.upsun.dev',
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturnOnConsecutiveCalls(
                new Response(
                    200,
                    ['Content-Type' => 'application/json'],
                    json_encode($fakeOrganizationProject)
                ),
                new Response(
                    200,
                    ['Content-Type' => 'application/json'],
                    json_encode($fakeListOrgPlanRecords200ResponseData)
                )
            );


        $result = $this->organizationsTask->listRecords(organizationId: 'org-123', filterProjectId: '123');
        $this->assertInstanceOf(ListOrgPlanRecords200Response::class, $result);
        $this->assertContainsOnlyInstancesOf(PlanRecords::class, $result->getItems());
        $this->assertObjectProperties($result, $fakeListOrgPlanRecords200ResponseData);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testApplyVoucher(): void
    {
        $code = 'PROMO-2025-ABC';

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                204,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'No Content',
                    'code' => 204
                ])
            ));

        $this->organizationsTask->applyVoucher(organizationId: 'org-123', code: $code);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function testGetAddons(): void
    {
        $addonsData = [
            'available' => [
                'user_management' => [
                    'standard' => 0,
                    'enhanced' => 365,
                ],
                'support_level' => [
                    'basic' => 0,
                    'premium' => 180,
                ],
            ],
            'current' => [
                'user_management' => [
                    'standard' => 200,
                ],
                'support_level' => [
                    'basic' => 90,
                ],
            ],
            'upgrades_available' => [
                'user_management' => ['enhanced'],
                'support_level' => ['premium'],
            ],
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($addonsData)
            ));

        $result = $this->organizationsTask->getAddons(organizationId: 'org-123');
        $this->assertInstanceOf(OrganizationAddonsObject::class, $result);
        $this->assertObjectProperties($result, $addonsData);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testUpdateAddons(): void
    {
        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'available' => [
                        'user_management' => [
                            'standard' => 0,
                            'enhanced' => 365,
                        ],
                        'support_level' => [
                            'basic' => 0,
                            'premium' => 180,
                        ],
                    ],
                    'current' => [
                        'user_management' => [
                            'standard' => 200,
                        ],
                        'support_level' => [
                            'basic' => 90,
                        ],
                    ],
                    'upgrades_available' => [
                        'user_management' => ['enhanced'],
                        'support_level' => ['premium'],
                    ],
                ])
            ));

        $result = $this->organizationsTask->updateAddons(
            organizationId: 'org-123',
            userManagement: 'standard',
            supportLevel: 'basic'
        );
        $this->assertSame(
            ['standard' => 200],
            $result->getCurrent()->getUserManagement()
        );
        $this->assertSame(
            ['basic' => 90],
            $result->getCurrent()->getSupportLevel()
        );
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testDownloadInvoiceSuccess(): void
    {
        $token = 'invoice-token-123';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/pdf'],
                'PDF-DATA-HERE'
            ));

        $result = $this->organizationsTask->downloadInvoice(token: $token);

        $this->assertIsString($result);
        $this->assertEquals('PDF-DATA-HERE', $result);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testDownloadInvoiceError(): void
    {
        $token = 'invoice-token-403';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                403,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'unauthorized',
                    'code' => 403
                ])
            ));

        $this->expectException(ApiException::class);

        $this->organizationsTask->downloadInvoice(token: $token);
    }
}
