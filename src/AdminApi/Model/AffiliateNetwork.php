<?php

namespace Playtini\KeitaroClient\AdminApi\Model;

use Playtini\KeitaroClient\AdminApi\Enum\AffiliateNetworkStateEnum;

class AffiliateNetwork
{
    public function __construct(
        public readonly int $id = 0,
        public readonly string $name = '', // Affiliate network name
        public readonly string $postbackUrl = '', // Postback URL for the Affiliate network
        public readonly string $offerParam = '', // These params are appends to offer URLs. Example, "sub1={subid}&sub2={campaign_name}"
        public readonly AffiliateNetworkStateEnum $state = AffiliateNetworkStateEnum::Active,
        public readonly string $templateName = '',
        public readonly string $notes = '', // User Notes for the Affiliate network
        public readonly string $pullApiOptions = '',
        public readonly ?\DateTimeInterface $createdAt = null,
        public readonly ?\DateTimeInterface $updatedAt = null,
        public readonly int $offers = 0,
    ) {
    }
}
