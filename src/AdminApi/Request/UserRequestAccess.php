<?php

namespace Playtini\KeitaroClient\AdminApi\Request;

use Playtini\KeitaroClient\AdminApi\Model\UserAccessData;

class UserRequestAccess
{
    public function __construct(
        public readonly UserAccessData $accessData,
    ) {
    }
}
