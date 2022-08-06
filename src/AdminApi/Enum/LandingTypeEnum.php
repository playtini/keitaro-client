<?php

namespace Playtini\KeitaroClient\AdminApi\Enum;

enum LandingTypeEnum: string
{
    case Local = 'local';
    case External = 'external';
    case Preloaded = 'preloaded';
    case Action = 'action';
}
