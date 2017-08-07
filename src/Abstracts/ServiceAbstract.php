<?php

namespace juniorb2ss\DeathByCaptcha\Abstracts;

use GuzzleHttp\Psr7\Response;
use juniorb2ss\DeathByCaptcha\DeathByCaptcha;
use juniorb2ss\DeathByCaptcha\Interfaces\ServiceInterface;
use juniorb2ss\DeathByCaptcha\Exceptions\InvalidResponseAttributeException;

abstract class ServiceAbstract implements ServiceInterface
{
    /**
     * [setResponse description]
     * @param Response $response [description]
     */
    public function setResponse(Response $response)
    {
        $bodyResponse = (string)$response->getBody();

        $this->objectResponse = json_decode(rtrim($bodyResponse));

        return $this;
    }

    /**
     * [getResponse description]
     * @param  [type] $attribute [description]
     * @return [type]            [description]
     */
    public function getResponse(): \Stdclass
    {
        return (object)$this->objectResponse;
    }

    /**
     * [getResponseAttribute description]
     * @param  [type] $attribute [description]
     * @return [type]            [description]
     */
    public function getResponseAttribute($attribute)
    {
        if (isset($this->objectResponse->{$attribute})) {
            return $this->objectResponse->{$attribute};
        }

        throw new InvalidResponseAttributeException;
    }

    /**
     * [toArray description]
     * @return [type] [description]
     */
    public function toArray(): array
    {
        return (array)$this->getResponse();
    }
}
