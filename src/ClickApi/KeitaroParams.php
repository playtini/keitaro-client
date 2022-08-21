<?php

namespace Playtini\KeitaroClient\ClickApi;

class KeitaroParams implements \JsonSerializable
{
    public function __construct(
        public readonly ?string $token = null,
        public readonly ?string $keyword = null,
        public readonly ?string $cost = null,
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
        public readonly ?string $log = null,
    ) {
    }

    public static function createFromQuery(array $a, string $campaignToken = null): self
    {
        return new self(
            token: $campaignToken,
            keyword: $a['keyword'] ?? null,
            cost: $a['cost'] ?? null,
            currency: $a['currency'] ?? null,
            externalId: $a['external_id'] ?? null,
            creativeId: $a['creative_id'] ?? null,
            adCampaignId: $a['ad_campaign_id'] ?? null,
            source: $a['source'] ?? null,
            subId1: $a['sub_id_1'] ?? null,
            subId2: $a['sub_id_2'] ?? null,
            subId3: $a['sub_id_3'] ?? null,
            subId4: $a['sub_id_4'] ?? null,
            subId5: $a['sub_id_5'] ?? null,
            subId6: $a['sub_id_6'] ?? null,
            subId7: $a['sub_id_7'] ?? null,
            subId8: $a['sub_id_8'] ?? null,
            subId9: $a['sub_id_9'] ?? null,
            subId10: $a['sub_id_10'] ?? null,
            subId11: $a['sub_id_11'] ?? null,
            subId12: $a['sub_id_12'] ?? null,
            subId13: $a['sub_id_13'] ?? null,
            subId14: $a['sub_id_14'] ?? null,
            subId15: $a['sub_id_15'] ?? null,
            log: $a['log'] ?? null,
        );
    }

    public static function createFromKeitaroRequest(KeitaroRequest $keitaroRequest, string $campaignToken = null): self
    {
        return self::createFromQuery($keitaroRequest->query, $campaignToken);
    }

    public function jsonSerialize(): array
    {
        return array_filter(
            [
                'token' => $this->token,
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
                'log' => $this->log,
            ],
            static fn($v) => $v !== null
        );
    }
}
