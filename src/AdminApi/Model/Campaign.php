<?php

/** @noinspection SpellCheckingInspection */

namespace Playtini\KeitaroClient\AdminApi\Model;

use Gupalo\DateUtils\DateUtils;
use Gupalo\Json\Json;
use Playtini\KeitaroClient\AdminApi\Enum\CampaignBindVisitorsEnum;
use Playtini\KeitaroClient\AdminApi\Enum\CampaignCostTypeEnum;
use Playtini\KeitaroClient\AdminApi\Enum\CampaignStateEnum;
use Playtini\KeitaroClient\AdminApi\Enum\CampaignTypeEnum;
use Playtini\KeitaroClient\AdminApi\Enum\CampaignUniquenessMethodEnum;
use Throwable;

class Campaign
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly string $alias = '', // Leave empty to generate automatically
        public readonly CampaignTypeEnum $type = CampaignTypeEnum::Position, // Set 'weight' to enable split-testing the flows.
        public readonly string $name = '',
        public readonly ?CampaignUniquenessMethodEnum $uniquenessMethod = null,
        public readonly bool $uniquenessUseCookies = false,
        public readonly int $cookiesTtl = 24, // hours
        public readonly int $position = 0,
        public readonly CampaignStateEnum $state = CampaignStateEnum::Active,
        public readonly CampaignCostTypeEnum $costType = CampaignCostTypeEnum::CPC,
        public readonly float $costValue = 0.0,
        public readonly string $costCurrency = '', // Leave empty to use tracker currency
        public readonly ?int $groupId = null,
        public readonly ?CampaignBindVisitorsEnum $bindVisitors = null,
        public readonly ?int $trafficSourceId = null,
        public readonly string $token = '', // Token to gain access to Click API
        public readonly bool $costAuto = false,
        public readonly ?SourceParameters $parameters = null,
        public readonly ?S2SPostbackCollection $postbacks = null,
        public readonly string $notes = '',
        public readonly float $trafficLoss = 0.0,
        public readonly string $domain = '',
        public readonly ?\DateTimeInterface $createdAt = null,
        public readonly ?\DateTimeInterface $updatedAt = null,
    ) {
    }

    public static function create(array $a): self
    {
        if (is_string($a['parameters'])) {
            try {
                $t = $a['parameters'];
                $a['parameters'] = Json::toArray($t);
            } catch (Throwable) {
                try {
                    // string may be double json encoded
                    $a['parameters'] = Json::toArray(json_decode($t, true, 512, JSON_THROW_ON_ERROR));
                } catch (Throwable $e) {
                    $a['parameters'] = [
                        'error' => $e->getMessage(),
                        'value' => (string)$t,
                    ];
                }
            }
        }

        return new self(
            id: $a['id'] ?? null,
            alias: $a['alias'] ?? '',
            type: CampaignTypeEnum::tryFrom($a['type'] ?? 'position') ?? CampaignTypeEnum::Position,
            name: $a['name'] ?? '',
            uniquenessMethod: CampaignUniquenessMethodEnum::tryFrom($a['uniqueness_method'] ?? null),
            uniquenessUseCookies: (bool)($a['uniqueness_use_cookies'] ?? false),
            cookiesTtl: $a['cookies_ttl'] ?? 24,
            position: $a['position'] ?? 0,
            state: CampaignStateEnum::tryFrom($a['state'] ?? 'active') ?? CampaignStateEnum::Active,
            costType: CampaignCostTypeEnum::tryFrom($a['cost_type'] ?? 'CPC') ?? CampaignCostTypeEnum::CPC,
            costValue: $a['cost_value'] ?? 0.0,
            costCurrency: $a['cost_currency'] ?? '',
            groupId: $a['group_id'] ?? null,
            bindVisitors: CampaignBindVisitorsEnum::tryFrom($a['bind_visitors'] ?? null),
            trafficSourceId: $a['traffic_source_id'] ?? null,
            token: $a['token'] ?? '',
            costAuto: (bool)($a['cost_auto'] ?? null),
            parameters: SourceParameters::create($a['parameters'] ?? []),
            postbacks: S2SPostbackCollection::create($a['postbacks'] ?? []),
            notes: $a['notes'] ?? '',
            trafficLoss: (float)($a['traffic_loss'] ?? 0.0),
            domain: $a['domain'] ?? '',
            createdAt: DateUtils::createNull($a['created_at'] ?? null),
            updatedAt: DateUtils::createNull($a['updated_at'] ?? null),
        );
    }
}
