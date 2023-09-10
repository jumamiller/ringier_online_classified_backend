<?php

namespace App\Shared;

use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Base64Upload
{
    /**
     * @param $base64_image
     * @param $image_path
     * @return string
     */
    public static function upload_image($base64_image,$image_path): string
    {
        try{
            $image_64 = $base64_image; //your base64 encoded data
            $extension = explode(';base64',$image_64);
            $extension = explode('/',$extension[0]);
            $extension = $extension[1];

            $replace = substr($image_64, 0, strpos($image_64, ',')+1);

            // find substring from replace here eg: data:image/png;base64,

            $image = str_replace($replace, '', $image_64);

            $image = str_replace(' ', '+', $image);
            //check image size, should not be more than 1MB
            $image_size = strlen($image);
            if($image_size > 1048576){
                return 'Image size should not be more than 1MB';
            }
            $imageName = time().'_'.Str::random(20).'.'.$extension;

            Storage::disk('public')->put($image_path.'/' .$imageName, base64_decode($image));
            return $image_path.'/'.$imageName;
        } catch (Exception $exception) {
            throw new($exception->getMessage());
        }
    }
}
