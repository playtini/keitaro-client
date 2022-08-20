<?php

namespace Playtini\KeitaroClient\AdminApi\Model;

use Gupalo\DateUtils\DateUtils;
use Playtini\KeitaroClient\AdminApi\Enum\DomainStateEnum;

class Domain
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $networkStatus, // "active"
        public readonly DomainStateEnum $state,
        public readonly string $status, // not in openapi // "active"
        public readonly \DateTimeInterface $createdAt,
        public readonly \DateTimeInterface $updatedAt,
        public readonly \DateTimeInterface $nextCheckAt, // not in openapi
        public readonly int $defaultCampaignId, // not in openapi
        public readonly string $defaultCampaign,
        public readonly int $groupId, // not in openapi
        public readonly string $group, // not in openapi
        public readonly bool $isSsl, // not in openapi
        public readonly bool $sslRedirect,
        public readonly string $sslStatus, // not in openapi // "issued"
        public readonly array $sslData, // not in openapi // [ checks => [timestamp], total => int]
        public readonly bool $catchNotFound,
        public readonly bool $allowIndexing,
        public readonly bool $wildcard, // in openapi but not in real api
        public readonly int $checkRetries, // not in openapi
        public readonly string $errorDescription, // not in openapi
        public readonly string $errorSolution, // not in openapi
        public readonly int $campaignsCount,
        public readonly string $notes,
    ) {
    }

    public static function create(array $a): self
    {
        return new self(
            id: $a['id'] ?? 0,
            name: $a['name'] ?? '',
            networkStatus: $a['network_status'] ?? '',
            state: DomainStateEnum::tryFrom($a['state'] ?? '') ?? DomainStateEnum::Active,
            status: $a['status'] ?? '',
            createdAt: DateUtils::createNull($a['created_at'] ?? null),
            updatedAt: DateUtils::createNull($a['updated_at'] ?? null),
            nextCheckAt: DateUtils::createNull($a['next_check_at'] ?? null),
            defaultCampaignId: $a['default_campaign_id'] ?? 0,
            defaultCampaign: $a['default_campaign'] ?? '',
            groupId: $a['group_id'] ?? 0,
            group: $a['group'] ?? '',
            isSsl: (bool)($a['is_ssl'] ?? false),
            sslRedirect: (bool)($a['ssl_redirect'] ?? false),
            sslStatus: $a['ssl_status'] ?? '',
            sslData: $a['ssl_data'] ?? [],
            catchNotFound: (bool)($a['catch_not_found'] ?? false),
            allowIndexing: (bool)($a['allow_indexing'] ?? false),
            wildcard: $a['wildcard'] ?? '',
            checkRetries: $a['check_retries'] ?? 0,
            errorDescription: $a['error_description'] ?? '',
            errorSolution: $a['error_solution'] ?? '',
            campaignsCount: $a['campaigns_count'] ?? 0,
            notes: $a['notes'] ?? '',
        );
    }
}
