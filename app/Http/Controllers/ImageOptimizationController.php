<?php

namespace App\Http\Controllers;

class ImageOptimizationController extends Controller
{
    public function show($path)
    {
        $fullPath = storage_path('app/public/'.$path);

        if (! file_exists($fullPath)) {
            abort(404);
        }

        $extension = strtolower(pathinfo($fullPath, PATHINFO_EXTENSION));

        if ($extension === 'svg' || $extension === 'svg+xml') {
            return response()->file($fullPath, [
                'Content-Type' => 'image/svg+xml',
                'Cache-Control' => 'public, max-age=31536000',
            ]);
        }

        $cacheDir = storage_path('app/public/.optimized');
        if (! file_exists($cacheDir)) {
            @mkdir($cacheDir, 0755, true);
        }

        $cacheFile = $cacheDir.'/'.md5($path).'.webp';
        $maxWidth = 800;
        $quality = 80;

        $needsRegeneration = ! file_exists($cacheFile) || filemtime($cacheFile) < filemtime($fullPath);

        if ($needsRegeneration) {
            if (! function_exists('imagecreatefromjpeg')) {
                return response()->file($fullPath);
            }

            $info = @getimagesize($fullPath);
            $mime = $info['mime'] ?? '';

            $src = false;

            switch ($mime) {
                case 'image/jpeg':
                    $src = @imagecreatefromjpeg($fullPath);
                    break;
                case 'image/png':
                    $src = @imagecreatefrompng($fullPath);
                    break;
                case 'image/webp':
                    if (function_exists('imagecreatefromwebp')) {
                        $src = @imagecreatefromwebp($fullPath);
                    }
                    break;
                case 'image/gif':
                    $src = @imagecreatefromgif($fullPath);
                    break;
                default:
                    return response()->file($fullPath);
            }

            if (! $src) {
                return response()->file($fullPath);
            }

            $width = imagesx($src);
            $height = imagesy($src);

            if ($width > $maxWidth) {
                $newHeight = (int) round($height * ($maxWidth / $width));
                $dst = imagecreatetruecolor($maxWidth, $newHeight);

                imagealphablending($dst, true);
                imagesavealpha($dst, true);

                $transparent = imagecolorallocatealpha($dst, 0, 0, 0, 127);
                imagefill($dst, 0, 0, $transparent);

                imagecopyresampled($dst, $src, 0, 0, 0, 0, $maxWidth, $newHeight, $width, $height);
            } else {
                $dst = $src;
            }

            if (! function_exists('imagewebp') || ! @imagewebp($dst, $cacheFile, $quality)) {
                if ($dst !== $src) {
                    imagedestroy($dst);
                }
                imagedestroy($src);

                return response()->file($fullPath);
            }

            if ($dst !== $src) {
                imagedestroy($dst);
            }
            imagedestroy($src);
        }

        return response()->file($cacheFile, [
            'Content-Type' => 'image/webp',
            'Cache-Control' => 'public, max-age=31536000',
        ]);
    }
}
