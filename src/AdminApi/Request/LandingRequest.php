<?php

namespace Playtini\KeitaroClient\AdminApi\Request;

use Playtini\KeitaroClient\AdminApi\Enum\FlowActionTypeEnum;
use Playtini\KeitaroClient\AdminApi\Enum\LandingStateEnum;
use Playtini\KeitaroClient\AdminApi\Enum\LandingTypeEnum;

class LandingRequest
{
    public function __construct(
        public readonly string $name, // Landing page name
        public readonly string|array $actionPayload, // Action payload
        public readonly int $groupId, // Group ID
        public readonly LandingStateEnum $state = LandingStateEnum::Active,
        public readonly LandingTypeEnum $landingType = LandingTypeEnum::Local, // Landing page type
        public readonly FlowActionTypeEnum $actionType = FlowActionTypeEnum::LocalFile,
        public readonly ?string $url = null, // URL
        public readonly ?string $archive = null, // ZIP-file encoded to base64.
        public readonly ?string $notes = null, // Notes
    ) {
    }
}
