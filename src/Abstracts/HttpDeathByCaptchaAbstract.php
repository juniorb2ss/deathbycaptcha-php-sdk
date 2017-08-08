<?php

namespace juniorb2ss\DeathByCaptcha\Abstracts;

use GuzzleHttp\Psr7\Response;
use juniorb2ss\DeathByCaptcha\DeathByCaptcha;
use juniorb2ss\DeathByCaptcha\Interfaces\HttpClientInterface;
use juniorb2ss\DeathByCaptcha\Exceptions\InvalidServiceResponseTypeException;

abstract class HttpDeathByCaptchaAbstract implements HttpClientInterface
{
    /**
     * [$headers description]
     * @var [type]
     */
    protected $headers = [
        'Accept' => 'application/json',
        'Expect' => '',
        'User-Agent' => DeathByCaptcha::API_VERSION
    ];

    /**
     * [get description]
     * @param  string $path    [description]
     * @param  array  $query   [description]
     * @param  array  $headers [description]
     * @return [type]          [description]
     */
    protected function get(string $path, array $query = [], array $headers = []): Response
    {
        $query = $this->getQueryForClientRequest($query);
        $headers = $this->getHeadersForClientRequest($headers);

        $options = array_merge(['query' => $query], $this->getClientOptions($headers));

        $response = $this->client->get(static::API_URL . $path, $options);
        $responseContentType = $response->getHeaderLine('Content-Type');

        if ($responseContentType !== 'application/json') {
            throw new InvalidServiceResponseTypeException;
        }

        return $response;
    }

    protected function post(string $path, array $query = [], array $headers = []): Response
    {
        $query = $this->getQueryForClientRequest($query);
        $headers = $this->getHeadersForClientRequest($headers);

        $options = array_merge(['form_params' => $query], $this->getClientOptions($headers));
        $response = $this->client->request('POST', static::API_URL . $path, $options);
        $responseContentType = $response->getHeaderLine('Content-Type');

        if ($responseContentType !== 'application/json') {
            throw new InvalidServiceResponseTypeException;
        }

        return $response;
    }

    /**
     * [getHeadersForClientRequest description]
     * @param  array  $headers [description]
     * @return [type]          [description]
     */
    public function getHeadersForClientRequest(array $headers = []): array
    {
        $headers = array_merge($headers, $this->headers);

        return $headers;
    }

    /**
     * [getQueryForClientRequest description]
     * @param  array  $query [description]
     * @return [type]        [description]
     */
    protected function getQueryForClientRequest(array $query = []): array
    {
        $auth = $this->getAuthData();
        $query = array_merge($query, $auth);

        return $query;
    }

    /**
     * [getAuthData description]
     * @return [type] [description]
     */
    protected function getAuthData()
    {
        return [
            'username' => $this->username,
            'password' => $this->password
        ];
    }

    /**
     * [getClientOptions description]
     * @param  array   $headers [description]
     * @param  boolean $referer [description]
     * @return [type]           [description]
     */
    protected function getClientOptions(array $headers, $referer = false): array
    {
        return [
            'allow_redirects' => [
                'referer' => $referer
            ],
            'timeout' => DeathByCaptcha::DEFAULT_TIMEOUT,
            'connect_timeout' => (DeathByCaptcha::DEFAULT_TIMEOUT / 4),
            'headers' => $headers
        ];
    }

    /**
     * [callAccountApi description]
     * @return [type] [description]
     */
    public function accountRequest(): Response
    {
        $response = $this->get('user');

        return $response;
    }

    /**
     * [callStatusApi description]
     * @return [type] [description]
     */
    public function statusRequest(): Response
    {
        $response = $this->get('status');

        return $response;
    }

    /**
     * [statusRequest description]
     * @return [type] [description]
     */
    public function captchAsIncorrect(int $id): Response
    {
        $response = $this->post("captcha/{$id}/report");

        return $response;
    }

    /**
     * [retrieveCaptcha description]
     * @param  int    $id [description]
     * @return [type]     [description]
     */
    public function retrieveCaptcha(int $id): Response
    {
        $response = $this->get("captcha/{$id}");

        return $response;
    }

    /**
     * [uploadCaptcha description]
     * @param  [type] $imageBase64 [description]
     * @return [type]              [description]
     */
    public function uploadCaptcha($imageBase64): Response
    {
        $response = $this->post('captcha', [
            'captchafile' => $imageBase64
        ]);

        return $response;
    }
}
