<?php

namespace Upsun\Core\Tasks;

use DateTime;
use InvalidArgumentException;
use Psr\Http\Client\ClientExceptionInterface;
use Upsun\Api\ApiException;
use Upsun\Api\DefaultApi;
use Upsun\Api\SupportApi;
use Upsun\Model\CreateTicketRequest;
use Upsun\Model\ListTicketCategories200ResponseInner;
use Upsun\Model\ListTicketPriorities200ResponseInner;
use Upsun\Model\ListTickets200Response;
use Upsun\Model\Ticket;
use Upsun\Model\UpdateTicketRequest;
use Upsun\UpsunClient;

/**
 * SupportTicketTask class.
 *
 * @author    Upsun Advocacy Team
 * @license   MIT
 * @see       https://docs.upsun.com
 */
class SupportTicketsTask extends TaskBase
{
    public function __construct(
        UpsunClient $client,
        private readonly DefaultApi $defaultApi,
        private readonly SupportApi $supportApi,
    ) {
        parent::__construct($client);
    }

    /**
     * Lists support tickets
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network error
     * @throws InvalidArgumentException if required parameters are missing or invalid
     */
    public function list(
        ?int $filterTicketId = null,
        ?DateTime $filterCreated = null,
        ?DateTime $filterUpdated = null,
        ?string $filterType = null,
        ?string $filterPriority = null,
        ?string $filterStatus = null,
        ?string $filterRequesterId = null,
        ?string $filterSubmitterId = null,
        ?string $filterAssigneeId = null,
        ?bool $filterHasIncidents = null,
        ?DateTime $filterDue = null,
        ?string $search = null,
        ?int $page = null
    ): ListTickets200Response {
        return $this->defaultApi->listTickets(
            filterTicketId: $filterTicketId,
            filterCreated: $filterCreated,
            filterUpdated: $filterUpdated,
            filterType: $filterType,
            filterPriority: $filterPriority,
            filterStatus: $filterStatus,
            filterRequesterId: $filterRequesterId,
            filterSubmitterId: $filterSubmitterId,
            filterAssigneeId: $filterAssigneeId,
            filterHasIncidents: $filterHasIncidents,
            filterDue: $filterDue,
            search: $search,
            page: $page
        );
    }

    /**
     * Creates a new support ticket
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network error
     * @throws InvalidArgumentException if required parameters are missing or invalid
     */
    public function create(
        string $subject,
        string $description,
        ?string $requesterId = null,
        ?string $priority = null,
        ?string $subscriptionId = null,
        ?string $organizationId = null,
        ?string $affectedUrl = null,
        ?string $followupTid = null,
        ?string $category = null,
        ?array $attachments = [],
        ?array $collaboratorIds = [],
    ): Ticket {
        $createTicketRequest = new CreateTicketRequest(
            subject: $subject,
            description: $description,
            requesterId: $requesterId,
            priority: $priority,
            subscriptionId: $subscriptionId,
            organizationId: $organizationId,
            affectedUrl: $affectedUrl,
            followupTid: $followupTid,
            category: $category,
            attachments: $attachments,
            collaboratorIds: $collaboratorIds
        );
        return $this->supportApi->createTicket(createTicketRequest: $createTicketRequest);
    }

    /**
     * Lists support ticket categories
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network error
     * @throws InvalidArgumentException if required parameters are missing or invalid
     * @return  ListTicketCategories200ResponseInner[]
     */
    public function listCategories(?string $organizationId = null, ?string $projectId = null): array
    {
        $this->checkOrganizationId($organizationId);

        $project = $projectId ? $this->client->projects->get($projectId) : null;
        $subscriptionId = $projectId ?
            $this->extractSubscriptionId($project->getSubscription()->getLicenseUri()) : null;

        return $this->supportApi->listTicketCategories(
            subscriptionId: $subscriptionId,
            organizationId: $organizationId
        );
    }

    /**
     * Lists support ticket priorities
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network error
     * @throws InvalidArgumentException if required parameters are missing or invalid
     * @return ListTicketPriorities200ResponseInner[]
     */
    public function listPriorities(?string $projectId = null, ?string $category = null): array
    {
        $project = $projectId ? $this->client->projects->get($projectId) : null;
        $path = parse_url($project?->getSubscription()->getLicenseUri(), PHP_URL_PATH);
        $subscriptionId = basename($path);
        return $this->supportApi->listTicketPriorities(subscriptionId: $subscriptionId, category: $category);
    }

    /**
     * Updates a ticket
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface on network error
     * @throws InvalidArgumentException if required parameters are missing or invalid
     */
    public function update(
        string $ticketId,
        ?string $status = null,
        ?array $collaboratorIds = [],
        ?bool $collaboratorsReplace = null,
    ): Ticket {
        $this->checkTicketId($ticketId);

        return $this->supportApi->updateTicket(
            ticketId: $ticketId,
            updateTicketRequest: new UpdateTicketRequest(
                status: $status,
                collaboratorIds: $collaboratorIds,
                collaboratorsReplace:  $collaboratorsReplace,
            )
        );
    }
}
