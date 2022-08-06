<?php

namespace Playtini\KeitaroClient\AdminApi\Model;

use Playtini\KeitaroClient\AdminApi\Enum\UserAccessDataAccessTypeEnum;

class UserAccessData
{
    public function __construct(
        public readonly UserAccessDataAccessTypeEnum $offersAccessType, // Offers access type
        public readonly UserAccessDataAccessTypeEnum $campaignsAccessType, // Campaigns access type
        public readonly UserAccessDataAccessTypeEnum $landingsAccessType, // Landing pages access type
        public readonly UserAccessDataAccessTypeEnum $trafficSourcesAccessType, // Traffic sources access type
        public readonly UserAccessDataAccessTypeEnum $streamsAccessType, // Flows access type
        public readonly UserAccessDataAccessTypeEnum $affiliateNetworksAccessType, // Affiliate networks access type
        public readonly UserAccessDataAccessTypeEnum $domainsAccessType, // Domains access type

        public readonly array $resources, // string[]. Available resources
        public readonly array $allowedResources, // string[]. Allowed resources
        public readonly array $reports, // string[]. Allowed reports
    ) {
    }
}
