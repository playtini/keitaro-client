<?php

namespace Playtini\KeitaroClient\AdminApi\Request;

class SortRequestCollection implements \JsonSerializable
{
    /** @var SortRequest[] */
    private array $items = [];

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

    public function jsonSerialize(): array
    {
        $result = [];
        foreach ($this->items as $item) {
            $result[] = $item->jsonSerialize();
        }

        return $result;
    }
}
