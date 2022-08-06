<?php

namespace Playtini\KeitaroClient\AdminApi\Request;

use Playtini\KeitaroClient\AdminApi\Model\UserAccessData;
use Playtini\KeitaroClient\AdminApi\Model\UserAccessData2;

class UserRequestAccess
{
    public function __construct(
        public readonly UserAccessData|UserAccessData2 $accessData,
    ) {
    }
}
