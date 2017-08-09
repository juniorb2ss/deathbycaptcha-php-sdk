<?php

namespace juniorb2ss\DeathByCaptcha;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Response;
use juniorb2ss\DeathByCaptcha\Abstracts\HttpDeathByCaptchaAbstract;
use juniorb2ss\DeathByCaptcha\Interfaces\AccountInterface;
use juniorb2ss\DeathByCaptcha\Interfaces\DeathByCaptchaInterface;
use juniorb2ss\DeathByCaptcha\Interfaces\ReportInterface;
use juniorb2ss\DeathByCaptcha\Interfaces\ResolverInterface;
use juniorb2ss\DeathByCaptcha\Interfaces\StatusInterface;
use juniorb2ss\DeathByCaptcha\Services\AccountService;
use juniorb2ss\DeathByCaptcha\Services\ImageService;
use juniorb2ss\DeathByCaptcha\Services\ReportService;
use juniorb2ss\DeathByCaptcha\Services\ResolverService;
use juniorb2ss\DeathByCaptcha\Services\StatusService;

class DeathByCaptcha extends HttpDeathByCaptchaAbstract implements DeathByCaptchaInterface
{
    /**
     * URL do serviço
     */
    const API_URL = 'http://api.dbcapi.me/api/';

    /**
     * API Version
     */
    const API_VERSION = 'DBC/PHP v5';

    /**
     * Request DEFAULT TIMEOUT
     */
    const DEFAULT_TIMEOUT = 60;

    /**
     * @param string                $username
     * @param string                $password
     * @param ClientInterface|null  $client
     * @param AccountInterface|null $account
     * @param StatusInterface|null  $status
     */
    public function __construct(
        string $username,
        string $password
    ) {
        $this->username = $username;
        $this->password = $password;

        $this->client = new GuzzleClient;
        $this->account = new AccountService;
        $this->status = new StatusService;
        $this->report = new ReportService;
        $this->resolver = new ResolverService;
    }

    public function setHttpClient(ClientInterface $client)
    {
        $this->client = $client;

        return $this;
    }

    public function account(): AccountInterface
    {
        $response = $this->accountRequest();

        return $this->account
                    ->setResponse($response);
    }

    public function status(): StatusInterface
    {
        $response = $this->statusRequest();

        return $this->status
                    ->setResponse($response);
    }

    public function report(int $id): ReportInterface
    {
        $response = $this->captchAsIncorrect($id);

        return $this->report
                    ->setResponse($response);
    }

    public function resolver($captcha): ResolverInterface
    {
        // If passed captcha id, retrieve captcha text
        if (is_int($captcha)) {
            $response = $this->retrieveCaptcha($captcha);
        } else {
            $image = ImageService::base64From($captcha);

            $response = $this->uploadCaptcha($image);
        }

        return $this->resolver
                    ->setResponse($response);
    }
}
