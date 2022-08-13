<?php

namespace Playtini\KeitaroClient\Http;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class KeitaroHttpClient
{
    private const DEFAULT_OPTS = [
        'headers' => [
            'User-Agent' => 'KHttpClient (playtini/keitaro-client)',
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ],
        'timeout' => 10,
        'max_duration' => 10,
        'verify_peer' => false,
        'verify_host' => false,
    ];

    private string $adminApiKey = '';

    public function __construct(
        private readonly HttpClientInterface $httpClient,
        private readonly string $trackerUrl,
    ) {
    }

    public function setAdminApiKey(string $adminApiKey): self
    {
        $this->adminApiKey = $adminApiKey;

        return $this;
    }

    public function clientApiRequest(array $params, array $options = []): ResponseInterface
    {
        $method = Request::METHOD_POST;
        $url = sprintf('%s/click_api/v3', $this->trackerUrl);
        $options = $this->buildOptions($method, $params, $options);

        return $this->httpClient->request($method, $url, $options);
    }

    public function getRedirectUrl(?string $url): ?string
    {
        $result = null;
        if ($url) {
            $options = array_merge(self::DEFAULT_OPTS, ['max_redirects' => 0]);
            $response = $this->httpClient->request(Request::METHOD_GET, $url, $options);
            $result = $response->getHeaders(false)['location'][0] ?? null;
        }

        return $result;
    }

    public function buildOfferUrl(?string $token): ?string
    {
        if (!$token) {
            return null;
        }

        return sprintf('%s/?%s', $this->trackerUrl, http_build_query([
            '_lp' => 1,
            '_token' => $token,
        ]));
    }

    public function adminApiRequest(string $method, string $endpoint, \JsonSerializable|array $params = [], array $options = []): ResponseInterface
    {
        if ($params instanceof \JsonSerializable) {
            $params = $params->jsonSerialize();
        }

        $url = sprintf('%s/admin_api/v1/%s', $this->trackerUrl, ltrim($endpoint, '/'));

        $options['headers'] = $options['headers'] ?? [];
        $options['headers']['Api-Key'] = $this->adminApiKey;
        $options = $this->buildOptions($method, $params, $options);

        return $this->httpClient->request($method, $url, $options);
    }

    private function buildOptions(string $method = Request::METHOD_GET, array $params = [], array $options = []): array
    {
        $headers = array_merge(
            self::DEFAULT_OPTS['headers'] ?? [],
            $options['headers'] ?? [],
        );

        $result = self::DEFAULT_OPTS;
        if (in_array($method, [Request::METHOD_POST, Request::METHOD_PUT, Request::METHOD_PATCH], true)) {
            $result = array_merge($result, ['json' => $params]);
            $options['headers']['content-type'] = 'application/json';
        }
        $result = array_merge($result, $options);

        if (!empty($headers)) {
            $result['headers'] = $headers;
        }

        return $result;
    }
}
