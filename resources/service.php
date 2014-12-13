<?php
/*
 * This file is part of the php-kissmetrics-api.
 *
 * (c) Richard van den Brand <richard@vandenbrand.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [
    'baseUrl' => 'http://trk.kissmetrics.com/',
    'operations' => [
        'recordEvent' => [
            'httpMethod' => 'GET',
            'uri' => 'e',
            'responseModel' => 'GetResponse',
            'parameters' => [
                '_k' => [
                    'type' => 'string',
                    'location' => 'query',
                    'required' => true
                ],
                '_p' => [
                    'type' => 'string',
                    'location' => 'query',
                    'required' => true
                ],
                '_n' => [
                    'type' => 'string',
                    'location' => 'query',
                    'required' => true
                ],
                '_t' => [
                    'type' => 'integer',
                    'location' => 'query',
                    'required' => false
                ],
                '_d' => [
                    'type' => 'integer',
                    'location' => 'query',
                    'required' => false
                ]
            ],
            "additionalParameters" => [
                "location" => "query"
            ]
        ],
        'setProperties' => [
            'httpMethod' => 'GET',
            'uri' => 's',
            'responseModel' => 'GetResponse',
            'parameters' => [
                '_k' => [
                    'type' => 'string',
                    'location' => 'query',
                    'required' => true
                ],
                '_p' => [
                    'type' => 'string',
                    'location' => 'query',
                    'required' => true
                ],
                '_t' => [
                    'type' => 'integer',
                    'location' => 'query',
                    'required' => false
                ],
                '_d' => [
                    'type' => 'integer',
                    'location' => 'query',
                    'required' => false
                ]
            ],
            "additionalParameters" => [
                "location" => "query"
            ]
        ],
        'aliasUser' => [
            'httpMethod' => 'GET',
            'uri' => 'a',
            'responseModel' => 'GetResponse',
            'parameters' => [
                '_k' => [
                    'type' => 'string',
                    'location' => 'query',
                    'required' => true
                ],
                '_p' => [
                    'type' => 'string',
                    'location' => 'query',
                    'required' => true
                ],
                '_n' => [
                    'type' => 'string',
                    'location' => 'query',
                    'required' => true
                ],
            ],
        ],
    ],
    'models' => [
        'GetResponse' => [
            'type' => 'object',
            'properties' => [
                'image' => [
                    'location' => 'body',
                    'type' => 'string'
                ]
            ],
        ],

    ]
];
