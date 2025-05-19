<?php

namespace App\Http\Controllers;

use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;

abstract class Controller
{
    public function imageresize($imagepath, $size)
    {
        $manager = new ImageManager(new Driver());

        // Fetch the file content from Wasabi
        if (!Storage::exists($imagepath)) {
            return response()->json(['error' => 'File not found in Wasabi storage.'], 404);
        }
        $filecontent = Storage::get($imagepath);

        // Extract the file extension
        $extension = pathinfo($imagepath, PATHINFO_EXTENSION);

        // Read the file content with Intervention Image
        $image = $manager->read($filecontent);

        // Resize or cover the image based on $size
        switch ($size) {
            case 1:
                // Resize proportionally and pad to 1920x1080 (16:9) with black background
                $image->resize(1920, 1080, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                $image->resizeCanvas(1920, 1080, 'center', false, '#000000'); // padding
                break;

            default:
                // Default fallback: crop to 300x250
                $image->cover(300, 250);
                break;
        }

        // Convert the image to its original format
        $imageBinary = match (strtolower($extension)) {
            'png'  => $image->toPng(),
            'webp' => $image->toWebp(),
            'gif'  => $image->toGif(),
            'jpg', 'jpeg' => $image->toJpeg(),
            default => $image->toJpeg(80),
        };

        // Replace the existing file in the same location
        Storage::put($imagepath, $imageBinary);
    }
}
