<?php

namespace Upsun\Test\Core;

use Exception;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use Psr\Http\Client\ClientInterface;
use Upsun\Api\AddOnsApi;
use Upsun\Api\APITokensApi;
use Upsun\Api\ConnectionsApi;
use Upsun\Api\DeploymentTargetApi;
use Upsun\Api\GrantsApi;
use Upsun\Api\InvoicesApi;
use Upsun\Api\MFAApi;
use Upsun\Api\OrdersApi;
use Upsun\Api\OrganizationMembersApi;
use Upsun\Api\OrganizationProjectsApi;
use Upsun\Api\OrganizationsApi;
use Upsun\Api\PhoneNumberApi;
use Upsun\Api\ProfilesApi;
use Upsun\Api\ProjectApi;
use Upsun\Api\ProjectSettingsApi;
use Upsun\Api\RecordsApi;
use Upsun\Api\RepositoryApi;
use Upsun\Api\SubscriptionsApi;
use Upsun\Api\SystemInformationApi;
use Upsun\Api\TeamAccessApi;
use Upsun\Api\TeamsApi;
use Upsun\Api\ThirdPartyIntegrationsApi;
use Upsun\Api\UserAccessApi;
use Upsun\Api\UserProfilesApi;
use Upsun\Api\UsersApi;
use Upsun\Api\VouchersApi;
use Upsun\Configuration;
use Upsun\Core\OAuthProvider;
use Upsun\HeaderSelector;
use Upsun\Model\AcceptedResponse;
use Upsun\Model\Address;
use Upsun\Model\CreateAuthorizationCredentials200Response;
use Upsun\Model\Invoice;
use Upsun\Model\ListOrgInvoices200Response;
use Upsun\Model\ListOrgOrders200Response;
use Upsun\Model\ListOrgPlanRecords200Response;
use Upsun\Model\ListOrgUsageRecords200Response;
use Upsun\Model\Order;
use Upsun\Model\OrganizationAddonsObject;
use Upsun\Model\OrganizationMFAEnforcement;
use Upsun\Model\PlanRecords;
use Upsun\Model\Profile;
use Upsun\Model\SendOrgMfaReminders200ResponseValue;
use Upsun\Model\Team;
use Upsun\Core\Tasks\OrganizationTask;
use Upsun\Model\Organization;
use Upsun\Model\OrganizationMember;
use Upsun\Model\OrganizationProject;
use Upsun\Model\Subscription;
use Upsun\Model\EstimationObject;
use Upsun\Model\SubscriptionCurrentUsageObject;
use Upsun\Model\CanCreateNewOrgSubscription200Response;
use Upsun\Core\Tasks\ProjectTask;
use Upsun\Core\Tasks\TeamTask;
use Upsun\Core\Tasks\UserTask;
use Upsun\Model\Vouchers;
use Upsun\UpsunClient;

class OrganizationTaskTest extends BaseTestCase
{
    protected OrganizationTask $organizationTask;

    private ClientInterface $httpClient;

