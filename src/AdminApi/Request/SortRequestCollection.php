<?php

namespace Playtini\KeitaroClient\AdminApi\Request;

class SortRequestCollection
{
    /** @var SortRequest[] */
    private array $items;

    public function __construct(
        array $items
    ) {
        foreach ($items as $item) {
            if ($item instanceof SortRequest) {
                $this->items[] = $item;
            }
        }
    }

    /**
     * @return SortRequest[]
     */
    public function all(): array
    {
        return $this->items;
    }
}
