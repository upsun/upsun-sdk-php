<?php

namespace Upsun;

use GuzzleHttp\Client;
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
    protected Client $client;

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

    public function __construct(private UpsunConfig $config)
    {
        $this->client = new Client([
            'base_uri' => $this->config->base_url
        ]);

        $this->activity = new ActivityTask($this->client);
        $this->application = new ApplicationTask($this->client);
        $this->backup = new BackupTask($this->client);
        $this->certificate = new CertificateTask($this->client);
        $this->domain = new DomainTask($this->client);
        $this->environment = new EnvironmentTask($this->client);
        $this->metrics = new MetricsTask($this->client);
        $this->mount = new MountTask($this->client);
        $this->operation = new OperationTask($this->client);
        $this->organization = new OrganizationTask($this->client);
        $this->project = new ProjectTask($this->client);
        $this->resource = new ResourcesTask($this->client);
        $this->route = new RouteTask($this->client);
        $this->sourceOperation = new SourceOperationTask($this->client);
        $this->team = new TeamTask($this->client);
        $this->user = new UserTask($this->client);
        $this->variables = new VariableTask($this->client);
        $this->worker = new WorkerTask($this->client);
    }
}