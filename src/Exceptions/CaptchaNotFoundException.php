<?php

namespace juniorb2ss\DeathByCaptcha\Exceptions;

use juniorb2ss\DeathByCaptcha\Exceptions\ClientException;

class CaptchaNotFoundException extends ClientException
{
    protected $message = 'CAPTCHA not found in service, please submit again.';
}
