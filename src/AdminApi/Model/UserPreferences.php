<?php

namespace Playtini\KeitaroClient\AdminApi\Model;

use Playtini\KeitaroClient\AdminApi\Enum\UserPreferencesFirstWeekday;
use Playtini\KeitaroClient\AdminApi\Enum\UserPreferencesLanguageEnum;

class UserPreferences
{
    public function __construct(
        public readonly UserPreferencesLanguageEnum $language, // User language
        public readonly string $timezone, // User timezone in UTC, e.g., "Europe/Minsk"
        public readonly UserPreferencesFirstWeekday $firstWeekday,
        public readonly array $other, // not in openapi
    ) {
    }

    public static function create(array $a): self
    {
        $other = $a;
        unset($other['language'], $other['timezone'], $other['first_weekday']);
        ksort($other);

        return new self(
            language: UserPreferencesLanguageEnum::tryFrom($a['language']) ?? UserPreferencesLanguageEnum::EN,
            timezone: $a['timezone'] ?? 'UTC',
            firstWeekday: UserPreferencesFirstWeekday::tryFrom((string)($a['first_weekday'] ?? '')) ?? UserPreferencesFirstWeekday::Monday,
            other: $other,
        );
    }
}
