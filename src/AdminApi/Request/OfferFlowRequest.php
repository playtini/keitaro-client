<?php

namespace Playtini\KeitaroClient\AdminApi\Request;

use Playtini\KeitaroClient\AdminApi\Enum\OfferFlowStateEnum;

class OfferFlowRequest
{
    public function __construct(
        public readonly int $offerId,
        public readonly int $share,
        public readonly OfferFlowStateEnum $state = OfferFlowStateEnum::Active,
    ) {
    }
}
