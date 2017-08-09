<?php

namespace juniorb2ss\DeathByCaptcha\Exceptions;

use juniorb2ss\DeathByCaptcha\Exceptions\ClientException;

class ServiceOverloadException extends ClientException
{
    protected $message = 'CAPTCHA was rejected due to service overload, try again later';
}
