<?php

namespace Playtini\KeitaroClient\AdminApi\Model;

class SourceParameters
{
    public function __construct(
        public readonly PlaceholderObject $keyword,
        public readonly PlaceholderObject $cost,
        public readonly PlaceholderObject $currency,
        public readonly PlaceholderObject $externalId,
        public readonly PlaceholderObject $creativeId,
        public readonly PlaceholderObject $adCampaignId,
        public readonly PlaceholderObject $source,
        public readonly PlaceholderObject $subId1,
        public readonly PlaceholderObject $subId2,
        public readonly PlaceholderObject $subId3,
        public readonly PlaceholderObject $subId4,
        public readonly PlaceholderObject $subId5,
        public readonly PlaceholderObject $subId6,
        public readonly PlaceholderObject $subId7,
        public readonly PlaceholderObject $subId8,
        public readonly PlaceholderObject $subId9,
        public readonly PlaceholderObject $subId10,
        public readonly PlaceholderObject $subId11,
        public readonly PlaceholderObject $subId12,
        public readonly PlaceholderObject $subId13,
        public readonly PlaceholderObject $subId14,
        public readonly PlaceholderObject $subId15,
    ) {
    }

    public static function create(array $a): self
    {
        // TODO: fix
        return new self(
            PlaceholderObject::create($a['keyword'] ?? null, 'keyword'),
            PlaceholderObject::create($a['cost'] ?? null, 'cost'),
            PlaceholderObject::create($a['currency'] ?? null, 'currency'),
            PlaceholderObject::create($a['external_id'] ?? null, 'external_id'),
            PlaceholderObject::create($a['creative_id'] ?? null, 'creative_id'),
            PlaceholderObject::create($a['ad_campaign_id'] ?? null, 'ad_campaign_id'),
            PlaceholderObject::create($a['source'] ?? null, 'source'),
            PlaceholderObject::create($a['sub_id_1'] ?? null, 'sub_id_1'),
            PlaceholderObject::create($a['sub_id_2'] ?? null, 'sub_id_2'),
            PlaceholderObject::create($a['sub_id_3'] ?? null, 'sub_id_3'),
            PlaceholderObject::create($a['sub_id_4'] ?? null, 'sub_id_4'),
            PlaceholderObject::create($a['sub_id_5'] ?? null, 'sub_id_5'),
            PlaceholderObject::create($a['sub_id_6'] ?? null, 'sub_id_6'),
            PlaceholderObject::create($a['sub_id_7'] ?? null, 'sub_id_7'),
            PlaceholderObject::create($a['sub_id_8'] ?? null, 'sub_id_8'),
            PlaceholderObject::create($a['sub_id_9'] ?? null, 'sub_id_9'),
            PlaceholderObject::create($a['sub_id_10'] ?? null, 'sub_id_10'),
            PlaceholderObject::create($a['sub_id_11'] ?? null, 'sub_id_11'),
            PlaceholderObject::create($a['sub_id_12'] ?? null, 'sub_id_12'),
            PlaceholderObject::create($a['sub_id_13'] ?? null, 'sub_id_13'),
            PlaceholderObject::create($a['sub_id_14'] ?? null, 'sub_id_14'),
            PlaceholderObject::create($a['sub_id_15'] ?? null, 'sub_id_15'),
        );
    }
}
