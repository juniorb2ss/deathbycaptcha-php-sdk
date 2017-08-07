<?php

namespace juniorb2ss\DeathByCaptcha\Interfaces;

use juniorb2ss\DeathByCaptcha\Interfaces\StatusInterface;
use juniorb2ss\DeathByCaptcha\Interfaces\AccountInterface;

interface DeathByCaptchaInterface
{
    public function account(): AccountInterface;
    public function status(): StatusInterface;
}
