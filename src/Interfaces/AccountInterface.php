<?php

namespace juniorb2ss\DeathByCaptcha\Interfaces;

interface AccountInterface
{
    /**
     * Verifica se o usuário esta banido
     * do serviço
     * @return boolean
     */
    public function isBanned(): bool;

    /**
     * Retorna status do serviço
     * @return int
     */
    public function getStatus(): int;

    /**
     * Retorna a taxa de de-captcha
     * @return int
     */
    public function getRate(): int;

    /**
     * Retorna quantidade de créditos
     * que o usuário possui no serviço
     * @return float
     */
    public function getBalance(): float;

    /**
     * Retorna o ID do usuário no serviço
     * @return int
     */
    public function getUser(): int;
}
