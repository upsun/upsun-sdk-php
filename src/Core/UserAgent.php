<?php

namespace Upsun\Core;

use Composer\InstalledVersions;

final class UserAgent
{
    private static ?string $sdkUserAgent = null;

    private static ?string $clientMetadata = null;

    public static function get(): string
    {
        return self::getSdkUserAgent();
    }

    public static function getSdkUserAgent(): string
    {
        if (self::$sdkUserAgent !== null) {
            return self::$sdkUserAgent;
        }

        self::$sdkUserAgent = sprintf('upsun-sdk-php@%s', self::resolveVersion());

        return self::$sdkUserAgent;
    }

    public static function getClientMetadata(): string
    {
        if (self::$clientMetadata !== null) {
            return self::$clientMetadata;
        }

        $parts = [
            'php/' . PHP_VERSION,
        ];

        if (function_exists('curl_version')) {
            $curl = curl_version();
            if (!empty($curl['version'])) {
                $parts[] = 'curl/' . $curl['version'];
            }
        }

        $parts[] = strtolower(PHP_OS_FAMILY);

        self::$clientMetadata = implode(' ', $parts);

        return self::$clientMetadata;
    }

    private static function resolveVersion(): string
    {
        $version = 'dev';

        if (class_exists(InstalledVersions::class)) {
            $version = InstalledVersions::getPrettyVersion('upsun/upsun-sdk-php') ?? 'dev';
        }

        return $version;
    }
}
