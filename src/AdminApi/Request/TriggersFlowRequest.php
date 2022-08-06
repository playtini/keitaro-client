<?php

namespace Playtini\KeitaroClient\AdminApi\Request;

use Playtini\KeitaroClient\AdminApi\Enum\TriggerFlowActionEnum;
use Playtini\KeitaroClient\AdminApi\Enum\TriggerFlowConditionEnum;
use Playtini\KeitaroClient\AdminApi\Enum\TriggerFlowTargetEnum;

class TriggersFlowRequest
{
    public function __construct(
        public readonly int $id, // Trigger ID
        public readonly int $streamId, // Flow ID
        public readonly TriggerFlowConditionEnum $condition,
        public readonly TriggerFlowTargetEnum $target, // Target
        public readonly string $selectedPage, // The URL of the Page to Check
        public readonly string $pattern, // Text Pattern to Check
        public readonly TriggerFlowActionEnum $action,
        public readonly int $interval, // Interval between Checks
        public readonly string $alternativeUrls, // URLs for replacement (split by \\n)
        public readonly string $grabFromPage, // URL of the page that contains a new URL
        public readonly string $avSettings, // Settings for AV Scanners
        public readonly bool $reverse, // Perform also in a reverse mode (true/false)
        public readonly bool $scanPage, // Tell AV scanner to scan the page content
    ) {
    }
}
