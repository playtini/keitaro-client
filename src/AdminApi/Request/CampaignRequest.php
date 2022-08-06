<?php

/** @noinspection SpellCheckingInspection */

namespace Playtini\KeitaroClient\AdminApi\Request;

use Playtini\KeitaroClient\AdminApi\Enum\CampaignBindVisitorsEnum;
use Playtini\KeitaroClient\AdminApi\Enum\CampaignCostTypeEnum;
use Playtini\KeitaroClient\AdminApi\Enum\CampaignStateEnum;
use Playtini\KeitaroClient\AdminApi\Enum\CampaignTypeEnum;
use Playtini\KeitaroClient\AdminApi\Model\S2SPostbackCollection;
use Playtini\KeitaroClient\AdminApi\Model\SourceParameters;

class CampaignRequest
{
    public function __construct(
        public readonly string $alias = '', // Campaign Alias which is Used in URL http://domain.com/ALIAS
        public readonly CampaignTypeEnum $type = CampaignTypeEnum::Position, // Flow Rotation Type. Set 'weight' to enable split-testing the flows.
        public readonly string $name = '', // Campaign Name
        public readonly int $cookiesTtl = 24, // When the Click Gets Unique Status Again, in Hours
        public readonly int $position = 0,
        public readonly CampaignStateEnum $state = CampaignStateEnum::Active, // Campaign State
        public readonly CampaignCostTypeEnum $costType = CampaignCostTypeEnum::CPC, // Cost Type
        public readonly float $costValue = 0.0, // Cost Value
        public readonly string $costCurrency = '', // Currency Value EUR/USD/RUB/UAH/GBP. Default Value is Taken from the Tracker's Settings.
        public readonly ?int $groupId = null, // Campaign Group ID
        public readonly ?CampaignBindVisitorsEnum $bindVisitors = null, // Bind Visitors Feature (null - disabled/ s - only to streams/ sl - to streams and LPs/ slo — to streams, LPs and offers).
        public readonly ?int $trafficSourceId = null, // Traffic source ID
        public readonly string $token = '', // Token to gain access to Click API
        public readonly bool $costAuto = false, // Enable Automatic Costs (0/1)
        public readonly ?SourceParameters $parameters = null,
        public readonly ?S2SPostbackCollection $postbacks = null, // Campaign S2S postback
        public readonly string $notes = '', // Notes for the campaign
        public readonly ?\DateTimeInterface $createdAt = null,
        public readonly ?\DateTimeInterface $updatedAt = null,
        public readonly int $domainId = 0, // Domain ID
    ) {
    }
}
