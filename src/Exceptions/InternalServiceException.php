<?php

namespace juniorb2ss\DeathByCaptcha\Exceptions;

/**
 * Exception to throw on rejected login attemts due to invalid DBC credentials,
 * low balance, or when account being banned.
 */
class InternalServiceException extends ClientException
{
    protected $message = 'Check your credentials, balance, and ensure you\'re using the API correctly.';
}
