<?php

namespace Playtini\KeitaroClient\AdminApi\Request;

use Playtini\KeitaroClient\AdminApi\Model\Proxy;

class FacebookRequest
{
    public function __construct(
        public readonly string $name, // The integration name
        public readonly string $adAccountId, // Facebook account ID
        public readonly string $token, // Facebook token
        public readonly bool $proxyEnabled, // Use proxy to connect
        public readonly Proxy $proxy,
    ) {
    }
}
