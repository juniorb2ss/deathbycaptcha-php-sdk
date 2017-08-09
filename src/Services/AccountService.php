<?php

namespace juniorb2ss\DeathByCaptcha\Services;

use GuzzleHttp\Psr7\Response;
use juniorb2ss\DeathByCaptcha\Abstracts\ServiceAbstract;
use juniorb2ss\DeathByCaptcha\Interfaces\AccountInterface;

class AccountService extends ServiceAbstract implements AccountInterface
{
    public function isBanned(): bool
    {
        return (bool)$this->getResponseAttribute('is_banned');
    }

    public function getStatus(): int
    {
        return (int)$this->getResponseAttribute('status');
    }

    public function getRate(): int
    {
        return (int)$this->getResponseAttribute('rate');
    }

    public function getBalance(): float
    {
        return (double)$this->getResponseAttribute('balance');
    }

    public function getUser(): int
    {
        return (int)$this->getResponseAttribute('user');
    }
}
