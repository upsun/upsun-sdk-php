<?php

namespace Upsun;

use Http\Discovery\Psr17FactoryDiscovery;
use Psr\Http\Client\ClientInterface;
use Symfony\Component\HttpClient\Psr18Client;
use Upsun\Api\AddOnsApi;
use Upsun\Api\ApiConfiguration;
use Upsun\Api\APITokensApi;
use Upsun\Api\CertManagementApi;
use Upsun\Api\ConnectionsApi;
use Upsun\Api\DefaultApi;
use Upsun\Api\DeploymentApi;
use Upsun\Api\DeploymentTargetApi;
use Upsun\Api\DomainManagementApi;
use Upsun\Api\EnvironmentActivityApi;
use Upsun\Api\EnvironmentApi;
use Upsun\Api\EnvironmentBackupsApi;
use Upsun\Api\EnvironmentTypeApi;
use Upsun\Api\EnvironmentVariablesApi;
use Upsun\Api\GrantsApi;
use Upsun\Api\InvoicesApi;
use Upsun\Api\MFAApi;
use Upsun\Api\OrdersApi;
use Upsun\Api\OrganizationInvitationsApi;
use Upsun\Api\OrganizationMembersApi;
use Upsun\Api\OrganizationProjectsApi;
use Upsun\Api\OrganizationsApi;
use Upsun\Api\PhoneNumberApi;
use Upsun\Api\ProfilesApi;
use Upsun\Api\ProjectActivityApi;
use Upsun\Api\ProjectApi;
use Upsun\Api\ProjectInvitationsApi;
use Upsun\Api\ProjectSettingsApi;
use Upsun\Api\ProjectVariablesApi;
use Upsun\Api\RecordsApi;
use Upsun\Api\RegionsApi;
use Upsun\Api\RepositoryApi;
use Upsun\Api\RoutingApi;
use Upsun\Api\RuntimeOperationsApi;
use Upsun\Api\SourceOperationsApi;
use Upsun\Api\SubscriptionsApi;
use Upsun\Api\SupportApi;
use Upsun\Api\SystemInformationApi;
use Upsun\Api\TeamAccessApi;
use Upsun\Api\TeamsApi;
use Upsun\Api\ThirdPartyIntegrationsApi;
use Upsun\Api\UserAccessApi;
use Upsun\Api\UserProfilesApi;
use Upsun\Api\UsersApi;
use Upsun\Api\VouchersApi;
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

/**
 * Upsun Client to interact with the API.
 *
 * @author    Upsun Advocacy Team
 * @license   MIT
 * @see       https://docs.upsun.com
 */
class UpsunClient
{
    public ClientInterface $apiClient;

    public ApiConfiguration $apiConfig;

    public OAuthProvider $auth;

    public ?string $userId = null;

    public ActivitiesTask $activities;

    public ApplicationsTask $applications;

    public BackupsTask $backups;

    public CertificatesTask $certificates;

    public DomainsTask $domains;

    public EnvironmentsTask $environments;

    public InvitationsTask $invitations;

    public MetricsTask $metrics;

    public MountsTask $mounts;

    public OperationsTask $operations;

    public OrganizationsTask $organizations;

    public ProjectsTask $projects;

    public RegionsTask $regions;

    public ResourcesTask $resources;

    public RoutesTask $routes;

    public SourceOperationsTask $sourceOperations;

    public TeamsTask $teams;

    public SupportTicketsTask $supportTickets;

    public UsersTask $users;

    public VariablesTask $variables;

    public WorkersTask $workers;

    public function __construct(protected UpsunConfig $upsunConfig)
    {
        $this->apiConfig = ApiConfiguration::getDefaultConfiguration()
            ->setHost($this->upsunConfig->base_url);

        // Symfony HTTP client compatible PSR-18
        $this->apiClient = new Psr18Client();

        $requestFactory = Psr17FactoryDiscovery::findRequestFactory();

        $this->auth = new OAuthProvider(
            $this->apiClient, // Symfony PSR-18 client
            $requestFactory,
            tokenEndpoint: $this->upsunConfig->auth_url . "/" . $this->upsunConfig->token_endpoint,
            clientId: $this->upsunConfig->clientId,
            clientSecret: $this->upsunConfig->apiToken,
        );

        // Initialize the command tasks.
        $this->activities = new ActivitiesTask(
            $this,
            new ProjectActivityApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig),
            new EnvironmentActivityApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig)
        );
        $this->applications = new ApplicationsTask(
            $this,
            new DeploymentApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig)
        );
        $this->backups = new BackupsTask(
            $this,
            new EnvironmentBackupsApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig)
        );
        $this->certificates = new CertificatesTask(
            $this,
            new CertManagementApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig)
        );
        $this->domains = new DomainsTask(
            $this,
            new DomainManagementApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig)
        );
        $this->environments = new EnvironmentsTask(
            $this,
            new EnvironmentApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig),
            new EnvironmentTypeApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig),
            new DeploymentApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig),
        );
        $this->invitations = new InvitationsTask(
            $this,
            new OrganizationInvitationsApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig),
            new ProjectInvitationsApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig),
        );
        $this->metrics = new MetricsTask($this);
        $this->mounts = new MountsTask($this);
        $this->operations = new OperationsTask(
            $this,
            new RuntimeOperationsApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig)
        );
        $this->organizations = new OrganizationsTask(
            $this,
            new OrganizationsApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig),
            new OrganizationProjectsApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig),
            new OrganizationMembersApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig),
            new SubscriptionsApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig),
            new InvoicesApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig),
            new MFAApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig),
            new OrdersApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig),
            new ProfilesApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig),
            new RecordsApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig),
            new VouchersApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig),
            new AddOnsApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig),
        );
        $this->projects = new ProjectsTask(
            $this,
            new ProjectApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig),
            new ProjectSettingsApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig),
            new DeploymentTargetApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig),
            new RepositoryApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig),
            new SystemInformationApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig),
            new ThirdPartyIntegrationsApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig),
            new SubscriptionsApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig),
        );
        $this->regions = new RegionsTask(
            $this,
            new RegionsApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig)
        );
        $this->resources = new ResourcesTask(
            $this,
            new DeploymentApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig)
        );
        $this->routes = new RoutesTask(
            $this,
            new RoutingApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig)
        );
        $this->sourceOperations = new SourceOperationsTask(
            $this,
            new SourceOperationsApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig)
        );
        $this->teams = new TeamsTask(
            $this,
            new TeamsApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig),
            new TeamAccessApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig),
        );
        $this->supportTickets = new SupportTicketsTask(
            $this,
            new DefaultApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig),
            new SupportApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig)
        );
        $this->users = new UsersTask(
            $this,
            new UsersApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig),
            new UserProfilesApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig),
            new UserAccessApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig),
            new APITokensApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig),
            new ConnectionsApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig),
            new GrantsApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig),
            new MFAApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig),
            new PhoneNumberApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig),
        );
        $this->variables = new VariablesTask(
            $this,
            new ProjectVariablesApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig),
            new EnvironmentVariablesApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig),
        );
        $this->workers = new WorkersTask(
            $this,
            new DeploymentApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig)
        );
    }

    public function getToken(): string
    {
        return $this->upsunConfig->apiToken;
    }
}
