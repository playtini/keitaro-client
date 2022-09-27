<?php

namespace Playtini\KeitaroClient\AdminApi\Request;

class TriggersFlowRequestCollection implements \JsonSerializable
{
    /** @var TriggersFlowRequest[] */
    private array $items = [];

    public function __construct(
        array $items
    ) {
        foreach ($items as $item) {
            if ($item instanceof TriggersFlowRequest) {
                $this->items[] = $item;
            }
        }
    }

    /**
     * @return TriggersFlowRequest[]
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
