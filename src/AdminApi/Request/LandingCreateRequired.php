<?php

namespace Playtini\KeitaroClient\AdminApi\Request;

class LandingCreateRequired
{
    public function __construct(
        public readonly string $name,
    ) {
    }
}
