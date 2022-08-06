<?php

namespace Playtini\KeitaroClient\AdminApi\Request;

class BotListRequest
{
    public function __construct(
        public readonly string $value = '', // List of IPs. Example, 1.2.3.4\n2.3.4.5
    ) {
    }
}
