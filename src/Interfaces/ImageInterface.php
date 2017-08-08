<?php

namespace juniorb2ss\DeathByCaptcha\Interfaces;

interface ImageInterface
{
    public static function base64From($content): string;
}
