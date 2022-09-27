<?php

namespace Playtini\KeitaroClient\AdminApi\Request;

use Playtini\KeitaroClient\AdminApi\Enum\OfferFlowStateEnum;

class OfferFlowRequest implements \JsonSerializable
{
    public function __construct(
        public readonly int $offerId,
        public readonly int $share,
        public readonly OfferFlowStateEnum $state = OfferFlowStateEnum::Active,
    ) {
    }

    public function jsonSerialize(): array
    {
        return [
            'offer_id' => $this->offerId,
            'share' => $this->share,
            'state' => $this->state->value,
        ];
    }
}
