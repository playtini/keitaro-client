<?php

namespace Playtini\KeitaroClient\AdminApi\Request;

class OfferFlowRequestCollection implements \JsonSerializable
{
    /** @var OfferFlowRequest[] */
    private array $items = [];

    public function __construct(
        array $items
    ) {
        foreach ($items as $item) {
            if ($item instanceof OfferFlowRequest) {
                $this->items[] = $item;
            }
        }
    }

    /**
     * @return OfferFlowRequest[]
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
