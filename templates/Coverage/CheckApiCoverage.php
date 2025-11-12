<?php

namespace Upsun\Coverage;

require 'vendor/autoload.php';

use PhpParser\NodeTraverser;
use PhpParser\ParserFactory;
use Upsun\Coverage\Collector\ApiMethodCall;
use Upsun\Coverage\Collector\FacadeMethodCall;

function scanDirectory($directory, $parser, $traverser)
{
    $excludedClasses = [
        'src/Api/AbstractApi.php',
        'src/Api/ApiConfiguration.php',
        'src/Api/ApiException.php',
        'src/Api/ApiHeaderSelector.php',
        'src/Api/Serializer/ApiObjectAttributesMapper.php',
        'src/Api/Serializer/ApiObjectFormatsMapper.php',
        'src/Api/Serializer/ApiObjectTypesMapper.php',
        'src/Api/Serializer/ObjectSerializer.php',
    ];

    if (!is_dir($directory)) {
        echo "Warning: Directory $directory does not exist\n";
        return;
    }

    $directoryIterator = new \RecursiveDirectoryIterator($directory);
    $iterator = new \RecursiveIteratorIterator($directoryIterator);
    $phpFiles = new \RegexIterator($iterator, '/^.+\.php$/i');

    foreach ($phpFiles as $file) {
        if (in_array($file->getPathName(), $excludedClasses, true)) {
            continue;
        }

        $code = file_get_contents($file->getPathname());
        try {
            $ast = $parser->parse($code);
            $traverser->traverse($ast);
        } catch (\Exception $e) {
            echo "Error parsing {$file->getPathname()}: {$e->getMessage()}\n";
        }
    }
}

// Init
$parser = (new ParserFactory())->createForNewestSupportedVersion();

// 1. Collect all Api methods
echo "=== Scanning API classes ===\n";
$apiCollector = new ApiMethodCall();
$apiTraverser = new NodeTraverser();
$apiTraverser->addVisitor($apiCollector);
scanDirectory('src/Api', $parser, $apiTraverser);

$apiMethods = $apiCollector->getApiMethods();
echo "\nFound " . count($apiMethods) . " public API methods\n\n";

// 2. Collect all Facades methods
echo "=== Scanning Facade classes ===\n";
$facadeCollector = new FacadeMethodCall();
$facadeTraverser = new NodeTraverser();
$facadeTraverser->addVisitor($facadeCollector);
scanDirectory('src/Core/Tasks', $parser, $facadeTraverser);

$calledMethods = array_unique($facadeCollector->getCalledMethods());
echo "\nFound " . count($calledMethods) . " method calls in facades\n";

// 3.a. Identify unmapped API methods
$unmappedMethods = [];
foreach ($apiMethods as $apiMethod) {
    $found = false;

    // Check if the method is called (exact match)
    foreach ($calledMethods as $calledMethod) {
        if ($apiMethod === $calledMethod) {
            $found = true;
            break;
        }
    }

    if (!$found) {
        $unmappedMethods[] = $apiMethod;
    }
}

// 3.b. Identify invalid Facade calls (methods that don't exist in API classes)
$invalidCalls = [];
foreach ($calledMethods as $calledMethod) {
    if (!in_array($calledMethod, $apiMethods, true)) {
        $invalidCalls[] = $calledMethod;
    }
}

// 4. Generate results
$results = [
    'total_api_methods' => count($apiMethods),
    'called_methods' => count($calledMethods),
    'unmapped_methods' => $unmappedMethods,
    'invalid_facade_calls' => $invalidCalls,
    'coverage_percentage' => count($apiMethods) > 0
        ? round((1 - count($unmappedMethods) / count($apiMethods)) * 100, 2)
        : 0
];

file_put_contents('api-coverage.json', json_encode($results, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

echo "\n=== Coverage ===\n";
echo "\n" . $results['coverage_percentage'] . "%\n";

echo "\nDetailed results saved to api-coverage.json\n";
