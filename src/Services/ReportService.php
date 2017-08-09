<?php

namespace juniorb2ss\DeathByCaptcha\Services;

use GuzzleHttp\Psr7\Response;
use juniorb2ss\DeathByCaptcha\Abstracts\ServiceAbstract;
use juniorb2ss\DeathByCaptcha\Interfaces\ReportInterface;

class ReportService extends ServiceAbstract implements ReportInterface
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
}
