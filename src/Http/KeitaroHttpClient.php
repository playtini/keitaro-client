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

    public function __construct(
        private readonly HttpClientInterface $httpClient,
        private readonly string $trackerUrl,
    ) {
    }

    public function clientApiRequest(array $params, array $options = []): ResponseInterface
    {
        $method = Request::METHOD_POST;
        $url = sprintf('%s/click_api/v3', $this->trackerUrl);
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
            $result = array_merge($result, ['body' => http_build_query($params)]);
        }
        $result = array_merge($result, $options);

        if (!empty($headers)) {
            $result['headers'] = $headers;
        }

        return $result;
    }
}
