<?php

namespace Playtini\KeitaroClient\AdminApi\Enum;

enum CampaignStateEnum: string
{
    case Active = 'active';
    case Disabled = 'disabled';
    case Deleted = 'deleted';
}
