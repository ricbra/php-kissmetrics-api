<?php
/*
 * This file is part of the php-kissmetrics-api.
 *
 * (c) Richard van den Brand <richard@vandenbrand.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KISSmetrics\Test;

use GuzzleHttp\Subscriber\History;
use GuzzleHttp\Subscriber\Mock;
use KISSmetrics\ClientFactory;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    public function testRecordEvent()
    {
        $history = new History();
        $client = $this->createClient($history);
        $client->recordEvent([
            '_p' => 'Facebook #23',
            '_n' => 'Test event'
        ]);
        $this->assertSame(
            'http://trk.kissmetrics.com/e?_k=123&_p=Facebook%20%2323&_n=Test%20event',
            $history->getLastRequest()->getUrl()
        );
        $this->assertSame('GET', $history->getLastRequest()->getMethod());

        $client = $this->createClient($history);
        $client->recordEvent([
            '_p' => 'Facebook #23',
            '_n' => 'Test event',
            '_t' => 12421412,
            '_d' => 0,
            'Beroep' => 'Huisarts',
            'Test' => 'App'
        ]);

        $this->assertSame(
            'http://trk.kissmetrics.com/e?_k=123&_p=Facebook%20%2323&_n=Test%20event&_t=12421412&_d=0&Beroep=Huisarts&Test=App',
            $history->getLastRequest()->getUrl()
        );
        $this->assertSame('GET', $history->getLastRequest()->getMethod());
    }

    public function testSetProperties()
    {
        $history = new History();
        $client = $this->createClient($history);
        $client->setProperties([
            '_p' => 'Facebook #23',
            'Hi' => 'There'
        ]);
        $this->assertSame(
            'http://trk.kissmetrics.com/s?_k=123&_p=Facebook%20%2323&Hi=There',
            $history->getLastRequest()->getUrl()
        );
        $this->assertSame('GET', $history->getLastRequest()->getMethod());

        $client = $this->createClient($history);
        $client->setProperties([
            '_p' => 'Facebook #23',
            '_d' => 1,
            '_t' => 21421421,
            'Hi' => 'There'
        ]);
        $this->assertSame(
            'http://trk.kissmetrics.com/s?_k=123&_p=Facebook%20%2323&_t=21421421&_d=1&Hi=There',
            $history->getLastRequest()->getUrl()
        );
        $this->assertSame('GET', $history->getLastRequest()->getMethod());
    }

    public function testAliasUser()
    {
        $history = new History();
        $client = $this->createClient($history);
        $client->aliasUser([
            '_p' => 'Facebook #23',
            '_n' => 'MSN 12'
        ]);
        $this->assertSame(
            'http://trk.kissmetrics.com/a?_k=123&_p=Facebook%20%2323&_n=MSN%2012',
            $history->getLastRequest()->getUrl()
        );
        $this->assertSame('GET', $history->getLastRequest()->getMethod());
    }

    protected function createClient(History $history)
    {
        $path = sprintf('%s/../../fixtures/store_event', __DIR__);
        $client = ClientFactory::factory('123', []);
        $httpClient = $client->getHttpClient();
        $mock = new Mock([
            $path
        ]);
        $httpClient->getEmitter()->attach($mock);
        $httpClient->getEmitter()->attach($history);

        return $client;
    }
} 
