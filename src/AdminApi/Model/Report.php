<?php

namespace Playtini\KeitaroClient\AdminApi\Model;

class Report
{
    public function __construct(
        public readonly array $rows, // string[]
        public readonly int $total,
        public readonly array $meta, // string[]
    ) {
    }
}
