<?php

namespace Playtini\KeitaroClient\AdminApi\Request;

use Playtini\KeitaroClient\AdminApi\Enum\LandingFlowStateEnum;

class LandingFlowRequest implements \JsonSerializable
{
    public function __construct(
        public readonly int $landingId, // Landing Page ID
        public readonly int $share, // Share among others
        public readonly LandingFlowStateEnum $state = LandingFlowStateEnum::Active,
    ) {
    }

    public function jsonSerialize(): array
    {
        return [
            'landing_id' => $this->landingId,
            'share' => $this->share,
            'state' => $this->state->value,
        ];
    }
}
