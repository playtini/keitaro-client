<?php

namespace Playtini\KeitaroClient\AdminApi\Model;

use Playtini\KeitaroClient\AdminApi\Enum\FlowActionTypeEnum;
use Playtini\KeitaroClient\AdminApi\Enum\FlowSchemaEnum;
use Playtini\KeitaroClient\AdminApi\Enum\FlowStateEnum;
use Playtini\KeitaroClient\AdminApi\Enum\FlowTypeEnum;
use Playtini\KeitaroClient\AdminApi\Request\FilterFlowRequestCollection;
use Playtini\KeitaroClient\AdminApi\Request\LandingFlowRequestCollection;
use Playtini\KeitaroClient\AdminApi\Request\OfferFlowRequestCollection;
use Playtini\KeitaroClient\AdminApi\Request\TriggersFlowRequestCollection;

class FlowObject implements \JsonSerializable
{
    public function __construct(
        public readonly int $campaignId, // Campaign ID
        public readonly FlowTypeEnum $type, // Flow type
        public readonly string $name, // Flow name
        public readonly int $position, // Position of a flow among other flows.
        public readonly float $weight, // Flow weight
        public readonly array $actionOptions, // Action options
        public readonly string $comments, // Comments or notes for the flow
        public readonly FlowStateEnum $state = FlowStateEnum::Active, // State of the flow
        public readonly FlowActionTypeEnum $actionType = FlowActionTypeEnum::Http,
        public readonly ?FlowSchemaEnum $schema = null,
        public readonly bool $collectClicks = false, // Flow saves clicks (true/false)
        public readonly bool $filterOr = false, // Use 'OR' operator between filters
        public readonly FilterFlowRequestCollection $filters = new FilterFlowRequestCollection([]),
        public readonly TriggersFlowRequestCollection $triggers = new TriggersFlowRequestCollection([]),
        public readonly LandingFlowRequestCollection $landings = new LandingFlowRequestCollection([]),
        public readonly OfferFlowRequestCollection $offers = new OfferFlowRequestCollection([]),
    ) {
    }

    public function jsonSerialize(): array
    {
        return [
            'campaign_id' => $this->campaignId,
            'type' => $this->type->value,
            'name' => $this->name,
            'position' => $this->position,
            'weight' => $this->weight,
            'action_options' => $this->actionOptions,
            'comments' => $this->comments,
            'state' => $this->state->value,
            'action_type' => $this->actionType->value,
            'schema' => $this->schema->value,
            'collect_clicks' => $this->collectClicks,
            'filter_or' => $this->filterOr,
            'filters' => $this->filters->jsonSerialize(),
            'triggers' => $this->triggers->jsonSerialize(),
            'landings' => $this->landings->jsonSerialize(),
            'offers' => $this->offers->jsonSerialize(),
        ];
    }
}
