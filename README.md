#Germania\SwiftMailerCallable

Callable wrapper around sending emails with [SwiftMailer](http://swiftmailer.org/)


##Installation

```bash
$ composer require germania-kg/swiftmailer-callable
```


##Usage

```php
<?php
use Germania\SwiftMailerCallable\SwiftMailerCallable;

// Dependencies
$swift_mailer    = Swift_Mailer::newInstance( ... );
$message_factory = function() { return Swift_Message::newInstance( ... ); });

// Setup callable
$mailer = new SwiftMailerCallable( $swift_mailer, $message_factory );

// Prepare sending
$subject = 'My mail subject';
$body    = 'Any mail text';

// Go! - Optionally pass recipient, if not already set in factory
$sent = $mailer( $subject, $body );
$sent = $mailer( $subject, $body, ['me@test.com' => 'Joen Doe'] );
```




##Development and Testing

Develop using `develop` branch, using [Git Flow](https://github.com/nvie/gitflow).   
**Currently, no tests are specified.**

```bash
$ git clone git@github.com:GermaniaKG/SwiftMailerCallable.git swiftmailer-callable
$ cd swiftmailer-callable
$ cp phpunit.xml.dist phpunit.xml
$ phpunit
```
