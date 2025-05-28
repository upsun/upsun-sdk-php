<?php

namespace Upsun\Core\Tasks;

use DateTime;
use OpenAPI\Client\ApiException;
use OpenAPI\Client\apisgen\DefaultApi;
use OpenAPI\Client\apisgen\SupportApi;
use OpenAPI\Client\Model\CreateTicketRequest;
use OpenAPI\Client\Model\ListTicketCategories200ResponseInner;
use OpenAPI\Client\Model\ListTicketPriorities200ResponseInner;
use OpenAPI\Client\Model\ListTickets200Response;
use OpenAPI\Client\Model\Ticket;
use OpenAPI\Client\Model\UpdateTicketRequest;
use Upsun\UpsunClient;

class SupportTicketTask extends TaskBase
{
    public readonly DefaultApi $api;
    public readonly SupportApi $supportApi;
    
    public function __construct(
        public readonly UpsunClient $client,
    )
    {
        $this->api = new DefaultApi($this->client->apiClient, $this->client->apiConfig);
        $this->supportApi = new SupportApi($this->client->apiClient, $this->client->apiConfig);
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
     * @param bool|null $filter_has_incidents Whether this ticket has incidents. (optional)
     * @param DateTime|null $filter_due ISO dateformat expected. A time that the ticket is due at. (optional)
     * @param string|null $search Search string for the ticket subject and description. (optional)
     * @param int|null $page Page to be displayed. Defaults to 1. (optional)
     * @return ListTickets200Response
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listTickets(int $filter_ticket_id = null, DateTime $filter_created = null, DateTime $filter_updated = null, string $filter_type = null, string $filter_priority = null, string $filter_status = null, string $filter_requester_id = null, string $filter_submitter_id = null, string $filter_assignee_id = null, bool $filter_has_incidents = null, DateTime $filter_due = null, string $search = null, int $page = null): ListTickets200Response
    {
        $this->refreshToken();
        return $this->api->listTickets($filter_ticket_id, $filter_created, $filter_updated, $filter_type, $filter_priority, $filter_status, $filter_requester_id, $filter_submitter_id, $filter_assignee_id, $filter_has_incidents, $filter_due, $search, $page);
    }
    
    /************** **********************/
    /********* SupportApi ****************/
    /************** **********************/

    /**
     * Operation createTicket
     *
     * Create a new support ticket
     *
     * @param array|null $create_ticket_request create_ticket_request (optional)
     * @return Ticket
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function createTicket(array $create_ticket_request = null): Ticket
    {
        $this->refreshToken();
        $create_ticket_request = new CreateTicketRequest($create_ticket_request);
        return $this->supportApi->createTicket($create_ticket_request);
    }

    /**
     * Operation listTicketCategories
     *
     * List support ticket categories
     *
     * @param string|null $subscription_id The ID of the subscription the ticket should be related to (optional)
     * @param string|null $organization_id The ID of the organization the ticket should be related to (optional)
     * @return ListTicketCategories200ResponseInner[]
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listTicketCategories(string $subscription_id = null, string $organization_id = null): array
    {
        $this->refreshToken();
        return $this->supportApi->listTicketCategories($subscription_id, $organization_id);
    }

    /**
     * Operation listTicketPriorities
     *
     * List support ticket priorities
     *
     * @param string|null $subscription_id The ID of the subscription the ticket should be related to (optional)
     * @param string|null $category The category of the support ticket. (optional)
     * @return ListTicketPriorities200ResponseInner[]
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listTicketPriorities(string $subscription_id = null, string $category = null): array
    {
        $this->refreshToken();
        return $this->supportApi->listTicketPriorities($subscription_id, $category);
    }

    /**
     * Operation updateTicket
     *
     * Update a ticket
     *
     * @param string $ticket_id The ID of the ticket (required)
     * @param array|null $update_ticket_request update_ticket_request (optional)
     * @return Ticket
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function updateTicket(string $ticket_id, array $update_ticket_request = null): Ticket
    {
        $this->refreshToken();
        $update_ticket_request = new UpdateTicketRequest($update_ticket_request);
        return $this->supportApi->createTicket($ticket_id, $update_ticket_request);
    }
}