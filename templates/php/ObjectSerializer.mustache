<?php

namespace Upsun;

use DateTime;
use ReflectionClass;
use ReflectionProperty;

class ObjectSerializer
{
    /**
     * Serialize data
     *
     * @param mixed $data the data to serialize
     * @param string $type class name for deserialization
     * @param string $format the format of the data
     *
     * @return string|object serialized form of $data
     */
    public static function serialize(mixed $data, string $type, string $format)
    {
        if ($format === 'json') {
            return json_encode($data);
        }

        return $data;
    }

    /**
     * Deserialize a JSON string into an object
     *
     * @param mixed $data object or primitive to be deserialized
     * @param string $class class name is passed as a string
     * @param string[] $httpHeaders HTTP headers
     * @param string $discriminator discriminator if polymorphism is used
     *
     * @return object|array|null a single or an array of $class instances
     */
    public static function deserialize($data, $class, $httpHeaders = null, $discriminator = null)
    {
        if (null === $data) {
            return null;
        }

        if (strcasecmp(substr($class, -2), '[]') === 0) {
            // Handle array of objects
            $class = substr($class, 0, -2);
            $values = [];
            if (is_array($data)) {
                foreach ($data as $value) {
                    $values[] = self::deserialize($value, $class, $httpHeaders);
                }
            }
            return $values;
        }

        // Handle primitive types
        if (in_array($class, ['bool', 'boolean', 'int', 'integer', 'float', 'double', 'string', 'byte', 'mixed', 'DateTime', 'SplFileObject'])) {
            return self::deserializePrimitive($data, $class);
        }

        // Handle model objects
        return self::deserializeModel($data, $class);
    }

    /**
     * Deserialize primitive types
     */
    private static function deserializePrimitive($data, $class)
    {
        switch ($class) {
            case 'bool':
            case 'boolean':
                return (bool) $data;
            case 'int':
            case 'integer':
                return (int) $data;
            case 'float':
            case 'double':
                return (float) $data;
            case 'string':
                return (string) $data;
            case 'DateTime':
                return new DateTime($data);
            default:
                return $data;
        }
    }

    /**
     * Deserialize model objects using reflection
     */
    private static function deserializeModel($data, $class)
    {
        if (!class_exists($class)) {
            throw new \InvalidArgumentException("Class {$class} does not exist");
        }

        $reflectionClass = new ReflectionClass($class);
        $constructor = $reflectionClass->getConstructor();

        if (!$constructor) {
            // No constructor, try to create empty instance
            return new $class();
        }

        $constructorParams = $constructor->getParameters();
        $args = [];

        foreach ($constructorParams as $param) {
            $paramName = $param->getName();
            $paramType = $param->getType();

            // Map parameter name to JSON property name
            $jsonKey = self::getJsonPropertyName($paramName, $class);
            if (is_object($data)) {
                $value = property_exists($data, $jsonKey) ? $data->$jsonKey : null;
            } else {
                $value = $data[$jsonKey] ?? null;
            }

            // Handle parameter type
            if ($paramType) {
                $typeName = $paramType->getName();

                if ($typeName === 'array') {
                    $args[] = $value ?? [];
                } elseif ($typeName === 'object') {
                    $args[] = is_array($value) ? (object) $value : $value;
                } elseif ($typeName === 'DateTime') {
                    $args[] = $value ? new DateTime($value) : null;
                } elseif (class_exists($typeName)) {
                    // Nested model
                    if ($value !== null) {
                        $args[] = self::deserializeModel($value, $typeName);
                    } else {
                        // Vérifier si le paramètre est nullable
                        $paramType = $param->getType();
                        $isNullable = $paramType?->allowsNull() ?? true;
                        if ($isNullable) {
                            $args[] = null;
                        } else {
                            throw new \InvalidArgumentException(
                                "Cannot deserialize '{$paramName}' for class {$class}: value is required but missing"
                            );
                        }
                    }
                } else {
                    // Primitive type
                    $args[] = $value;
                }
            } else {
                $args[] = $value;
            }
        }

        return new $class(...$args);
    }

