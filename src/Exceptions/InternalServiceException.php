<?php

namespace juniorb2ss\DeathByCaptcha\Exceptions;

/**
 * Exception to throw on rejected login attemts due to invalid DBC credentials,
 * low balance, or when account being banned.
 */
class InternalServiceException extends ClientException
{
    protected $message = 'Unable to complete request. Check your account credentials, balance, and ensure you\'re using the API correctly. If you\'re receiving this message on our API, please check in our website for Updates notices. If this problem persists, please contact support at help@deathbycaptcha.eu';
}
