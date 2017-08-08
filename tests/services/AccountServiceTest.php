<?php

namespace juniorb2ss\DeathByCaptcha\Tests\Services;

use juniorb2ss\DeathByCaptcha\Tests\TestCase;
use juniorb2ss\DeathByCaptcha\Interfaces\DeathByCaptchaAccountInterface;

class AccountServiceTest extends TestCase
{
    protected $contentToHttpResponse = 'api/user.json';

    public function setUp()
    {
        parent::setUp();

        $this->account = $this->service->account();
    }

    public function testIsBanned()
    {
        $expected = (bool)$this->expectedReturn['is_banned'];
        $actual = $this->account->isBanned();

        $this->assertEquals($expected, $actual);
    }

    public function testGetStatus()
    {
        $expected = (bool)$this->expectedReturn['status'];
        $actual = $this->account->getStatus();

        $this->assertEquals($expected, $actual);
    }


    public function testGetRate()
    {
        $expected = (int)$this->expectedReturn['rate'];
        $actual = $this->account->getRate();

        $this->assertEquals($expected, $actual);
    }


    public function testGetBalance()
    {
        $expected = (double)$this->expectedReturn['balance'];
        $actual = $this->account->getBalance();

        $this->assertEquals($expected, $actual);
    }


    public function testGetUser()
    {
        $expected = (int)$this->expectedReturn['user'];
        $actual = $this->account->getUser();

        $this->assertEquals($expected, $actual);
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
