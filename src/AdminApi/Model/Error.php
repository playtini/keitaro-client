<?php

namespace Playtini\KeitaroClient\AdminApi\Model;

class Error
{
    public function __construct(
        public readonly string $error,
    ) {
    }
}
