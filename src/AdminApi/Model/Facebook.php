<?php

namespace Playtini\KeitaroClient\AdminApi\Model;

class Facebook
{
    public function __construct(
        public readonly int $id, // Integration ID
        public readonly string $integration, // The integration name
        public readonly bool $proxyEnabled, // Use proxy
        public readonly string $name, // The integration name
        public readonly string $adAccountId, // Facebook account ID
        public readonly string $token, // Facebook token
        public readonly string $lastError, // Last error
        public readonly string $lastRawError, // Error message from facebook
        public readonly Proxy $proxy,
    ) {
    }
}
