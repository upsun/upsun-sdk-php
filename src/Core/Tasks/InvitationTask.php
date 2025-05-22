<?php

namespace Upsun\Core\Tasks;

use OpenAPI\Client\apisgen\InvitationsApi;
use OpenAPI\Client\Model\CreateOrgInviteRequest;
use Upsun\UpsunClient;

class InvitationTask extends TaskBase
{
    public readonly InvitationsApi $api;

    public function __construct(
        public readonly UpsunClient $client,
    )
    {
        $this->api = new InvitationsApi($this->client->apiClient, $this->client->apiConfig);
    }


    public function createOrgInvite($organization_id, string $email, array $permissions, bool $force = true)
    {
        $this->refreshToken();
        
        $inviteRequest = new CreateOrgInviteRequest([
            'email' => $email, 
            'permissions' => $permissions, 
            'force' => $force
        ]);
        return $this->api->createOrgInvite($organization_id, $inviteRequest);
    }

    public function createOrgInviteAsync($organization_id, $create_org_invite_request = null, string $contentType = '')
    {
        $this->refreshToken();
        return $this->api->createOrgInviteAsync($organization_id, $create_org_invite_request, $contentType);
    }

}