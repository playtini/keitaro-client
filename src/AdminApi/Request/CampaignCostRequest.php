<?php

namespace Playtini\KeitaroClient\AdminApi\Request;

class CampaignCostRequest
{
    public function __construct(
        public readonly \DateTimeInterface $startDate, // Start date and time. For example, \"2017-09-10 20:10\"
        public readonly \DateTimeInterface $endDate, // End date and time. For example, \"2017-09-10 20:10\"
        public readonly string $timezone, // Timezone for the time range. For example, \"Europe/Madrid\".
        public readonly float $cost, // Cost for the time range. For example, \"19.22\".
        public readonly string $currency, // Currency of cost. For example \"EUR\".
        public readonly bool $onlyCampaignUniques = false, // Apply new costs to unique clicks only.
        public readonly ?FilterCostRequest $filter = null,
    ) {
    }
}
