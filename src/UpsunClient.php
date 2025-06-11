<?php

namespace Upsun;

use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;
use OpenAPI\Client\apisgen\APITokensApi;
use OpenAPI\Client\apisgen\CertManagementApi;
use OpenAPI\Client\apisgen\ConnectionsApi;
use OpenAPI\Client\apisgen\DefaultApi;
use OpenAPI\Client\apisgen\DeploymentApi;
use OpenAPI\Client\apisgen\DeploymentTargetApi;
use OpenAPI\Client\apisgen\DomainManagementApi;
use OpenAPI\Client\apisgen\EnvironmentActivityApi;
use OpenAPI\Client\apisgen\EnvironmentApi;
use OpenAPI\Client\apisgen\EnvironmentBackupsApi;
use OpenAPI\Client\apisgen\EnvironmentTypeApi;
use OpenAPI\Client\apisgen\EnvironmentVariablesApi;
use OpenAPI\Client\apisgen\GrantsApi;
use OpenAPI\Client\apisgen\InvoicesApi;
use OpenAPI\Client\apisgen\MFAApi;
use OpenAPI\Client\apisgen\OrdersApi;
use OpenAPI\Client\apisgen\OrganizationInvitationsApi;
use OpenAPI\Client\apisgen\OrganizationMembersApi;
use OpenAPI\Client\apisgen\OrganizationProjectsApi;
use OpenAPI\Client\apisgen\OrganizationsApi;
use OpenAPI\Client\apisgen\PhoneNumberApi;
use OpenAPI\Client\apisgen\ProfilesApi;
use OpenAPI\Client\apisgen\ProjectActivityApi;
use OpenAPI\Client\apisgen\ProjectApi;
use OpenAPI\Client\apisgen\ProjectInvitationsApi;
use OpenAPI\Client\apisgen\ProjectSettingsApi;
use OpenAPI\Client\apisgen\ProjectVariablesApi;
use OpenAPI\Client\apisgen\RecordsApi;
use OpenAPI\Client\apisgen\RegionsApi;
use OpenAPI\Client\apisgen\RepositoryApi;
use OpenAPI\Client\apisgen\RoutingApi;
use OpenAPI\Client\apisgen\RuntimeOperationsApi;
use OpenAPI\Client\apisgen\SourceOperationsApi;
use OpenAPI\Client\apisgen\SubscriptionsApi;
use OpenAPI\Client\apisgen\SupportApi;
use OpenAPI\Client\apisgen\SystemInformationApi;
use OpenAPI\Client\apisgen\TeamAccessApi;
use OpenAPI\Client\apisgen\TeamsApi;
use OpenAPI\Client\apisgen\ThirdPartyIntegrationsApi;
use OpenAPI\Client\apisgen\UserAccessApi;
use OpenAPI\Client\apisgen\UserProfilesApi;
use OpenAPI\Client\apisgen\UsersApi;
use OpenAPI\Client\apisgen\VouchersApi;
use OpenAPI\Client\Configuration;
use OpenAPI\Client\HeaderSelector;
use Symfony\Component\HttpClient\HttpClient;
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
        if ($this->userId == null) {
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