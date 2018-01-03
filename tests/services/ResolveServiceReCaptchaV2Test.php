<?php

namespace juniorb2ss\DeathByCaptcha\Tests\Services;

use juniorb2ss\DeathByCaptcha\Interfaces\ResolverInterface;
use juniorb2ss\DeathByCaptcha\Tests\TestCase;

class ResolveServiceReCaptchaV2Test extends TestCase
{
    protected $contentToHttpResponse = 'api/reCaptch-v2/captcha.json';

    public function testReCaptchaV2WithRelativePath()
    {
        $sitekey = 'randomstring';
        $url = 'random-url';

        $response = $this->service->resolverV2($sitekey, $url);

        $this->assertExpectedApiResponse($response);
    }

    public function assertExpectedApiResponse(ResolverInterface $response)
    {
        $this->assertEquals((int)$this->expectedReturn['status'], $response->status());
        $this->assertEquals((int)$this->expectedReturn['captcha'], $response->captchaId());
        $this->assertEquals((bool)$this->expectedReturn['is_correct'], $response->isCorrect());
    }

    public function testReCaptchaV2RetriveCaptchaResultWithId()
    {
        $id = $this->expectedReturn['captcha'];

        $response = $this->service->resolverV2((int) $id);

        $this->assertExpectedApiResponse($response);

        $this->assertEquals((string)$this->expectedReturn['text'], $response->text());
    }
}