    /**
     * Map constructor parameter names to JSON property names
     * Override this method if your mapping is different
     */
    private static function getJsonPropertyName($paramName, $class)
    {
        // Common mappings - you can extend this based on your needs
        $mappings = [
            // Add your specific mappings here
            // 'constructorParamName' => 'json_property_name'
        ];

        return $mappings[$paramName] ?? $paramName;
    }

    /**
     * Sanitize filename for download
     */
    public static function sanitizeFilename($filename)
    {
        return preg_replace('/[^a-zA-Z0-9_.-]/', '', $filename);
    }

    /**
     * Take value and turn it into a string suitable for inclusion in
     * the path, by url-encoding.
     *
     * @param string $value a string which will be part of the path
     *
     * @return string the serialized object
     */
    public static function toPathValue($value)
    {
        return rawurlencode(self::toString($value));
    }

    /**
     * Take value and turn it into a string suitable for inclusion in
     * the query, by imploding comma-separated if it's an array, and url-encoding.
     *
     * @param string[]|string|\DateTime $object an object to be serialized to a string
     *
     * @return string the serialized object
     */
    public static function toQueryValue($object)
    {
        if (is_array($object)) {
            return implode(',', array_map([__CLASS__, 'toString'], $object));
        } else {
            return urlencode(self::toString($object));
        }
    }

    /**
     * Take value and turn it into a string suitable for inclusion in
     * the header. If it's a string, pass through unchanged
     * If it's a datetime object, format it in ISO8601
     *
     * @param string $value a string which will be part of the header
     *
     * @return string the header string
     */
    public static function toHeaderValue($value)
    {
        return self::toString($value);
    }

    /**
     * Take value and turn it into a string suitable for inclusion in
     * the http body (form parameter). If it's a string, pass through unchanged
     * If it's a datetime object, format it in ISO8601
     *
     * @param string|\SplFileObject $value the value to be formatted
     *
     * @return string the formatted string
     */
    public static function toFormValue($value)
    {
        if ($value instanceof \SplFileObject) {
            return $value->getRealPath();
        } else {
            return self::toString($value);
        }
    }

    /**
     * Take value and turn it into a string
     *
     * @param string|object $value object to be converted to string
     *
     * @return string the string representation of $value
     */
    public static function toString($value)
    {
        if ($value instanceof \DateTime) {
            return $value->format(DateTime::ATOM);
        } else {
            return (string) $value;
        }
    }
    
    /**
        * Build a query string from an array of key value pairs.
        *
        * This function can use the return value of `parse()` to build a query
        * string. This function does not modify the provided keys when an array is
        * encountered (like `http_build_query()` would).
        *
        * The function is copied from https://github.com/guzzle/psr7/blob/a243f80a1ca7fe8ceed4deee17f12c1930efe662/src/Query.php#L59-L112
        * with a modification which is described in https://github.com/guzzle/psr7/pull/603
        */
        public static function buildQuery(array $params, int|false $encoding = PHP_QUERY_RFC3986): string
        {
            if (!$params) {
                return '';
            }
    
            if ($encoding === false) {
                $encoder = function (string $str): string {
                    return $str;
                };
            } elseif ($encoding === PHP_QUERY_RFC3986) {
                $encoder = 'rawurlencode';
            } elseif ($encoding === PHP_QUERY_RFC1738) {
                $encoder = 'urlencode';
            } else {
                throw new \InvalidArgumentException('Invalid type');
            }
    
            $castBool = Configuration::BOOLEAN_FORMAT_INT == Configuration::getDefaultConfiguration()->getBooleanFormatForQueryString()
                ? function ($v) { return (int) $v; }
                : function ($v) { return $v ? 'true' : 'false'; };
    
            $qs = '';
            foreach ($params as $k => $v) {
                $k = $encoder((string) $k);
                if (!is_array($v)) {
                    $qs .= $k;
                    $v = is_bool($v) ? $castBool($v) : $v;
                    if ($v !== null) {
                        $qs .= '='.$encoder((string) $v);
                    }
                    $qs .= '&';
                } else {
                    foreach ($v as $vv) {
                        $qs .= $k;
                        $vv = is_bool($vv) ? $castBool($vv) : $vv;
                        if ($vv !== null) {
                            $qs .= '='.$encoder((string) $vv);
                        }
                        $qs .= '&';
                    }
                }
            }
    
            return $qs ? (string) substr($qs, 0, -1) : '';
        }
}