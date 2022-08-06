<?php

namespace Playtini\KeitaroClient\AdminApi\Request;

class ClicksUpdateCostsRequest
{
    public function __construct(
        public readonly array $campaignIds = [], // int[]. Array of campaigns IDs
        public readonly ClicksUpdateCostsPayloadCollection $costs = new ClicksUpdateCostsPayloadCollection([]),
        public readonly ?string $timezone = null,
        public readonly ?string $currency = null,
        public readonly int $onlyCampaignUniques = 0, // TODO: test if boolean is ok
    ) {
    }
}
