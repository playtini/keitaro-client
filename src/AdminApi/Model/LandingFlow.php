<?php

namespace Playtini\KeitaroClient\AdminApi\Model;

use Gupalo\DateUtils\DateUtils;
use Playtini\KeitaroClient\AdminApi\Enum\LandingFlowStateEnum;

class LandingFlow
{
    public function __construct(
        public readonly int $id,
        public readonly int $flowId,
        public readonly int $landingId,
        public readonly LandingFlowStateEnum $state,
        public readonly int $share,
        public readonly \DateTimeInterface $createdAt,
        public readonly \DateTimeInterface $updatedAt,
    ) {
    }

    public static function create(array $a): self
    {
        return new self(
            id: $a['id'] ?? 0,
            flowId: $a['stream_id'] ?? 0,
            landingId: $a['landing_id'] ?? 0,
            state: LandingFlowStateEnum::tryFrom($a['state'] ?? null) ?? LandingFlowStateEnum::Active,
            share: $a['share'] ?? 100,
            createdAt: DateUtils::createNull($a['created_at'] ?? null),
            updatedAt: DateUtils::createNull($a['updated_at'] ?? null),
        );
    }
}
