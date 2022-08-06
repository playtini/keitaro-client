<?php

namespace Playtini\KeitaroClient\AdminApi\Model;

class Landing
{
    public function __construct(
        public readonly int $id,
        public readonly string $landingType,
        public readonly string $actionType,
        public readonly string|array $actionPayload,
        public readonly array $actionOptions,
        public readonly string $name,
        public readonly int $groupId,
        public readonly int $offerCount,
        public readonly string $notes,
        public readonly string $state,
        public readonly \DateTimeInterface $createdAt,
        public readonly \DateTimeInterface $updatedAt,
        public readonly string $archive,
        public readonly string $localPath,
        public readonly string $previewPath,
    ) {
    }

    public static function create(array $a): self
    {
        // TODO
        throw new \RuntimeException('Not implemented');
    }
}
