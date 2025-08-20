<?php

use Upsun\Configuration;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\HttplugClient;
use Upsun\Core\Tasks\SupportTicketTask;
use Upsun\UpsunClient;
use Upsun\Api\DefaultApi;
use Upsun\Api\SupportApi;
use Upsun\Model\Ticket;
use Upsun\Model\ListTickets200Response;
use Upsun\Model\CreateTicketRequest;
use Upsun\Model\UpdateTicketRequest;
use Upsun\ApiException;
use Upsun\UpsunConfig;

class SupportTicketTaskTest extends TestCase
{
    private UpsunClient $client;
    private DefaultApi $defaultApi;
    private SupportApi $supportApi;
    private SupportTicketTask $task;

    protected function setUp(): void
    {
        $this->client = new class() extends UpsunClient {
            public HttplugClient $apiClient;
            public Configuration $apiConfig;

            public UpsunConfig $upsunConfig;

            public function __construct()
            {
            }
        };
        
        $this->defaultApi = $this->createMock(DefaultApi::class);
        $this->supportApi = $this->createMock(SupportApi::class);
        $this->task = new class($this->client, $this->defaultApi, $this->supportApi) extends SupportTicketTask {
            public function refreshToken(): void
            {
            }
        };
    }

    public function testListSuccess(): void
    {
        $response = $this->createMock(ListTickets200Response::class);
        $this->defaultApi->expects($this->once())
            ->method('listTickets')
            ->willReturn($response);

        $result = $this->task->list();
        $this->assertInstanceOf(ListTickets200Response::class, $result);
    }

    public function testCreateSuccess(): void
    {
        $ticket = $this->createMock(Ticket::class);
        $this->supportApi->expects($this->once())
            ->method('createTicket')
            ->with($this->isInstanceOf(CreateTicketRequest::class))
            ->willReturn($ticket);

        $result = $this->task->create(['title' => 'Issue']);
        $this->assertInstanceOf(Ticket::class, $result);
    }

    public function testUpdateSuccess(): void
    {
        $ticket = $this->createMock(Ticket::class);
        $this->supportApi->expects($this->once())
            ->method('updateTicket') 
            ->with($this->equalTo('123'), $this->isInstanceOf(UpdateTicketRequest::class))
            ->willReturn($ticket);

        $result = $this->task->update('123', ['status' => 'open']);
        $this->assertInstanceOf(Ticket::class, $result);
    }

    public function testListCategoriesSuccess(): void
    {
        $this->supportApi->expects($this->once())
            ->method('listTicketCategories')
            ->willReturn([['label' => 'Bug']]);

        $result = $this->task->listCategories();
        $this->assertIsArray($result);
    }

    public function testListPrioritiesSuccess(): void
    {
        $this->supportApi->expects($this->once())
            ->method('listTicketPriorities')
            ->willReturn([['label' => 'High']]);

        $result = $this->task->listPriorities();
        $this->assertIsArray($result);
    }

    public function testCreateThrowsApiException(): void
    {
        $this->supportApi->expects($this->once())
            ->method('createTicket')
            ->willThrowException($this->createMock(ApiException::class));

        $this->expectException(ApiException::class);
        $this->task->create(['invalid' => true]);
    }

    public function testUpdateThrowsApiException(): void
    {
        $this->supportApi->expects($this->once())
            ->method('updateTicket')
            ->willThrowException($this->createMock(ApiException::class));

        $this->expectException(ApiException::class);
        $this->task->update('invalid-id', ['invalid' => true]);
    }
}
