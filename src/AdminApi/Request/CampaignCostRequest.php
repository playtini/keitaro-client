<?php

namespace Playtini\KeitaroClient\AdminApi\Request;

use Gupalo\DateUtils\DateUtils;

class CampaignCostRequest implements \JsonSerializable
{
    public function __construct(
        public readonly \DateTimeInterface $startDate, // Start date and time. For example, \"2017-09-10 20:10\"
        public readonly \DateTimeInterface $endDate, // End date and time. For example, \"2017-09-10 20:10\"
        public readonly string $timezone = 'UTC', // Timezone for the time range. For example, \"Europe/Madrid\".
        public readonly float $cost = 0.0, // Cost for the time range. For example, \"19.22\".
        public readonly string $currency = 'USD', // Currency of cost. For example \"EUR\".
        public readonly bool $onlyCampaignUniques = false, // Apply new costs to unique clicks only.
        public readonly ?FilterCostRequest $filter = null,
    ) {
    }

    public function jsonSerialize(): array
    {
        $result = [
            'start_date' => DateUtils::format($this->startDate),
            'end_date' => DateUtils::format($this->endDate),
            'timezone' => $this->timezone,
            'cost' => (string)$this->cost,
            'currency' => $this->currency,
        ];
        $filters = $this->filter->jsonSerialize();
        if ($filters) {
            $result['filters'] = $filters;
        }

        return $result;
    }
}
