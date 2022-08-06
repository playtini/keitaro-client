<?php

namespace Playtini\KeitaroClient\AdminApi\Request;

use Playtini\KeitaroClient\AdminApi\Enum\SortOrderEnum;

class SortRequest
{
    public function __construct(
        public readonly string $name, // Column or metric name
        public readonly SortOrderEnum $order = SortOrderEnum::ASC, // Order
    ) {
    }
}
