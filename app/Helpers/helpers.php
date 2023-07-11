<?php

function get_image($image, $gender = 'male'){

    if (!file_exists($image)){
        $image = 'assets/';
        if ($gender == 'male') {
            $image .= "img/male.jpg";
            
        }elseif($gender == "female"){
            $image .= "img/female.jpg";
        }
    }else {
        $class = new App\Models\ImageCrop();
        $image = '/' . $class->profile_thumb($image);
    }
    return $image;
}

