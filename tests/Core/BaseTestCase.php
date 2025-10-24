<?php

namespace Upsun\Tests\Core;

use PHPUnit\Framework\TestCase;

abstract class BaseTestCase extends TestCase
{
    /**
     * @throws \Exception
     */
    protected function assertObjectProperties(mixed $actual, mixed $expected, string $prefix = ''): void
    {
        // Case objet
        if (is_object($actual) && is_iterable($expected)) {
            foreach ($expected as $key => $value) {
                $getter = 'get' . ucfirst($key);
                if (!method_exists($actual, $getter)) {
                    continue;
                }
                $propValue = $actual->$getter();
                $this->assertObjectProperties($propValue, $value, "$prefix$key.");
            }
            return;
        }

        // Case array
        if (is_array($actual) && is_iterable($expected)) {
            foreach ($actual as $idx => $item) {
                $expectedItem = $expected[$idx] ?? $expected;
                $this->assertObjectProperties($item, $expectedItem, "$prefix" . "[$idx].");
            }
            return;
        }

        // Case DateTime
        if ($actual instanceof \DateTime) {
            if (!($expected instanceof \DateTime)) {
                $expected = new \DateTime($expected);
            }
            $this->assertEquals(
                $expected->getTimestamp(),
                $actual->getTimestamp(),
                "Failed asserting equality at $prefix"
            );
            return;
        }

        $this->assertEquals(
            $expected,
            $actual,
            "Failed asserting equality at $prefix"
        );
    }

    /**
     * Compare list of objects (ex: Activity[]) with expected
     */
    protected function assertObjectMatchesArray(array $actual, array $expected, string $prefix = ''): void
    {
        $this->assertCount(
            count($expected),
            $actual,
            "Array size mismatch at $prefix"
        );
        
        // Case objet
        foreach ($actual as $index => $object) {
            $this->assertObjectProperties(
                $object,
                $expected[$index],
                $prefix . "[$index]."
            );
        }
    }
}
