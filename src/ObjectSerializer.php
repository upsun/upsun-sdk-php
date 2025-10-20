<?php

namespace Upsun;

use ReflectionClass;
use stdClass;
use SplFileObject;
use DateTime;
use DateTimeInterface;
use Exception;
use InvalidArgumentException;
use Psr\Http\Message\StreamInterface;
use GuzzleHttp\Psr7\Utils;
use Upsun\Model\ModelInterface;

/**
 * ObjectSerializer Class Doc Comment
 *
 * @category Class
 * @package  Upsun
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class ObjectSerializer
{
    private static string $dateTimeFormat = DateTimeInterface::ATOM;

    /**
     * Serialize data
     */
    public static function sanitizeForSerialization(
        mixed $data,
        ?string $type = null,
        ?string $format = null
    ): float|object|array|bool|int|string|null {
        if (is_scalar($data) || null === $data) {
            return $data;
        }

        if ($data instanceof DateTime) {
            return ($format === 'date') ? $data->format('Y-m-d') : $data->format(self::$dateTimeFormat);
        }

        if (is_array($data)) {
            foreach ($data as $property => $value) {
                $data[$property] = self::sanitizeForSerialization($value);
            }

            return $data;
        }

        if (is_object($data)) {
            $values = [];
            if ($data instanceof ModelInterface) {
                $formats = ObjectOpenApiFormatsMapper::openAPIFormats($data->getModelName());

                foreach (ObjectOpenApiTypesMapper::openAPITypes($data->getModelName()) as $property => $openAPIType) {
                    $camelCaseProperty = lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $property))));
                    $getterMethod = 'get' . ucfirst($camelCaseProperty);
                    if (method_exists($data, $getterMethod)) {
                        $value = $data->$getterMethod();
                    } else {
                        throw new InvalidArgumentException(
                            "No valid getter get" . ucfirst($property) . " found for " . $property
                        );
                    }

                    if ($value !== null && !in_array($openAPIType, ['\DateTime', '\SplFileObject', 'array', 'bool', 'boolean', 'byte', 'float', 'int', 'integer', 'mixed', 'number', 'object', 'string', 'void'], true)) {
                        $callable = [$openAPIType, 'getAllowableEnumValues'];
                        if (is_callable($callable)) {
                            /** array $callable */
                            $allowedEnumTypes = $callable();
                            if (!in_array($value, $allowedEnumTypes, true)) {
                                $imploded = implode("', '", $allowedEnumTypes);
                                throw new InvalidArgumentException(
                                    sprintf(
                                        "Invalid value for enum '%s', must be one of: '%s'",
                                        $openAPIType,
                                        $imploded
                                    )
                                );
                            }
                        }
                    }

                    if ($value !== null) {
                        $values[ObjectAttributesMapper::attributeMap($data->getModelName())[$camelCaseProperty]]
                            = self::sanitizeForSerialization($value, $openAPIType, $formats[$camelCaseProperty]);
                    }
                }
            } else {
                foreach ($data as $property => $value) {
                    $values[$property] = self::sanitizeForSerialization($value);
                }
            }

            return (object)$values;
        } else {
            return (string)$data;
        }
    }

    /**
     * Sanitize filename by removing path.
     * e.g. ../../sun.gif becomes sun.gif
     */
    public static function sanitizeFilename(string $filename): string
    {
        if (preg_match("/.*[\/\\\\](.*)$/", $filename, $match)) {
            return $match[1];
        } else {
            return $filename;
        }
    }

    /**
     * Take value and turn it into a string suitable for inclusion in
     * the path, by url-encoding.
     *
     * @param string $value a string which will be part of the path
     *
     * @return string the serialized object
     */
    public static function toPathValue(string $value): string
    {
        return rawurlencode(self::toString($value));
    }

    /**
     * Take value and turn it into a string suitable for inclusion in
     * the parameter. If it's a string, pass through unchanged
     * If it's a datetime object, format it in ISO8601
     * If it's a boolean, convert it to "true" or "false".
     */
    public static function toString(float|DateTime|bool|int|string $value): string
    {
        if ($value instanceof DateTime) { // datetime in ISO8601 format
            return $value->format(self::$dateTimeFormat);
        } elseif (is_bool($value)) {
            return $value ? 'true' : 'false';
        } else {
            return (string)$value;
        }
    }

    /**
     * Simple deserializer for new models with parameterized constructors
     * @throws Exception
     */
    private static function deserializeSimplifiedModel($data, string $class)
    {
        if (null === $data) {
            return null;
        }

        if (!class_exists($class)) {
            throw new InvalidArgumentException(sprintf('Class %s does not exist', $class));
        }

        if (str_ends_with($class, '[]')) {
            $subClass = substr($class, 0, -2);
            if (!is_array($data)) {
                throw new InvalidArgumentException('Data must be an array to deserialize into ' . $class);
            }

            return array_map(fn($item) => self::deserializeSimplifiedModel($item, $subClass), $data);
        }

        $fullClass = ltrim($class, '\\');
        $reflectionClass = new ReflectionClass($class);
        $constructor = $reflectionClass->getConstructor();

        if (!$constructor) {
            return new $class(); // no-arg constructor
        }

        $args = [];
        foreach ($constructor->getParameters() as $param) {
            $paramName = $param->getName();
            $paramType = $param->getType();
            $allowsNull = $paramType?->allowsNull() ?? true;

            $attributeMap = ObjectAttributesMapper::attributeMap($fullClass);
            $jsonKey = $attributeMap[$paramName] ?? $paramName;

            $value = null;
            if (is_object($data)) {
                $value = $data->{$jsonKey} ?? $data->{$paramName} ?? null;
            } elseif (is_array($data)) {
                $value = $data[$jsonKey] ?? $data[$paramName] ?? null;
            }

            if ($value instanceof stdClass && $paramType?->getName() === 'array') {
                $value = (array)$value;
            }

            if ($value === null && $paramType?->allowsNull()) {
                $args[] = null;
                continue;
            }

            if ($value === null && $param->isDefaultValueAvailable()) {
                $value = $param->getDefaultValue();
            }

            if ($value === null && $paramType && $paramType->getName() === 'array') {
                $value = [];
            }

            if ($paramType) {
                $typeName = $paramType->getName();

                if ($paramType->getName() === 'array' && is_array($value)) {
                    $types = ObjectOpenApiTypesMapper::openAPITypes($fullClass);

                    if (isset($types[$paramName]) && str_ends_with($types[$paramName], '[]')) {
                        $itemClass = substr($types[$paramName], 0, -2); // remove []

                        if (class_exists($itemClass)) {
                            $args[] = array_map(function ($item) use ($itemClass) {
                                return self::deserializeSimplifiedModel($item, $itemClass);
                            }, $value);
                            continue;
                        }
                    }

                    // Fallback if no metadata
                    $args[] = $value;
                }

                if (str_ends_with($typeName, '[]')) {
                    $subClass = substr($typeName, 0, -2);
                    $args[] = $value !== null
                        ? array_map(fn($item) => self::deserializeSimplifiedModel($item, $subClass), (array)$value)
                        : [];
                    continue;
                }

                if ($paramType->isBuiltin()) {
                    switch ($typeName) {
                        case 'string':
                            $args[] = $value !== null ? (string)$value : null;
                            break;
                        case 'int':
                            $args[] = $value !== null ? (int)$value : null;
                            break;
                        case 'float':
                            $args[] = $value !== null ? (float)$value : null;
                            break;
                        case 'bool':
                            $args[] = $value !== null ? (bool)$value : null;
                            break;
                        case 'array':
                            break;
                        case 'object':
                            $args[] = $value !== null ? (object)$value : null;
                            break;
                        default:
                            $args[] = $value;
                            break;
                    }
                } elseif ($typeName === 'DateTime') {
                    $args[] = $value !== null ? new DateTime($value) : null;
                } elseif (class_exists($typeName)) {
                    if (is_string($value) && in_array('getAllowableEnumValues', get_class_methods($typeName))) {
                        // Generated Enum
                        $args[] = new $typeName($value);
                    } else {
                        $args[] = $value !== null ? self::deserializeSimplifiedModel($value, $typeName) : null;
                    }
                } else {
                    $args[] = $value;
                }
            } else {
                $args[] = $value;
            }

            if ($args[count($args) - 1] === null && !$allowsNull) {
                $types = ObjectOpenApiTypesMapper::openAPITypes($fullClass);
                if (isset($types[$jsonKey]) && str_contains($types[$jsonKey], 'null')) {
                    continue;
                }

                throw new InvalidArgumentException(
                    sprintf("Required value '%s' missing for class %s", $paramName, $class)
                );
            }
        }

        return new $class(...$args);
    }


    /**
     * @throws Exception
     */
    public static function deserialize($data, string $class, $httpHeaders = null)
    {
        if ($data === null) {
            return null;
        }

        // Handle any class with array properties
        if (class_exists($class) && is_subclass_of($class, ModelInterface::class)) {
            if (is_array($data)) {
                $data = self::preprocessArrayProperties($data, $class);
            }

            return self::deserializeSimplifiedModel($data, $class);
        }

        // Handle array of models
        if (str_ends_with($class, '[]')) {
            $subClass = substr($class, 0, -2); // remove []
            $values = [];

            if (!is_array($data)) {
                throw new InvalidArgumentException('Data must be an array to deserialize into ' . $class);
            }

            foreach ($data as $item) {
                $values[] = self::deserialize($item, $subClass, $httpHeaders);
            }

            return $values;
        }

        // Primitive types
        switch ($class) {
            case 'bool':
            case 'boolean':
                return (bool)$data;
            case 'int':
            case 'integer':
                return (int)$data;
            case 'float':
            case 'double':
                return (float)$data;
            case 'string':
            case 'byte':
                return (string)$data;
            case 'mixed':
                return $data;
            case 'array':
                error_log("Warning: Deserializing generic 'array' type - should use specific model class");
                return (array)$data;
            case 'DateTime':
                return new DateTime($data);
            case 'SplFileObject':
                $data = Utils::streamFor($data);

                /** @var StreamInterface $data */

                // determine file name
                if (
                    is_array($httpHeaders)
                    && array_key_exists('Content-Disposition', $httpHeaders)
                    && preg_match(
                        '/inline; filename=[\'"]?([^\'"\s]+)[\'"]?$/i',
                        $httpHeaders['Content-Disposition'],
                        $match
                    )
                ) {
                    $filename =
                        Configuration::getDefaultConfiguration()->getTempFolderPath()
                        . DIRECTORY_SEPARATOR
                        . self::sanitizeFilename($match[1]);
                } else {
                    $filename = tempnam(Configuration::getDefaultConfiguration()->getTempFolderPath(), '');
                }

                $file = fopen($filename, 'w');
                while ($chunk = $data->read(200)) {
                    fwrite($file, $chunk);
                }

                fclose($file);

                return new SplFileObject($filename, 'r');
            default:
                // Nested model
                return self::deserializeSimplifiedModel($data, $class);
        }
    }

    /**
     * Preprocess array properties to deserialize models
     */
    private static function preprocessArrayProperties(array $data, string $class): array
    {
        if (!method_exists($class, 'openAPITypes')) {
            return $data;
        }

        $types = $class::openAPITypes();

        foreach ($types as $propertyName => $propertyType) {
            // If it's an array of models (ends with [])
            if (str_ends_with($propertyType, '[]')) {
                $subClass = ltrim(substr($propertyType, 0, -2), '?'); // remove [] et ?

                // If the data contains this property and it's an array
                if (isset($data[$propertyName]) && is_array($data[$propertyName])) {
                    // If it's a model class, deserialize each element
                    if (class_exists($subClass)) {
                        $values = [];
                        foreach ($data[$propertyName] as $item) {
                            $values[] = self::deserialize($item, $subClass);
                        }

                        $data[$propertyName] = $values;
                    }
                }
            }
        }

        return $data;
    }

    /**
     * Build a query string from an array of key value pairs.
     *
     * This function can use the return value of `parse()` to build a query
     * string. This function does not modify the provided keys when an array is
     * encountered (like `http_build_query()` would).
     *
     * The function is copied from
     * https://github.com/guzzle/psr7/blob/a243f80a1ca7fe8ceed4deee17f12c1930efe662/src/Query.php#L59-L112
     * with a modification which is described in https://github.com/guzzle/psr7/pull/603
     */
    public static function buildQuery(array $params, $encoding = PHP_QUERY_RFC3986): string
    {
        if ($encoding === false) {
            $encoder = function (string $str): string {
                return $str;
            };
        } elseif ($encoding === PHP_QUERY_RFC3986) {
            $encoder = 'rawurlencode';
        } elseif ($encoding === PHP_QUERY_RFC1738) {
            $encoder = 'urlencode';
        } else {
            throw new InvalidArgumentException('Invalid type');
        }

        $castBool =
            Configuration::BOOLEAN_FORMAT_INT
                == Configuration::getDefaultConfiguration()->getBooleanFormatForQueryString()
            ? function ($v) {
                return (int)$v;
            }
            : function ($v) {
                return $v ? 'true' : 'false';
            };

        $qs = '';
        foreach ($params as $k => $v) {
            $k = $encoder((string)$k);
            if (!is_array($v)) {
                $qs .= $k;
                $v = is_bool($v) ? $castBool($v) : $v;
                if ($v !== null) {
                    $qs .= '=' . $encoder((string)$v);
                }

                $qs .= '&';
            } else {
                foreach ($v as $vv) {
                    $qs .= $k;
                    $vv = is_bool($vv) ? $castBool($vv) : $vv;
                    if ($vv !== null) {
                        $qs .= '=' . $encoder((string)$vv);
                    }

                    $qs .= '&';
                }
            }
        }

        return $qs ? substr($qs, 0, -1) : '';
    }
}
