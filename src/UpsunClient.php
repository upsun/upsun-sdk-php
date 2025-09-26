<?php

namespace Upsun;

use Http\Client\Common\PluginClient;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;
use Psr\Http\Client\ClientInterface;
use Symfony\Component\HttpClient\Psr18Client;
use Upsun\Api\AddOnsApi;
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
use Symfony\Component\HttpClient\HttplugClient;
use Upsun\Core\OAuthProvider;
use Upsun\Core\Tasks\ActivityTask;
use Upsun\Core\Tasks\ApplicationTask;
use Upsun\Core\Tasks\BackupTask;
use Upsun\Core\Tasks\CertificateTask;
use Upsun\Core\Tasks\DomainTask;
use Upsun\Core\Tasks\EnvironmentTask;
use Upsun\Core\Tasks\InvitationTask;
use Upsun\Core\Tasks\MetricsTask;
use Upsun\Core\Tasks\MountTask;
use Upsun\Core\Tasks\OperationTask;
use Upsun\Core\Tasks\OrganizationTask;
use Upsun\Core\Tasks\ProjectTask;
use Upsun\Core\Tasks\RegionTask;
use Upsun\Core\Tasks\ResourcesTask;
use Upsun\Core\Tasks\RouteTask;
use Upsun\Core\Tasks\SourceOperationTask;
use Upsun\Core\Tasks\SupportTicketTask;
use Upsun\Core\Tasks\TeamTask;
use Upsun\Core\Tasks\UserTask;
use Upsun\Core\Tasks\VariableTask;
use Upsun\Core\Tasks\WorkerTask;

/**
 * Upsun Client to interact with the API.
 *
 * @author    Upsun SDK Team
 * @license   Apache-2.0
 * @see       https://docs.upsun.com
 */
class UpsunClient
{
    public ClientInterface $apiClient;

    public Configuration $apiConfig;

    public OAuthProvider $auth;

    public ?string $userId = null;

    public ActivityTask $activity;

    public ApplicationTask $application;

    public BackupTask $backup;

    public CertificateTask $certificate;

    public DomainTask $domain;

    public EnvironmentTask $environment;

    public InvitationTask $invitations;

    public MetricsTask $metrics;

    public MountTask $mount;

    public OperationTask $operation;

    public OrganizationTask $organization;

    public ProjectTask $project;

    public RegionTask $region;

    public ResourcesTask $resource;

    public RouteTask $route;

    public SourceOperationTask $sourceOperation;

    public TeamTask $team;

    public SupportTicketTask $supportTicket;

    public UserTask $user;

    public VariableTask $variables;

    public WorkerTask $worker;

    public function __construct(protected UpsunConfig $upsunConfig)
    {
        $this->apiConfig = Configuration::getDefaultConfiguration()
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

        // Initialize the commands tasks.
        $this->activity = new ActivityTask(
            $this,
            new ProjectActivityApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig),
            new EnvironmentActivityApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig)
        );
        $this->application = new ApplicationTask(
            $this,
            new DeploymentApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig)
        );
        $this->backup = new BackupTask(
            $this,
            new EnvironmentBackupsApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig)
        );
        $this->certificate = new CertificateTask(
            $this,
            new CertManagementApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig)
        );
        $this->domain = new DomainTask(
            $this,
            new DomainManagementApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig)
        );
        $this->environment = new EnvironmentTask(
            $this,
            new EnvironmentApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig),
            new EnvironmentTypeApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig),
            new DeploymentApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig),
        );
        $this->invitations = new InvitationTask(
            $this,
            new OrganizationInvitationsApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig),
            new ProjectInvitationsApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig),
        );
        $this->metrics = new MetricsTask($this);
        $this->mount = new MountTask($this);
        $this->operation = new OperationTask(
            $this,
            new RuntimeOperationsApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig)
        );
        $this->organization = new OrganizationTask(
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
        $this->project = new ProjectTask(
            $this,
            new ProjectApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig),
            new ProjectSettingsApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig),
            new DeploymentTargetApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig),
            new RepositoryApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig),
            new SystemInformationApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig),
            new ThirdPartyIntegrationsApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig),
            new SubscriptionsApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig),
        );
        $this->region = new RegionTask(
            $this,
            new RegionsApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig)
        );
        $this->resource = new ResourcesTask(
            $this,
            new DeploymentApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig)
        );
        $this->route = new RouteTask(
            $this,
            new RoutingApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig)
        );
        $this->sourceOperation = new SourceOperationTask(
            $this,
            new SourceOperationsApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig)
        );
        $this->team = new TeamTask(
            $this,
            new TeamsApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig),
            new TeamAccessApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig),
        );
        $this->supportTicket = new SupportTicketTask(
            $this,
            new DefaultApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig),
            new SupportApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig)
        );
        $this->user = new UserTask(
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
        $this->variables = new VariableTask(
            $this,
            new ProjectVariablesApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig),
            new EnvironmentVariablesApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig),
        );
        $this->worker = new WorkerTask(
            $this,
            new DeploymentApi($this->auth, $this->apiClient, $requestFactory, $this->apiConfig)
        );
    }

    public function getToken(): string
    {
        return $this->upsunConfig->apiToken;
    }
}
