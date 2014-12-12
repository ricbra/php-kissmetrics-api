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

use KISSmetrics\ClientFactory;

class ClientFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testFactory()
    {
        $client = ClientFactory::factory('123', []);
        $default = ['User-Agent' => 'php-kissmetrics-api/1.0.0 +https://github.com/ricbra/php-kissmetrics-api'];
        $this->assertSame($default, $client->getHttpClient()->getDefaultOption('headers'));
    }

    public function testFactoryWithCustomUserAgent()
    {
        $client = ClientFactory::factory('123', [
            'defaults' => [
                'headers' => ['User-Agent' => 'test']
            ]
        ]);
        $default = ['User-Agent' => 'test'];
        $this->assertSame($default, $client->getHttpClient()->getDefaultOption('headers'));
    }
} 
