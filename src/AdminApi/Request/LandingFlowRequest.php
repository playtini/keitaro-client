<?php

namespace Playtini\KeitaroClient\AdminApi\Request;

use Playtini\KeitaroClient\AdminApi\Enum\LandingFlowStateEnum;

class LandingFlowRequest
{
    public function __construct(
        public readonly int $landingId, // Landing Page ID
        public readonly int $share, // Share among others
        public readonly LandingFlowStateEnum $state = LandingFlowStateEnum::Active,
    ) {
    }
}
