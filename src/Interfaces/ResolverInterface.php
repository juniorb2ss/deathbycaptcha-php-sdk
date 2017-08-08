<?php

namespace juniorb2ss\DeathByCaptcha\Interfaces;

interface ResolverInterface
{
    public function captchaId(): int;
    public function isCorrect(): bool;
    public function text(): string;
    public function status(): bool;
}
