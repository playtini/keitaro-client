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

    public static function create(array $a): self
    {
        return new self(
            rows: $a['rows'] ?? [],
            total: $a['total'] ?? 0,
            meta: $a['meta'] ?? [],
        );
    }
}
