<?php

function create_thumbnail($file, $pathToSave = '', $w, $h = '' , $type='png' , $crop = FALSE)
{

    $new_height = $h;

    list($width, $height) = getimagesize($file);

    $r = $width / $height;

    if ($crop) {
        if ($width > $height) {
            $width = ceil($width - ($width * abs($r - $w / $h)));
        } else {
            $height = ceil($height - ($height * abs($r - $w / $h)));
        }
        $newwidth = $w;
        $newheight = $h;
    } else {
        if ($w / $h > $r) {
            $newwidth = $h * $r;
            $newheight = $h;
        } else {
            $newheight = $w / $r;
            $newwidth = $w;
        }
    }

    $what = getimagesize($file);

    switch (strtolower($what['mime'])) {
        case 'image/png':
            $src = imagecreatefrompng($file);

            break;
        case 'image/jpeg':
            $src = imagecreatefromjpeg($file);
            break;
        case 'image/gif':
            $src = imagecreatefromgif($file);
            break;
        default:
            //die();
    }

    if ($new_height != '') {
        $newheight = $new_height;
    }

    $dst = imagecreatetruecolor($newwidth, $newheight);//the new image

    if ($type == 'png') {
        /*for tranparent background*/
        $transparent = imagecolorallocatealpha($dst, 0, 0, 0, 127);
        imagefill($dst, 0, 0, $transparent);
        imagesavealpha($dst, true);
    }

    imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);//az function

    if ($type == 'png'){
        imagepng($dst, $pathToSave);
    } else {
        imagejpeg($dst, $pathToSave, 95); //pish farz in tabe 75 darsad quality ast*/
    }


    return $dst;
}