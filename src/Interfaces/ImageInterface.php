<?php

namespace juniorb2ss\DeathByCaptcha\Interfaces;

interface ImageInterface
{
    /**
     * Efetua o encode da imagem conforme
     * o content repassado
     * @param  string $content
     * @return string $base64
     */
    public static function base64From(string $content): string;
}
