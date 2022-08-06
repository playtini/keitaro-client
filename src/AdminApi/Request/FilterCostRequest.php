<?php

namespace Playtini\KeitaroClient\AdminApi\Request;

/**
 * Send a key-value object to apply filters to clicks. For example, {"sub_id_1": "1,2,3", "source": "site.ru"}.
 */
class FilterCostRequest
{
    public function __construct(
        public readonly string $keyword,
        public readonly float $cost,
        public readonly string $currency,
        public readonly string $externalId,
        public readonly string $creativeId,
        public readonly string $adCampaignId,
        public readonly string $source,
        public readonly string $subId1,
        public readonly string $subId2,
        public readonly string $subId3,
        public readonly string $subId4,
        public readonly string $subId5,
        public readonly string $subId6,
        public readonly string $subId7,
        public readonly string $subId8,
        public readonly string $subId9,
        public readonly string $subId10,
        public readonly string $subId11,
        public readonly string $subId12,
        public readonly string $subId13,
        public readonly string $subId14,
        public readonly string $subId15,
    ) {
    }
}
