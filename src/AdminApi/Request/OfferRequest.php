<?php

namespace Playtini\KeitaroClient\AdminApi\Request;

use Playtini\KeitaroClient\AdminApi\Enum\OfferPayoutTypeEnum;
use Playtini\KeitaroClient\AdminApi\Enum\OfferStateEnum;

class OfferRequest
{
    public function __construct(
        public readonly string $name,
        public readonly int $groupId, // Offer group ID
        public readonly string $offerType, // Offer Type ('local'/'external'/'preloaded'/'action')
        public readonly string $actionType, // Action or redirect type
        public readonly string|array $actionPayload, // Action payload or URL
        public readonly int $affiliateNetworkId, // Affiliate network ID
        public readonly float $payoutValue, // Payout value
        public readonly string $payoutCurrency, // Payout currency
        public readonly OfferPayoutTypeEnum $payoutType, // Payout type
        public readonly OfferStateEnum $state = OfferStateEnum::Active, // Offer State
        public readonly bool $payoutAuto = false, // If true, offer receives payout value from postback
        public readonly bool $payoutUpsell = false, // Allow offer to get upsells
        public readonly array $country = [], // string[]. Country codes (i.g, ["US", "DE", "JP"])
        public readonly string $notes = '',
        public readonly string $archive = '', // ZIP-file encoded to base64
        public readonly bool $conversionCapEnabled = false, // Turn on that feature if the offer limit conversions per day
        public readonly ?int $dailyCap = null, // Daily limit of conversions, after which the tracker will send traffic to another offer
        public readonly ?string $conversionTimezone = null, // Which timezone is being used by the Affiliate network for calculating conversions, e.g. UTC or Europe/Madrid
        public readonly ?int $alternativeOfferId = null, // Offer id, where to send traffic when daily limit is reached
    ) {
    }
}
