<?php

namespace Playtini\KeitaroClient\AdminApi\Model;

class TriggerCollection
{
    /** @var Trigger[] */
    private array $items = [];

    public function __construct(
        array $items
    ) {
        foreach ($items as $item) {
            if ($item instanceof Trigger) {
                $this->items[] = $item;
            }
        }
    }

    /**
     * @return Trigger[]
     */
    public function all(): array
    {
        return $this->items;
    }

    public static function create(array $a): self
    {
        return new self(
            array_map(
                static fn(array $a) => Trigger::create($a),
                $a
            )
        );
    }
}
