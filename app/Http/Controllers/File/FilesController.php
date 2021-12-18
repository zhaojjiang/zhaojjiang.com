<?php

namespace App\Http\Controllers\File;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class FilesController extends Controller
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function getImage($image = null)
    {
        if (!$image) {
            abort(404);
        }
        if (strncmp($image, 'uploads', 7) !== 0 || strncmp($image, '/uploads', 8) !== 0) {
            $image = "uploads/images/" . ltrim($image, '/');
        }
        preg_match('/^(.*\.(.*))!(.*)/', $image, $matches);
        $image_path = $matches[1] ?? '';
        $image_ext = $matches[2] ?? '';
        $image_attr = $matches[3] ?? '';

        if (!is_file(public_path($image_path))) {
            abort(404);
        }

        $image = $image_path;
        if ($image_attr) {
            if (preg_match('/^\d+\*\d+$/', $image_attr)) {
                $wh = explode('*', $image_attr);
                $width = $wh[0];
                $height = $wh[1];
                $image = Image::make($image)->resize($width, $height);
                $image = $image->response();
            } else if (preg_match('/^(\d+\.?\d*)$/', $image_attr, $zoom)) {
                $zoom = (float)$zoom[1];
                if ($zoom > 0 && $zoom !== 1.0) {
                    $image = Image::make($image);
                    $image = $image->resize($image->width() * $zoom, $image->height() * $zoom);
                    $image = $image->response();
                }
            }
        }

        if (is_string($image)) {
            return response()->file($image);
        } else {
            return $image;
        }
    }
}
