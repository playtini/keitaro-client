<?php

namespace Playtini\KeitaroClient\AdminApi\Request;

class LandingFlowRequestCollection
{
    /** @var LandingFlowRequest[] */
    private array $items = [];

    public function __construct(
        array $items
    ) {
        foreach ($items as $item) {
            if ($item instanceof LandingFlowRequest) {
                $this->items[] = $item;
            }
        }
    }

    /**
     * @return LandingFlowRequest[]
     */
    public function all(): array
    {
        return $this->items;
    }
}
