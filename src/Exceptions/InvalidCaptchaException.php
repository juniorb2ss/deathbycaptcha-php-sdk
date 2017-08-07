<?php

namespace juniorb2ss\DeathByCaptcha\Exceptions;

/**
 * Exception to throw on invalid CAPTCHA image payload: on empty images, on images too big, on non-image payloads.
 *
 * @package DBCAPI
 * @subpackage PHP
 */
class InvalidCaptchaException extends ClientException
{
}
