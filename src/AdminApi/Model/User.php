<?php

namespace Playtini\KeitaroClient\AdminApi\Model;

use Playtini\KeitaroClient\AdminApi\Enum\UserStateEnum;

class User
{
    public function __construct(
        public readonly int $id, // User ID
        public readonly UserStateEnum $state, // not in openapi // active
        public readonly UserTypeEnum $type, // User type
        public readonly string $login, // User login
        public readonly UserAccessData $accessData,
        public readonly UserPreferences $preferences, // User preferences
        public readonly string $permissions, // not in openapi
        public readonly int $keyCount, // not in openapi; both in keys "key_count" and "keyCount"
    ) {
    }

    public static function create(array $a): self
    {
        return new self(
            id: $a['id'] ?? '',
            state: UserStateEnum::tryFrom($a['state'] ?? '') ?? UserStateEnum::Active,
            type: UserTypeEnum::tryFrom($a['type'] ?? '') ?? UserTypeEnum::User,
            login: $a['login'] ?? '',
            accessData: UserAccessData::create($a['access_data'] ?? []),
            preferences: UserPreferences::create($a['preferences'] ?? ''),
            permissions: $a['permissions'] ?? '',
            keyCount: $a['key_count'] ?? $a['keyCount'] ?? 0,
        );
    }
}
