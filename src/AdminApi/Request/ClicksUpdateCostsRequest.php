<?php

namespace Playtini\KeitaroClient\AdminApi\Request;

class ClicksUpdateCostsRequest implements \JsonSerializable
{
    public function __construct(
        public readonly array $campaignIds = [0], // int[]. Array of campaigns IDs
        public readonly ClicksUpdateCostsPayloadCollection $costs = new ClicksUpdateCostsPayloadCollection([]),
        public readonly ?string $timezone = null,
        public readonly ?string $currency = null,
        public readonly ?bool $onlyCampaignUniques = null
    ) {
    }

    public function jsonSerialize(): array
    {
        $result = [
            'campaign_ids' => $this->campaignIds,
            'costs' => $this->costs->jsonSerialize(),
        ];
        if ($this->timezone) {
            $result['timezone'] = $this->timezone;
        }
        if ($this->currency) {
            $result['currency'] = $this->currency;
        }
        if ($this->onlyCampaignUniques !== null) {
            $result['only_campaign_uniques'] = $this->onlyCampaignUniques ? 1 : 0;
        }

        return $result;
    }
}
