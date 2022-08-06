<?php

namespace Playtini\KeitaroClient\AdminApi\Enum;

enum UserAccessDataAccessTypeEnum: string
{
    case FullAccess = 'full_access';
    case ReadOnly = 'read_only';
    case ToGroupsAndSelected = 'to_groups_and_selected';
    case CreatedByUserGroupsAndSelected = 'created_by_user_groups_and_selected';
}
