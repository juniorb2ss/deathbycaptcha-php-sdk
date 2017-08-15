<?php

namespace juniorb2ss\DeathByCaptcha\Abstracts;

use Psr\Http\Message\ResponseInterface;
use juniorb2ss\DeathByCaptcha\Exceptions\AccessDeniedException;
use juniorb2ss\DeathByCaptcha\Exceptions\CaptchaNotFoundException;
use juniorb2ss\DeathByCaptcha\Exceptions\InternalServiceException;
use juniorb2ss\DeathByCaptcha\Exceptions\InvalidCaptchaException;
use juniorb2ss\DeathByCaptcha\Exceptions\InvalidServiceResponseException;
use juniorb2ss\DeathByCaptcha\Exceptions\ServiceOverloadException;

abstract class HttpHandlerResponseAbstract
{

    /**
     * Define o content que deverá ser a resposta
     * do serviço
     * @var string
     */
    protected $contentTypeOk = 'application/json; charset=utf8';

    /**
     * Executa verificação da integridade da resposta
     * desde do cabeçalho do response até o conteúdo
     * @return void|ClientException
     */
    protected function handlerHttpResponseIsOk()
    {
        $response = $this->response;
        $contentType = $response->getHeaderLine('Content-Type');

        $statusCode = $response->getStatusCode();

        // Efetua o tratamento do status code do response
        switch ($statusCode) {
            case 400:
                throw new InvalidCaptchaException;
                break;
            case 403:
                throw new AccessDeniedException;
                break;
            case 404:
                throw new CaptchaNotFoundException;
                break;
            case 413:
                throw new InvalidCaptchaException;
                break;
            case 500:
                throw new InternalServiceException;
            case 503:
                throw new ServiceOverloadException;
                break;
        }

        // Uma coisa básica é verificar o tipo do conteúdo
        // da resposta HTTP.
        // Parece a principio algo meio "desnecessário"
        // já que se a resposta for ok e for passado o
        // accept de json, técnicamente deverá retornar
        // o content type como json
        // mas... nunca se sabe, né?
        if (($contentType !== $this->contentTypeOk) or (empty((string)$response->getBody()))) {
            throw new InvalidServiceResponseException;
        }
    }
}
