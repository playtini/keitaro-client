<?php

namespace Playtini\KeitaroClient\AdminApi\Model;

use Playtini\KeitaroClient\AdminApi\Enum\S2SPostbackMethodEnum;

class S2SPostback
{
    public function __construct(
        public readonly int $postbackId,
        public readonly int $campaignId,
        public readonly S2SPostbackMethodEnum $method = S2SPostbackMethodEnum::GET,
        public readonly string $url = '', // Postback URL
        public readonly S2SPostbackStatuses $statuses = new S2SPostbackStatuses(),
    ) {
    }

    public static function create(array $a): self
    {
        return new self(
            postbackId: $a['id'] ?? 0,
            campaignId: $a['campaign_id'] ?? 0,
            method: S2SPostbackMethodEnum::tryFrom($a['method'] ?? 'GET') ?? S2SPostbackMethodEnum::GET,
            url: $a['url'],
            statuses: new S2SPostbackStatuses(
                isLead: in_array('lead', $a['statuses'] ?? [], true),
                isSale: in_array('sale', $a['statuses'] ?? [], true),
                isRejected: in_array('rejected', $a['statuses'] ?? [], true),
                isRebill: in_array('rebill', $a['statuses'] ?? [], true),
            ),
        );
    }
}
