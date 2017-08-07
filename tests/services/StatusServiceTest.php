<?php

namespace juniorb2ss\DeathByCaptcha\Tests\Services;

use juniorb2ss\DeathByCaptcha\Interfaces\DeathByCaptchaAccountInterface;
use juniorb2ss\DeathByCaptcha\Tests\TestCase;

class StatusServiceTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->expectedReturn = [
            'status' => 0,
            'todays_accuracy' => 0.97337,
            'solved_in' => 9,
            'is_service_overloaded' => false
        ];
        $service = $this->mock('api/status.json');
        $this->status = $service->status();
    }

    public function testStatus()
    {
        $this->assertEquals((bool)0, $this->status->status());
    }

    public function testTodaysAccuracy()
    {
        $this->assertEquals((float)0.97337, $this->status->todaysAccuracy());
    }

    public function testSolvedIn()
    {
        $this->assertEquals((int)9, $this->status->solvedIn());
    }


    public function testIsServiceOverloaded()
    {
        $this->assertEquals(false, $this->status->isServiceOverloaded());
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
