<?php

namespace Playtini\KeitaroClient\AdminApi\Enum;

enum LandingStateEnum: string
{
    case Active = 'active';
    case Disabled = 'disabled';
    case Deleted = 'deleted';
}
