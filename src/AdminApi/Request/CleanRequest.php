<?php

namespace Playtini\KeitaroClient\AdminApi\Request;

class CleanRequest
{
    public function __construct(
        public readonly \DateTimeInterface $startDate, // The date and the time for the period to delete, e.g. 2017-04-01 10:10
        public readonly \DateTimeInterface $endDate, // The date and the time for the period to delete, e.g. 2017-04-01 10:10
        public readonly ?int $campaignId = null,
        public readonly ?string $timezone = null,
    ) {
    }
}
