<?php

namespace juniorb2ss\DeathByCaptcha\Services;

use Intervention\Image\Exception\ImageException;
use Intervention\Image\ImageManagerStatic as Image;
use juniorb2ss\DeathByCaptcha\Interfaces\ImageInterface;
use juniorb2ss\DeathByCaptcha\Exceptions\InvalidCaptchaException;

class ImageService implements ImageInterface
{
    public static function base64From(string $content): string
    {
        try {
            $img = Image::make($content)->encode('data-url');
            $base64 = substr($img->encoded, 22);

            return 'base64:' . $base64;
        } catch (ImageException $e) {
            throw new InvalidCaptchaException;
        }
    }
}
