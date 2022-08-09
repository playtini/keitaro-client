<?php

/** @noinspection SpellCheckingInspection */

namespace Playtini\KeitaroClient\ClickApi;

use Playtini\KeitaroClient\Http\KeitaroHttpClient;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
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
    private const SYSTEM_PARAMS = ['api_key', 'token', 'language', 'ua', 'ip', 'referrer', 'force_redirect_offer'];

    private ?KeitaroClickApiResult $lastResult = null;

    public ParameterBag $params;

    public function __construct(
        public readonly KeitaroHttpClient $keitaroHttpClient,
        private readonly Request $request,
        ?string $campaignToken = null, // if you not set it here then don't forget to set it later: $client->params->set('token', 'YOUR_TOKEN')
        array $params = [],
        bool $setParamsFromQuery = true
    ) {
        $this->params = new ParameterBag($this->buildParams($params, $campaignToken, $setParamsFromQuery));
    }

    public function setParamsFromQuery(): self
    {
        $params = $this->extractParamsFromQuery();
        foreach ($params as $k => $v) {
            $this->params->set($k, $v);
        }

        return $this;
    }

    public function getResponse(?KeitaroClickApiResult $apiResult = null, $redirectToOffer = true): Response
    {
        $apiResult = $apiResult ?? $this->lastResult ?? $this->getResult();

        $content = $apiResult->body;
        if (
            str_contains($apiResult->contentType, 'image') ||
            str_contains($apiResult->contentType, 'application/pdf')
        ) {
            $content = base64_decode($content);
        }

        // sometimes Keitaro just selects offer but doesn't redirect user
        $redirectUrl = null;
        if ($redirectToOffer && $apiResult->offerUrl && $apiResult->isEmpty()) {
            $redirectUrl = $this->keitaroHttpClient->getRedirectUrl($apiResult->offerUrl);
        }

        if ($redirectUrl) {
            $response = new RedirectResponse($redirectUrl);
        } else {
            $response = new Response($content, $apiResult->status, $apiResult->headers);
        }

        foreach ($apiResult->cookies as $k => $v) {
            $cookieHost = preg_match('#^www\.#i', $this->request->getHost()) ? preg_replace('#^www\.#i', '.', $this->request->getHost()) : null;
            $response->headers->setCookie(Cookie::create($k, $v, $apiResult->cookiesTtlHours * 3600, '/', $cookieHost));
        }
        if ($apiResult->contentType) {
            $response->headers->set('Content-Type', $apiResult->contentType);
        }

        return $response;
    }

    public function getResult(): KeitaroClickApiResult
    {
        $options = $this->buildRequestOptions();

        $response = $this->keitaroHttpClient->clientApiRequest($this->params->all(), $options);
        $responseData = $response->toArray();
        $responseData['offer_url'] = $this->keitaroHttpClient->buildOfferUrl($responseData['info']['token'] ?? '');

        return KeitaroClickApiResult::create($responseData);
    }

    private function isPrefetchDetected(): bool
    {
        $checkHeaders = [
            'x-purpose' => 'preview',
            'x-moz' => 'prefetch',
            'x-fb-http-engine' => 'Liger',
        ];
        foreach ($checkHeaders as $k => $v) {
            if ($this->request->headers->get($k) === $v) {
                return true;
            }
        }

        return false;
    }

    private function buildRequestOptions(): array
    {
        $options = [
            'headers' => [],
        ];
        $cookies = [];
        foreach ($this->request->cookies as $k => $v) {
            if ($k !== 'PHPSESSID') {
                $cookies[] = $k.'='.$v;
            }
        }
        if (!empty($cookies)) {
            $options['headers']['Cookie'] = implode('; ', $cookies);
        }

        return $options;
    }

    private function buildParams(array $params = [], string $campaignToken = null, bool $setParamsFromQuery = true): array
    {
        $result = $params;

        if ($setParamsFromQuery) {
            $result = array_merge($result, $this->extractParamsFromQuery());
        }

        if ($campaignToken !== null) {
            $result['token'] = $campaignToken;
        }

        $result['version'] = 3;
        $result['info'] = 1;
        $result['ip'] = $this->request->getClientIp();
        $result['ua'] = $this->request->headers->get('user-agent');
        $result['language'] = substr($this->request->headers->get('accept-language', ''), 0, 2);
        $result['x_requested_with'] = $this->request->headers->get('x-requested-with');
        $result['se_referrer'] = $this->request->headers->get('referer');
        $result['referrer'] = $this->request->headers->get('referer');
        $result['original_headers'] = array_map(static fn($v) => $v[0], $this->request->headers->all());
        $result['original_host'] = $this->request->getHost();
        $result['original_method'] = $this->request->getMethod();
        $result['uri'] = $this->request->getUri();
        $result['kversion'] = '3.4'; // strange, but it differes from KClient version
        if ($this->isPrefetchDetected()) {
            $result['prefetch'] = 1;
        }

        return $result;
    }

    private function extractParamsFromQuery(): array
    {
        $queryParams = $this->request->query->all();

        $result = [];
        foreach ($queryParams as $k => $v) {
            if (!in_array($k, self::SYSTEM_PARAMS, true)) {
                $result[$k] = $v;
            }
        }

        return $result;
    }
}
