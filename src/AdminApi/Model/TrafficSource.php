<?php

namespace Playtini\KeitaroClient\AdminApi\Model;

use Gupalo\DateUtils\DateUtils;
use Playtini\KeitaroClient\AdminApi\Enum\TrafficSourceStateEnum;

class TrafficSource
{
    public function __construct(
        public readonly int $id,
        public readonly \DateTimeInterface $createdAt,
        public readonly \DateTimeInterface $updatedAt,
        public readonly TrafficSourceStateEnum $state,
        public readonly string $templateName,
        public readonly string $name,
        public readonly string $postbackUrl,
        public readonly array $postbackStatuses, // string[] - [lead, sale]
        public readonly bool $acceptParameters,
        public readonly float $trafficLoss,
        public readonly string $notes,
        public readonly SourceParameters $parameters,
        public readonly string $updateInCampaigns,
    ) {
    }

    public static function create(array $a): self
    {
        return new self(
            id: $a['id'] ?? 0,
            createdAt: DateUtils::createNull($a['created_at'] ?? null),
            updatedAt: DateUtils::createNull($a['updated_at'] ?? null),
            state: TrafficSourceStateEnum::tryFrom($a['state'] ?? null) ?? TrafficSourceStateEnum::Active,
            templateName: $a['template_name'] ?? '',
            name: $a['name'] ?? '',
            postbackUrl: $a['postback_url'] ?? '',
            postbackStatuses: $a['postback_statuses'] ?? ['lead', 'sale'],
            acceptParameters: (bool)($a['accept_parameters'] ?? false),
            trafficLoss: $a['traffic_loss'] ?? 0.0,
            notes: $a['notes'] ?? '',
            parameters: SourceParameters::create($a['parameters'] ?? []),
            updateInCampaigns: $a['update_in_campaigns'] ?? '',// in openapi but not in real api
        );
    }
}
