<?php

namespace juniorb2ss\DeathByCaptcha\Interfaces;

use Psr\Http\Message\ResponseInterface;

interface ClientInterface
{
    /**
     * Efetua requisição no serviço
     * que retorna dados da conta do usuário
     * @return ResponseInterface
     */
    public function accountRequest(): ResponseInterface;

    /**
     * Retorna status do serviço
     * @return ResponseInterface
     */
    public function statusRequest(): ResponseInterface;

    /**
     * Efetua requisição do serviço marcando
     * o captcha como inválido
     * @param  int    $id captcha_id
     * @return ResponseInterface
     */
    public function captchAsIncorrect(int $id): ResponseInterface;
}
