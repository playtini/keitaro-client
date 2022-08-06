<?php

/** @noinspection SpellCheckingInspection */

namespace Playtini\KeitaroClient\AdminApi\Enum;

enum CampaignCostTypeEnum: string
{
    case CPM = 'CPM';
    case CPC = 'CPC';
    case CPUC = 'CPUC';
    case RevShare = 'RevShare';
    case CPA = 'CPA';
    case CPS = 'CPS';
    case CPUV = 'CPUV';
    case CPV = 'CPV';
}
