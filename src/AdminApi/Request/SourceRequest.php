<?php

namespace Playtini\KeitaroClient\AdminApi\Request;

use Playtini\KeitaroClient\AdminApi\Model\SourceParameters;

class SourceRequest
{
    public function __construct(
        public readonly string $name,
        public readonly string $postbackUrl,
        public readonly array $postbackStatuses, // string[]
        public readonly string $templateName,
        public readonly bool $acceptParameters,
        public readonly SourceParameters $parameters,
        public readonly string $notes,
        public readonly string $state,
        public readonly float $trafficLoss,
    ) {
    }
}
