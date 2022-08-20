<?php

namespace Playtini\KeitaroClient\AdminApi\Model;

use Gupalo\DateUtils\DateUtils;
use Playtini\KeitaroClient\AdminApi\Enum\FlowActionTypeEnum;
use Playtini\KeitaroClient\AdminApi\Enum\LandingStateEnum;
use Playtini\KeitaroClient\AdminApi\Enum\LandingTypeEnum;

class Landing
{
    public function __construct(
        public readonly int $id,
        public readonly \DateTimeInterface $createdAt,
        public readonly \DateTimeInterface $updatedAt,
        public readonly string $archive, // in openapi but not in real api
        public readonly int $groupId,
        public readonly string $group, // not in openapi
        public readonly LandingStateEnum $state,
        public readonly LandingTypeEnum $landingType,
        public readonly string $name,
        public readonly FlowActionTypeEnum $actionType,
        public readonly string|array $actionPayload,
        public readonly array $actionOptions,
        public readonly int $offerCount,
        public readonly string $notes,
        public readonly string $localPath, // in openapi but not in real api
        public readonly string $previewPath, // in openapi but not in real api
    ) {
    }
    public static function create(array $a): self
    {
        return new self(
            id: $a['id'] ?? 0,
            createdAt: DateUtils::createNull($a['created_at'] ?? null),
            updatedAt: DateUtils::createNull($a['updated_at'] ?? null),
            archive: $a['archive'] ?? '',
            groupId: $a['group_id'] ?? 0,
            group: $a['group'] ?? '',
            state: LandingStateEnum::tryFrom($a['state'] ?? null) ?? LandingStateEnum::Active,
            landingType: LandingTypeEnum::tryFrom($a['landing_type'] ?? null) ?? LandingTypeEnum::External,
            name: $a['name'] ?? '',
            actionType: FlowActionTypeEnum::tryFrom($a['action_type'] ?? null) ?? FlowActionTypeEnum::Http,
            actionPayload: $a['action_payload'] ?? '',
            actionOptions: $a['action_options'] ?? [],
            offerCount: $a['offer_count'] ?? 0,
            notes: $a['notes'] ?? '',
            localPath: $a['local_path'] ?? '',
            previewPath: $a['preview_path'] ?? '',
        );
    }
}
