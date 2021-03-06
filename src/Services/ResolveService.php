<?php

namespace juniorb2ss\DeathByCaptcha\Services;

use GuzzleHttp\Psr7\Response;
use juniorb2ss\DeathByCaptcha\Abstracts\ServiceAbstract;
use juniorb2ss\DeathByCaptcha\Interfaces\ResolveInterface;

class ResolveService extends ServiceAbstract implements ResolveInterface
{
    public function isCorrect(): bool
    {
        return (bool)$this->getResponseAttribute('is_correct');
    }

    public function text(): string
    {
        return (string)$this->getResponseAttribute('text');
    }

    public function status(): int
    {
        return (int)$this->getResponseAttribute('status');
    }

    public function captchaId(): int
    {
        return (int)$this->getResponseAttribute('captcha');
    }
}
