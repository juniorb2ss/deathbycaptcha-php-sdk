<?php

namespace juniorb2ss\DeathByCaptcha\Tests;

use Psr\Http\Message\ResponseInterface;
use juniorb2ss\DeathByCaptcha\Tests\TestCase;
use juniorb2ss\DeathByCaptcha\Interfaces\AccountInterface;
use juniorb2ss\DeathByCaptcha\Interfaces\StatusInterface;

class DeathByCaptchaTest extends TestCase
{
    /**
     * @expectedException juniorb2ss\DeathByCaptcha\Exceptions\InvalidServiceResponseTypeException
     */
    public function testInvalidResponseContentType()
    {
        $client = $this->mock('', function (ResponseInterface $response) {
            return $response->withHeader('Content-Type', 'any/invalid/content-type');
        });

        $client->account();
    }
}
