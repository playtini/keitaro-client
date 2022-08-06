<?php

namespace Playtini\KeitaroClient\AdminApi\Request;

use Playtini\KeitaroClient\AdminApi\Enum\GroupTypeEnum;

class GroupRequest
{
    public function __construct(
        public readonly string $name, // Group name
        public readonly GroupTypeEnum $type, // Group type
    ) {
    }
}
