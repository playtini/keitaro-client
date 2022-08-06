<?php

namespace Playtini\KeitaroClient\AdminApi\Model;

use Playtini\KeitaroClient\AdminApi\Enum\DomainStateEnum;

class Domain
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $networkStatus,
        public readonly int $defaultCampaign,
        public readonly DomainStateEnum $state,
        public readonly \DateTimeInterface $createdAt,
        public readonly \DateTimeInterface $updatedAt,
        public readonly bool $wildcard,
        public readonly bool $catchNotFound,
        public readonly string $notes,
        public readonly int $campaignsCount,
        public readonly bool $sslRedirect,
        public readonly bool $allowIndexing,
    ) {
    }
}
