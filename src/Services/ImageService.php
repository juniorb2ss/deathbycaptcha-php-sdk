<?php

namespace juniorb2ss\DeathByCaptcha\Services;

use Intervention\Image\ImageManagerStatic as Image;
use juniorb2ss\DeathByCaptcha\Interfaces\ImageInterface;

class ImageService implements ImageInterface
{
    public static function base64From($content): string
    {
        $image = Image::make($content);

        return (string)$image->encode();
    }
}
