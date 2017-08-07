<?php

namespace juniorb2ss\DeathByCaptcha\Services;

use GuzzleHttp\Psr7\Response;
use juniorb2ss\DeathByCaptcha\Abstracts\ServiceAbstract;
use juniorb2ss\DeathByCaptcha\Interfaces\AccountInterface;

class AccountService extends ServiceAbstract implements AccountInterface
{
    /**
     * [isBanned description]
     * @return boolean [description]
     */
    public function isBanned(): bool
    {
        return (bool)$this->getResponseAttribute('is_banned');
    }

    /**
     * [getStatus description]
     * @return [type] [description]
     */
    public function getStatus(): int
    {
        return (int)$this->getResponseAttribute('status');
    }

    /**
     * [getRate description]
     * @return [type] [description]
     */
    public function getRate(): int
    {
        return (int)$this->getResponseAttribute('rate');
    }

    /**
     * [getBalance description]
     * @return [type] [description]
     */
    public function getBalance(): float
    {
        return (double)$this->getResponseAttribute('balance');
    }

    /**
     * [getUser description]
     * @return [type] [description]
     */
    public function getUser(): int
    {
        return (int)$this->getResponseAttribute('user');
    }
}
