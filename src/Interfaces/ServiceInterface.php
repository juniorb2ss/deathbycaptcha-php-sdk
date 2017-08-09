<?php

namespace juniorb2ss\DeathByCaptcha\Interfaces;

use Psr\Http\Message\ResponseInterface;

interface ServiceInterface
{
    /**
     * Efetua o decode da resposta do serviço
     * @param self $response
     */
    public function setResponse(ResponseInterface $response);

    /**
     * Retorna o resultado da requisição
     * em modo array
     * @return array
     */
    public function toArray(): array;

    /**
     * Retorna resposta da requisição
     * em modo de objeto
     * @return StdClass
     */
    public function getResponse(): \StdClass;

    /**
     * Retorna atributo da resposta da requisição.
     * @param  string $attribute
     * @return mix
     */
    public function getResponseAttribute(string $attribute);
}
