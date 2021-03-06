<?php

namespace juniorb2ss\DeathByCaptcha\Tests\Exceptions;

use Psr\Http\Message\ResponseInterface;
use juniorb2ss\DeathByCaptcha\Tests\TestCase;
use juniorb2ss\DeathByCaptcha\Interfaces\AccountInterface;
use juniorb2ss\DeathByCaptcha\Interfaces\StatusInterface;

class ExceptionsTest extends TestCase
{

    /**
     * @expectedException juniorb2ss\DeathByCaptcha\Exceptions\InvalidServiceResponseException
     */
    public function testResponseEmpty()
    {
        $service = $this->mock('');

        $service->account();
    }

    /**
     * @expectedException juniorb2ss\DeathByCaptcha\Exceptions\InvalidServiceResponseException
     */
    public function testResponseInvalidContentType()
    {
        $service = $this->mock('', function (ResponseInterface $response) {
            return $response->withHeader('Content-Type', 'any/invalid/content-type');
        });

        $service->account();
    }

    /**
     * @expectedException juniorb2ss\DeathByCaptcha\Exceptions\AccessDeniedException
     */
    public function testAccessDeniedException()
    {
        $service = $this->mock('{}', function (ResponseInterface $response) {
            return $response->withStatus(403);
        });

        $service->account();
    }

    /**
     * @expectedException juniorb2ss\DeathByCaptcha\Exceptions\CaptchaNotFoundException
     */
    public function testCaptchaNotFoundException()
    {
        $service = $this->mock('{}', function (ResponseInterface $response) {
            return $response->withStatus(404);
        });

        $service->resolve((int) 1);
    }

    /**
     * @expectedException juniorb2ss\DeathByCaptcha\Exceptions\InvalidCaptchaException
     */
    public function testInvalidCaptchaExceptionWith400()
    {
        $service = $this->mock('{}', function (ResponseInterface $response) {
            return $response->withStatus(400);
        });

        $captchaPath = dirname(__FILE__) . '/../stubs/captcha.png';

        $service->resolve((string) $captchaPath);
    }

    /**
     * @expectedException juniorb2ss\DeathByCaptcha\Exceptions\InvalidCaptchaException
     */
    public function testInvalidCaptchaExceptionWith413()
    {
        $service = $this->mock('{}', function (ResponseInterface $response) {
            return $response->withStatus(413);
        });

        $captchaPath = dirname(__FILE__) . '/../stubs/captcha.png';

        $service->resolve((string) $captchaPath);
    }

    /**
     * @expectedException juniorb2ss\DeathByCaptcha\Exceptions\InvalidCaptchaException
     */
    public function testInvalidCaptchaExceptionWith501()
    {
        $service = $this->mock('{}', function (ResponseInterface $response) {
            return $response->withStatus(501);
        });

        $captchaPath = dirname(__FILE__) . '/../stubs/captcha.png';

        $service->resolve((string) $captchaPath);
    }

    /**
     * @expectedException juniorb2ss\DeathByCaptcha\Exceptions\InternalServiceException
     */
    public function testInternalServiceException()
    {
        $service = $this->mock('{}', function (ResponseInterface $response) {
            return $response->withStatus(500);
        });

        $service->account();
    }

    /**
     * @expectedException juniorb2ss\DeathByCaptcha\Exceptions\ServiceOverloadException
     */
    public function testServiceOverloadException()
    {
        $service = $this->mock('{}', function (ResponseInterface $response) {
            return $response->withStatus(503);
        });

        $service->account();
    }
}
