<?php

namespace juniorb2ss\DeathByCaptcha\Abstracts;

use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\GuzzleException;
use juniorb2ss\DeathByCaptcha\DeathByCaptcha;
use juniorb2ss\DeathByCaptcha\Exceptions\ClientException;
use juniorb2ss\DeathByCaptcha\Interfaces\ClientInterface;
use juniorb2ss\DeathByCaptcha\Abstracts\HttpHandlerResponseAbstract;

abstract class HttpDeathByCaptchaAbstract extends HttpHandlerResponseAbstract implements ClientInterface
{
    /**
     * Headers por padrão para requisição HTTP
     * @var array
     */
    protected $defaultHeaders = [
        'Accept' => 'application/json',
        'Expect' => '',
        'User-Agent' => DeathByCaptcha::API_VERSION
    ];

    /**
     * Create and send an HTTP request.
     *
     * Use an absolute path to override the base path of the client, or a
     * relative path to append to the base path of the client. The URL can
     * contain the query string as well.
     *
     * @param string              $method  HTTP method.
     * @param string|UriInterface $uri     URI object or string.
     * @param array               $options Request options to apply.
     *
     * @return ResponseInterface
     * @throws GuzzleException
     */
    protected function request($method, $uri, array $options = []): ResponseInterface
    {
        // Handler request to client
        $this->response = $this->client->request($method, $uri, $options);

        // Handler response to check HTTP code erros
        // and content-type and content body
        // Make sure everything is correct before proceeding.
        $this->handlerHttpResponseIsOk();

        // all is ok!
        return $this->response;
    }

    /**
     * Efetua requisição GET no client
     * @param  string $path
     * @param  array  $query
     * @param  array  $headers
     * @return ResponseInterface
     */
    protected function get(string $path, array $query = [], array $headers = []): ResponseInterface
    {
        $query = $this->getQueryForClientRequest($query);
        $headers = $this->getHeadersForClientRequest($headers);

        $options = array_merge(['query' => $query], $this->getClientOptions($headers));

        $response = $this->request('GET', static::API_URL . $path, $options);

        return $response;
    }

    /**
     * Efetua requisição POST no client
     * @param  string $path
     * @param  array  $query
     * @param  array  $headers
     * @return ResponseInterface
     */
    protected function post(string $path, array $query = [], array $headers = []): ResponseInterface
    {
        $query = $this->getQueryForClientRequest($query);
        $headers = $this->getHeadersForClientRequest($headers);

        $options = array_merge(['form_params' => $query], $this->getClientOptions($headers));
        $response = $this->request('POST', static::API_URL . $path, $options);

        return $response;
    }

    /**
     * Retorna os headers que serão utilizados
     * nas requisições no cliente
     * @param  array  $headers
     * @return array  $headers
     */
    protected function getHeadersForClientRequest(array $headers = []): array
    {
        $headers = array_merge($headers, $this->defaultHeaders);

        return $headers;
    }

    /**
     * Retorna array de dados que serão utilizados
     * nas requisições no cliente
     * @param  array  $query
     * @return array  $query
     */
    protected function getQueryForClientRequest(array $query = []): array
    {
        $auth = $this->getAuthData();
        $query = array_merge($query, $auth);

        return $query;
    }

    /**
     * Retorna dados de autenticação
     * para as requisições
     * @return array
     */
    protected function getAuthData()
    {
        return [
            'username' => $this->username,
            'password' => $this->password
        ];
    }

    /**
     * Retorna as opções da requisição para
     * o cliente
     * @param  array   $headers
     * @param  boolean $referer
     * @return array
     */
    protected function getClientOptions(array $headers, $referer = false): array
    {
        return [
            'allow_redirects' => [
                'referer' => $referer
            ],
            'http_errors' => false,
            'timeout' => DeathByCaptcha::DEFAULT_TIMEOUT,
            'connect_timeout' => (DeathByCaptcha::DEFAULT_TIMEOUT / 4),
            'headers' => $headers
        ];
    }

    /**
     * Efetua requisição no cliente
     * retornando informações da conta no serviço
     * @return ResponseInterface
     */
    public function accountRequest(): ResponseInterface
    {
        $response = $this->get('user');

        return $response;
    }

    /**
     * Efetua requisição no cliente
     * retornando informações do status do serviço
     * @return ResponseInterface
     */
    public function statusRequest(): ResponseInterface
    {
        $response = $this->get('status');

        return $response;
    }

    /**
     * Informa pro serviço que o captcha recuperado
     * é inválido
     * @param  int    $id
     * @return ResponseInterface
     */
    public function captchAsIncorrect(int $id): ResponseInterface
    {
        $response = $this->post("captcha/{$id}/report");

        return $response;
    }

    /**
     * Recupera o resultado de um captcha através
     * do ID recentemente retornado pelo método
     * upload.
     * @param  int    $id
     * @return ResponseInterface
     */
    public function retrieveCaptcha(int $id): ResponseInterface
    {
        $response = $this->get("captcha/{$id}");

        return $response;
    }

    /**
     * Envia o captcha para o serviço
     * @param  string $imageBase64
     * @return ResponseInterface
     */
    public function uploadCaptcha($imageBase64): ResponseInterface
    {
        $response = $this->post('captcha', [
            'captchafile' => $imageBase64
        ]);

        return $response;
    }

    /**
     * Envia o captcha para o serviço
     * @param  string $googlekey
     * @param  $url
     * @return ResponseInterface
     */
    public function sendReCaptchaV2($googlekey, $url)
    {
        $response = $this->post('captcha', [
            'type' => 4,
            'token_params' => json_encode([
                'proxytype' => 'HTTP',
                'googlekey' => $googlekey,
                'pageurl' => $url,
            ])
        ]);

        return $response;
    }
}
