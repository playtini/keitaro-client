<?php

namespace Playtini\KeitaroClient\ClickApi;

use Playtini\KeitaroClient\Http\KeitaroHttpClient;
use Symfony\Component\HttpFoundation\Request;

class KeitaroClickApiClientFactory
{
    public function __construct(
        private readonly KeitaroHttpClient $keitaroHttpClient,
    ) {
    }

    public function create(
        KeitaroRequest $request = null,
        KeitaroParams $params = null,
        string $campaignToken = null,
    ): KeitaroClickApiClient {
        if ($request === null) {
            $request = KeitaroRequest::create(Request::createFromGlobals());
        }
        if ($params === null) {
            $params = KeitaroParams::createFromKeitaroRequest($request, $campaignToken);
        }

        return new KeitaroClickApiClient(
            keitaroHttpClient: $this->keitaroHttpClient,
            keitaroRequest: $request,
            params: $params,
        );
    }
}