    protected function setUp(): void
    {
        $psr17Factory = new Psr17Factory();

        $this->httpClient = $this->createMock(ClientInterface::class);

        $oauthProvider = $this->createMock(OAuthProvider::class);

        $headerSelector = new HeaderSelector();

        $upsunClient = $this->createMock(UpsunClient::class);

        // UserTask init
        $usersApi = new UsersApi(
            $oauthProvider,
            $this->httpClient,
            $psr17Factory,
            new Configuration()
        );

        $userProfilesApi = new UserProfilesApi(
            $oauthProvider,
            $this->httpClient,
            $psr17Factory,
            new Configuration()
        );

        $userAccessApi = new UserAccessApi(
            $oauthProvider,
            $this->httpClient,
            $psr17Factory,
            new Configuration()
        );

        $apiTokensApi = new APITokensApi(
            $oauthProvider,
            $this->httpClient,
            $psr17Factory,
            new Configuration()
        );

        $connectionsApi = new ConnectionsApi(
            $oauthProvider,
            $this->httpClient,
            $psr17Factory,
            new Configuration()
        );

        $grantsApi = new GrantsApi(
            $oauthProvider,
            $this->httpClient,
            $psr17Factory,
            new Configuration()
        );

        $mfaApi = new MFAApi(
            $oauthProvider,
            $this->httpClient,
            $psr17Factory,
            new Configuration()
        );

        $phoneNumberApi = new PhoneNumberApi(
            $oauthProvider,
            $this->httpClient,
            $psr17Factory,
            new Configuration()
        );

        $userTask = new class (
            $upsunClient,
            $usersApi,
            $userProfilesApi,
            $userAccessApi,
            $apiTokensApi,
            $connectionsApi,
            $grantsApi,
            $mfaApi,
            $phoneNumberApi
        ) extends UserTask {
        };
        $upsunClient->user = $userTask;


        // ProjectTask init
        $projectApi = new ProjectApi(
            $oauthProvider,
            $this->httpClient,
            $psr17Factory,
            new Configuration()
        );

        $projectSettingsApi = new ProjectSettingsApi(
            $oauthProvider,
            $this->httpClient,
            $psr17Factory,
            new Configuration()
        );

        $deploymentTargetApi = new DeploymentTargetApi(
            $oauthProvider,
            $this->httpClient,
            $psr17Factory,
            new Configuration()
        );

        $repositoryApi = new RepositoryApi(
            $oauthProvider,
            $this->httpClient,
            $psr17Factory,
            new Configuration()
        );

        $systemInfoApi = new SystemInformationApi(
            $oauthProvider,
            $this->httpClient,
            $psr17Factory,
            new Configuration()
        );

        $thirdPartyIntegrationsApi = new ThirdPartyIntegrationsApi(
            $oauthProvider,
            $this->httpClient,
            $psr17Factory,
            new Configuration()
        );

        $subscriptionsApi = new SubscriptionsApi(
            $oauthProvider,
            $this->httpClient,
            $psr17Factory,
            new Configuration()
        );

        $organizationProjectsApi = new OrganizationProjectsApi(
            $oauthProvider,
            $this->httpClient,
            $psr17Factory,
            new Configuration()
        );

        $projectTask = new class (
            $upsunClient,
            $projectApi,
            $projectSettingsApi,
            $deploymentTargetApi,
            $repositoryApi,
            $systemInfoApi,
            $thirdPartyIntegrationsApi,
            $subscriptionsApi,
            $organizationProjectsApi
        ) extends ProjectTask {
        };

        $upsunClient->project = $projectTask;

        // TeamTask init
        $teamsApi = new TeamsApi(
            $oauthProvider,
            $this->httpClient,
            $psr17Factory,
            new Configuration()
        );

        $teamAccessApi = new TeamAccessApi(
            $oauthProvider,
            $this->httpClient,
            $psr17Factory,
            new Configuration()
        );

        $teamTask = new class (
            $upsunClient,
            $teamsApi,
            $teamAccessApi
        ) extends TeamTask {
        };

        $upsunClient->team = $teamTask;

        // init OrganizationTask
        $organizationsApi = new OrganizationsApi(
            $oauthProvider,
            $this->httpClient,
            $psr17Factory,
            new Configuration()
        );

        $organizationProjectsApi = new OrganizationProjectsApi(
            $oauthProvider,
            $this->httpClient,
            $psr17Factory,
            new Configuration()
        );

        $organizationMembersApi = new OrganizationMembersApi(
            $oauthProvider,
            $this->httpClient,
            $psr17Factory,
            new Configuration()
        );

        $invoicesApi = new InvoicesApi(
            $oauthProvider,
            $this->httpClient,
            $psr17Factory,
            new Configuration()
        );

        $mfaApi = new MFAApi(
            $oauthProvider,
            $this->httpClient,
            $psr17Factory,
            new Configuration()
        );

        $ordersApi = new OrdersApi(
            $oauthProvider,
            $this->httpClient,
            $psr17Factory,
            new Configuration()
        );

        $profilesApi = new ProfilesApi(
            $oauthProvider,
            $this->httpClient,
            $psr17Factory,
            new Configuration()
        );

        $recordsApi = new RecordsApi(
            $oauthProvider,
            $this->httpClient,
            $psr17Factory,
            new Configuration()
        );

        $vouchersApi = new VouchersApi(
            $oauthProvider,
            $this->httpClient,
            $psr17Factory,
            new Configuration()
        );

        $addsOnApi = new AddOnsApi(
            $oauthProvider,
            $this->httpClient,
            $psr17Factory,
            new Configuration()
        );

        $this->organizationTask = new class (
            $upsunClient,
            $organizationsApi,
            $organizationProjectsApi,
            $organizationMembersApi,
            $subscriptionsApi,
            $invoicesApi,
            $mfaApi,
            $ordersApi,
            $profilesApi,
            $recordsApi,
            $vouchersApi,
            $addsOnApi
        ) extends OrganizationTask {
        };
    }

