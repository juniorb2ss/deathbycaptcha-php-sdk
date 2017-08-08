<?php

namespace juniorb2ss\DeathByCaptcha\Services;

use GuzzleHttp\Psr7\Response;
use juniorb2ss\DeathByCaptcha\Abstracts\ServiceAbstract;
use juniorb2ss\DeathByCaptcha\Interfaces\ResolverInterface;

class ResolverService extends ServiceAbstract implements ResolverInterface
{
    /**
     * [isCorrect description]
     * @return boolean [description]
     */
    public function isCorrect(): bool
    {
        return (bool)$this->getResponseAttribute('is_correct');
    }

    /**
     * [text description]
     * @return [type] [description]
     */
    public function text(): string
    {
        return (string)$this->getResponseAttribute('text');
    }

    /**
     * [status description]
     * @return [type] [description]
     */
    public function status(): bool
    {
        return (bool)$this->getResponseAttribute('status');
    }

    /**
     * [captchaId description]
     * @return [type] [description]
     */
    public function captchaId(): int
    {
        return (int)$this->getResponseAttribute('captcha');
    }
}
