<?php

namespace Playtini\KeitaroClient\AdminApi\Model;

class S2SPostbackCollection
{
    /** @var S2SPostback[] */
    private array $items = [];

    public function __construct(
        array $items
    ) {
        foreach ($items as $item) {
            if ($item instanceof S2SPostback) {
                $this->items[] = $item;
            }
        }
    }

    /**
     * @return S2SPostback[]
     */
    public function all(): array
    {
        return $this->items;
    }

    public static function create(array $a): self
    {
        return new self(
            array_map(
                static fn(array $a) => S2SPostback::create($a),
                $a
            )
        );
    }
}
