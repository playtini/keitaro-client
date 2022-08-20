<?php

namespace Playtini\KeitaroClient\AdminApi\Model;

use Playtini\KeitaroClient\AdminApi\Enum\GroupTypeEnum;

class Group
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly int $position,
        public readonly GroupTypeEnum $type,
    ) {
    }

    public static function create(array $a): self
    {
        return new self(
            id: $a['id'] ?? 0,
            name: $a['name'] ?? '',
            position: $a['position'] ?? 0,
            type: GroupTypeEnum::tryFrom($a['type'] ?? null) ?? GroupTypeEnum::Campaigns,
        );
    }
}
