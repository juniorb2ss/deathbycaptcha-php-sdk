<?php

namespace juniorb2ss\DeathByCaptcha\Interfaces;

interface StatusInterface
{
    /**
     * Retorna o status do serviço
     * @return int
     */
    public function status(): int;

    /**
     * Retorna o total de ocorrências no dia
     * @return float
     */
    public function todaysAccuracy(): float;

    /**
     * Retorna o valor do tempo de demora para o
     * captcha ser resolvido
     * @return int
     */
    public function solvedIn(): int;

    /**
     * Retorna se o serviço esta sobrecarregado.
     * @return boolean
     */
    public function isServiceOverloaded(): bool;
}
