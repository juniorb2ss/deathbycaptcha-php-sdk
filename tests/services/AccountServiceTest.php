<?php

namespace juniorb2ss\DeathByCaptcha\Tests\Services;

use juniorb2ss\DeathByCaptcha\Tests\TestCase;
use juniorb2ss\DeathByCaptcha\Interfaces\DeathByCaptchaAccountInterface;

class AccountServiceTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $service = $this->mock('api/user.json');
        $this->expectedReturn = [
            'is_banned' => false,
            'status' => 0,
            'rate' => 0.139,
            'balance' => 1232.2881,
            'user' => 279449
        ];
        $this->account = $service->account();
    }

    public function testIsBanned()
    {
        $this->assertEquals((bool)0, $this->account->isBanned());
    }

    public function testGetStatus()
    {
        $this->assertEquals((bool)0, $this->account->getStatus());
    }


    public function testGetRate()
    {
        $this->assertEquals((int)0.139, $this->account->getRate());
    }


    public function testGetBalance()
    {
        $this->assertEquals((double)1232.2881, $this->account->getBalance());
    }


    public function testGetUser()
    {
        $this->assertEquals((int)279449, $this->account->getUser());
    }

    public function testGetToArray()
    {
        $this->assertEquals($this->expectedReturn, $this->account->toArray());
    }

    public function testGetObjectResponse()
    {
        $this->assertEquals((object)$this->expectedReturn, $this->account->getResponse());
    }

    /**
     * @expectedException \juniorb2ss\DeathByCaptcha\Exceptions\InvalidResponseAttributeException
     */
    public function testGetInvalidAttributeResponse()
    {
        $this->account->getResponseAttribute('any-attribute');
    }
}
