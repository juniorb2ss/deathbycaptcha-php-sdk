<?php

namespace juniorb2ss\DeathByCaptcha\Tests\Services;

use juniorb2ss\DeathByCaptcha\Interfaces\DeathByCaptchaAccountInterface;
use juniorb2ss\DeathByCaptcha\Tests\TestCase;

class StatusServiceTest extends TestCase
{
    protected $contentToHttpResponse = 'api/status.json';

    public function setUp()
    {
        parent::setUp();

        $this->status = $this->service->status();
    }

    public function testStatus()
    {
        $expected = (int)$this->expectedReturn['status'];
        $actual = $this->status->status();

        $this->assertEquals($expected, $actual);
    }

    public function testTodaysAccuracy()
    {
        $expected = (float)$this->expectedReturn['todays_accuracy'];
        $actual = $this->status->todaysAccuracy();

        $this->assertEquals($expected, $actual);
    }

    public function testSolvedIn()
    {
        $expected = (int)$this->expectedReturn['solved_in'];
        $actual = $this->status->solvedIn();

        $this->assertEquals($expected, $actual);
    }


    public function testIsServiceOverloaded()
    {
        $expected = (bool)$this->expectedReturn['is_service_overloaded'];
        $actual = $this->status->isServiceOverloaded();

        $this->assertEquals($expected, $actual);
    }

    public function testStatusToArray()
    {
        $this->assertEquals($this->expectedReturn, $this->status->toArray());
    }

    /**
     * [testGet description]
     * @return [type] [description]
     */
    public function testGetObjectResponse()
    {
        $this->assertEquals((object)$this->expectedReturn, $this->status->getResponse());
    }
}
