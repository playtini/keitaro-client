<?php

namespace Playtini\KeitaroClient\AdminApi\Enum;

enum UserStateEnum: string
{
    case Active = 'active';
    case Deleted = 'deleted';
}
