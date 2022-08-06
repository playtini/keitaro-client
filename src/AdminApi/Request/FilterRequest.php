<?php

namespace Playtini\KeitaroClient\AdminApi\Request;

class FilterRequest
{
    public function __construct(
        public readonly string $name, // Name of the field
        public readonly string $operator, // One of the available operators (<a href="#operators">operators</a>)
        public readonly string|float|null $expression = null, // Expression for the filter
    ) {
    }
}