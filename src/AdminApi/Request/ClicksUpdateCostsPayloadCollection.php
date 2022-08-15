<?php

namespace Playtini\KeitaroClient\AdminApi\Request;

class ClicksUpdateCostsPayloadCollection implements \JsonSerializable
{
    /** @var ClicksUpdateCostsPayload[] */
    private array $items;

    public function __construct(
        array $items
    ) {
        foreach ($items as $item) {
            if ($item instanceof ClicksUpdateCostsPayload) {
                $this->items[] = $item;
            }
        }
    }

    /**
     * @return ClicksUpdateCostsPayload[]
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
