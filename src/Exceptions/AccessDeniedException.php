<?php

namespace juniorb2ss\DeathByCaptcha\Exceptions;

/**
 * Exception to throw on rejected login attemts due to invalid DBC credentials,
 * low balance, or when account being banned.
 */
class AccessDeniedException extends ClientException
{
    protected $message = 'Access denied, check your credentials and/or balance';
}
