<?php

namespace Playtini\KeitaroClient\AdminApi\Model;

use Playtini\KeitaroClient\AdminApi\Enum\FlowActionTypeEnum;
use Playtini\KeitaroClient\AdminApi\Enum\TriggerFlowConditionEnum;
use Playtini\KeitaroClient\AdminApi\Enum\TriggerFlowTargetEnum;

class Trigger
{
    public function __construct(
        public readonly int $id,
        public readonly int $oid,
        public readonly int $streamId,
        public readonly ?TriggerFlowTargetEnum $target, // in openapi it's "taget", not "target"
        public readonly ?TriggerFlowConditionEnum $condition,
        public readonly string $selectedPage,
        public readonly string $pattern,
        public readonly ?FlowActionTypeEnum $action,
        public readonly int $interval,
        public readonly int $nextRunAt,
        public readonly string $alternativeUrls,
        public readonly string $grabFromPage,
        public readonly string $avSettings,
        public readonly bool $reverse,
        public readonly bool $enabled,
        public readonly bool $scanPage,
    ) {
    }

    public static function create(array $a)
    {
        return new self(
            id: $a['id'] ?? 0,
            oid: $a['oid'] ?? 0,
            streamId: $a['stream_id'] ?? 0,
            target: TriggerFlowTargetEnum::tryFrom($a['target'] ?? null),
            condition: TriggerFlowConditionEnum::tryFrom($a['condition'] ?? null),
            selectedPage: $a['selected_page'] ?? '',
            pattern: $a['pattern'] ?? '',
            action: FlowActionTypeEnum::tryFrom($a['action'] ?? null),
            interval: $a['interval'] ?? 0,
            nextRunAt: $a['next_run_at'] ?? 0,
            alternativeUrls: $a['alternative_urls'] ?? '',
            grabFromPage: $a['grab_from_page'] ?? '',
            avSettings: $a['av_settings'] ?? '',
            reverse: (bool)($a['reverse'] ?? false),
            enabled: (bool)($a['enabled'] ?? false),
            scanPage: (bool)($a['scan_pae'] ?? false),
        );
    }
}