    /**
     * @throws Exception
     */
    public function testCreateOrganization()
    {
        $data = [
            'ownerId' => 'user_7890',
            'label' => 'My Org Label',
            'name' => 'My Organization',
            'country' => 'FR',
            'type' => 'enterprise'
        ];

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'id' => 'org_123456',
                    'type' => 'enterprise',
                    'ownerId' => 'user_7890',
                    'namespace' => 'upsun',
                    'name' => 'My Organization',
                    'label' => 'My Org Label',
                    'country' => 'FR',
                    'capabilities' => [
                        'projects' => true,
                        'teams' => true,
                        'billing' => false,
                        'integrations' => ['github', 'gitlab'],
                    ],
                    'vendor' => 'Upsun Inc.',
                    'status' => 'active',
                    'createdAt' => '2025-09-10T08:00:00+00:00',
                    'updatedAt' => '2025-09-12T09:30:00+00:00',
                    'links' => [
                        'self' => 'https://api.upsun.com/organizations/org_123456',
                        'edit' => '/organizations/org_123456/edit',
                        'access' => '/organizations/org_123456/access',
                    ],
                ])
            ));

        $result = $this->organizationTask->create($data);
        $this->assertInstanceOf(Organization::class, $result);
        $this->assertEquals("org_123456", $result->getId());
        $this->assertEquals($data['name'], $result->getName());
        $this->assertEquals($data['label'], $result->getLabel());
        $this->assertEquals($data['ownerId'], $result->getOwnerId());
        $this->assertEquals($data['country'], $result->getCountry());
        $this->assertEquals($data['type'], $result->getType());
    }

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
        $this->organizationTask->delete('org_123');
    }

    public function testGetOrganization()
    {
        $orgId = 'org_123';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'id' => 'org_654321',
                    'type' => 'startup',
                    'ownerId' => 'user_9876',
                    'namespace' => 'devhub',
                    'name' => 'DevHub Organization',
                    'label' => 'DevHub Org',
                    'country' => 'US',
                    'capabilities' => [
                        'projects' => true,
                        'teams' => false,
                        'billing' => false,
                        'integrations' => ['bitbucket'],
                    ],
                    'vendor' => 'DevHub Ltd.',
                    'status' => 'suspended',
                    'createdAt' => '2025-08-01T10:20:00+00:00',
                    'updatedAt' => '2025-09-05T15:00:00+00:00',
                    'links' => [
                        'self' => 'https://api.upsun.com/organizations/org_654321',
                        'edit' => '/organizations/org_654321/edit',
                        'access' => '/organizations/org_654321/access',
                    ],
                ])
            ));

        $result = $this->organizationTask->get($orgId);
        $this->assertEquals("org_654321", $result->getId());
        $this->assertEquals("user_9876", $result->getOwnerId());
    }

    /**
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
                    'id' => 'org_123456',
                    'type' => 'enterprise',
                    'ownerId' => 'user_7890',
                    'namespace' => 'upsun',
                    'name' => 'My First Organization',
                    'label' => 'First Org',
                    'country' => 'FR',
                    'capabilities' => [
                        'projects' => true,
                        'teams' => true,
                        'billing' => true,
                        'integrations' => ['github', 'gitlab'],
                    ],
                    'vendor' => 'Upsun Inc.',
                    'status' => 'active',
                    'createdAt' => '2025-09-10T08:00:00+00:00',
                    'updatedAt' => '2025-09-12T09:30:00+00:00',
                    'links' => [
                        'self' => 'https://api.upsun.com/organizations/org_123456',
                        'edit' => '/organizations/org_123456/edit',
                        'access' => '/organizations/org_123456/access',
                    ],
                ],
                [
                    'id' => 'org_654321',
                    'type' => 'startup',
                    'ownerId' => 'user_9876',
                    'namespace' => 'devhub',
                    'name' => 'DevHub Organization',
                    'label' => 'DevHub Org',
                    'country' => 'US',
                    'capabilities' => [
                        'projects' => true,
                        'teams' => false,
                        'billing' => false,
                        'integrations' => ['bitbucket'],
                    ],
                    'vendor' => 'DevHub Ltd.',
                    'status' => 'suspended',
                    'createdAt' => '2025-08-01T10:20:00+00:00',
                    'updatedAt' => '2025-09-05T15:00:00+00:00',
                    'links' => [
                        'self' => 'https://api.upsun.com/organizations/org_654321',
                        'edit' => '/organizations/org_654321/edit',
                        'access' => '/organizations/org_654321/access',
                    ],
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

        $result = $this->organizationTask->list();
        $this->assertEquals($organizations['items'][0]['id'], $result->getItems()[0]->getId());
        $this->assertEquals($organizations['items'][0]['ownerId'], $result->getItems()[0]->getOwnerId());
        $this->assertEquals($organizations['items'][0]['name'], $result->getItems()[0]->getName());
        $this->assertEquals($organizations['items'][1]['id'], $result->getItems()[1]->getId());
        $this->assertEquals($organizations['items'][1]['ownerId'], $result->getItems()[1]->getOwnerId());
        $this->assertEquals($organizations['items'][1]['name'], $result->getItems()[1]->getName());
    }

    public function testListUserOrganizations()
    {
        $organizations = [
            'links' => [
                'self' => ['href' => 'href'],
                'previous' => ['href' => 'href'],
                'next' => ['href' => 'href'],
            ],
            'items' => [
                [
                    'id' => 'org_123456',
                    'type' => 'enterprise',
                    'ownerId' => 'user_9876',
                    'namespace' => 'upsun',
                    'name' => 'My First Organization',
                    'label' => 'First Org',
                    'country' => 'FR',
                    'capabilities' => [
                        'projects' => true,
                        'teams' => true,
                        'billing' => true,
                        'integrations' => ['github', 'gitlab'],
                    ],
                    'vendor' => 'Upsun Inc.',
                    'status' => 'active',
                    'createdAt' => '2025-09-10T08:00:00+00:00',
                    'updatedAt' => '2025-09-12T09:30:00+00:00',
                    'links' => [
                        'self' => 'https://api.upsun.com/organizations/org_123456',
                        'edit' => '/organizations/org_123456/edit',
                        'access' => '/organizations/org_123456/access',
                    ],
                ],
                [
                    'id' => 'org_654321',
                    'type' => 'startup',
                    'ownerId' => 'user_9876',
                    'namespace' => 'devhub',
                    'name' => 'DevHub Organization',
                    'label' => 'DevHub Org',
                    'country' => 'US',
                    'capabilities' => [
                        'projects' => true,
                        'teams' => false,
                        'billing' => false,
                        'integrations' => ['bitbucket'],
                    ],
                    'vendor' => 'DevHub Ltd.',
                    'status' => 'suspended',
                    'createdAt' => '2025-08-01T10:20:00+00:00',
                    'updatedAt' => '2025-09-05T15:00:00+00:00',
                    'links' => [
                        'self' => 'https://api.upsun.com/organizations/org_654321',
                        'edit' => '/organizations/org_654321/edit',
                        'access' => '/organizations/org_654321/access',
                    ],
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
        $result = $this->organizationTask->listUserOrgs($ownerId);
        $this->assertEquals($organizations['items'][0]['id'], $result->getItems()[0]->getId());
        $this->assertEquals($ownerId, $result->getItems()[0]->getOwnerId());
        $this->assertEquals($organizations['items'][0]['name'], $result->getItems()[0]->getName());
        $this->assertEquals($organizations['items'][1]['id'], $result->getItems()[1]->getId());
        $this->assertEquals($ownerId, $result->getItems()[1]->getOwnerId());
        $this->assertEquals($organizations['items'][1]['name'], $result->getItems()[1]->getName());
    }

    public function testListCurrentUserOrganizations()
    {
        $organizations = [
            'links' => [
                'self' => ['href' => 'href'],
                'previous' => ['href' => 'href'],
                'next' => ['href' => 'href'],
            ],
            'items' => [
                [
                    'id' => 'org_123456',
                    'type' => 'enterprise',
                    'ownerId' => 'user_9876',
                    'namespace' => 'upsun',
                    'name' => 'My First Organization',
                    'label' => 'First Org',
                    'country' => 'FR',
                    'capabilities' => [
                        'projects' => true,
                        'teams' => true,
                        'billing' => true,
                        'integrations' => ['github', 'gitlab'],
                    ],
                    'vendor' => 'Upsun Inc.',
                    'status' => 'active',
                    'createdAt' => '2025-09-10T08:00:00+00:00',
                    'updatedAt' => '2025-09-12T09:30:00+00:00',
                    'links' => [
                        'self' => 'https://api.upsun.com/organizations/org_123456',
                        'edit' => '/organizations/org_123456/edit',
                        'access' => '/organizations/org_123456/access',
                    ],
                ],
                [
                    'id' => 'org_654321',
                    'type' => 'startup',
                    'ownerId' => 'user_9876',
                    'namespace' => 'devhub',
                    'name' => 'DevHub Organization',
                    'label' => 'DevHub Org',
                    'country' => 'US',
                    'capabilities' => [
                        'projects' => true,
                        'teams' => false,
                        'billing' => false,
                        'integrations' => ['bitbucket'],
                    ],
                    'vendor' => 'DevHub Ltd.',
                    'status' => 'suspended',
                    'createdAt' => '2025-08-01T10:20:00+00:00',
                    'updatedAt' => '2025-09-05T15:00:00+00:00',
                    'links' => [
                        'self' => 'https://api.upsun.com/organizations/org_654321',
                        'edit' => '/organizations/org_654321/edit',
                        'access' => '/organizations/org_654321/access',
                    ],
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
        $result = $this->organizationTask->listCurrentUserOrgs();
        $this->assertEquals($organizations['items'][0]['id'], $result->getItems()[0]->getId());
        $this->assertEquals($ownerId, $result->getItems()[0]->getOwnerId());
        $this->assertEquals($organizations['items'][0]['name'], $result->getItems()[0]->getName());
        $this->assertEquals($organizations['items'][1]['id'], $result->getItems()[1]->getId());
        $this->assertEquals($ownerId, $result->getItems()[1]->getOwnerId());
        $this->assertEquals($organizations['items'][1]['name'], $result->getItems()[1]->getName());
    }

    /**
     * @throws Exception
     */
    public function testUpdateOrganization()
    {

        $orgId = 'project-123';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'id' => 'org_654321',
                    'type' => 'startup',
                    'ownerId' => 'user_9876',
                    'namespace' => 'devhub',
                    'name' => 'upsun-cloud',
                    'label' => 'Upsun Cloud Europe',
                    'country' => 'FR',
                    'capabilities' => [
                        'projects' => true,
                        'teams' => false,
                        'billing' => false,
                        'integrations' => ['bitbucket'],
                    ],
                    'vendor' => 'DevHub Ltd.',
                    'status' => 'suspended',
                    'createdAt' => '2025-08-01T10:20:00+00:00',
                    'updatedAt' => '2025-09-05T15:00:00+00:00',
                    'links' => [
                        'self' => 'https://api.upsun.com/organizations/org_654321',
                        'edit' => '/organizations/org_654321/edit',
                        'access' => '/organizations/org_654321/access',
                    ],
                ])
            ));

        $data = [
            'name' => 'upsun-cloud',
            'label' => 'Upsun Cloud Europe',
            'country' => 'FR',
        ];

        $result = $this->organizationTask->update($orgId, $data);
        $this->assertInstanceOf(Organization::class, $result);
        $this->assertEquals($data['name'], $result->getName());
        $this->assertEquals($data['label'], $result->getLabel());
        $this->assertEquals($data['country'], $result->getCountry());
    }

    public function testCreateMember()
    {
        $orgId = 'org_98765';
        $userId = 'user_54321';
        $permissions = ['read', 'write', 'admin'];
        $organizationMemberData = [
            'id' => 'member_12345',
            'organizationId' => 'org_98765',
            'userId' => 'user_54321',
            'permissions' => ['read', 'write', 'admin'],
            'level' => 'maintainer',
            'owner' => true,
            'createdAt' => '2025-01-15T08:00:00+00:00',
            'updatedAt' => '2025-09-10T14:20:00+00:00',
            'links' => [
                'self' => 'https://api.upsun.com/orgs/org_98765/members/member_12345',
                'user' => 'https://api.upsun.com/users/user_54321',
            ],
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($organizationMemberData)
            ));

        $result = $this->organizationTask->createMember($orgId, $userId, $permissions);
        $this->assertInstanceOf(OrganizationMember::class, $result);
        $this->assertEquals($userId, $result->getUserId());
        $this->assertEquals(['read', 'write', 'admin'], $result->getPermissions());
    }

    public function testUpdateMember()
    {
        $permissions = ['read', 'write', 'admin'];

        $organizationMemberData = [
            'id' => 'member_12345',
            'organizationId' => 'org_98765',
            'userId' => 'user_54321',
            'permissions' => ['read', 'write', 'admin'],
            'level' => 'maintainer',
            'owner' => true,
            'createdAt' => '2025-01-15T08:00:00+00:00',
            'updatedAt' => '2025-09-10T14:20:00+00:00',
            'links' => [
                'self' => 'https://api.upsun.com/orgs/org_98765/members/member_12345',
                'user' => 'https://api.upsun.com/users/user_54321',
            ],
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($organizationMemberData)
            ));

        $response = $this->organizationTask->updateMember('org_123', 'user_1', $permissions);
        $this->assertInstanceOf(OrganizationMember::class, $response);
        $this->assertEquals(['read', 'write', 'admin'], $response->getPermissions());
    }

    public function testGetMember()
    {
        $orgId = 'org_98765';
        $userId = 'user_54321';

        $organizationMemberData = [
            'id' => 'member_12345',
            'organizationId' => 'org_98765',
            'userId' => 'user_54321',
            'permissions' => ['read', 'write', 'admin'],
            'level' => 'admin',
            'owner' => true,
            'createdAt' => '2025-01-15T08:00:00+00:00',
            'updatedAt' => '2025-09-10T14:20:00+00:00',
            'links' => [
                'self' => 'https://api.upsun.com/orgs/org_98765/members/member_12345',
                'user' => 'https://api.upsun.com/users/user_54321',
            ],
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($organizationMemberData)
            ));

        $response = $this->organizationTask->getMember($orgId, $userId);
        $this->assertInstanceOf(OrganizationMember::class, $response);
        $this->assertEquals($userId, $response->getUserId());
        $this->assertEquals($orgId, $response->getOrganizationId());
        $this->assertEquals(['read', 'write', 'admin'], $response->getPermissions());
    }

    public function testListMembers()
    {
        $orgId = 'org_98765';

        $organizationMembersData = [
            "count" => 1,
            "items" => [
                [
                    'id' => 'member_12345',
                    'organizationId' => 'org_98765',
                    'userId' => 'user_54321',
                    'permissions' => ['read', 'write', 'admin'],
                    'level' => 'admin',
                    'owner' => true,
                    'createdAt' => '2025-01-15T08:00:00+00:00',
                    'updatedAt' => '2025-09-10T14:20:00+00:00',
                    'links' => [
                        'self' => 'https://api.upsun.com/orgs/org_98765/members/member_12345',
                        'user' => 'https://api.upsun.com/users/user_54321',
                    ],
                ],
                [
                    'id' => 'member_67890',
                    'organizationId' => 'org_98765',
                    'userId' => 'user_54321',
                    'permissions' => ['read', 'write'],
                    'level' => 'maintainer',
                    'owner' => true,
                    'createdAt' => '2025-01-15T08:00:00+00:00',
                    'updatedAt' => '2025-09-10T14:20:00+00:00',
                    'links' => [
                        'self' => 'https://api.upsun.com/orgs/org_98765/members/member_12345',
                        'user' => 'https://api.upsun.com/users/user_54321',
                    ],
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

        $response = $this->organizationTask->listMembers($orgId);
        $members = $response->getItems();
        $this->assertContainsOnlyInstancesOf(OrganizationMember::class, $members);
        $this->assertEquals($orgId, $members[0]->getOrganizationId());
        $this->assertEquals(['read', 'write', 'admin'], $members[0]->getPermissions());
        $this->assertEquals($orgId, $members[1]->getOrganizationId());
        $this->assertEquals(['read', 'write'], $members[1]->getPermissions());
    }

    /**
     * @throws Exception
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
        $this->organizationTask->deleteMember('org_123', 'user_1');
    }

    /**
     * @throws Exception
     */
    public function testListTeams()
    {
        $orgId = 'fake-org-id-5678';

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
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
                ])
            ));

        $response = $this->organizationTask->listTeams($orgId);
        $teams = $response->getItems();
        $this->assertContainsOnlyInstancesOf(Team::class, $teams);
        $this->assertEquals($orgId, $teams[0]->getOrganizationId());
        $this->assertEquals(
            ["admin", "production:admin", "staging:contributor", "development:viewer"],
            $teams[0]->getProjectPermissions()
        );
        $this->assertEquals($orgId, $teams[1]->getOrganizationId());
        $this->assertEquals(['admin'], $teams[1]->getProjectPermissions());
    }

    public function testGetProject()
    {
        $orgId = 'fake-org-5678';
        $projectId = 'fake-proj-1234';

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode(
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
                    ]
                )
            ));

        $result = $this->organizationTask->getProject($orgId, $projectId);
        $this->assertInstanceOf(OrganizationProject::class, $result);
        $this->assertEquals($projectId, $result->getId());
        $this->assertEquals($orgId, $result->getOrganizationId());
    }

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

        $response = $this->organizationTask->listProjects($orgId);
        $projects = $response->getItems();
        $this->assertIsArray($projects);
        $this->assertContainsOnlyInstancesOf(OrganizationProject::class, $projects);
        $this->assertEquals("fake-proj-1234", $projects[0]->getId());
        $this->assertEquals($orgId, $projects[0]->getOrganizationId());
        $this->assertEquals("fake-proj-5678", $projects[1]->getId());
        $this->assertEquals($orgId, $projects[1]->getOrganizationId());
    }

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

        $result = $this->organizationTask->canCreateProject($orgId);
        $this->assertInstanceOf(CanCreateNewOrgSubscription200Response::class, $result);
        $this->assertTrue($result->getCanCreate());
    }

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

        $response = $this->organizationTask->createProject($orgId, $data);
        $this->assertInstanceOf(Subscription::class, $response);
        $this->assertEquals($data['projectRegion'], $response->getProjectRegion());
    }

    /**
     * @throws Exception
     */
    public function testDeleteProject()
    {
        $projectId = 'proj-1';
        $organizationId = 'org-1';

        $this->httpClient
            ->expects($this->atMost(2))
            ->method('sendRequest')
            ->willReturnOnConsecutiveCalls(
                new Response(
                    200,
                    ['Content-Type' => 'application/json'],
                    json_encode([
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
                    ])
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

        $this->organizationTask->deleteProject($organizationId, $projectId);
    }

    public function testUpdateProject()
    {
        $prjId = 'proj_1';
        $data = [
            'defaultBranch' => 'main',
            'defaultDomain' => 'example.com',
            'attributes' => [
                'featureFlag' => true,
                'maintenanceMode' => false,
            ],
            'title' => 'Projet Fake',
            'description' => 'Ceci est un projet simulé pour les tests',
            'timezone' => 'America/New_York',
            'region' => 'us.platform.sh',
        ];

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode([
                    'status' => 'accepted',
                    'code' => 200
                ])
            ));

        $response = $this->organizationTask->updateProject($prjId, $data);

        $this->assertEquals(new AcceptedResponse('accepted', 200), $response);
    }

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

        $response = $this->organizationTask->estimateNewProject(
            $orgId,
            $estimationObject['environments'],
            $estimationObject['storage'],
            $estimationObject['userLicenses'],
            $estimationObject['format'],
        );
        $this->assertInstanceOf(EstimationObject::class, $response);
        $this->assertEquals($estimationObject['plan'], $response->getPlan());
        $this->assertEquals($estimationObject['userLicenses'], $response->getUserLicenses());
        $this->assertEquals($estimationObject['environments'], $response->getEnvironments());
        $this->assertEquals($estimationObject['storage'], $response->getStorage());
        $this->assertEquals((object)$estimationObject['options'], $response->getOptions());
    }

    /**
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

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($estimationObject)
            ));

        $response = $this->organizationTask->estimateProject(
            $orgId,
            $prjId,
            $estimationObject['environments'],
            $estimationObject['storage'],
            $estimationObject['userLicenses'],
            $estimationObject['format'],
        );
        $this->assertInstanceOf(EstimationObject::class, $response);
        $this->assertObjectProperties($response, $estimationObject);
    }

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

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($currentUsageData)
            ));

        $response = $this->organizationTask->getProjectUsage(
            $orgId,
            $prjId,
            'usageGroups',
            true
        );
        $this->assertInstanceOf(SubscriptionCurrentUsageObject::class, $response);
        $this->assertObjectProperties($response, $currentUsageData);
    }

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

        $this->organizationTask->disableMfaEnforcement($orgId);
    }

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
            'type' => 'invoice', // ou 'credit_memo'
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

        $result = $this->organizationTask->getInvoice(
            $invoiceData['id'],
            'org-123'
        );
        $this->assertInstanceOf(Invoice::class, $result);
        $this->assertObjectProperties($result, $invoiceData);
    }

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

        $result = $this->organizationTask->getAddress('org-123');
        $this->assertInstanceOf(Address::class, $result);
        $this->assertObjectProperties($result, $data);
    }

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

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($data)
            ));

        $response = $this->organizationTask->listUsageRecords('org-123');
        $this->assertInstanceOf(ListOrgUsageRecords200Response::class, $response);
        $this->assertObjectProperties($response->getItems(), $data['items']);
    }

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

        $result = $this->organizationTask->listVouchers('org-123');
        $this->assertInstanceOf(Vouchers::class, $result);
        $this->assertObjectProperties($result, $data);
    }

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

        $this->organizationTask->enableMfaEnforcement('org-123');
    }

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

        $result = $this->organizationTask->getMfaEnforcement('org-123');
        $this->assertInstanceOf(OrganizationMFAEnforcement::class, $result);
        $this->assertObjectProperties($result, $data);
    }

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

        $result = $this->organizationTask->sendMfaReminders(
            'org-123',
            [
                'userIds' => [
                    'user-123-abc',
                    'user-456-def',
                    'user-789-ghi',
                ],
            ]
        );
        $this->assertContainsOnlyInstancesOf(SendOrgMfaReminders200ResponseValue::class, $result);
    }

    public function testListInvoices(): void
    {
        $data = [
            [
                'id' => 'inv_001',
                'invoice_number' => '2025-0001',
                'type' => 'invoice', // ou 'credit_memo'
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

        $result = $this->organizationTask->listInvoices('org-123');
        $this->assertInstanceOf(ListOrgInvoices200Response::class, $result);
        $this->assertContainsOnlyInstancesOf(Invoice::class, $result->getItems());
        $this->assertObjectProperties($result, $data);
    }

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
        $result = $this->organizationTask->createAuthorizationCredentials($orgId, $orderId);
        $this->assertInstanceOf(CreateAuthorizationCredentials200Response::class, $result);
        $this->assertObjectProperties($result, $data);
    }

//    public function testDownloadInvoice(): void
//    {
//        $data = [
//            'type' => 'redirect',
//            'redirect_to_url' => [
//                'return_url' => 'https://example.com/payment/return',
//                'url' => 'https://api.platform.sh/api/platform/orders/download?token=eyJ0eXAiOiJKV1QiLCJhbGciO',
//            ],
//        ];
//
//        $this->httpClient
//            ->expects($this->once())
//            ->method('sendRequest')
//            ->willReturn(new Response(
//                200,
//                ['Content-Type' => 'application/json'],
//                json_encode($data)
//            ));
//
//        $return = $this->organizationTask->downloadInvoice('token_123');
//        var_dump($return);
//    }

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

        $result = $this->organizationTask->getOrder('org-123', 'order-001');
        $this->assertInstanceOf(Order::class, $result);
        $this->assertObjectProperties($result, $data);
    }

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

        $result = $this->organizationTask->listOrders('org-123', 'completed');
        $this->assertInstanceOf(ListOrgOrders200Response::class, $result);
        $this->assertContainsOnlyInstancesOf(Order::class, $result->getItems());
        $this->assertObjectProperties($result, $data);
    }

    /**
     * @throws Exception
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
            'securityContact' => 'security@example.com',
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

        $result = $this->organizationTask->getProfile('org-123');
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

        $result = $this->organizationTask->updateAddress('org-123', $fakeAddressData);
        $this->assertInstanceOf(Address::class, $result);
        $this->assertObjectProperties($result, $fakeAddressData);
    }

    /**
     * @throws Exception
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
            'securityContact' => 'security@example.com',
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
            'securityContact' => 'security@example.com',
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

        $result = $this->organizationTask->updateProfile('org-123', $fakeUpdateOrgProfileRequestData);
        $this->assertInstanceOf(Profile::class, $result);
        $this->assertObjectProperties($result, $data);
    }

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

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode($fakeListOrgPlanRecords200ResponseData)
            ));

        $result = $this->organizationTask->listRecords('org-123');
        $this->assertInstanceOf(ListOrgPlanRecords200Response::class, $result);
        $this->assertContainsOnlyInstancesOf(PlanRecords::class, $result->getItems());
        $this->assertObjectProperties($result, $fakeListOrgPlanRecords200ResponseData);
    }

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

        $this->organizationTask->applyVoucher('org-123', $code);
    }

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

        $result = $this->organizationTask->getAddons('org-123');
        $this->assertInstanceOf(OrganizationAddonsObject::class, $result);
        $this->assertObjectProperties($result, $addonsData);
    }

    public function testUpdateAddons(): void
    {
        $fakeUpdateOrgAddonsRequest = [
            'userManagement' => 'standard', // or "enhanced"
            'supportLevel'   => 'basic',    // or "premium"
        ];

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

        $result = $this->organizationTask->updateAddons('org-123', $fakeUpdateOrgAddonsRequest);
        $this->assertSame(
            ['standard' => 200],
            $result->getCurrent()->getUserManagement()
        );
        $this->assertSame(
            ['basic' => 90],
            $result->getCurrent()->getSupportLevel()
        );
    }
}
