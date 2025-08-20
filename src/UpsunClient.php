<?php

namespace Upsun;

use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;
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

class UpsunClient
{
    public HttplugClient $apiClient;
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

        $this->apiClient = new HttplugClient();

        $httpClient = Psr18ClientDiscovery::find(); // découvre automatiquement curl-client
        $requestFactory = Psr17FactoryDiscovery::findRequestFactory();

        $this->auth = new OAuthProvider(
            $httpClient,
            $requestFactory,
            tokenEndpoint: $this->upsunConfig->auth_url . "/" . $this->upsunConfig->token_endpoint,
            clientId: $this->upsunConfig->clientId,
            clientSecret: $this->upsunConfig->apiKey,
        );

        // Initialize the commands tasks.
        $this->activity = new ActivityTask(
            $this,
            new ProjectActivityApi($this->apiClient, $this->apiConfig),
            new EnvironmentActivityApi($this->apiClient, $this->apiConfig)
        );
        $this->application = new ApplicationTask(
            $this,
            new DeploymentApi($this->apiClient, $this->apiConfig)
        );
        $this->backup = new BackupTask(
            $this,
            new EnvironmentBackupsApi($this->apiClient, $this->apiConfig)
        );
        $this->certificate = new CertificateTask(
            $this,
            new CertManagementApi($this->apiClient, $this->apiConfig)
        );
        $this->domain = new DomainTask(
            $this,
            new DomainManagementApi($this->apiClient, $this->apiConfig)
        );
        $this->environment = new EnvironmentTask(
            $this,
            new EnvironmentApi($this->apiClient, $this->apiConfig),
            new EnvironmentTypeApi($this->apiClient, $this->apiConfig),
            new DeploymentApi($this->apiClient, $this->apiConfig),
        );
        $this->invitations = new InvitationTask(
            $this,
            new OrganizationInvitationsApi($this->apiClient, $this->apiConfig),
            new ProjectInvitationsApi($this->apiClient, $this->apiConfig),
        );
        $this->metrics = new MetricsTask($this);
        $this->mount = new MountTask($this);
        $this->operation = new OperationTask(
            $this,
            new RuntimeOperationsApi($this->apiClient, $this->apiConfig)
        );
        $this->organization = new OrganizationTask(
            $this,
            new HeaderSelector(),
            new OrganizationsApi($this->apiClient, $this->apiConfig),
            new OrganizationProjectsApi($this->apiClient, $this->apiConfig),
            new OrganizationMembersApi($this->apiClient, $this->apiConfig),
            new SubscriptionsApi($this->apiClient, $this->apiConfig),
            new InvoicesApi($this->apiClient, $this->apiConfig),
            new MFAApi($this->apiClient, $this->apiConfig),
            new OrdersApi($this->apiClient, $this->apiConfig),
            new ProfilesApi($this->apiClient, $this->apiConfig),
            new RecordsApi($this->apiClient, $this->apiConfig),
            new VouchersApi($this->apiClient, $this->apiConfig),
        );
        $this->project = new ProjectTask(
            $this,
            new ProjectApi($this->apiClient, $this->apiConfig),
            new ProjectSettingsApi($this->apiClient, $this->apiConfig),
            new DeploymentTargetApi($this->apiClient, $this->apiConfig),
            new RepositoryApi($this->apiClient, $this->apiConfig),
            new SystemInformationApi($this->apiClient, $this->apiConfig),
            new ThirdPartyIntegrationsApi($this->apiClient, $this->apiConfig),
            new SubscriptionsApi($this->apiClient, $this->apiConfig),
            new OrganizationProjectsApi($this->apiClient, $this->apiConfig)
        );
        $this->region = new RegionTask(
            $this,
            new RegionsApi($this->apiClient, $this->apiConfig)
        );
        $this->resource = new ResourcesTask(
            $this
        );
        $this->route = new RouteTask(
            $this,
            new RoutingApi($this->apiClient, $this->apiConfig)
        );
        $this->sourceOperation = new SourceOperationTask(
            $this,
            new SourceOperationsApi($this->apiClient, $this->apiConfig)
        );
        $this->team = new TeamTask(
            $this,
            new TeamsApi($this->apiClient, $this->apiConfig),
            new TeamAccessApi($this->apiClient, $this->apiConfig),
        );
        $this->supportTicket = new SupportTicketTask(
            $this,
            new DefaultApi($this->apiClient, $this->apiConfig),
            new SupportApi($this->apiClient, $this->apiConfig)
        );
        $this->user = new UserTask(
            $this,
            new UsersApi($this->apiClient, $this->apiConfig),
            new UserProfilesApi($this->apiClient, $this->apiConfig),
            new UserAccessApi($this->apiClient, $this->apiConfig),
            new APITokensApi($this->apiClient, $this->apiConfig),
            new ConnectionsApi($this->apiClient, $this->apiConfig),
            new GrantsApi($this->apiClient, $this->apiConfig),
            new MFAApi($this->apiClient, $this->apiConfig),
            new PhoneNumberApi($this->apiClient, $this->apiConfig),
        );
        $this->variables = new VariableTask(
            $this,
            new ProjectVariablesApi($this->apiClient, $this->apiConfig),
            new EnvironmentVariablesApi($this->apiClient, $this->apiConfig),
        );
        $this->worker = new WorkerTask(
            $this,
            new DeploymentApi($this->apiClient, $this->apiConfig)
        );
    }

    public function getUserId()
    {
        if (!$this->userId) {
            $this->userId = $this->user->me()->getId();
        }

        return $this->userId;
    }

    public function getToken()
    {
        return $this->upsunConfig->apiKey;
    }

    public function getApiClient(): HttplugClient
    {
        return $this->apiClient;
    }

    public function getApiConfig(): Configuration
    {
        return $this->apiConfig;
    }
}
