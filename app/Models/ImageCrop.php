<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageCrop extends Model
{
    use HasFactory;

    public function crop($src_image_path, $dest_image_path, $max_size = 600){
        
        if (file_exists($src_image_path)) 
        {
            $ext = strtolower(pathinfo($src_image_path, PATHINFO_EXTENSION));
            if ($ext == 'jpeg' || $ext == 'jpg') 
            {
                $src_image = imagecreatefromjpeg($src_image_path);

            }elseif ($ext == 'png') 
            {
                $src_image = imagecreatefrompng($src_image_path);

            }elseif ($ext == 'gif') 
            {
                $src_image = imagecreatefromgif($src_image_path);

            }else{
                $src_image = imagecreatefromjpeg($src_image_path);
            }

            if ($src_image) 
            {   
                $width = imagesx($src_image);
                $height = imagesy($src_image);
                

                // check which side is larger and calculate
                if ($width > $height)
                {
                    $extra_space = $width - $height;
                    $src_x = $extra_space / 2;
                    $src_y = 0;

                    $src_width  = $height;
                    $src_height = $height;
                }else {
                    $extra_space = $height - $width;
                    $src_y = $extra_space / 2;
                    $src_x = 0;

                    $src_width  = $width;
                    $src_height = $width;
                }

                // create a new image
                $dst_image = imagecreatetruecolor($max_size, $max_size);

                // restructure the image
                imagecopyresampled($dst_image, $src_image, 0,  0,   $src_x,   $src_y,   $max_size,  $max_size,  $src_width,  $src_height);

                // save image as jepeg
                imagejpeg($dst_image, $dest_image_path);
            }
        }
    }

    
    // create thumbnails to ease cropping
    public function profile_thumb($image_path)
    {
        dd("here");
        // call the crop method and set the size
        $crop_size = 600;
        // 
        // rewwrite the extension
        $ext = strtolower(pathinfo($image_path, PATHINFO_EXTENSION));
        $thumbnail = str_replace(".".$ext, "_thumb.".$ext, $image_path);

        if (!file_exists($thumbnail)) 
        {
            $this->crop($image_path,$thumbnail,$crop_size);
        }
        return $thumbnail;
        
    }
}
