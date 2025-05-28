<?php

namespace Upsun\Core\Tasks;

use DateTime;
use OpenAPI\Client\ApiException;
use OpenAPI\Client\apisgen\DefaultApi;
use OpenAPI\Client\Model\ListTickets200Response;
use Upsun\UpsunClient;

class SupportTicketTask extends TaskBase
{
    public readonly DefaultApi $api;
    
    public function __construct(
        public readonly UpsunClient $client,
    )
    {
        $this->api = new DefaultApi($this->client->apiClient, $this->client->apiConfig);
    }
    
    /************** **********************/
    /********* DefaultApi ****************/
    /************** **********************/

    /**
     * Operation listTickets
     *
     * List support tickets
     *
     * @param int|null $filter_ticket_id The ID of the ticket. (optional)
     * @param DateTime|null $filter_created ISO dateformat expected. The time when the support ticket was created. (optional)
     * @param DateTime|null $filter_updated ISO dateformat expected. The time when the support ticket was updated. (optional)
     * @param string|null $filter_type The type of the support ticket. (optional)
     * @param string|null $filter_priority The priority of the support ticket. (optional)
     * @param string|null $filter_status The status of the support ticket. (optional)
     * @param string|null $filter_requester_id UUID of the ticket requester. Converted from the ZID value. (optional)
     * @param string|null $filter_submitter_id UUID of the ticket submitter. Converted from the ZID value. (optional)
     * @param string|null $filter_assignee_id UUID of the ticket assignee. Converted from the ZID value. (optional)
     * @param bool|null $filter_has_incidents Whether or not this ticket has incidents. (optional)
     * @param DateTime|null $filter_due ISO dateformat expected. A time that the ticket is due at. (optional)
     * @param string|null $search Search string for the ticket subject and description. (optional)
     * @param int|null $page Page to be displayed. Defaults to 1. (optional)
     * @return ListTickets200Response
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listTickets(int $filter_ticket_id = null, DateTime $filter_created = null, DateTime $filter_updated = null, string $filter_type = null, string $filter_priority = null, string $filter_status = null, string $filter_requester_id = null, string $filter_submitter_id = null, string $filter_assignee_id = null, bool $filter_has_incidents = null, DateTime $filter_due = null, string $search = null, int $page = null): ListTickets200Response
    {
        $this->refreshToken();
        return $this->api->listTickets($filter_ticket_id, $filter_created, $filter_updated, $filter_type, $filter_priority, $filter_status, $filter_requester_id, $filter_submitter_id, $filter_assignee_id, $filter_has_incidents, $filter_due, $search , $page);
    }
}