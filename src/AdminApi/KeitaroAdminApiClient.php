<?php

/** @noinspection PhpDocMissingThrowsInspection */
/** @noinspection PhpUnhandledExceptionInspection */

namespace Playtini\KeitaroClient\AdminApi;

use Playtini\KeitaroClient\AdminApi\Model\Campaign;
use Playtini\KeitaroClient\AdminApi\Model\Flow;
use Playtini\KeitaroClient\AdminApi\Model\Report;
use Playtini\KeitaroClient\AdminApi\Request\CampaignCostRequest;
use Playtini\KeitaroClient\AdminApi\Request\ClicksUpdateCostsRequest;
use Playtini\KeitaroClient\AdminApi\Request\ReportsRequest;
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
        return array_map(
            static fn($a) => Campaign::create($a),
            $this->keitaroHttpClient->adminApiRequest(Request::METHOD_GET, 'campaigns')
        );
    }

    /**
     * Get Campaign
     *
     * @param int $campaignId
     * @return Campaign
     */
    public function campaign(int $campaignId): Campaign
    {
        return Campaign::create(
            $this->keitaroHttpClient->adminApiRequest(Request::METHOD_GET, sprintf('campaigns/%s', $campaignId))
        );
    }

    /**
     * Get Campaign Flows
     *
     * @param int $campaignId
     * @return Flow[]
     */
    public function campaignFlows(int $campaignId): array
    {
        return array_map(
            static fn($a) => Flow::create($a),
            $this->keitaroHttpClient->adminApiRequest(Request::METHOD_GET, sprintf('campaigns/%s/streams', $campaignId))
        );
    }

    public function campaignUpdateCosts(int $campaignId, CampaignCostRequest $campaignCostRequest): void
    {
        $result = $this->keitaroHttpClient->adminApiRequest(
            method: Request::METHOD_POST,
            endpoint: sprintf('/campaigns/%s/update_costs', $campaignId),
            params: $campaignCostRequest
        );

        if (empty($result['success'])) {
            throw new \RuntimeException('invalid_api_request', ['method' => __METHOD__, 'response' => $result]);
        }
    }

    /**
     * It's safer to keep "only_campaign_uniques = 0" when you are using filter not only by campaigns,
     * because your filter may select only non-unique (for campaign) clicks and costs will not be updated
     */
    public function clickUpdateCosts(ClicksUpdateCostsRequest $clicksUpdateCostsRequest): void
    {
        $result = $this->keitaroHttpClient->adminApiRequest(
            method: Request::METHOD_POST,
            endpoint: '/clicks/update_costs',
            params: $clicksUpdateCostsRequest,
        );

        if (empty($result['success'])) {
            throw new \RuntimeException('invalid_api_request', ['method' => __METHOD__, 'response' => $result]);
        }
    }

    public function reportBuild(ReportsRequest $reportsRequest): Report
    {
        return Report::create(
            $this->keitaroHttpClient->adminApiRequest(
                method: Request::METHOD_POST,
                endpoint: '/report/build',
                params: $reportsRequest,
            )
        );
    }
}
