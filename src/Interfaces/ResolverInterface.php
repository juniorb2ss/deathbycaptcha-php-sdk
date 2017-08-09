<?php

namespace juniorb2ss\DeathByCaptcha\Interfaces;

interface ResolverInterface
{
    /**
     * Retorna o ID do captcha
     * @return int
     */
    public function captchaId(): int;

    /**
     * Captcha é considerado correto
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
