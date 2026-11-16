<?php

namespace Upsun\Tests\Api;

use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Upsun\Api\ApiConfiguration;
use Upsun\Api\ApiException;
use Upsun\Api\LogsApi;
use Upsun\Core\TokenProvider;

/**
 * Array query parameters of the generated APIs, with LogsApi as the example.
 */
class ArrayQueryParamsTest extends TestCase
{
    private ?RequestInterface $sentRequest = null;

    private function sentQuery(array $severities): string
    {
        $httpClient = $this->createMock(ClientInterface::class);
        $httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturnCallback(function (RequestInterface $request): Response {
                $this->sentRequest = $request;

                return new Response(500);
            });

        $api = new LogsApi(
            new class implements TokenProvider
            {
                public function __invoke(bool $force = false): string
                {
                    return 'Bearer test-token';
                }
            },
            $httpClient,
            new Psr17Factory(),
            new ApiConfiguration()
        );

        try {
            $api->logsOverview('proj-1', 'main', 1, 2, severities: $severities, severitiesMode: '1');
            $this->fail('Expected ApiException was not thrown');
        } catch (ApiException) {
        }

        return urldecode($this->sentRequest->getUri()->getQuery());
    }

    public function testAListRepeatsTheParameterNameForEachValue(): void
    {
        $this->assertSame(
            'from=1&to=2&severities[]=ERROR&severities[]=CRITICAL&severities_mode=1',
            $this->sentQuery(['ERROR', 'CRITICAL'])
        );
    }

    public function testAFilteredListWithGapsInItsKeysKeepsTheParameterName(): void
    {
        $this->assertSame(
            'from=1&to=2&severities[]=CRITICAL&severities_mode=1',
            $this->sentQuery(array_filter(['', 'CRITICAL']))
        );
    }

    public function testAnEmptyListSendsNoParameter(): void
    {
        $this->assertSame('from=1&to=2&severities_mode=1', $this->sentQuery([]));
    }
}
