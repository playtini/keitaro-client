<?php

namespace Playtini\KeitaroClient\AdminApi\Model;

class S2SPostbackStatuses
{
    public function __construct(
        public readonly bool $isLead = false,
        public readonly bool $isSale = false,
        public readonly bool $isRejected = false,
        public readonly bool $isRebill = false,
    ) {
    }
}
