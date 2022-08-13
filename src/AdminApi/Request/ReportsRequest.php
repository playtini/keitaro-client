<?php

namespace Playtini\KeitaroClient\AdminApi\Request;

class ReportsRequest implements \JsonSerializable
{
    public const GROUPING_CAMPAIGN_ID = 'campaign_id';
    public const GROUPING_SUB_ID_1 = 'sub_id_1';
    public const GROUPING_SUB_ID_2 = 'sub_id_2';
    public const GROUPING_SUB_ID_3 = 'sub_id_3';
    public const GROUPING_SUB_ID_4 = 'sub_id_4';
    public const GROUPING_SUB_ID_5 = 'sub_id_5';
    public const GROUPING_SUB_ID_6 = 'sub_id_6';
    public const GROUPING_SUB_ID_7 = 'sub_id_7';
    public const GROUPING_SUB_ID_8 = 'sub_id_8';
    public const GROUPING_SUB_ID_9 = 'sub_id_9';
    public const GROUPING_SUB_ID_10 = 'sub_id_10';
    public const GROUPING_SUB_ID_11 = 'sub_id_11';
    public const GROUPING_SUB_ID_12 = 'sub_id_12';
    public const GROUPING_SUB_ID_13 = 'sub_id_13';
    public const GROUPING_SUB_ID_14 = 'sub_id_14';
    public const GROUPING_SUB_ID_15 = 'sub_id_15';

    public const METRIC_CLICKS = 'clicks';

    public function __construct(
        public readonly RangeRequest $range,
        public readonly array $grouping, // string[]
        public readonly array $metrics, // string[]
        public readonly FilterRequestCollection $filters,
        public readonly SortRequestCollection $sort,
    ) {
    }

    public function jsonSerialize(): array
    {
        $result = [
            'range' => $this->range->jsonSerialize(),
        ];
        if ($this->grouping) {
            $result['grouping'] = $this->grouping;
        }
        if ($this->metrics) {
            $result['metrics'] = $this->metrics;
        }
        if ($this->filters->all()) {
            $result['filters'] = $this->filters->jsonSerialize();
        }
        if ($this->sort->all()) {
            $result['sort'] = $this->sort->jsonSerialize();
        }

        return $result;
    }
}
