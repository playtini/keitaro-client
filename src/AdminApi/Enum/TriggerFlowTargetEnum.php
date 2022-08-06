<?php

namespace Playtini\KeitaroClient\AdminApi\Enum;

enum TriggerFlowTargetEnum: string
{
    case Flow = 'stream';
    case Landings = 'landings';
    case Offers = 'offers';
    case SelectedPage = 'selected_page';
}
