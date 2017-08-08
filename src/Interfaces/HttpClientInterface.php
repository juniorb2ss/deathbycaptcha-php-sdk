<?php

namespace juniorb2ss\DeathByCaptcha\Interfaces;

use GuzzleHttp\Psr7\Response;

interface HttpClientInterface
{
    public function accountRequest(): Response;
    public function statusRequest(): Response;
    public function captchAsIncorrect(int $id): Response;
}
