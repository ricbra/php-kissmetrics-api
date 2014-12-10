<?php
/*
 * (c) Waarneembemiddeling.nl
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
echo '<pre>';
require 'vendor/autoload.php';

$client = \KISSmetrics\ClientFactory::factory('123456789', [
    'defaults' => [
        'headers' => ['User-Agent' => 'your-app-name/1.0.0 +https://yourapp.com']
    ]
]);
$history = new GuzzleHttp\Subscriber\History();
$client->getHttpClient()->getEmitter()->attach($history);

try {
    $client->setProperties([
        '_p' => 'Facebook #23',
        'Test' => 'TEst'
    ]);
} catch (Exception $e) {
echo $e;
}

foreach ($history as $row) {

    //print (string) $row['request'];
    print (string) $row['response'];
}
