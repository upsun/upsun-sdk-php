<?php

namespace Upsun\Core;

/**
 * TokenProvider
 *
 * Contract for any object that can supply a Bearer authorization header value.
 * Calling the provider with `$force = true` must guarantee that a fresh token
 * is obtained before the value is returned (e.g. after receiving a 401).
 *
 * Analogous to `type TokenProvider = (force?: boolean) => string` in the Node SDK.
 *
 * Implementations:
 * @see \Upsun\Core\OAuthProvider — OAuth2 client-credentials implementation
 * @see \Upsun\UpsunClient        — façade covering OAuth2 and static bearer modes
 */
interface TokenProvider
{
    /**
     * Return the current authorization header value (e.g. `"Bearer eyJ..."`).
     *
     * @param bool $force When true, force-refresh the token before returning.
     * @return string The full Authorization header value.
     */
    public function __invoke(bool $force = false): string;
}
