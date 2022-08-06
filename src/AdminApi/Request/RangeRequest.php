<?php

namespace Playtini\KeitaroClient\AdminApi\Request;

class RangeRequest
{
    public function __construct(
        public readonly \DateTimeInterface $from, // Start Date, e.g., '2017-09-10'
        public readonly \DateTimeInterface $to, // End Date, e.g., '2017-09-10'
        public readonly string $timezone, // E.g., Europe/Madrid
        public readonly string $interval, // One of the intervals can be used: today, yesterday, 7_days_ago, first_day_of_this_week, 1_month_ago, first_day_of_this_month, 1_year_ago, first_day_of_this_year, all_time
    ) {
    }
}
