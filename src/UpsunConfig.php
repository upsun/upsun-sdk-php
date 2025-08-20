<?php

namespace Upsun;

class UpsunConfig
{
    public function __construct(
        public readonly string $base_url = "https://api.upsun.com",
        public readonly string $auth_url = "https://auth.upsun.com",
        public readonly string $apiKey = "UPSUN_CLI_TOKEN is not defined!",
        public readonly string $token_endpoint = "oauth2/token",
        public readonly string $refresh_endpoint = "oauth2/token",
        public readonly string $clientId = "sdk-php-client-id",
    ) {
    }
}
