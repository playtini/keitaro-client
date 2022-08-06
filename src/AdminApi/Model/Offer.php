<?php

namespace Playtini\KeitaroClient\AdminApi\Model;

class Offer
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly int $groupId,
        public readonly string $actionType,
        public readonly string|array $actionPayload,
        public readonly array $actionOptions,
        public readonly int $affiliateNetworkId,
        public readonly float $payoutValue,
        public readonly string $payoutCurrency,
        public readonly string $payoutType,
        public readonly string $state,
        public readonly \DateTimeInterface $createdAt,
        public readonly \DateTimeInterface $updatedAt,
        public readonly bool $payoutAuto,
        public readonly bool $payoutUpsell,
        public readonly array $country, // string[]
        public readonly string $notes,
        public readonly string $affiliateNetwork,
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
