<?php

namespace Playtini\KeitaroClient\ClickApi;

use Playtini\KeitaroClient\AdminApi\KeitaroAdminApiClient;
use Psr\Cache\CacheItemPoolInterface;

class KeitaroClickApiTokenResolver
{
    public function __construct(
        private readonly KeitaroAdminApiClient $adminApiClient,
        private readonly ?CacheItemPoolInterface $cache = null,
    ) {
    }

    public function getCampaignToken(string $campaignAlias): ?string
    {
        $value = $this->cache ? $this->getCachedValue() : $this->getValue();

        return $value[$campaignAlias] ?? null;
    }

    private function getValue(): array
    {
        $value = [];
        $campaigns = $this->adminApiClient->campaigns();
        foreach ($campaigns as $campaign) {
            $value[$campaign->alias] = $campaign->token;
        }

        return $value;
    }

    private function getCachedValue(): array
    {
        $cacheKeyWithoutReservedCharacters = md5(__METHOD__);
        $cacheItem = $this->cache->getItem($cacheKeyWithoutReservedCharacters);

        if ($cacheItem->isHit()) {
            $value = $cacheItem->get();
        } else {
            $value = $this->getValue();

            $cacheItem->set($value);
            $this->cache->save($cacheItem);
        }

        return $value;
    }
}
