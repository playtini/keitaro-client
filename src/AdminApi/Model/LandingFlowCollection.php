<?php

namespace Playtini\KeitaroClient\AdminApi\Model;

class LandingFlowCollection
{
    /** @var LandingFlow[] */
    private array $items;

    public function __construct(
        array $items
    ) {
        foreach ($items as $item) {
            if ($item instanceof LandingFlow) {
                $this->items[] = $item;
            }
        }
    }

    /**
     * @return LandingFlow[]
     */
    public function all(): array
    {
        return $this->items;
    }

    public static function create(array $a): self
    {
        return new self(
            array_map(
                static fn(array $a) => LandingFlow::create($a),
                $a
            )
        );
    }
}
