<?php

namespace Playtini\KeitaroClient\AdminApi\Model;

class Time
{
    public function __construct(
        public readonly string $date,
        public readonly int $timezoneType,
        public readonly string $timezone,
    ) {
    }
}
