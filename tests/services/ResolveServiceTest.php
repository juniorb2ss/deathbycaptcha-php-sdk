<?php

namespace juniorb2ss\DeathByCaptcha\Tests\Services;

use juniorb2ss\DeathByCaptcha\Interfaces\ResolverInterface;
use juniorb2ss\DeathByCaptcha\Tests\TestCase;

class ResolveServiceTest extends TestCase
{
    protected $contentToHttpResponse = 'api/captcha.json';

    public function testUploaderCaptchaWithRelativePath()
    {
        $captchaPath = dirname(__FILE__) . '/../stubs/captcha.png';

        $response = $this->service->resolver((string) $captchaPath);

        $this->assertExpectedApiResponse($response);
    }

    /**
     * @expectedException \juniorb2ss\DeathByCaptcha\Exceptions\InvalidCaptchaException
     */
    public function testUploaderBadCaptcha()
    {
        $this->service->resolver('bad image captcha');
    }

    public function assertExpectedApiResponse(ResolverInterface $response)
    {
        $this->assertEquals((int)$this->expectedReturn['status'], $response->status());
        $this->assertEquals((int)$this->expectedReturn['captcha'], $response->captchaId());
        $this->assertEquals((bool)$this->expectedReturn['is_correct'], $response->isCorrect());
    }

    public function testRetriveCaptchaResultWithId()
    {
        $id = $this->expectedReturn['captcha'];

        $response = $this->service->resolver((int) $id);

        $this->assertExpectedApiResponse($response);

        $this->assertEquals((string)$this->expectedReturn['text'], $response->text());
    }
}
