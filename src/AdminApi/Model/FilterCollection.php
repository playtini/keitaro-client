<?php

namespace Playtini\KeitaroClient\AdminApi\Model;

class FilterCollection
{
    /** @var Filter[] */
    private array $items;

    public function __construct(
        array $items
    ) {
        foreach ($items as $item) {
            if ($item instanceof Filter) {
                $this->items[] = $item;
            }
        }
    }

    /**
     * @return Filter[]
     */
    public function all(): array
    {
        return $this->items;
    }

    public static function create(array $a): self
    {
        return new self(
            array_map(
                static fn(array $a) => Filter::create($a),
                $a
            )
        );
    }
}
