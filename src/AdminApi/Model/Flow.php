<?php

namespace Playtini\KeitaroClient\AdminApi\Model;

use Gupalo\DateUtils\DateUtils;
use Playtini\KeitaroClient\AdminApi\Enum\FlowActionTypeEnum;
use Playtini\KeitaroClient\AdminApi\Enum\FlowSchemaEnum;
use Playtini\KeitaroClient\AdminApi\Enum\FlowStateEnum;
use Playtini\KeitaroClient\AdminApi\Enum\FlowTypeEnum;

class Flow
{
    public function __construct(
        public readonly ?int $id,
        public readonly FlowTypeEnum $type,
        public readonly string $name,
        public readonly int $campaignId,
        public readonly int $position,
        public readonly float $weight,
        public readonly array $actionOptions,
        public readonly string $comments,
        public readonly FlowStateEnum $state,
        public readonly ?\DateTimeInterface $updatedAt,
        public readonly FlowActionTypeEnum $actionType,
        public readonly string|array $actionPayload,
        public readonly FlowSchemaEnum $schema,
        public readonly bool $collectClicks,
        public readonly bool $filterOr,
        public readonly FilterCollection $filters,
        public readonly TriggerCollection $triggers,
        public readonly LandingFlowCollection $landings,
        public readonly OfferFlowCollection $offers,
    ) {
    }

    public static function create(array $a): self
    {
        return new self(
            id: $a['id'] ?? null,
            type: FlowTypeEnum::tryFrom($a['type'] ?? null) ?? FlowTypeEnum::Regular,
            name: $a['name'],
            campaignId: $a['campaign_id'],
            position: $a['position'],
            weight: $a['weight'],
            actionOptions: is_array($a['action_options']) ? $a['action_options'] : [],
            comments: $a['comments'],
            state: FlowStateEnum::tryFrom($a['state'] ?? null) ?? FlowStateEnum::Active,
            updatedAt: DateUtils::createNull($a['updated_at'] ?? null),
            actionType: FlowActionTypeEnum::tryFrom($a['action_type'] ?? null) ?? FlowActionTypeEnum::Http,
            actionPayload: $a['action_payload'] ?? '',
            schema: FlowSchemaEnum::tryFrom($a['schema'] ?? null) ?? FlowSchemaEnum::Redirect,
            collectClicks: (bool)($a['collect_clicks'] ?? false),
            filterOr: (bool)($a['filter_or'] ?? false),
            filters: FilterCollection::create($a['filters'] ?? []),
            triggers: TriggerCollection::create($a['triggers'] ?? []),
            landings: LandingFlowCollection::create($a['landings'] ?? []),
            offers: OfferFlowCollection::create($a['offers'] ?? []),
        );
    }
}
