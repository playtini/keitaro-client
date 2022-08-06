<?php

namespace Playtini\KeitaroClient\AdminApi\Model;

class FlowFilter
{
    public function __construct(
        public readonly string $value, // Filter Name
        public readonly string $tooltip, // Filter Description
        public readonly FlowFilterModes $modes,
        public readonly string $group, // Group ID. It's used to group filters in a filters dropdown menu.
        public readonly string $template, // HTML code for rendering filter body view (Not recommended to use)
        public readonly string $headerTemplate, // HTML code for rendering filter body view (Not recommended to use)
        public readonly string $defaults, // Default values
    ) {
    }
}
