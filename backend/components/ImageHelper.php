<?php

namespace backend\components;

use yii\imagine\Image;
use Imagine\Image\Box;

final class ImageHelper
{
    /**
     * @param string $imagePath
     * @param int $quality
     * @param null $newPathSave
     * @return \Imagine\Image\ImageInterface
     */
    public function compressImage(string $imagePath, int $quality, $newPathSave = null)
    {
        return
            Image::getImagine()
                ->open($imagePath)
                ->save(
                    $newPathSave ?? $imagePath,
                    ['quality' => $quality]
                );
    }

    /**
     * @param string $imagePath
     * @param int $width
     * @param int $height
     * @param null $newPathSave
     * @return \Imagine\Image\ImageInterface
     */
    public function reSize(string $imagePath, int $width, int $height, $newPathSave = null)
    {
        $image = Image::getImagine()->open($imagePath);
        $width = $image->getSize()->getWidth() >= $width ? $width : $image->getSize()->getWidth();
        $height = $image->getSize()->getHeight() >= $height ? $height : $image->getSize()->getWidth();

        return $image->thumbnail(new Box($width, $height))->save($newPathSave);
    }
}