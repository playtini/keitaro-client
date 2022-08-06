<?php

namespace Playtini\KeitaroClient\AdminApi\Model;

use Gupalo\DateUtils\DateUtils;
use Playtini\KeitaroClient\AdminApi\Enum\OfferFlowStateEnum;

class OfferFlow
{
    public function __construct(
        public readonly int $id,
        public readonly int $flowId,
        public readonly int $offerId,
        public readonly OfferFlowStateEnum $state,
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
            offerId: $a['offer_id'] ?? 0,
            state: OfferFlowStateEnum::tryFrom($a['state'] ?? null) ?? OfferFlowStateEnum::Active,
            share: $a['share'] ?? 100,
            createdAt: DateUtils::createNull($a['created_at'] ?? null),
            updatedAt: DateUtils::createNull($a['updated_at'] ?? null),
        );
    }
}
