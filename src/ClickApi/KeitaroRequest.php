<?php

namespace Playtini\KeitaroClient\ClickApi;

use Symfony\Component\HttpFoundation\Request;

class KeitaroRequest
{
    private const SYSTEM_PARAMS = ['api_key', 'token', 'language', 'ua', 'ip', 'referrer', 'force_redirect_offer'];

    public function __construct(
        public readonly string $ip,
        public readonly string $host,
        public readonly string $method,
        public readonly string $uri,
        public readonly array $query,
        public readonly array $headers,
        public readonly array $cookies,
    ) {
    }

    public static function create(Request $request): self
    {
        return new self(
            ip: $request->getClientIp(),
            host: $request->getHost(),
            method: $request->getMethod(),
            uri: $request->getUri(),
            query: $request->query->all(),
            headers: array_map(static fn($v) => $v[0], $request->headers->all()),
            cookies: $request->cookies->all(),
        );
    }

    public function getQueryParamsWithoutSystemParams(): array
    {
        $result = [];
        foreach ($this->query as $k => $v) {
            if (!in_array($k, self::SYSTEM_PARAMS, true)) {
                $result[$k] = $v;
            }
        }

        return $result;
    }

    public function getUserAgent(): string
    {
        return $this->getHeader('user-agent');
    }

    public function getXRequestedWith(): string
    {
        return $this->getHeader('x-requested-with');
    }

    public function getReferer(): string
    {
        return $this->getHeader('referer');
    }

    public function getLanguage(): string
    {
        return substr($this->getHeader('accept-language'), 0, 2);
    }

    public function getCookieHost(): ?string
    {
        return preg_match('#^www\.#i', $this->host) ? preg_replace('#^www\.#i', '.', $this->host) : null;
    }

    /** @noinspection SpellCheckingInspection */
    public function isPrefetchDetected(): bool
    {
        $checkHeaders = [
            'x-purpose' => 'preview',
            'x-moz' => 'prefetch',
            'x-fb-http-engine' => 'Liger',
        ];
        foreach ($checkHeaders as $k => $v) {
            if ($this->getHeader($k) === $v) {
                return true;
            }
        }

        return false;
    }

    public function buildCookieHeader(): ?string
    {
        $cookies = [];
        foreach ($this->cookies as $k => $v) {
            if ($k !== 'PHPSESSID') {
                $cookies[] = $k.'='.$v;
            }
        }

        return $cookies ? implode('; ', $cookies) : null;
    }

    private function getHeader(string $name): string
    {
        return $this->headers[$name] ?? '';
    }
}
