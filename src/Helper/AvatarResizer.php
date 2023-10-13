<?php

declare(strict_types=1);

namespace App\Helper;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class AvatarResizer
{
    private const MAX_WIDTH = 256;

    private const MAX_HEIGHT = 256;

    private const IMAGE_QUALITY = 75;

    private const EXTENSION_PNG = '.png';

    private ParameterBagInterface $parameterBag;

    private LoggerInterface $logger;

    public function __construct(ParameterBagInterface $parameterBag, LoggerInterface $logger)
    {
        $this->parameterBag = $parameterBag;
        $this->logger = $logger;
    }

    public function resizeAndCompressImage(UploadedFile $file, string $destination): string
    {
        if (!\is_dir($destination) && !mkdir($destination, 0755, true) && !is_dir($destination)) {
            $this->logger->error(__METHOD__.\sprintf('Directory "%s" was not created', $destination));

            throw new \RuntimeException(\sprintf('Directory "%s" was not created', $destination));
        }

        $image = new File($file->getPathname());

        $resizedImage = $this->resizeImageFile($image);
        $compressedImage = $this->compressImage($resizedImage);

        $filename = \uniqid('', true) . self::EXTENSION_PNG;
        $compressedImage->move($destination, $filename);

        return $filename;
    }

    private function resizeImageFile(File $image): File
    {
        [$width, $height] = \getimagesize($image->getPathname());
        $aspectRatio = $width / $height;

        if ($width > self::MAX_WIDTH || $height > self::MAX_HEIGHT) {
            if (self::MAX_WIDTH / self::MAX_HEIGHT > $aspectRatio) {
                $newWidth = self::MAX_HEIGHT * $aspectRatio;
                $newHeight = self::MAX_HEIGHT;
            } else {
                $newWidth = self::MAX_WIDTH;
                $newHeight = self::MAX_WIDTH / $aspectRatio;
            }

            return $this->resizeImageToNewDimensions($image, (int)\round($newWidth), (int)\round($newHeight));
        }

        return $image;
    }

    private function resizeImageToNewDimensions(File $image, int $newWidth, int $newHeight): File
    {
        [$width, $height] = \getimagesize($image->getPathname());
        $resource = $this->createImageResource($image);

        $thumb = \imagecreatetruecolor($newWidth, $newHeight);
        \imagecopyresampled($thumb, $resource, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

        $resizedDirectoryPath = $this->parameterBag->get('kernel.project_dir').'/var/img/temp/';
        $resizedImagePath = $resizedDirectoryPath.$image->getFilename();

        if (!\is_dir($resizedDirectoryPath) && !mkdir($resizedDirectoryPath, 0755, true) && !is_dir($resizedDirectoryPath)) {
            $this->logger->error(__METHOD__.\sprintf('Temp directory "%s" was not created', $resizedDirectoryPath));

            throw new \RuntimeException(\sprintf('Temp directory "%s" was not created', $resizedImagePath));
        }

        \imagepng($thumb, $resizedImagePath, (int)\round(self::IMAGE_QUALITY / 10));
        \imagedestroy($thumb);

        return new File($resizedImagePath);
    }

    private function createImageResource(File $image)
    {
        $mimeType = \mime_content_type($image->getPathname());

        if (\str_starts_with($mimeType, 'image/jpeg')) {
            return \imagecreatefromjpeg($image->getPathname());
        }

        if (\str_starts_with($mimeType, 'image/png')) {
            return \imagecreatefrompng($image->getPathname());
        }

        if (\str_starts_with($mimeType, 'image/webp')) {
            return \imagecreatefromwebp($image->getPathname());
        }

        throw new FileException('Unsupported image type.');
    }

    private function compressImage(File $image): File
    {
        $resizedImagePath = $image->getPathname();

        $imageInfo = getimagesize($resizedImagePath);
        $mimeType = $imageInfo['mime'];

        if (\str_starts_with($mimeType, 'image/jpeg')) {
            \imagejpeg(\imagecreatefromjpeg($resizedImagePath), $resizedImagePath, self::IMAGE_QUALITY);
        } elseif (\str_starts_with($mimeType, 'image/png')) {
            \imagepng(\imagecreatefrompng($resizedImagePath), $resizedImagePath, (int)\round(self::IMAGE_QUALITY / 10));
        } elseif (\str_starts_with($mimeType, 'image/webp')) {
            \imagewebp(\imagecreatefromwebp($resizedImagePath), $resizedImagePath, self::IMAGE_QUALITY);
        } else {
            $this->logger->error(__METHOD__.' - Unsupported image type for compression.');

            throw new FileException('Unsupported image type for compression.');
        }

        return new File($resizedImagePath);
    }
}
