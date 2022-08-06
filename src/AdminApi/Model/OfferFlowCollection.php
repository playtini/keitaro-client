<?php

namespace Playtini\KeitaroClient\AdminApi\Model;

class OfferFlowCollection
{
    /** @var OfferFlow[] */
    private array $items;

    public function __construct(
        array $items
    ) {
        foreach ($items as $item) {
            if ($item instanceof OfferFlow) {
                $this->items[] = $item;
            }
        }
    }

    /**
     * @return OfferFlow[]
     */
    public function all(): array
    {
        return $this->items;
    }

    public static function create(array $a): self
    {
        return new self(
            array_map(
                static fn(array $a) => OfferFlow::create($a),
                $a
            )
        );
    }
}
