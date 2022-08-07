<?php

namespace Playtini\KeitaroClient\ClickApi;

use Playtini\KeitaroClient\AdminApi\KeitaroAdminApiClient;
use Psr\Cache\CacheItemPoolInterface;

class KeitaroClickApiTokenResolver
{
    public function __construct(
        private readonly KeitaroAdminApiClient $adminApiClient,
        private readonly CacheItemPoolInterface $cache,
    ) {
    }

    public function getCampaignToken(string $campaignAlias): ?string
    {
        $cacheItem = $this->cache->getItem(__METHOD__);

        if ($cacheItem->isHit()) {
            $value = $cacheItem->get();
        } else {
            $value = [];

            $campaigns = $this->adminApiClient->campaigns();
            foreach ($campaigns as $campaign) {
                $value[$campaign->alias] = $campaign->token;
            }

            $cacheItem->set($value);
            $this->cache->save($cacheItem);
        }

        return $value[$campaignAlias] ?? null;
    }
}
