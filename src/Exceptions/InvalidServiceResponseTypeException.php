<?php

namespace juniorb2ss\DeathByCaptcha\Exceptions;

use juniorb2ss\DeathByCaptcha\Exceptions\ClientException;

class InvalidServiceResponseTypeException extends ClientException
{
    protected $message = 'Service request returned invalid content-type';
}
