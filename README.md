# Germania KG · SwiftMailerCallable

**Callable wrapper around sending emails with [SwiftMailer](http://swiftmailer.org/)**

[![Packagist](https://img.shields.io/packagist/v/germania-kg/swiftmailer-callable.svg?style=flat)](https://packagist.org/packages/germania-kg/swiftmailer-callable)
[![PHP version](https://img.shields.io/packagist/php-v/germania-kg/swiftmailer-callable.svg)](https://packagist.org/packages/germania-kg/swiftmailer-callable)
[![Build Status](https://img.shields.io/travis/com/GermaniaKG/SwiftMailerCallable.svg?label=Travis%20CI)](https://travis-ci.com/GermaniaKG/SwiftMailerCallable)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/GermaniaKG/SwiftMailerCallable/badges/quality-score.png)](https://scrutinizer-ci.com/g/GermaniaKG/SwiftMailerCallable)
[![Code Coverage](https://scrutinizer-ci.com/g/GermaniaKG/SwiftMailerCallable/badges/coverage.png)](https://scrutinizer-ci.com/g/GermaniaKG/SwiftMailerCallable/)
[![Build Status](https://scrutinizer-ci.com/g/GermaniaKG/SwiftMailerCallable/badges/build.png)](https://scrutinizer-ci.com/g/GermaniaKG/SwiftMailerCallable)




## Installation

```bash
$ composer require germania-kg/swiftmailer-callable
```


## Usage

```php
<?php
use Germania\SwiftMailerCallable\SwiftMailerCallable;

// Dependencies
$swift_mailer    = Swift_Mailer::newInstance( ... );
$message_factory = function() { return Swift_Message::newInstance( ... ); });

// Setup callable, optionally with PSR-3 Logger
$mailer = new SwiftMailerCallable( $swift_mailer, $message_factory );
$mailer = new SwiftMailerCallable( $swift_mailer, $message_factory, $logger );

// PSR-3 LoggerAwareInterface
$mailer->setLogger( $logger );

// Prepare sending
$subject = 'My mail subject';
$body    = 'Any mail text';

// Go! - Optionally pass recipient, if not already set in factory
$sent = $mailer( $subject, $body );
$sent = $mailer( $subject, $body, ['me@test.com' => 'Joen Doe'] );
```

## Issues

See [issues list.][i0]

[i0]: https://github.com/GermaniaKG/SwiftMailerCallable/issues



## Development

```bash
$ git clone https://github.com/GermaniaKG/SwiftMailerCallable.git
$ cd SwiftMailerCallable
$ composer install
```

## Unit tests

Either copy `phpunit.xml.dist` to `phpunit.xml` and adapt to your needs, or leave as is. Run [PhpUnit](https://phpunit.de/) test or composer scripts like this:

```bash
$ composer test
# or
$ vendor/bin/phpunit
```


