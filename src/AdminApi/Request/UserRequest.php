<?php

namespace Playtini\KeitaroClient\AdminApi\Request;

use Playtini\KeitaroClient\AdminApi\Model\UserPreferences;
use Playtini\KeitaroClient\AdminApi\Model\UserTypeEnum;

class UserRequest
{
    public function __construct(
        public readonly string $login, // User login
        public readonly string $newPassword, // User password
        public readonly string $newPasswordConfirmation, // Repeat user password
        public readonly UserTypeEnum $type, // User type
        public readonly UserPreferences $preferences, // User preferences
    ) {
    }
}
