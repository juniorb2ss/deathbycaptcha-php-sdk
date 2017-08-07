<?php

namespace juniorb2ss\DeathByCaptcha;

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Client as GuzzleClient;
use juniorb2ss\DeathByCaptcha\Services\AccountService;
use juniorb2ss\DeathByCaptcha\Services\StatusService;
use juniorb2ss\DeathByCaptcha\Interfaces\StatusInterface;
use juniorb2ss\DeathByCaptcha\Interfaces\AccountInterface;
use juniorb2ss\DeathByCaptcha\Interfaces\DeathByCaptchaInterface;
use juniorb2ss\DeathByCaptcha\Abstracts\HttpDeathByCaptchaAbstract;

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
}
