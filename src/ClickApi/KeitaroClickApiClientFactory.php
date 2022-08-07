<?php

namespace Playtini\KeitaroClient\ClickApi;

use Playtini\KeitaroClient\Http\KeitaroHttpClient;
use Symfony\Component\HttpFoundation\Request;

class KeitaroClickApiClientFactory
{
    public function __construct(
        private readonly KeitaroHttpClient $keitaroHttpClient,
        private ?string $campaignToken = null,
        private readonly array $params = [],
    ) {
    }

    public function create(
        Request $request = null,
        array $params = [],
        bool $setParamsFromQuery = true,
        ?string $campaignToken = null,
    ): KeitaroClickApiClient {
        if ($request === null) {
            $request = Request::createFromGlobals();
        }

        return new KeitaroClickApiClient(
            keitaroHttpClient: $this->keitaroHttpClient,
            request: $request,
            campaignToken: $campaignToken ?? $this->campaignToken,
            params: array_merge($this->params, $params),
            setParamsFromQuery: $setParamsFromQuery,
        );
    }

    public function setCampaignToken(?string $campaignToken): self
    {
        $this->campaignToken = $campaignToken;

        return $this;
    }
}
