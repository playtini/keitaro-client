<?php

namespace Playtini\KeitaroClient\AdminApi\Request;

abstract class AbstractFilterRequest
{
    public function __construct(
        public readonly ?RangeRequest $range = null,
        public readonly ?int $limit = null, // Clicks Request Limit. Either 'limit' or 'range' Parameters are a Must.
        public readonly int $offset = 0,
        public readonly array $columns = [], // string[]
        public readonly ?FilterRequest $filters = null,
        public readonly ?SortRequest $sort = null,
    ) {
    }
}
