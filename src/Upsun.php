<?php

namespace Upsun;

use GuzzleHttp\Client;
use Upsun\Core\Tasks\Project;
use Upsun\Core\Tasks\Organization;
use Upsun\Core\Tasks\Variables;

class Upsun
{
    protected Client $client;
    public $project;
    public $organization;
    public $variables;

    public function __construct(private UpsunConfig $config)
    {
        $this->client = new Client([
            'base_uri' => $this->config->base_url]);
        $this->project = new Project($this->client);
        $this->organization = new Organization($this->client);
        $this->variables = new Variables($this->client);
    }
}