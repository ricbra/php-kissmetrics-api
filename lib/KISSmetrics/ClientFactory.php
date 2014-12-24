<?php
/*
 * This file is part of the php-discogs-api.
 *
 * (c) Richard van den Brand <richard@vandenbrand.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KISSmetrics;

use GuzzleHttp\Client;
use GuzzleHttp\Command\Event\InitEvent;
use GuzzleHttp\Command\Guzzle\Description;
use GuzzleHttp\Command\Guzzle\GuzzleClient;

class ClientFactory
{
    public static function factory($apiKey, array $config = [])
    {
        $defaultConfig = [
            'defaults' => [
                'headers' => ['User-Agent' => 'php-kissmetrics-api/1.0.0 +https://github.com/ricbra/php-kissmetrics-api'],
            ],
        ];

        $client         = new Client(self::mergeRecursive($defaultConfig, $config));
        $service        = include __DIR__ . '/../../resources/service.php';
        $description    = new Description($service);
        $client         = new GuzzleClient($client, $description);

        // Inject key & convert bools to int so false doesnt get lost
        $client->getEmitter()->on('init', function (InitEvent $event) use ($apiKey) {
            $command = $event->getCommand();
            $command['_k'] = $apiKey;
            foreach ($command->toArray() as $key => $value) {
                if (is_bool($value)) {
                    $command[$key] = (int) $value;
                }
            }
        }, 'first');

        return $client;
    }

    public static function &mergeRecursive(array &$array1, &$array2 = null)
    {
        $merged = $array1;
        if (is_array($array2)) {
            foreach ($array2 as $key => $val) {
                if (is_array($array2[$key])) {
                    $merged[$key] = is_array($merged[$key]) ? self::mergeRecursive($merged[$key], $array2[$key]) : $array2[$key];
                } else {
                    $merged[$key] = $val;
                }
            }
        }
        return $merged;
    }
}
