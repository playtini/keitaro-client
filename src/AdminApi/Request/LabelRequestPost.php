<?php

namespace Playtini\KeitaroClient\AdminApi\Request;

class LabelRequestPost
{
    public function __construct(
        public readonly int $campaignId, // Campaign ID
        public readonly string $refName = '', // List of available ref names: ip, source, ad_campaign_id, creative_id, keyword, ad_campaign_idn, sub_id_1..15
        public readonly array $items = [], // An Object like a {"value":"blacklist"}
    ) {
    }
}
