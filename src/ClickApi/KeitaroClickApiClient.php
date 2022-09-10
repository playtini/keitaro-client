<?php

/** @noinspection SpellCheckingInspection */

namespace Playtini\KeitaroClient\ClickApi;

use Playtini\KeitaroClient\Http\KeitaroHttpClient;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Response;

/**
 * Based on KClient 3.15
 *
 * Differences:
 * - doesn't use global objects directly (bad practice) - uses Request object to get information
 * - doesn't print to output or sends headers (bad practice) - uses Response object which you can process before sending to user
 * - params property is ParameterBag with get, set, all and other methods
 * - there are external dependencies, not one-file solution
 * - doesn't allow to save and restore result from session
 *
 * @url https://v9.help.keitaro.io/en/campaign-integrations/kclient-php.html
 */
class KeitaroClickApiClient
{
    public ParameterBag $params;

    public function __construct(
        public readonly KeitaroHttpClient $keitaroHttpClient,
        private readonly KeitaroRequest $keitaroRequest,
        KeitaroParams $params = null, // if you not campaign tokent here then don't forget to set it later: $client->params->set('token', 'YOUR_TOKEN')

    ) {
        $this->params = new ParameterBag(
            $this->buildParams(
                $params ?? KeitaroParams::createFromKeitaroRequest($keitaroRequest)
            )
        );
    }

    public function setParamsFromQuery(): self
    {
        $params = $this->keitaroRequest->getQueryParamsWithoutSystemParams();
        foreach ($params as $k => $v) {
            $this->params->set($k, $v);
        }

        return $this;
    }

    public function createResponse(KeitaroClickApiResult $apiResult): Response
    {
        $response = new Response($this->getApiResultBody($apiResult), $apiResult->status, $apiResult->headers);

        foreach ($apiResult->cookies as $k => $v) {
            $expire = $apiResult->cookiesTtlHours * 3600;
            if (!in_array($k, ['_subid', '_token'], true)) { // uniqueness_cookie
                $expire = new \DateTime('+10 years');
            }

            $cookie = Cookie::create(
                name: $k,
                value: $v,
                expire: $expire,
                path: '/',
                domain: $this->keitaroRequest->getCookieHost()
            );
            $response->headers->setCookie($cookie);
        }
        if ($apiResult->contentType) {
            $response->headers->set('Content-Type', $apiResult->contentType);
        }

        return $response;
    }

    public function getResult(bool $forceRedirectOffer = true): KeitaroClickApiResult
    {
        if (!$this->params->get('token')) {
            throw new \InvalidArgumentException('empty_campaign_token');
        }

        $this->params->set('force_redirect_offer', $forceRedirectOffer ? '1' : '');
        $options = $this->buildRequestOptions();

        $responseData = $this->keitaroHttpClient->clientApiRequest($this->params->all(), $options);

        return KeitaroClickApiResult::create($responseData);
    }

    public function buildOfferUrl(string $token): string
    {
        return $this->keitaroHttpClient->buildOfferUrl($token); // KeitaroClickApiResult->token
    }

    private function buildRequestOptions(): array
    {
        $options = [
            'headers' => [],
        ];

        $cookieHeader = $this->keitaroRequest->buildCookieHeader();
        if ($cookieHeader !== null) {
            $options['headers']['Cookie'] = $cookieHeader;
        }

        return $options;
    }

    private function buildParams(KeitaroParams $params): array
    {
        $result = array_merge($params->jsonSerialize(), [
            'version' => 3,
            'info' => 1,
            'ip' => $this->keitaroRequest->ip,
            'ua' => $this->keitaroRequest->getUserAgent(),
            'language' => $this->keitaroRequest->getLanguage(),
            'x_requested_with' => $this->keitaroRequest->getXRequestedWith(),
            'se_referrer' => $this->keitaroRequest->getReferer(),
            'referrer' => $this->keitaroRequest->getReferer(),
            'original_headers' => $this->keitaroRequest->headers,
            'original_host' => $this->keitaroRequest->host,
            'original_method' => $this->keitaroRequest->method,
            'uri' => $this->keitaroRequest->uri,
            'kversion' => '3.4', // strange, but it differes from KClient version
        ]);

        if ($this->keitaroRequest->isPrefetchDetected()) {
            $result['prefetch'] = 1;
        }

        return $result;
    }

    private function getApiResultBody(KeitaroClickApiResult $apiResult): string
    {
        $content = (string)$apiResult->body;
        if (
            str_contains($apiResult->contentType, 'image') ||
            str_contains($apiResult->contentType, 'application/pdf')
        ) {
            $content = base64_decode($content);
        }

        return $content;
    }
}
