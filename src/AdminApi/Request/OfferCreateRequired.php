<?php

namespace Playtini\KeitaroClient\AdminApi\Request;

class OfferCreateRequired
{
    public function __construct(
        public readonly string $name,
    ) {
    }
}
