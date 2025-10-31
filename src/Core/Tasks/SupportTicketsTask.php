<?php

namespace Upsun\Core\Tasks;

use DateTime;
use Upsun\Api\DefaultApi;
use Upsun\Api\SupportApi;
use Upsun\Model\CreateTicketRequest;
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
     * @throws ClientExceptionInterface
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
     * @param array|null{
     *     subject: string,
     *     description: string,
     *     requestId?: string,
     *     priority?: string,
     *     subscriptionId?: string,
     *     organizationId?: string,
     *     affectedUrl?: string,
     *     followupTid?: string,
     *     category?: string,
     *     attachments?: array,
     *     collaboratorIds?: array,
     * } $data
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function create(?array $data = null): Ticket
    {
        $createTicketRequest = new CreateTicketRequest(...$data);
        return $this->supportApi->createTicket($createTicketRequest);
    }

    /**
     * Lists support ticket categories
     *
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @return  ListTicketCategories200ResponseInner[]
     */
    public function listCategories(?string $organizationId = null, ?string $projectId = null): array
    {
        $project = $projectId ? $this->client->projects->get($projectId) : null;
        $path = parse_url($project?->getSubscription()->getLicenseUri(), PHP_URL_PATH);
        $subscriptionId = basename($path);
        return $this->supportApi->listTicketCategories($subscriptionId, $organizationId);
    }

    /**
     * Lists support ticket priorities
     *
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @return ListTicketPriorities200ResponseInner[]
     */
    public function listPriorities(?string $projectId = null, ?string $category = null): array
    {
        $project = $projectId ? $this->client->projects->get($projectId) : null;
        $path = parse_url($project?->getSubscription()->getLicenseUri(), PHP_URL_PATH);
        $subscriptionId = basename($path);
        return $this->supportApi->listTicketPriorities($subscriptionId, $category);
    }

    /**
     * Updates a ticket
     *
     * @param array|null{
     *     status?: string,
     *     collaboratorIds?: array,
     *     collaboratorsReplace?: bool,
     * } $data
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function update(string $ticketId, ?array $data = null): Ticket
    {
        $updateTicketRequest = new UpdateTicketRequest(...$data);
        return $this->supportApi->updateTicket($ticketId, $updateTicketRequest);
    }
}
