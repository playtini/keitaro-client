<?php

namespace Playtini\KeitaroClient\AdminApi\Model;

class User
{
    public function __construct(
        public readonly int $id, // User ID
        public readonly string $login, // User login
        public readonly UserTypeEnum $type, // User type
        public readonly UserAccessData|UserAccessData2 $accessData,
        public readonly UserPreferences $preferences, // User preferences
    ) {
    }
}
