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

    public function campaignUpdateCosts(int $campaignId, CampaignCostRequest $campaignCostRequest): void
    {
        $response = $this->keitaroHttpClient->adminApiRequest(
            method: Request::METHOD_POST,
            endpoint: sprintf('/campaigns/%s/update_costs', $campaignId),
            params: $campaignCostRequest
        );

        $result = $response->toArray();
        if (empty($result['success'])) {
            throw new \RuntimeException('invalid_api_request', ['method' => __METHOD__, 'response' => $response->getContent()]);
        }
    }

    /**
     * I don't know why but it doesn't work :(
     */
    public function clickUpdateCosts(ClicksUpdateCostsRequest $clicksUpdateCostsRequest): void
    {
        $response = $this->keitaroHttpClient->adminApiRequest(
            method: Request::METHOD_POST,
            endpoint: '/clicks/update_costs',
            params: $clicksUpdateCostsRequest,
        );

        //print_r($clicksUpdateCostsRequest->jsonSerialize());
        $result = $response->toArray();
        if (empty($result['success'])) {
            throw new \RuntimeException('invalid_api_request', ['method' => __METHOD__, 'response' => $response->getContent()]);
        }
    }

    public function reportBuild(ReportsRequest $reportsRequest): Report
    {
        $response = $this->keitaroHttpClient->adminApiRequest(
            method: Request::METHOD_POST,
            endpoint: '/report/build',
            params: $reportsRequest,
        );

        return Report::create($response->toArray());
    }
}
