<?php

namespace Upsun;

use GuzzleHttp\Client;
use OpenAPI\Client\Configuration;
use Upsun\Core\Tasks\ActivityTask;
use Upsun\Core\Tasks\ApplicationTask;
use Upsun\Core\Tasks\BackupTask;
use Upsun\Core\Tasks\CertificateTask;
use Upsun\Core\Tasks\DomainTask;
use Upsun\Core\Tasks\EnvironmentTask;
use Upsun\Core\Tasks\MetricsTask;
use Upsun\Core\Tasks\MountTask;
use Upsun\Core\Tasks\OperationTask;
use Upsun\Core\Tasks\OrganizationTask;
use Upsun\Core\Tasks\ProjectTask;
use Upsun\Core\Tasks\ResourcesTask;
use Upsun\Core\Tasks\RouteTask;
use Upsun\Core\Tasks\SourceOperationTask;
use Upsun\Core\Tasks\TeamTask;
use Upsun\Core\Tasks\UserTask;
use Upsun\Core\Tasks\VariableTask;
use Upsun\Core\Tasks\WorkerTask;

class UpsunClient
{
    public Client $apiClient;
    public Configuration $apiConfig;

    public $activity;
    public $application;
    public $backup;
    public $certificate;
    public $domain;
    public $environment;
    public $metrics;
    public $mount;
    public $operation;
    public $organization;
    public $project;
    public $resource;
    public $route;
    public $sourceOperation;
    public $team;
    public $user;
    public $variables;
    public $worker;

    public function __construct(private UpsunConfig $upsunConfig)
    {
        $this->upsunConfig = $upsunConfig;
        $this->apiConfig = Configuration::getDefaultConfiguration()
            ->setAccessToken($this->upsunConfig->apiKey)
            ->setHost($this->upsunConfig->base_url);
        
        $this->apiClient = new Client();

        $this->activity = new ActivityTask($this);
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
        $this->resource = new ResourcesTask($this);
        $this->route = new RouteTask($this);
        $this->sourceOperation = new SourceOperationTask($this);
        $this->team = new TeamTask($this);
        $this->user = new UserTask($this);
        $this->variables = new VariableTask($this);
        $this->worker = new WorkerTask($this);
    }
}