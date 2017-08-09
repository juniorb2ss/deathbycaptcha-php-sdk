<?php

namespace juniorb2ss\DeathByCaptcha\Abstracts;

use Psr\Http\Message\ResponseInterface;
use juniorb2ss\DeathByCaptcha\DeathByCaptcha;
use juniorb2ss\DeathByCaptcha\Interfaces\ServiceInterface;
use juniorb2ss\DeathByCaptcha\Exceptions\InvalidResponseAttributeException;

abstract class ServiceAbstract implements ServiceInterface
{
    public function setResponse(ResponseInterface $response)
    {
        $bodyResponse = (string)$response->getBody();

        $this->objectResponse = json_decode(rtrim($bodyResponse));

        return $this;
    }

    public function getResponse(): \StdClass
    {
        return (object)$this->objectResponse;
    }

    public function getResponseAttribute(string $attribute)
    {
        if (isset($this->objectResponse->{$attribute})) {
            return $this->objectResponse->{$attribute};
        }

        throw new InvalidResponseAttributeException;
    }

    public function toArray(): array
    {
        return (array)$this->getResponse();
    }
}
