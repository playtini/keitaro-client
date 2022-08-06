<?php

namespace Playtini\KeitaroClient\AdminApi\Enum;

enum TriggerFlowConditionEnum: string
{
    case NotRespond = 'not_respond';
    case Always = 'always';
    case NotContains = 'not_contains';
    case AvDetected = 'av_detected';
}
