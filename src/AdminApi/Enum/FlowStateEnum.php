<?php

namespace Playtini\KeitaroClient\AdminApi\Enum;

enum FlowStateEnum: string
{
    case Active = 'active';
    case Disabled = 'disabled';
    case Deleted = 'deleted';
}
