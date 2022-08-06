<?php

namespace Playtini\KeitaroClient\AdminApi\Model;

class OptionNumber
{
    public function __construct(
        public readonly string $name,
        public readonly float $value,
    ) {
    }
}
