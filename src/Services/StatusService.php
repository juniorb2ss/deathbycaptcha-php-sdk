<?php

namespace juniorb2ss\DeathByCaptcha\Services;

use GuzzleHttp\Psr7\Response;
use juniorb2ss\DeathByCaptcha\Abstracts\ServiceAbstract;
use juniorb2ss\DeathByCaptcha\Interfaces\StatusInterface;

class StatusService extends ServiceAbstract implements StatusInterface
{
    /**
     * [status description]
     * @return [type] [description]
     */
    public function status(): bool
    {
        return (bool)$this->getResponseAttribute('status');
    }

    /**
     * [todaysAccuracy description]
     * @return [type] [description]
     */
    public function todaysAccuracy(): float
    {
        return (float)$this->getResponseAttribute('todays_accuracy');
    }

    /**
     * [solvedIn description]
     * @return [type] [description]
     */
    public function solvedIn(): int
    {
        return (int)$this->getResponseAttribute('solved_in');
    }

    /**
     * [isServiceOverloaded description]
     * @return boolean [description]
     */
    public function isServiceOverloaded(): bool
    {
        return (bool)$this->getResponseAttribute('is_service_overloaded');
    }
}
