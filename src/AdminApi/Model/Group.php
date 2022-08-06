<?php

namespace Playtini\KeitaroClient\AdminApi\Model;

class Group
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly int $position,
        public readonly string $type,
    ) {
    }
}
