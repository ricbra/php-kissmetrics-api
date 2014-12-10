## Discogs Api

[![Build Status](https://secure.travis-ci.org/ricbra/php-kissmetrics-api.png)](http://travis-ci.org/ricbra/php-kissmetrics-api)
[![Latest Stable Version](https://poser.pugx.org/ricbra/php-kissmetrics-api/v/stable.svg)](https://packagist.org/packages/ricbra/php-kissmetrics-api)
[![Total Downloads](https://poser.pugx.org/ricbra/php-kissmetrics-api/downloads.png)](https://packagist.org/packages/ricbra/php-kissmetrics-api)
[![License](https://poser.pugx.org/ricbra/php-kissmetrics-api/license.png)](https://packagist.org/packages/ricbra/php-kissmetrics-api)
[![Quality](https://scrutinizer-ci.com/g/ricbra/php-kissmetrics-api/badges/quality-score.png)](https://scrutinizer-ci.com/g/ricbra/php-kissmetrics-api/)

This library is a PHP 5.4 implementation of the [KISSmetrics API ](http://support.kissmetrics.com/apis/specifications.html)

This client is build using [Guzzle 4.0](http://guzzle.readthedocs.org/en/latest/).

## License
This library is released under the MIT license. See the complete license in the LICENSE file.

## Installation
Start by [installing composer](http://getcomposer.org/doc/01-basic-usage.md#installation).
Next do:

    $ composer require ricbra/php-kissmetrics-api

## Requirements
PHP >=5.4.0

## Usage
Creating a new instance:

```php
<?php
$client = \KISSmetrics\ClientFactory::factory('your-api-key-here', [
    'defaults' => [
        'headers' => ['User-Agent' => 'your-app-name/1.0.0 +https://yourapp.com']
    ]
]);
```

### Set user properties

```php
<?php

$client->setProperties([
    '_p' => 'Facebook #23',
    '_d' => 1,
    '_t' => 21421421,
    'Property' => 'Value'
]);

```

### Record event

```php
<?php

$client->recordEvent([
    '_p' => 'Facebook #23',
    '_n' => 'Test event',
    '_t' => 12421412,
    '_d' => 1,
    'Property' => 'Value',
]);

```

### Alias user

```php
<?php

$client->recordEvent([
    '_p' => 'Facebook #23',
    '_n' => 'Test event',
    '_t' => 12421412,
    '_d' => 1,
    'Property' => 'Value',
]);

```
