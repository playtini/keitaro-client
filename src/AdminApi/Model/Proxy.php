<?php

namespace Playtini\KeitaroClient\AdminApi\Model;

use Playtini\KeitaroClient\AdminApi\Enum\ProxyProtocolEnum;

class Proxy
{
    public function __construct(
        public readonly ProxyProtocolEnum $protocol, // Protocol
        public readonly string $address, // Proxy address
        public readonly int $port, // Proxy port
        public readonly string $login, // Proxy login
        public readonly string $password, // Proxy password
    ) {
    }
}
