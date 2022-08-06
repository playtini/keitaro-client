<?php

namespace Playtini\KeitaroClient\AdminApi\Model;

class AffiliateNetworkObject
{
    public function __construct(
        public readonly string $name = '', // Affiliate network name
        public readonly string $postbackUrl = '', // Postback URL for the Affiliate network
        public readonly string $offerParam = '', // These params are appends to offer URLs. Example, "sub1={subid}&sub2={campaign_name}"
        public readonly string $notes = '', // User Notes for the Affiliate network
    ) {
    }
}
