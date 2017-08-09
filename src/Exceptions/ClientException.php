<?php

namespace juniorb2ss\DeathByCaptcha\Exceptions;

use juniorb2ss\DeathByCaptcha\Exceptions\DeathByCaptchaException;

/**
 * Generic exception to throw on API client errors.
 */
class ClientException extends DeathByCaptchaException
{
    public function __construct($message = null, $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
