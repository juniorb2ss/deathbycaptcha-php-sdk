<?php

namespace juniorb2ss\DeathByCaptcha\Tests\Services;

use juniorb2ss\DeathByCaptcha\Interfaces\ReportInterface;
use juniorb2ss\DeathByCaptcha\Tests\TestCase;

class ReportServiceTest extends TestCase
{
    protected $contentToHttpResponse = 'api/report.json';

    public function testMarkIncorrectCaptcha()
    {
        $id = $this->expectedReturn['captcha'];

        $response = $this->service->report($id);

        $isCorrect = $response->isCorrect();

        $this->assertEquals((bool)$this->expectedReturn['is_correct'], $isCorrect);
        $this->assertEquals((string)$this->expectedReturn['text'], $response->text());
        $this->assertEquals((string)$this->expectedReturn['status'], $response->status());
    }
}
