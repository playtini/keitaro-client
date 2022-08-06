<?php

namespace Playtini\KeitaroClient\AdminApi\Model;

class Success
{
    public function __construct(
        public readonly bool $success,
    ) {
    }
}
