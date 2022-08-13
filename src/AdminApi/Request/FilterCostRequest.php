<?php

namespace Playtini\KeitaroClient\AdminApi\Request;

/**
 * Send a key-value object to apply filters to clicks. For example, {"sub_id_1": "1,2,3", "source": "site.ru"}.
 */
class FilterCostRequest implements \JsonSerializable
{
    public function __construct(
        public readonly ?string $keyword = null,
        public readonly ?float $cost = null,
        public readonly ?string $currency = null,
        public readonly ?string $externalId = null,
        public readonly ?string $creativeId = null,
        public readonly ?string $adCampaignId = null,
        public readonly ?string $source = null,
        public readonly ?string $subId1 = null,
        public readonly ?string $subId2 = null,
        public readonly ?string $subId3 = null,
        public readonly ?string $subId4 = null,
        public readonly ?string $subId5 = null,
        public readonly ?string $subId6 = null,
        public readonly ?string $subId7 = null,
        public readonly ?string $subId8 = null,
        public readonly ?string $subId9 = null,
        public readonly ?string $subId10 = null,
        public readonly ?string $subId11 = null,
        public readonly ?string $subId12 = null,
        public readonly ?string $subId13 = null,
        public readonly ?string $subId14 = null,
        public readonly ?string $subId15 = null,
    ) {
    }

    public function jsonSerialize(): array
    {
        return array_filter(
            [
                'keyword' => $this->keyword,
                'cost' => $this->cost,
                'currency' => $this->currency,
                'external_id' => $this->externalId,
                'creative_id' => $this->creativeId,
                'ad_campaign_id' => $this->adCampaignId,
                'source' => $this->source,
                'sub_id_1' => $this->subId1,
                'sub_id_2' => $this->subId2,
                'sub_id_3' => $this->subId3,
                'sub_id_4' => $this->subId4,
                'sub_id_5' => $this->subId5,
                'sub_id_6' => $this->subId6,
                'sub_id_7' => $this->subId7,
                'sub_id_8' => $this->subId8,
                'sub_id_9' => $this->subId9,
                'sub_id_10' => $this->subId10,
                'sub_id_11' => $this->subId11,
                'sub_id_12' => $this->subId12,
                'sub_id_13' => $this->subId13,
                'sub_id_14' => $this->subId14,
                'sub_id_15' => $this->subId15,
            ],
            static fn($v): bool => $v !== null
        );
    }
}
