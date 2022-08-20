<?php

namespace Playtini\KeitaroClient\AdminApi\Model;

use Playtini\KeitaroClient\AdminApi\Enum\UserAccessDataAccessTypeEnum;

class UserAccessData
{
    public function __construct(
        public readonly ?UserAccessDataAccessTypeEnum $offersAccessType, // Offers access type
        public readonly ?UserAccessDataAccessTypeEnum $campaignsAccessType, // Campaigns access type
        public readonly ?UserAccessDataAccessTypeEnum $landingsAccessType, // Landing pages access type
        public readonly ?UserAccessDataAccessTypeEnum $trafficSourcesAccessType, // Traffic sources access type
        public readonly ?UserAccessDataAccessTypeEnum $streamsAccessType, // Flows access type
        public readonly ?UserAccessDataAccessTypeEnum $affiliateNetworksAccessType, // Affiliate networks access type
        public readonly ?UserAccessDataAccessTypeEnum $domainsAccessType, // Domains access type

        public readonly array $resources, // string[]. Available resources
        public readonly array $allowedResources, // string[]. Allowed resources
        public readonly array $reports, // string[]. Allowed reports

        public readonly array $campaignsSelectedEntities, // not in openapi
        public readonly array $landingsSelectedEntities, // not in openapi
        public readonly array $offersSelectedEntities, // not in openapi
        public readonly array $affiliateNetworksSelectedEntities, // not in openapi
    ) {
    }

    public static function create(array $a): self
    {
        return new self(
            offersAccessType: UserAccessDataAccessTypeEnum::tryFrom($a['offers_access_type'] ?? ''),
            campaignsAccessType: UserAccessDataAccessTypeEnum::tryFrom($a['campaigns_access_type'] ?? ''),
            landingsAccessType: UserAccessDataAccessTypeEnum::tryFrom($a['landings_access_type'] ?? ''),
            trafficSourcesAccessType: UserAccessDataAccessTypeEnum::tryFrom($a['traffic_sources_access_type'] ?? ''),
            streamsAccessType: UserAccessDataAccessTypeEnum::tryFrom($a['streams_access_type'] ?? ''),
            affiliateNetworksAccessType: UserAccessDataAccessTypeEnum::tryFrom($a['affiliate_networks_access_type'] ?? ''),
            domainsAccessType: UserAccessDataAccessTypeEnum::tryFrom($a['domains_access_type'] ?? ''),
            resources: $a['resources'] ?? [],
            allowedResources: $a['allowed_resources'] ?? [],
            reports: $a['reports'] ?? [],
            campaignsSelectedEntities: $a['campaigns_selected_entities'] ?? [],
            landingsSelectedEntities: $a['landings_selected_entities'] ?? [],
            offersSelectedEntities: $a['offers_selected_entities'] ?? [],
            affiliateNetworksSelectedEntities: $a['affiliate_networks_selected_entities'] ?? [],
        );
    }
}
