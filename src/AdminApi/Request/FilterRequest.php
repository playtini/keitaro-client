<?php

namespace Playtini\KeitaroClient\AdminApi\Request;

class FilterRequest implements \JsonSerializable
{
    public function __construct(
        public readonly string $name, // Name of the field
        public readonly string $operator, // One of the available operators (<a href="#operators">operators</a>)
        public readonly string|float|array|null $expression = null, // Expression for the filter
    ) {
    }

    public function jsonSerialize(): array
    {
        return [
            'name' => $this->name,
            'operator' => $this->operator,
            'expression' => $this->expression,
        ];
    }
}
