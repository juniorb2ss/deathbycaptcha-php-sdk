<?php

namespace juniorb2ss\DeathByCaptcha\Services;

use GuzzleHttp\Psr7\Response;
use juniorb2ss\DeathByCaptcha\Abstracts\ServiceAbstract;
use juniorb2ss\DeathByCaptcha\Interfaces\StatusInterface;

class StatusService extends ServiceAbstract implements StatusInterface
{
    public function status(): int
    {
        return (int)$this->getResponseAttribute('status');
    }

    public function todaysAccuracy(): float
    {
        return (float)$this->getResponseAttribute('todays_accuracy');
    }

    public function solvedIn(): int
    {
        return (int)$this->getResponseAttribute('solved_in');
    }

    public function isServiceOverloaded(): bool
    {
        return (bool)$this->getResponseAttribute('is_service_overloaded');
    }
}
