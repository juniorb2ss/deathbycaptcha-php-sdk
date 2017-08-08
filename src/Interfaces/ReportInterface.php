<?php

namespace juniorb2ss\DeathByCaptcha\Interfaces;

interface ReportInterface
{
    public function isCorrect(): bool;
    public function text(): string;
    public function status(): int;
}
