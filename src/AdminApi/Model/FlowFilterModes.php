<?php

namespace Playtini\KeitaroClient\AdminApi\Model;

class FlowFilterModes
{
    public function __construct(
        public readonly string $accept, // Accept mode
        public readonly string $reject, // Reject mode
    ) {
    }
}
