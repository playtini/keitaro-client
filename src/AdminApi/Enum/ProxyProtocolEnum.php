<?php

/** @noinspection PhpDuplicateMatchArmBodyInspection */

namespace Playtini\KeitaroClient\AdminApi\Enum;

enum ProxyProtocolEnum: string
{
    case Http = 'http';
    case Https = 'https';
    case Socks5 = 'socks5';
}
