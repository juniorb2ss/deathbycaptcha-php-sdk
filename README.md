# DeathByCaptcha PHP SDK

[![Build Status](https://travis-ci.org/juniorb2ss/deathbycaptcha-php-sdk.svg?branch=master)](https://travis-ci.org/juniorb2ss/deathbycaptcha-php-sdk) [![Code Coverage](https://scrutinizer-ci.com/g/juniorb2ss/deathbycaptcha-php-sdk/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/juniorb2ss/deathbycaptcha-php-sdk/?branch=master) [![Laravel](https://img.shields.io/badge/Laravel-5.*-green.svg)](https://laravel.com) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/juniorb2ss/deathbycaptcha-php-sdk/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/juniorb2ss/deathbycaptcha-php-sdk/?branch=master) [![StyleCI](https://styleci.io/repos/99140491/shield?branch=master)](https://styleci.io/repos/84957945) [![Code Climate](https://codeclimate.com/github/juniorb2ss/deathbycaptcha-php-sdk/badges/gpa.svg)](https://codeclimate.com/github/juniorb2ss/deathbycaptcha-php-sdk)

## CAPTCHA Bypass done right

With Death by Captcha you can solve any CAPTCHA. All you need to do is implement our API, pass us your CAPTCHAs and we’ll return the text. It’s that easy!

Please note that our services should be used only for research projects and any illegal use of our services is strictly prohibited. Any bypass and CAPTCHA violations should be reported to  emailcom

The `juniorb2ss/deathbycaptcha-php-sdk` is a package to make Decaptcha easy!

## Install

You can install this package via composer:

``` bash
$ composer require juniorb2ss/deathbycaptcha-php-sdk~1.*
```

## Example
```php
use juniorb2ss\DeathByCaptcha\DeathByCaptcha;

// You need first register and buy credits in http://www.deathbycaptcha.com
$dtc = new DeathByCaptcha('yourUsername', 'yourPassword');

// To retrieve service status
$serviceStatus = $dtc->status();

// To get user informations
$user = $dtc->account();

echo 'My Credits: ' . $user->getBalance(); //1232.2881

// you can pass: path image, base64, image link
$captcha = $dtc->resolve('captcha.jpg');

// This is captcha ID in service, you need call resolve method with this ID seconds later.
$captchaId = $dtc->captchaId();

// make a simple loop or just sleep
// sleep(7);
$captchaText = $dtc->resolve((int) $captchaId) // return captcha text for human
```

## Tests

```bash
composer run test
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Credits

- [Carlos Eduardo](https://github.com/juniorb2ss)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.