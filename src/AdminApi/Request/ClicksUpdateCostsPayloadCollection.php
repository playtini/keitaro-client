<?php

namespace Playtini\KeitaroClient\AdminApi\Request;

class ClicksUpdateCostsPayloadCollection
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
}
