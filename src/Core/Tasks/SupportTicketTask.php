<?php

namespace Upsun\Core\Tasks;

use DateTime;
use OpenAPI\Client\ApiException;
use OpenAPI\Client\apisgen\DefaultApi;
use OpenAPI\Client\apisgen\SupportApi;
use OpenAPI\Client\Model\CreateTicketRequest;
use OpenAPI\Client\Model\ListTickets200Response;
use OpenAPI\Client\Model\Ticket;
use OpenAPI\Client\Model\UpdateTicketRequest;
use Upsun\UpsunClient;

class SupportTicketTask extends TaskBase
{

    public function __construct(
        public readonly UpsunClient $client,
        private readonly DefaultApi $defaultApi,
        private readonly SupportApi $supportApi,
    )
    {
        parent::__construct($this->client);
    }

    /**
     * Lists support tickets
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function list(
        ?int      $filterTicketId = null,
        ?DateTime $filterCreated = null,
        ?DateTime $filterUpdated = null,
        ?string   $filterType = null,
        ?string   $filterPriority = null,
        ?string   $filterStatus = null,
        ?string   $filterRequesterId = null,
        ?string   $filterSubmitterId = null,
        ?string   $filterAssigneeId = null,
        ?bool     $filterHasIncidents = null,
        ?DateTime $filterDue = null,
        ?string   $search = null,
        ?int      $page = null
    ): ListTickets200Response
    {
        $this->refreshToken();
        return $this->defaultApi->listTickets(
            $filterTicketId,
            $filterCreated,
            $filterUpdated,
            $filterType,
            $filterPriority,
            $filterStatus,
            $filterRequesterId,
            $filterSubmitterId,
            $filterAssigneeId,
            $filterHasIncidents,
            $filterDue,
            $search,
            $page
        );
    }

    /**
     * Creates a new support ticket
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function create(?array $createTicketRequest = null): Ticket
    {
        $this->refreshToken();
        $createTicketRequest = new CreateTicketRequest($createTicketRequest);
        return $this->supportApi->createTicket($createTicketRequest);
    }

    /**
     * Lists support ticket categories
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listCategories(?string $projectId = null, ?string $organizationId = null): array
    {
        $this->refreshToken();
        return $this->supportApi->listTicketCategories($projectId, $organizationId);
    }

    /**
     * Lists support ticket priorities
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function listPriorities(?string $projectId = null, ?string $category = null): array
    {
        $this->refreshToken();
        return $this->supportApi->listTicketPriorities($projectId, $category);
    }

    /**
     * Updates a ticket
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function update(string $ticket_id, ?array $updateTicketRequest = null): Ticket
    {
        $this->refreshToken();
        $updateTicketRequest = new UpdateTicketRequest($updateTicketRequest);
        return $this->supportApi->createTicket($ticket_id, $updateTicketRequest);
    }
}
