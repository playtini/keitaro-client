<?php

namespace Playtini\KeitaroClient\AdminApi\Model;

use Gupalo\DateUtils\DateUtils;
use Playtini\KeitaroClient\AdminApi\Enum\OfferPayoutTypeEnum;
use Playtini\KeitaroClient\AdminApi\Enum\OfferStateEnum;

class Offer
{
    public function __construct(
        public readonly int $id,
        public readonly int $alternativeOfferId, // not in openapi
        public readonly \DateTimeInterface $createdAt,
        public readonly \DateTimeInterface $updatedAt,
        public readonly string $archive, // bool?
        public readonly OfferStateEnum $state,
        public readonly string $name,
        public readonly int $groupId,
        public readonly string $group, // not in openapi
        public readonly string $offerType, // not in openapi; "external"
        public readonly string $actionType, // "http"
        public readonly string|array $actionPayload, // example: url
        public readonly array $actionOptions,
        public readonly int $affiliateNetworkId,
        public readonly string $affiliateNetworkName,
        public readonly OfferPayoutTypeEnum $payoutType,
        public readonly float $payoutValue,
        public readonly string $payoutCurrency,
        public readonly bool $payoutAuto,
        public readonly bool $payoutUpsell,
        public readonly string $localPath,
        public readonly string $previewPath,
        public readonly string $conversionTimezone, // not in openapi
        public readonly bool $conversionCapEnabled, // not in openapi
        public readonly int $dailyCap, // not in openapi
        public readonly array $country, // string[]
        public readonly string $notes,
    ) {
    }

    public static function create(array $a): self
    {
        $country = $a['country'] ?? [];
        if (is_string($country)) {
            $country = explode(',', $country);
        }

        return new self(
            id: $a['id'] ?? 0,
            alternativeOfferId: $a['alternative_offer_id'] ?? 0,
            createdAt: DateUtils::createNull($a['created_at'] ?? null),
            updatedAt: DateUtils::createNull($a['updated_at'] ?? null),
            archive: (bool)($a['archive'] ?? false),
            state: OfferStateEnum::tryFrom($a['state'] ?? null) ?? OfferStateEnum::Active,
            name: $a['name'] ?? '',
            groupId: $a['group_id'] ?? 0,
            group: $a['group'] ?? '',
            offerType: $a['offer_type'] ?? '',
            actionType: $a['action_type'] ?? '',
            actionPayload: $a['action_payload'] ?? '',
            actionOptions: $a['action_options'] ?? [],
            affiliateNetworkId: $a['affiliate_network_id'] ?? '', // empty or "1"
            affiliateNetworkName: $a['affiliate_network'] ?? '', // empty or "1"
            payoutType: OfferPayoutTypeEnum::tryFrom($a['payout_type'] ?? null) ?? OfferPayoutTypeEnum::CPA,
            payoutValue: $a['payout_value'] ?? 0.0,
            payoutCurrency: $a['payout_currency'] ?? 'USD',
            payoutAuto: (bool)($a['payout_auto'] ?? false), // have not seen it so not sure about format
            payoutUpsell: (bool)($a['payout_upsell'] ?? false),
            localPath: $a['local_path'] ?? '',
            previewPath: $a['preview_path'] ?? '',
            conversionTimezone: $a['conversion_timezone'] ?? 'UTC',
            conversionCapEnabled: (bool)($a['conversion_cap_enabled'] ?? false),
            dailyCap: $a['daily_cap'] ?? 0,
            country: $country,
            notes: $a['notes'] ?? '',
        );
    }
}
