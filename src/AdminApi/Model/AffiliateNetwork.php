<?php

namespace Playtini\KeitaroClient\AdminApi\Model;

use Gupalo\DateUtils\DateUtils;
use Playtini\KeitaroClient\AdminApi\Enum\AffiliateNetworkStateEnum;

class AffiliateNetwork
{
    public function __construct(
        public readonly int $id = 0,
        public readonly ?\DateTimeInterface $createdAt = null,
        public readonly ?\DateTimeInterface $updatedAt = null,
        public readonly AffiliateNetworkStateEnum $state = AffiliateNetworkStateEnum::Active,
        public readonly string $name = '', // Affiliate network name
        public readonly string $postbackUrl = '', // Postback URL for the Affiliate network
        public readonly string $offerParam = '', // These params are appends to offer URLs. Example, "sub1={subid}&sub2={campaign_name}"
        public readonly string $templateName = '', // based on which template this affiliate network was created
        public readonly string $notes = '', // User Notes for the Affiliate network
        public readonly string $pullApiOptions = '', // in openapi but not in real api
        public readonly int $offers = 0, // in openapi but not in real api
    ) {
    }

    public static function create(array $a): self
    {
        return new self(
            id: $a['id'] ?? 0,
            createdAt: DateUtils::createNull($a['created_at'] ?? null),
            updatedAt: DateUtils::createNull($a['updated_at'] ?? null),
            state: AffiliateNetworkStateEnum::tryFrom($a['state'] ?? null) ?? AffiliateNetworkStateEnum::Active,
            name: $a['name'] ?? '',
            postbackUrl: $a['postback_url'] ?? '',
            offerParam: $a['offer_param'] ?? '',
            templateName: $a['template_name'] ?? '',
            notes: $a['notes'] ?? '',
            pullApiOptions: $a['pull_api_options'] ?? '',
            offers: $a['offers'] ?? 0,
        );
    }
}
