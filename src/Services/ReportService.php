<?php

namespace juniorb2ss\DeathByCaptcha\Services;

use GuzzleHttp\Psr7\Response;
use juniorb2ss\DeathByCaptcha\Abstracts\ServiceAbstract;
use juniorb2ss\DeathByCaptcha\Interfaces\ReportInterface;

class ReportService extends ServiceAbstract implements ReportInterface
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
    public function status(): int
    {
        return (int)$this->getResponseAttribute('status');
    }
}
