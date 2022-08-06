<?php

namespace Playtini\KeitaroClient\AdminApi\Model;

class OfferCollection
{
    /** @var Offer[] */
    private array $items;

    public function __construct(
        array $items
    ) {
        foreach ($items as $item) {
            if ($item instanceof Offer) {
                $this->items[] = $item;
            }
        }
    }

    /**
     * @return Offer[]
     */
    public function all(): array
    {
        return $this->items;
    }

    public static function create(array $a): self
    {
        return new self(
            array_map(
                static fn(array $a) => Offer::create($a),
                $a
            )
        );
    }
}
