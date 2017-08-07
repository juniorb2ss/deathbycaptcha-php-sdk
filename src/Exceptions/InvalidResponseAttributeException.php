<?php

namespace juniorb2ss\DeathByCaptcha\Exceptions;

class InvalidResponseAttributeException extends ClientException
{
    protected $message = 'Attribute not exists in response payload.';
}
