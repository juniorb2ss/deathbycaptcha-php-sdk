<?php

namespace juniorb2ss\DeathByCaptcha\Interfaces;

use GuzzleHttp\Psr7\Response;

interface ServiceInterface
{
    public function setResponse(Response $response);
    public function toArray(): array;
    public function getResponse(): \Stdclass;
    public function getResponseAttribute($attribute);
}
