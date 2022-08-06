<?php

namespace Playtini\KeitaroClient\AdminApi\Request;

class GroupCreateRequired
{
    public function __construct(
        public readonly string $name,
        public readonly string $type,
    ) {
    }
}
