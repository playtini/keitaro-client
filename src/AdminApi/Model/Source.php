<?php

namespace Playtini\KeitaroClient\AdminApi\Model;

class Source
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $postbackUrl,
        public readonly array $postbackStatuses, // string[]
        public readonly string $templateName,
        public readonly bool $acceptParameters,
        public readonly SourceParameters $parameters,
        public readonly string $notes,
        public readonly string $state,
        public readonly \DateTimeInterface $createdAt,
        public readonly \DateTimeInterface $updatedAt,
        public readonly float $trafficLoss,
        public readonly string $updateInCampaigns,
    ) {
    }
}
