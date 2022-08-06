Keitaro Client
==============

[Keitaro](https://keitaro.io) is a tool for affiliate and performance marketing.

It has 2 APIs:

* Click API - accept traffic at your server, let Keitaro track and route your traffic
* Admin API - view, edit data at Keitaro without using UI

Click API is available in Pro and Business Keitaro editions.
Admin API is available only in Business Keitaro edition.

Click API docs:
* https://docs.keitaro.io/en/development/click-api.html
* https://docs.keitaro.io/en/campaign-integrations/kclient-php.html
* https://blog.keitaro.io/en/kclient-php-an-in-depth-article/

Admin API docs:
* https://blog.keitaro.io/en/admin-api-article/
* https://admin-api.docs.keitaro.io/

## Maintainer

This library is created and supported by [Playtini](https://playtini.ua).

We're hiring marketers (FB, Tiktok, UAC, in-app, Google) and developers (PHP, JS): [playtini.ua/jobs](https://playtini.ua/jobs)

## Admin API

Usage:

```

use Playtini\KeitaroClient\AdminApi\KeitaroAdminApiClient;
use Playtini\KeitaroClient\Http\KeitaroHttpClient;
use Symfony\Component\HttpClient\CurlHttpClient;

require_once(__DIR__ . '/vendor/autoload.php');

$keitaroHttpClient = new KeitaroHttpClient(new CurlHttpClient(), 'https://keitaro.example.com'); // change to your TDS domain
$adminClient = new KeitaroAdminApiClient($keitaroHttpClient, 'YOUR_API_KEY_HERE');

print_r($adminClient->campaigns());
```
