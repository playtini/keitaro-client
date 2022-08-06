<?php

namespace Playtini\KeitaroClient\AdminApi\Model;

class FlowAction
{
    public function __construct(
        public readonly string $key,
        public readonly string $name,
        public readonly string $field,
        public readonly string $type,
        public readonly string $description,
    ) {
    }
}
