<?php

namespace Playtini\KeitaroClient\AdminApi\Enum;

enum CampaignUniquenessMethodEnum: string
{
    case Ip = 'ip';
    case IpUserAgent = 'ip_ua';
}
