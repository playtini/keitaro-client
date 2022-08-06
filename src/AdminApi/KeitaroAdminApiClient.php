<?php

/** @noinspection PhpDocMissingThrowsInspection */
/** @noinspection PhpUnhandledExceptionInspection */

namespace Playtini\KeitaroClient\AdminApi;

use Playtini\KeitaroClient\AdminApi\Model\Campaign;
use Playtini\KeitaroClient\AdminApi\Model\Flow;
use Playtini\KeitaroClient\Http\KeitaroHttpClient;
use Symfony\Component\HttpFoundation\Request;

class KeitaroAdminApiClient
{
    public function __construct(
        public readonly KeitaroHttpClient $keitaroHttpClient,
        string $adminApiKey = '',
    ) {
        $this->keitaroHttpClient->setAdminApiKey($adminApiKey);
    }

    /**
     * Get all campaigns
     *
     * @return Campaign[]
     */
    public function campaigns(): array
    {
        $response = $this->keitaroHttpClient->adminApiRequest(Request::METHOD_GET, 'campaigns');

        return array_map(static fn($a) => Campaign::create($a), $response->toArray());
    }

    /**
     * Get Campaign
     *
     * @param int $campaignId
     * @return Campaign
     */
    public function campaign(int $campaignId): Campaign
    {
        $response = $this->keitaroHttpClient->adminApiRequest(Request::METHOD_GET, sprintf('campaigns/%s', $campaignId));

        return Campaign::create($response->toArray());
    }

    /**
     * Get Campaign Flows
     *
     * @param int $campaignId
     * @return Flow[]
     */
    public function campaignFlows(int $campaignId): array
    {
        $response = $this->keitaroHttpClient->adminApiRequest(Request::METHOD_GET, sprintf('campaigns/%s/streams', $campaignId));

        return array_map(static fn($a) => Flow::create($a), $response->toArray());
    }
}
