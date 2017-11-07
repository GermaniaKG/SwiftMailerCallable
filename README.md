# Germania KG · SwiftMailerCallable

**Callable wrapper around sending emails with [SwiftMailer](http://swiftmailer.org/)**

[![Build Status](https://travis-ci.org/GermaniaKG/SwiftMailerCallable.svg?branch=master)](https://travis-ci.org/GermaniaKG/SwiftMailerCallable)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/GermaniaKG/SwiftMailerCallable/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/GermaniaKG/SwiftMailerCallable/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/GermaniaKG/SwiftMailerCallable/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/GermaniaKG/SwiftMailerCallable/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/GermaniaKG/SwiftMailerCallable/badges/build.png?b=master)](https://scrutinizer-ci.com/g/GermaniaKG/SwiftMailerCallable/build-status/master)


## Installation

**This wrapper works with SwiftMailer version 5.** SwiftMailer's newer 6.0 release creates objects another way, so this wrapper will be incompatible with the newest SwiftMailer versions. The upcoming **SwiftMailerCallable 2.0** will address this.

```bash
$ composer require germania-kg/swiftmailer-callable:^1.0
```

## A Word on SwiftMailer


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
$ git clone git@github.com:GermaniaKG/SwiftMailerCallable.git swiftmailer-callable
$ cd swiftmailer-callable
$ composer install
```

## Unit tests

Either copy `phpunit.xml.dist` to `phpunit.xml` and adapt to your needs, or leave as is. 
Run [PhpUnit](https://phpunit.de/) like this:

```bash
$ vendor/bin/phpunit
```

