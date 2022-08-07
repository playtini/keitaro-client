Keitaro Client
==============

[Keitaro](https://keitaro.io) is a tool for affiliate and performance marketing.

It has 2 APIs: Click API, Admin API

## Maintainer

This library is created and supported by [Playtini](https://playtini.ua).

We're hiring marketers (FB, Tiktok, UAC, in-app, Google) and developers (PHP, JS): [playtini.ua/jobs](https://playtini.ua/jobs)

## Click API

Accept traffic at your server, let Keitaro track and route your traffic.

Click API is available in Pro and Business Keitaro editions.

Click API docs:
* https://docs.keitaro.io/en/development/click-api.html
* https://docs.keitaro.io/en/campaign-integrations/kclient-php.html
* https://blog.keitaro.io/en/kclient-php-an-in-depth-article/

Usage:
```
use Playtini\KeitaroClient\ClickApi\KeitaroClickApiClient;
use Playtini\KeitaroClient\Http\KeitaroHttpClient;
use Symfony\Component\HttpClient\CurlHttpClient;
use Symfony\Component\HttpFoundation\Request;

require_once(__DIR__ . '/vendor/autoload.php');

$request = Request::createFromGlobals();
$keitaroHttpClient = new KeitaroHttpClient(new CurlHttpClient(), 'https://keitaro.example.com'); // change to your TDS domain
$clickApiClient = new KeitaroClickApiClient($keitaroHttpClient, $request, 'CAMPAIGN_TOKEN_HERE'); // change campaign token
$response = $clickApiClient->getResponse();
$response->send();
```

## Admin API

View, edit data at Keitaro without using UI.

Admin API is available only in Business Keitaro edition.

Admin API docs:
* https://blog.keitaro.io/en/admin-api-article/
* https://admin-api.docs.keitaro.io/


Usage:

```

use Playtini\KeitaroClient\AdminApi\KeitaroAdminApiClient;
use Playtini\KeitaroClient\Http\KeitaroHttpClient;
use Symfony\Component\HttpClient\CurlHttpClient;

require_once(__DIR__ . '/vendor/autoload.php');

$keitaroHttpClient = new KeitaroHttpClient(new CurlHttpClient(), 'https://keitaro.example.com'); // change to your TDS domain
$adminClient = new KeitaroAdminApiClient($keitaroHttpClient, 'YOUR_API_KEY_HERE'); // change api key

print_r($adminClient->campaigns());
```
