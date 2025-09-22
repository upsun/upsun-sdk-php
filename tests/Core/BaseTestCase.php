<?php

namespace Upsun\Test\Core;

use PHPUnit\Framework\TestCase;

abstract class BaseTestCase extends TestCase
{
    protected function assertObjectProperties(mixed $actual, mixed $expected, string $prefix = ''): void
    {
        // Cas objet
        if (is_object($actual)) {
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

        // Cas tableau
        if (is_array($actual)) {
            foreach ($actual as $idx => $item) {
                $expectedItem = $expected[$idx] ?? $expected;
                $this->assertObjectProperties($item, $expectedItem, "$prefix" . "[$idx].");
            }
            return;
        }

        $this->assertEquals(
            $expected,
            $actual,
            "Failed asserting equality at $prefix"
        );
    }

    protected function assertObjectMatchesArray(mixed $expected, mixed $actual, string $prefix = ''): void
    {
        if ($actual instanceof \stdClass) {
            $actual = (array) $actual;
        }

        if (is_object($actual)) {
            foreach ($expected as $key => $value) {
                $getter = 'get' . ucfirst($key);
                $this->assertTrue(
                    method_exists($actual, $getter),
                    "Getter $getter() not found on " . get_class($actual)
                );

                $propValue = $actual->$getter();
                $this->assertObjectMatchesArray($value, $propValue, "$prefix$key.");
            }
            return;
        }

        if (is_array($actual)) {
            foreach ($expected as $key => $value) {
                $this->assertArrayHasKey($key, $actual, "Missing key $prefix$key");
                $this->assertObjectMatchesArray($value, $actual[$key], "$prefix$key.");
            }
            return;
        }

        $this->assertEquals(
            $expected,
            $actual,
            "Failed asserting equality at $prefix"
        );
    }
}
