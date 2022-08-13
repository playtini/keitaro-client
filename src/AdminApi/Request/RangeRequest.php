<?php

namespace Playtini\KeitaroClient\AdminApi\Request;

use Gupalo\DateUtils\DateUtils;

class RangeRequest implements \JsonSerializable
{
    public function __construct(
        public readonly ?\DateTimeInterface $from = null, // Start Date, e.g., '2017-09-10'
        public readonly ?\DateTimeInterface $to = null, // End Date, e.g., '2017-09-10'
        public readonly ?string $timezone = null, // E.g., Europe/Madrid
        public readonly ?string $interval = null, // One of the intervals can be used: today, yesterday, 7_days_ago, first_day_of_this_week, 1_month_ago, first_day_of_this_month, 1_year_ago, first_day_of_this_year, all_time
    ) {
    }

    public function jsonSerialize(): array
    {
        if ($this->interval) {
            return ['interval' => $this->interval];
        }

        return [
            'from' => DateUtils::format($this->from),
            'to' => DateUtils::format($this->to),
            'timezone' => $this->timezone ?? 'UTC'
        ];
    }
}
