<?php

namespace Playtini\KeitaroClient\AdminApi\Request;

class FilterFlowRequestCollection
{
    /** @var FilterFlowRequest[] */
    private array $items = [];

    public function __construct(
        array $items
    ) {
        foreach ($items as $item) {
            if ($item instanceof FilterFlowRequest) {
                $this->items[] = $item;
            }
        }
    }

    /**
     * @return FilterFlowRequest[]
     */
    public function all(): array
    {
        return $this->items;
    }
}
