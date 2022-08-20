<?php

/** @noinspection PhpDocMissingThrowsInspection */
/** @noinspection PhpUnhandledExceptionInspection */

namespace Playtini\KeitaroClient\AdminApi;

use Playtini\KeitaroClient\AdminApi\Enum\GroupTypeEnum;
use Playtini\KeitaroClient\AdminApi\Model\AffiliateNetwork;
use Playtini\KeitaroClient\AdminApi\Model\Campaign;
use Playtini\KeitaroClient\AdminApi\Model\Domain;
use Playtini\KeitaroClient\AdminApi\Model\Flow;
use Playtini\KeitaroClient\AdminApi\Model\Group;
use Playtini\KeitaroClient\AdminApi\Model\Landing;
use Playtini\KeitaroClient\AdminApi\Model\Offer;
use Playtini\KeitaroClient\AdminApi\Model\Report;
use Playtini\KeitaroClient\AdminApi\Model\TrafficSource;
use Playtini\KeitaroClient\AdminApi\Model\User;
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
     * Get all Affiliate Networks
     *
     * @return AffiliateNetwork[]
     */
    public function affiliateNetworks(): array
    {
        return array_map(
            static fn($a) => AffiliateNetwork::create($a),
            $this->keitaroHttpClient->adminApiRequest(Request::METHOD_GET, 'affiliate_networks')
        );
    }

    /**
     * Get all Сampaigns
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
     * Get all Offers
     *
     * @return Offer[]
     */
    public function offers(): array
    {
        return array_map(
            static fn($a) => Offer::create($a),
            $this->keitaroHttpClient->adminApiRequest(Request::METHOD_GET, 'offers')
        );
    }

    /**
     * Get all Landing Pages
     *
     * @return Landing[]
     */
    public function landings(): array
    {
        return array_map(
            static fn($a) => Landing::create($a),
            $this->keitaroHttpClient->adminApiRequest(Request::METHOD_GET, 'landing_pages')
        );
    }

    /**
     * Get all Traffic Sources
     *
     * @return TrafficSource[]
     */
    public function trafficSources(): array
    {
        return array_map(
            static fn($a) => TrafficSource::create($a),
            $this->keitaroHttpClient->adminApiRequest(Request::METHOD_GET, 'traffic_sources')
        );
    }

    /**
     * Get all Groups
     *
     * @return Group[]
     */
    public function groups(GroupTypeEnum $type): array
    {
        return array_map(
            static fn($a) => Group::create($a),
            $this->keitaroHttpClient->adminApiRequest(Request::METHOD_GET, 'groups', ['type' => $type->value])
        );
    }

    /**
     * Get all Domains
     *
     * @return Domain[]
     */
    public function domains(): array
    {
        return array_map(
            static fn($a) => Domain::create($a),
            $this->keitaroHttpClient->adminApiRequest(Request::METHOD_GET, 'domains')
        );
    }

    /**
     * Get all Users
     *
     * @return User[]
     */
    public function users(): array
    {
        return array_map(
            static fn($a) => User::create($a),
            $this->keitaroHttpClient->adminApiRequest(Request::METHOD_GET, 'users')
        );
    }

    /**
     * Get Bot List
     *
     * @return array
     */
    public function botList(): array
    {
        $data = $this->keitaroHttpClient->adminApiRequest(Request::METHOD_GET, 'botlist');

        return array_map('trim', explode("\n", str_replace("\r", '', trim($data['value']))));
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
