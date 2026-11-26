<?php

namespace Upsun\Tests\Api\Serializer;

use PHPUnit\Framework\TestCase;
use Upsun\Api\Serializer\ObjectSerializer;
use Upsun\Model\HttpMetricsEdgeTimeline200ResponseTopHitsTimelineDataInner;
use Upsun\Model\HttpMetricsEdgeTimeline200ResponseTopHitsTimelineDataInnerCodes;
use Upsun\Model\OrganizationLinks;
use Upsun\Model\OrganizationLinksCreateMember;
use Upsun\Model\OrganizationLinksSelf;

/**
 * @covers \Upsun\Api\Serializer\ObjectSerializer
 */
class ObjectSerializerTest extends TestCase
{
    public function testSerializeUsesApiNamesOfPropertiesThatTheGeneratorRenames(): void
    {
        // The generator turns `UNKNOWN` into `uNKNOWN` and `1XX` into `_1xX`.
        $codes = new HttpMetricsEdgeTimeline200ResponseTopHitsTimelineDataInnerCodes(0, 1, 2, 3, 4, 5);

        $this->assertSame(
            ['UNKNOWN' => 0, '1XX' => 1, '2XX' => 2, '3XX' => 3, '4XX' => 4, '5XX' => 5],
            (array) ObjectSerializer::sanitizeForSerialization($codes)
        );
    }

    public function testSerializeUsesApiNamesWithHyphens(): void
    {
        $links = new OrganizationLinks(
            self: new OrganizationLinksSelf('https://api.example.com/organizations/org1'),
            createMember: new OrganizationLinksCreateMember('https://api.example.com/organizations/org1/members', 'POST'),
        );

        $this->assertSame(
            '{"self":{"href":"https:\/\/api.example.com\/organizations\/org1"},'
            . '"create-member":{"href":"https:\/\/api.example.com\/organizations\/org1\/members","method":"POST"}}',
            json_encode(ObjectSerializer::sanitizeForSerialization($links))
        );
    }

    public function testSerializeOfDeserializedEdgeTimelinePointGivesBackThePayload(): void
    {
        $payload = '{"timestamp":1700000000,"_total_count":42,"response_size":1024,'
            . '"codes":{"UNKNOWN":1,"1XX":2,"2XX":30,"3XX":4,"4XX":3,"5XX":2}}';

        $point = ObjectSerializer::deserialize(
            json_decode($payload),
            HttpMetricsEdgeTimeline200ResponseTopHitsTimelineDataInner::class
        );

        $this->assertSame($payload, json_encode(ObjectSerializer::sanitizeForSerialization($point)));
    }

    public function testSerializeOmitsNullProperties(): void
    {
        $point = new HttpMetricsEdgeTimeline200ResponseTopHitsTimelineDataInner(1700000000);

        $this->assertSame(['timestamp' => 1700000000], (array) ObjectSerializer::sanitizeForSerialization($point));
    }
}
