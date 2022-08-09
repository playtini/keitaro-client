<?php

namespace Playtini\KeitaroClient\ClickApi;

use Symfony\Component\HttpFoundation\Response;

class KeitaroClickApiResult
{
    public function __construct(
        public readonly ?string $body = null,
        public readonly array $headers = [],
        public readonly ?int $status = null,
        public readonly ?string $contentType = null,
        public readonly ?int $cookiesTtlHours = null, // key "cookies_ttl"
        public readonly array $cookies = [],
        public readonly ?string $uniquenessCookie = null,
        public readonly ?bool $uniquenessCampaign = null,
        public readonly ?bool $uniquenessFlow = null,
        public readonly ?bool $uniquenessGlobal = null,
        public readonly ?string $type = null, // values: "http"
        public readonly ?string $redirectUrl = null, // key "url"
        public readonly ?int $campaignId = null,
        public readonly ?int $flowId = null,
        public readonly ?int $offerId = null,
        public readonly ?int $landingId = null,
        public readonly ?string $subId = null,
        public readonly ?bool $isBot = null,
        public readonly ?string $token = null,
        public readonly ?string $offerUrl = null,
        public readonly array $log = [],
    ) {
    }

    public function isEmpty(): bool
    {
        return (
            (string)$this->body === '' &&
            (
                $this->status === Response::HTTP_OK ||
                $this->status === null
            )
        );
    }

    public static function create(array $item): self
    {
        $headers = $item['headers'] ?? [];
        if (!is_array($headers)) {
            $headers = [];
        }
        $t = [];
        foreach ($headers as $header) {
            if (str_contains($header, ': ')) {
                [$k, $v] = explode(': ', $header, 2);
                if (!isset($t[$k])) {
                    $t[$k] = [];
                }
                $t[$k][] = $v;
            }
        }
        $headers = $t;

        $cookies = $item['cookies'] ?? [];
        if (!is_array($cookies)) {
            $cookies = [];
        }

        $info = $item['info'] ?? [];
        if (!is_array($info)) {
            $info = [];
        }

        $infoUniqueness = $info['uniqueness'] ?? [];
        if (!is_array($infoUniqueness)) {
            $infoUniqueness = [];
        }

        $uniquenessCampaign = $infoUniqueness['campaign'] ?? null;
        $uniquenessFlow = $infoUniqueness['stream'] ?? null;
        $uniquenessGlobal = $infoUniqueness['global'] ?? null;

        $isBot = $info['is_bot'] ?? null;

        return new self(
            body: $item['body'] ?? null,
            headers: $headers,
            status: $item['status'] ?? null,
            contentType: $item['contentType'] ?? null, // yes, this key is camelCase
            cookiesTtlHours: $item['cookies_ttl'], // yes, it differs from property name "cookiesTtlMinutes"
            cookies: $cookies,
            uniquenessCookie: $item['uniqueness_cookie'],
            uniquenessCampaign: ($uniquenessCampaign !== null) ? (bool)$uniquenessCampaign : null,
            uniquenessFlow: ($uniquenessFlow !== null) ? (bool)$uniquenessFlow : null,
            uniquenessGlobal: ($uniquenessGlobal !== null) ? (bool)$uniquenessGlobal : null,
            type: $info['type'],
            redirectUrl: $info['url'], // yes, it differs from property name "redirectUrl"
            campaignId: $info['campaign_id'],
            flowId: $info['stream_id'],
            offerId: $info['offer_id'],
            landingId: $info['landing_id'],
            subId: $info['sub_id'],
            isBot: ($isBot !== null) ? (bool)$isBot : null,
            token: $info['token'],
            offerUrl: $item['offer_url'] ?? null,
            log: $item['log'] ?? [],
        );
    }
}
