<?php

namespace Playtini\KeitaroClient\AdminApi\Enum;

enum FlowTypeEnum: string
{
    case Forced = 'forced';
    case Regular = 'regular';
    case Default = 'default';
}
