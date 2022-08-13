<?php

namespace Playtini\KeitaroClient\AdminApi\Request;

class FilterRequestCollection implements \JsonSerializable
{
    /** @var FilterRequest[] */
    private array $items = [];

    public function __construct(
        array $items
    ) {
        foreach ($items as $item) {
            if ($item instanceof FilterRequest) {
                $this->items[] = $item;
            }
        }
    }

    /**
     * @return FilterRequest[]
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
