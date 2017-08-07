<?php

namespace juniorb2ss\DeathByCaptcha\Interfaces;

interface AccountInterface
{
    public function isBanned(): bool;
    public function getStatus(): int;
    public function getRate(): int;
    public function getBalance(): float;
    public function getUser(): int;
}
