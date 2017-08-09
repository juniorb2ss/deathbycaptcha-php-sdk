<?php

namespace juniorb2ss\DeathByCaptcha\Interfaces;

interface ReportInterface
{
    /**
     * Retorna se o captcha foi considerado
     * correto no serviço
     * @return boolean
     */
    public function isCorrect(): bool;

    /**
     * Retorna o texto do captcha resolvido
     * @return string
     */
    public function text(): string;

    /**
     * Retorna o status do serviço
     * @return int
     */
    public function status(): int;
}
