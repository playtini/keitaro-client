<?php

namespace Playtini\KeitaroClient\AdminApi\Request;

class CampaignCreateRequired
{
    public function __construct(
        public readonly string $alias,
        public readonly string $name,
    ) {
    }
}
