<?php

namespace Playtini\KeitaroClient\AdminApi\Request;

class FilterFlowRequestCollection implements \JsonSerializable
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

    public function jsonSerialize(): array
    {
        $result = [];
        foreach ($this->items as $item) {
            $result[] = $item->jsonSerialize();
        }

        return $result;
    }
}
