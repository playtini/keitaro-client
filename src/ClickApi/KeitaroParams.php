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
        public readonly ?string $extraParam1 = null,
        public readonly ?string $extraParam2 = null,
        public readonly ?string $extraParam3 = null,
        public readonly ?string $extraParam4 = null,
        public readonly ?string $extraParam5 = null,
        public readonly ?string $extraParam6 = null,
        public readonly ?string $extraParam7 = null,
        public readonly ?string $extraParam8 = null,
        public readonly ?string $extraParam9 = null,
        public readonly ?string $extraParam10 = null,
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
            extraParam1: $a['extra_param_1'] ?? null,
            extraParam2: $a['extra_param_2'] ?? null,
            extraParam3: $a['extra_param_3'] ?? null,
            extraParam4: $a['extra_param_4'] ?? null,
            extraParam5: $a['extra_param_5'] ?? null,
            extraParam6: $a['extra_param_6'] ?? null,
            extraParam7: $a['extra_param_7'] ?? null,
            extraParam8: $a['extra_param_8'] ?? null,
            extraParam9: $a['extra_param_9'] ?? null,
            extraParam10: $a['extra_param_10'] ?? null,
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
                'extra_param_1' => $this->extraParam1,
                'extra_param_2' => $this->extraParam2,
                'extra_param_3' => $this->extraParam3,
                'extra_param_4' => $this->extraParam4,
                'extra_param_5' => $this->extraParam5,
                'extra_param_6' => $this->extraParam6,
                'extra_param_7' => $this->extraParam7,
                'extra_param_8' => $this->extraParam8,
                'extra_param_9' => $this->extraParam9,
                'extra_param_10' => $this->extraParam10,
                'log' => $this->log,
            ],
            static fn($v) => $v !== null
        );
    }
}
