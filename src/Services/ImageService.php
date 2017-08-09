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
            $image = Image::make($content);

            return (string)$image->encode();
        } catch (ImageException $e) {
            throw new InvalidCaptchaException;
        }
    }
}
