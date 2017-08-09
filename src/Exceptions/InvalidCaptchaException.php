<?php

namespace juniorb2ss\DeathByCaptcha\Exceptions;

use juniorb2ss\DeathByCaptcha\Exceptions\ClientException;

/**
 * Exception to throw on invalid CAPTCHA image payload: on empty images, on images too big, on non-image payloads.
 */
class InvalidCaptchaException extends ClientException
{
    protected $message = 'CAPTCHA was rejected by the service, check if it\'s a valid image';
}
