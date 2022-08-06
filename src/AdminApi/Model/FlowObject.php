<?php

namespace Playtini\KeitaroClient\AdminApi\Model;

use Playtini\KeitaroClient\AdminApi\Enum\FlowSchemaEnum;
use Playtini\KeitaroClient\AdminApi\Enum\FlowStateEnum;
use Playtini\KeitaroClient\AdminApi\Enum\FlowTypeEnum;
use Playtini\KeitaroClient\AdminApi\Request\FilterFlowRequestCollection;
use Playtini\KeitaroClient\AdminApi\Request\LandingFlowRequestCollection;
use Playtini\KeitaroClient\AdminApi\Request\OfferFlowRequestCollection;
use Playtini\KeitaroClient\AdminApi\Request\TriggersFlowRequestCollection;

class FlowObject
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
        public readonly string $actionType = '', // Action to perform (see 'Retrieve available flow action types')
        public readonly ?FlowSchemaEnum $schema = null,
        public readonly bool $collectClicks = false, // Flow saves clicks (true/false)
        public readonly bool $filterOr = false, // Use 'OR' operator between filters
        public readonly FilterFlowRequestCollection $filters = new FilterFlowRequestCollection([]),
        public readonly TriggersFlowRequestCollection $triggers = new TriggersFlowRequestCollection([]),
        public readonly LandingFlowRequestCollection $landings = new LandingFlowRequestCollection([]),
        public readonly OfferFlowRequestCollection $offers = new OfferFlowRequestCollection([]),
    ) {
    }
}
