<?php

namespace Upsun;

use GuzzleHttp\Client;
use OpenAPI\Client\apisgen\EnvironmentActivityApi;
use OpenAPI\Client\apisgen\ProjectActivityApi;
use OpenAPI\Client\Configuration;

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
    public Client $apiClient;
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

        $this->upsunConfig = $upsunConfig;
        $this->apiConfig = Configuration::getDefaultConfiguration()
            ->setHost($this->upsunConfig->base_url);

        $this->apiClient = new Client();

        $this->auth = new OAuthProvider(
            tokenEndpoint: $this->upsunConfig->auth_url . "/" . $this->upsunConfig->token_endpoint,
            clientId: $this->upsunConfig->clientId,
            clientSecret: $this->upsunConfig->apiKey,
        );

        // Initialize the commands tasks.
        $this->activity = new ActivityTask(
            new ProjectActivityApi($this->apiClient, $this->apiConfig),
            new EnvironmentActivityApi($this->apiClient, $this->apiConfig)
        );
        $this->application = new ApplicationTask($this);
        $this->backup = new BackupTask($this);
        $this->certificate = new CertificateTask($this);
        $this->domain = new DomainTask($this);
        $this->environment = new EnvironmentTask($this);
        $this->metrics = new MetricsTask($this);
        $this->mount = new MountTask($this);
        $this->operation = new OperationTask($this);
        $this->organization = new OrganizationTask($this);
        $this->project = new ProjectTask($this);
        $this->region = new RegionTask($this);
        $this->resource = new ResourcesTask($this);
        $this->route = new RouteTask($this);
        $this->sourceOperation = new SourceOperationTask($this);
        $this->team = new TeamTask($this);
        $this->supportTicket = new SupportTicketTask($this);
        $this->user = new UserTask($this);
        $this->variables = new VariableTask($this);
        $this->worker = new WorkerTask($this);
        $this->invitations = new InvitationTask($this);
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

    public function getApiClient(): Client {
        return $this->apiClient;
    }
    public function getApiConfig(): Configuration {
        return $this->apiConfig;
    }
}