<?php

namespace juniorb2ss\DeathByCaptcha\Interfaces;

interface StatusInterface
{
    public function status(): bool;
    public function todaysAccuracy(): float;
    public function solvedIn(): int;
    public function isServiceOverloaded(): bool;
}
