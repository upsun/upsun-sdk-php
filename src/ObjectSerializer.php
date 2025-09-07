<?php

namespace Upsun;

use DateTime;
use ReflectionClass;
use ReflectionProperty;

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
    private static string $dateTimeFormat = \DateTime::ATOM;

    /**
     * Change the date format
     */
    public static function setDateTimeFormat(string $format): void
    {
        self::$dateTimeFormat = $format;
    }

    /**
     * Serialize data
     *
     * @param mixed  $data   the data to serialize
     * @param string|null $type   the OpenAPIToolsType of the data
     * @param string|null $format the format of the OpenAPITools type of the data
     *
     * @return scalar|object|array|null serialized form of $data
     */
    public static function sanitizeForSerialization(mixed $data, ?string $type = null, ?string $format = null)
    {
        if (is_scalar($data) || null === $data) {
            return $data;
        }

        if ($data instanceof \DateTime) {
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
                $formats = $data::openAPIFormats();
                foreach ($data::openAPITypes() as $property => $openAPIType) {
                    $getter = $data::getters()[$property];
                    $value = $data->$getter();
                    if ($value !== null && !in_array($openAPIType, ['\DateTime', '\SplFileObject', 'array', 'bool', 'boolean', 'byte', 'float', 'int', 'integer', 'mixed', 'number', 'object', 'string', 'void'], true)) {
                        $callable = [$openAPIType, 'getAllowableEnumValues'];
                        if (is_callable($callable)) {
                            /** array $callable */
                            $allowedEnumTypes = $callable();
                            if (!in_array($value, $allowedEnumTypes, true)) {
                                $imploded = implode("', '", $allowedEnumTypes);
                                throw new \InvalidArgumentException(
                                    "Invalid value for enum '$openAPIType', must be one of: '$imploded'"
                                );
                            }
                        }
                    }
                    if (($data::isNullable($property) && $data->isNullableSetToNull($property)) || $value !== null) {
                        $values[$data::attributeMap()[$property]]
                            = self::sanitizeForSerialization($value, $openAPIType, $formats[$property]);
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
     *
     * @param string $filename filename to be sanitized
     *
     * @return string the sanitized filename
     */
    public static function sanitizeFilename($filename)
    {
        if (preg_match("/.*[\/\\\\](.*)$/", $filename, $match)) {
            return $match[1];
        } else {
            return $filename;
        }
    }

    /**
     * Shorter timestamp microseconds to 6 digits length.
     *
     * @param string $timestamp Original timestamp
     *
     * @return string the shorten timestamp
     */
    public static function sanitizeTimestamp($timestamp)
    {
        if (!is_string($timestamp)) return $timestamp;

        return preg_replace('/(:\d{2}.\d{6})\d*/', '$1', $timestamp);
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
     * Checks if a value is empty, based on its OpenAPI type.
     *
     * @param mixed  $value
     * @param string $openApiType
     *
     * @return bool true if $value is empty
     */
    private static function isEmptyValue($value, string $openApiType): bool
    {
        # If empty() returns false, it is not empty regardless of its type.
        if (!empty($value)) {
            return false;
        }

        # Null is always empty, as we cannot send a real "null" value in a query parameter.
        if ($value === null) {
            return true;
        }

        switch ($openApiType) {
            # For numeric values, false and '' are considered empty.
            # This comparison is safe for floating point values, since the previous call to empty() will
            # filter out values that don't match 0.
            case 'int':
            case 'integer':
                return $value !== 0;

            case 'number':
            case 'float':
                return $value !== 0 && $value !== 0.0;

            # For boolean values, '' is considered empty
            case 'bool':
            case 'boolean':
                return !in_array($value, [false, 0], true);

            # For string values, '' is considered empty.
            case 'string':
                return $value === '';

            # For all the other types, any value at this point can be considered empty.
            default:
                return true;
        }
    }

    /**
     * Take query parameter properties and turn it into an array suitable for
     * native http_build_query or GuzzleHttp\Psr7\Query::build.
     *
     * @param mixed  $value       Parameter value
     * @param string $paramName   Parameter name
     * @param string $openApiType OpenAPIType eg. array or object
     * @param string $style       Parameter serialization style
     * @param bool   $explode     Parameter explode option
     * @param bool   $required    Whether query param is required or not
     *
     * @return array
     */
    public static function toQueryValue(
        $value,
        string $paramName,
        string $openApiType = 'string',
        string $style = 'form',
        bool $explode = true,
        bool $required = true
    ): array {

        # Check if we should omit this parameter from the query. This should only happen when:
        #  - Parameter is NOT required; AND
        #  - its value is set to a value that is equivalent to "empty", depending on its OpenAPI type. For
        #    example, 0 as "int" or "boolean" is NOT an empty value.
        if (self::isEmptyValue($value, $openApiType)) {
            if ($required) {
                return ["{$paramName}" => ''];
            } else {
                return [];
            }
        }

        # Handle DateTime objects in query
        if($openApiType === "\\DateTime" && $value instanceof \DateTime) {
            return ["{$paramName}" => $value->format(self::$dateTimeFormat)];
        }

        $query = [];
        $value = (in_array($openApiType, ['object', 'array'], true)) ? (array)$value : $value;

        // since \GuzzleHttp\Psr7\Query::build fails with nested arrays
        // need to flatten array first
        $flattenArray = function ($arr, $name, &$result = []) use (&$flattenArray, $style, $explode) {
            if (!is_array($arr)) return $arr;

            foreach ($arr as $k => $v) {
                $prop = ($style === 'deepObject') ? $prop = "{$name}[{$k}]" : $k;

                if (is_array($v)) {
                    $flattenArray($v, $prop, $result);
                } else {
                    if ($style !== 'deepObject' && !$explode) {
                        // push key itself
                        $result[] = $prop;
                    }
                    $result[$prop] = $v;
                }
            }
            return $result;
        };

        $value = $flattenArray($value, $paramName);

        // https://github.com/OAI/OpenAPI-Specification/blob/main/versions/3.1.0.md#style-values
        if ($openApiType === 'array' && $style === 'deepObject' && $explode) {
            return $value;
        }

        if ($openApiType === 'object' && ($style === 'deepObject' || $explode)) {
            return $value;
        }

        if ('boolean' === $openApiType && is_bool($value)) {
            $value = self::convertBoolToQueryStringFormat($value);
        }

        // handle style in serializeCollection
        $query[$paramName] = ($explode) ? $value : self::serializeCollection((array)$value, $style);

        return $query;
    }

    /**
     * Convert boolean value to format for query string.
     *
     * @param bool $value Boolean value
     *
     * @return int|string Boolean value in format
     */
    public static function convertBoolToQueryStringFormat(bool $value)
    {
        if (
            Configuration::BOOLEAN_FORMAT_STRING 
            == Configuration::getDefaultConfiguration()->getBooleanFormatForQueryString()
        ) {
            return $value ? 'true' : 'false';
        }

        return (int) $value;
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
        $callable = [$value, 'toHeaderValue'];
        if (is_callable($callable)) {
            return $callable();
        }

        return self::toString($value);
    }

    /**
     * Take value and turn it into a string suitable for inclusion in
     * the parameter. If it's a string, pass through unchanged
     * If it's a datetime object, format it in ISO8601
     * If it's a boolean, convert it to "true" or "false".
     *
     * @param float|int|bool|\DateTime $value the value of the parameter
     *
     * @return string the header string
     */
    public static function toString($value)
    {
        if ($value instanceof \DateTime) { // datetime in ISO8601 format
            return $value->format(self::$dateTimeFormat);
        } elseif (is_bool($value)) {
            return $value ? 'true' : 'false';
        } else {
            return (string) $value;
        }
    }

    /**
     * Serialize an array to a string.
     *
     * @param array  $collection                 collection to serialize to a string
     * @param string $style                      the format use for serialization (csv,
     * ssv, tsv, pipes, multi)
     * @param bool   $allowCollectionFormatMulti allow collection format to be a multidimensional array
     *
     * @return string
     */
    public static function serializeCollection(array $collection, $style, $allowCollectionFormatMulti = false)
    {
        if ($allowCollectionFormatMulti && ('multi' === $style)) {
            // http_build_query() almost does the job for us. We just
            // need to fix the result of multidimensional arrays.
            return preg_replace('/%5B[0-9]+%5D=/', '=', http_build_query($collection, '', '&'));
        }
        switch ($style) {
            case 'pipeDelimited':
            case 'pipes':
                return implode('|', $collection);

            case 'tsv':
                return implode("\t", $collection);

            case 'spaceDelimited':
            case 'ssv':
                return implode(' ', $collection);

            case 'simple':
            case 'csv':
                // Deliberate fall through. CSV is default format.
            default:
                return implode(',', $collection);
        }
    }

    /**
     * Simple deserializer for new models with parameterized constructors
     */
    private static function deserializeSimplifiedModel($data, string $class)
    {
        if (null === $data) {
            return null;
        }
    
        if (!class_exists($class)) {
            throw new \InvalidArgumentException("Class {$class} does not exist");
        }
    
        if (substr($class, -2) === '[]') {
            $subClass = substr($class, 0, -2);
            if (!is_array($data)) {
                throw new \InvalidArgumentException("Data must be an array to deserialize into {$class}");
            }
            return array_map(fn($item) => self::deserializeSimplifiedModel($item, $subClass), $data);
        }
    
        $reflectionClass = new \ReflectionClass($class);
        $constructor = $reflectionClass->getConstructor();
    
        if (!$constructor) {
            return new $class(); // no-arg constructor
        }
    
        $args = [];
        foreach ($constructor->getParameters() as $param) {
            $paramName = $param->getName();
            $paramType = $param->getType();
            $allowsNull = $paramType?->allowsNull() ?? true;
    
            $jsonKey = $paramName; // fallback
            if (method_exists($class, 'attributeMap')) {
                $attributeMap = $class::attributeMap();
                $jsonKey = $attributeMap[$paramName] ?? $paramName;
            }
            $value = null;
            if (is_object($data)) {
                $value = $data->{$jsonKey} ?? $data->{$paramName} ?? null;
            } elseif (is_array($data)) {
                $value = $data[$jsonKey] ?? $data[$paramName] ?? null;
            }

            if ($value instanceof \stdClass && $paramType?->getName() === 'array') {
                $value = (array) $value;
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

                if ($paramType && $paramType->getName() === 'array' && $value !== null && is_array($value)) {
                    if (method_exists($class, 'openAPITypes')) {
                        $types = $class::openAPITypes();
        
                        if (isset($types[$paramName]) && str_ends_with($types[$paramName], '[]')) {
                            $itemClass = substr($types[$paramName], 0, -2); // Enlever []
        
                            if (class_exists($itemClass)) {
                                $args[] = array_map(function($item) use ($itemClass) {
                                    return self::deserializeSimplifiedModel($item, $itemClass);
                                }, $value);
                                continue;
                            }
                        }
                    }
                    
                    // Fallback si pas de métadonnées
                    $args[] = $value ?? [];
                }

                
                if (substr($typeName, -2) === '[]') {
                    $subClass = substr($typeName, 0, -2);
                    $args[] = $value !== null
                        ? array_map(fn($item) => self::deserializeSimplifiedModel($item, $subClass), (array)$value)
                        : [];
                    continue;
                }
    
                if ($paramType->isBuiltin()) {
                    switch ($typeName) {
                        case 'string': $args[] = $value !== null ? (string)$value : null; break;
                        case 'int':    $args[] = $value !== null ? (int)$value : null; break;
                        case 'float':  $args[] = $value !== null ? (float)$value : null; break;
                        case 'bool':   $args[] = $value !== null ? (bool)$value : null; break;
                        case 'array':  break;
                        case 'object': $args[] = $value !== null ? (object)$value : null; break;
                        default: $args[] = $value; break;
                    }
                } elseif ($typeName === 'DateTime') {
                    $args[] = $value !== null ? new \DateTime($value) : null;
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

            if ($args[count($args)-1] === null && !$allowsNull) {
                if (method_exists($class, 'openAPITypes')) {
                    $types = $class::openAPITypes();
                    var_dump('ici'. $types[$jsonKey]);
                    if (isset($types[$jsonKey]) && str_contains($types[$jsonKey], 'null')) {
                        continue;
                    }
                }
                throw new \InvalidArgumentException("Required value '{$paramName}' missing for class {$class}");
            }
        }
    
        return new $class(...$args);
    }


    public static function deserialize($data, string $class, $httpHeaders = null, $discriminator = null)
    {    
        if ($data === null) {
            return null;
        }

        // Handle ActivityCollection (or any Collection schema with only "items")
        if (class_exists($class) && is_subclass_of($class, ModelInterface::class)) {
            $types = $class::openAPITypes();
            if (isset($types['items']) && str_ends_with($types['items'], '[]')) {
                $subClass = substr($types['items'], 0, -2);
                $values = [];
                foreach ($data as $item) {
                    $values[] = self::deserialize($item, $subClass, $httpHeaders, $discriminator);
                }
                return $values;
            }
        }
        
        // Handle array of models
        if (substr($class, -2) === '[]') {
            $subClass = substr($class, 0, -2); // remove []
            $values = [];

            if (!is_array($data)) {
                throw new \InvalidArgumentException("Data must be an array to deserialize into {$class}");
            }

            foreach ($data as $item) {
                $values[] = self::deserialize($item, $subClass, $httpHeaders, $discriminator);
            }

            return $values;
        }

        // Primitive types
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
            case 'byte':
                return (string) $data;
            case 'mixed':
                return $data;
            case 'array':
                return (array) $data;
            case 'DateTime':
                return new \DateTime($data);
            case 'SplFileObject':
                $data = Utils::streamFor($data);

                /** @var \Psr\Http\Message\StreamInterface $data */
    
                // determine file name
                if (
                    is_array($httpHeaders)
                    && array_key_exists('Content-Disposition', $httpHeaders)
                    && preg_match('/inline; filename=[\'"]?([^\'"\s]+)[\'"]?$/i', $httpHeaders['Content-Disposition'], $match)
                ) {
                    $filename = Configuration::getDefaultConfiguration()->getTempFolderPath() . DIRECTORY_SEPARATOR . self::sanitizeFilename($match[1]);
                } else {
                    $filename = tempnam(Configuration::getDefaultConfiguration()->getTempFolderPath(), '');
                }
    
                $file = fopen($filename, 'w');
                while ($chunk = $data->read(200)) {
                    fwrite($file, $chunk);
                }
                fclose($file);
    
                return new \SplFileObject($filename, 'r');
            default:
                // Nested model
                return self::deserializeSimplifiedModel($data, $class);
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
    public static function buildQuery(array $params, $encoding = PHP_QUERY_RFC3986): string
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
    
    private static function guessItemClass(string $parentClass, string $paramName): ?string 
    {
        if (preg_match('/List(\w+)200Response$/', $parentClass, $matches)) {
            $modelName = $matches[1];
            $singular = rtrim($modelName, 's');
            return "\\Upsun\\Model\\{$singular}";
        }
        
        return null;
    }
}
