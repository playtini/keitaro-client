<?php

namespace Playtini\KeitaroClient\AdminApi\Request;

use Gupalo\DateUtils\DateUtils;

class ClicksUpdateCostsPayload implements \JsonSerializable
{
    public function __construct(
        public readonly \DateTimeInterface $startDate, // Start date and time, e.g., “2017-09-10 20:10”
        public readonly \DateTimeInterface $endDate, // End date and time, e.g., “2017-09-10 20:10”
        public readonly float $cost = 0.0, // Cost value, e.g., 19.22
        //public readonly string $currency = 'USD', // TODO: test; strange - in openapi it is not in object properties, but is in "required"
        public readonly ?FilterCostRequest $filterCostRequest = null,
    ) {
    }

    public function jsonSerialize(): array
    {
        $result = [
            'start_date' => DateUtils::format($this->startDate),
            'end_date' => DateUtils::format($this->endDate),
            'cost' => $this->cost,
            //'currency' => $this->currency,
        ];
        if ($this->filterCostRequest) {
            $result['filters'] = $this->filterCostRequest->jsonSerialize();
        }

        return $result;
    }
}
