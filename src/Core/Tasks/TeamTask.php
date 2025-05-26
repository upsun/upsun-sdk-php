<?php

namespace Upsun\Core\Tasks;

use OpenAPI\Client\apisgen\TeamsApi;
use Upsun\UpsunClient;

class TeamTask extends TaskBase
{
    public readonly TeamsApi $api;

    public function __construct(
        public readonly UpsunClient $client,
    )
    {
        $this->api = new TeamsApi($this->client->apiClient, $this->client->apiConfig);
    }

    public function getTeam(string $id)
    {
        $this->refreshToken();
        return $this->api->getTeam($id);
    }

    public function listUserTeams($user_id, $filter_organization_id = null, $filter_updated_at = null, $page_size = null, $page_before = null, $page_after = null, $sort = null)
    {
        $this->refreshToken();
        return $this->api->listUserTeams($user_id, $filter_organization_id, $filter_updated_at, $page_size, $page_before, $page_after, $sort);
    }
}