<?php

namespace Playtini\KeitaroClient\AdminApi\Model;

use Playtini\KeitaroClient\AdminApi\Enum\UserPreferencesLanguageEnum;

class UserPreferences
{
    public function __construct(
        public readonly UserPreferencesLanguageEnum $language, // User language
        public readonly string $timezone, // User timezone in UTC, e.g., "Europe/Minsk"
    ) {
    }
}
