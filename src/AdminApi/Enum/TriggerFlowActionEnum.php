<?php

namespace Playtini\KeitaroClient\AdminApi\Enum;

enum TriggerFlowActionEnum: string
{
    case Disable = 'disable';
    case ReplaceUrl = 'replace_url';
    case GrabFromPage = 'grab_from_page';
}
