<?php

namespace Playtini\KeitaroClient\AdminApi\Request;

class ClicksUpdateCostsPayload
{
    public function __construct(
        public readonly \DateTimeInterface $startDate, // Start date and time, e.g., “2017-09-10 20:10”
        public readonly \DateTimeInterface $endDate, // End date and time, e.g., “2017-09-10 20:10”
        public readonly float $cost = 0.0, // Cost value, e.g., 19.22
        //public readonly string $currency = '', // TODO: test; strange - in openapi it is not in object properties, but is in "required"
        public readonly ?FilterCostRequest $filterCostRequest = null,
    ) {
    }
}
