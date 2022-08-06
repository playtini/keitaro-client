<?php

namespace Playtini\KeitaroClient\AdminApi\Request;

class ReportsRequest
{
    public function __construct(
        public readonly RangeRequest $range,
        public readonly array $grouping, // string[]
        public readonly array $metrics, // string[]
        public readonly FilterRequestCollection $filters,
        public readonly SortRequestCollection $sort,
    ) {
    }
}
