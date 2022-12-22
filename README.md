Keitaro PHP Client
==================

[![Version](http://poser.pugx.org/playtini/keitaro-client/version)](https://packagist.org/packages/playtini/keitaro-client)
[![PHP Version Require](http://poser.pugx.org/playtini/keitaro-client/require/php)](https://packagist.org/packages/playtini/keitaro-client)
[![Packagist Downloads](https://img.shields.io/packagist/dt/playtini/keitaro-client)](https://packagist.org/packages/playtini/keitaro-client)

[Keitaro](https://keitaro.io) is a tool for affiliate and performance marketing.

It has 2 APIs: Click API, Admin API.


## Maintainer

This library is created and supported by [Playtini](https://playtini.ua).

We're hiring marketers (FB, Tiktok, UAC, in-app, Google) and developers (PHP, JS): [playtini.ua/jobs](https://playtini.ua/jobs)


## Install

```bash
composer require playtini/keitaro-client
```


## Click API

Accept traffic at your server, let Keitaro track and route your traffic.

Click API is available in Pro and Business Keitaro editions.

Click API docs:
* https://docs.keitaro.io/en/development/click-api.html
* https://docs.keitaro.io/en/campaign-integrations/kclient-php.html
* https://blog.keitaro.io/en/kclient-php-an-in-depth-article/

Usage:
```php
use Playtini\KeitaroClient\ClickApi\KeitaroClickApiClient;
use Playtini\KeitaroClient\ClickApi\KeitaroParams;
use Playtini\KeitaroClient\ClickApi\KeitaroRequest;
use Playtini\KeitaroClient\Http\KeitaroHttpClient;
use Symfony\Component\HttpClient\CurlHttpClient;
use Symfony\Component\HttpFoundation\Request;

require_once(__DIR__ . '/vendor/autoload.php');

$keitaroHttpClient = new KeitaroHttpClient(new CurlHttpClient(), 'https://keitaro.example.com'); // change to your TDS domain
$keitaroRequest = KeitaroRequest::create(Request::createFromGlobals()),
$keitaroParams = KeitaroParams::createFromKeitaroRequest($keitaroRequest, 'CAMPAIGN_TOKEN_HERE'); // change campaign token
$clickApiClient = new KeitaroClickApiClient($keitaroHttpClient, $keitaroRequest, $keitaroParams);
$response = $clickApiClient->createResponse($clickApiClient->getResult());
$response->send();

```

If you don't know campaign token but know campaign alias (unique URL part in TDS link - like
https://keitaro.example.com/THIS_IS_ALIAS ) then use `KeitaroClickApiTokenResolver` to get token via Admin API.
```php


use Playtini\KeitaroClient\AdminApi\KeitaroAdminApiClient;
use Playtini\KeitaroClient\ClickApi\KeitaroClickApiTokenResolver;
use Playtini\KeitaroClient\Http\KeitaroHttpClient;
use Symfony\Component\HttpClient\CurlHttpClient;

$keitaroHttpClient = new KeitaroHttpClient(new CurlHttpClient(), 'https://keitaro.example.com'); // change to your TDS domain
$adminClient = new KeitaroAdminApiClient($keitaroHttpClient, 'ADMIN_API_KEY_HERE'); // change api key
$resolver = new KeitaroClickApiTokenResolver($adminClient);
$resolver->getCampaignToken('test-tds')
```

For dependency injection you can use `KeitaroClickApiClientFactory`.


## Admin API

View, edit data at Keitaro without using UI.

Admin API is available only in Business Keitaro edition.

Admin API docs:
* https://blog.keitaro.io/en/admin-api-article/
* https://admin-api.docs.keitaro.io/

Usage:

```php
use Playtini\KeitaroClient\AdminApi\KeitaroAdminApiClient;
use Playtini\KeitaroClient\Http\KeitaroHttpClient;
use Symfony\Component\HttpClient\CurlHttpClient;

require_once(__DIR__ . '/vendor/autoload.php');

$keitaroHttpClient = new KeitaroHttpClient(new CurlHttpClient(), 'https://keitaro.example.com'); // change to your TDS domain
$adminClient = new KeitaroAdminApiClient($keitaroHttpClient, 'ADMIN_API_KEY_HERE'); // change api key

print_r($adminClient->campaigns());
```

Warning! Only several endpoints are implemented. If you need more please add an issue, we'll make them sooner.

## Symfony config example

`config/services.yaml`

```yaml
    Playtini\KeitaroClient\Http\KeitaroHttpClient:
        bind:
            $trackerUrl: '%env(KEITARO_TRACKER_URL)%'

    Playtini\KeitaroClient\AdminApi\KeitaroAdminApiClient:
        bind:
            $adminApiKey: '%env(KEITARO_ADMIN_API_KEY)%'

    Playtini\KeitaroClient\ClickApi\KeitaroClickApiClientFactory: {public: true}
    Playtini\KeitaroClient\ClickApi\KeitaroClickApiTokenResolver: {public: true}
```

```.env
KEITARO_TRACKER_URL=https://keitaro.example.com
KEITARO_ADMIN_API_KEY=aaa111bbb222aaa111bbb222
```
Don't forget to set real values in environment variables.

Click API controller method
```php
public function __invoke(
    string $slug,
    Request $request,
    KeitaroClickApiClientFactory $clientFactory,
    KeitaroClickApiTokenResolver $apiTokenResolver,
): Response
{
    $client = $clientFactory->create(
        request: $request,
        campaignToken: $apiTokenResolver->getCampaignToken($slug), // it's cached
    );
    $client->params->set('log', 1);

    return $client->createResponse($client->getResult());
}
```

Admin API controller method
```php
public function __invoke(KeitaroAdminApiClient $keitaroAdminApiClient): JsonResponse
{
    $campaigns = $keitaroAdminApiClient->campaigns();

    $tokens = [];
    foreach ($campaigns as $campaign) {
        $tokens[$campaign->alias] = $campaign->token;
    }

    return new JsonResponse($tokens);
}
```
