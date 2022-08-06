<?php

namespace Playtini\KeitaroClient\AdminApi\Model;

class LandingCollection
{
    /** @var Landing[] */
    private array $items;

    public function __construct(
        array $items
    ) {
        foreach ($items as $item) {
            if ($item instanceof Landing) {
                $this->items[] = $item;
            }
        }
    }

    /**
     * @return Landing[]
     */
    public function all(): array
    {
        return $this->items;
    }

    public static function create(array $a): self
    {
        return new self(
            array_map(
                static fn(array $a) => Landing::create($a),
                $a
            )
        );
    }
}
