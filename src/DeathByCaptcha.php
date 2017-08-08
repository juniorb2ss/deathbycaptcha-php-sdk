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
     *
     */
    const API_URL = 'http://api.dbcapi.me/api/';

    /**
     *
     */
    const API_VERSION = 'DBC/PHP v5';

    /**
     *
     */
    const DEFAULT_TIMEOUT = 60;

    /**
     * [__construct description]
     * @param string                $username [description]
     * @param string                $password [description]
     * @param ClientInterface|null  $client   [description]
     * @param AccountInterface|null $account  [description]
     * @param StatusInterface|null  $status   [description]
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

    /**
     * [account description]
     * @return [type] [description]
     */
    public function account(): AccountInterface
    {
        $response = $this->accountRequest();

        return $this->account
                    ->setResponse($response);
    }

    /**
     * [status description]
     * @return [type] [description]
     */
    public function status(): StatusInterface
    {
        $response = $this->statusRequest();

        return $this->status
                    ->setResponse($response);
    }

    /**
     * [report description]
     * @return [type] [description]
     */
    public function report(int $id): ReportInterface
    {
        $response = $this->captchAsIncorrect($id);

        return $this->report
                    ->setResponse($response);
    }

    /**
     * [resolver description]
     * @param  [type] $mix [description]
     * @return [type]      [description]
     */
    public function resolver($mix): ResolverInterface
    {
        // If passed captcha id, retrieve captcha text
        if (is_int($mix)) {
            $response = $this->retrieveCaptcha($mix);
        } else {
            $image = ImageService::base64From($mix);

            $response = $this->uploadCaptcha($image);
        }

        return $this->resolver
                    ->setResponse($response);
    }
}
