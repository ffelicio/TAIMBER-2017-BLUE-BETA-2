<?php

// funcao para rotacionar imagem
function rotacionar_imagem($jpgFile, $thumbFile, $width) {

// dados da imagem
$dados_imagem = getimagesize($jpgFile);

// valida o tipo de imagem
switch($dados_imagem['mime']){
	
    case 'image/jpeg':
    $image_create_func = 'imagecreatefromjpeg';
    break;

    case 'image/png':
    $image_create_func = 'imagecreatefrompng';
    break;

    case 'image/gif':
    $image_create_func = 'imagecreatefromgif';
    break;

	default:
	$image_create_func = 'imagecreatefromjpeg';
	
};

//read EXIF header from uploaded file
$exif = exif_read_data($jpgFile);

// Get new dimensions
list($width_orig, $height_orig) = getimagesize($jpgFile);
$height = (int)(($width / $width_orig) * $height_orig);

// Resample
$image_p = imagecreatetruecolor($width, $height);
$image = $image_create_func($jpgFile);
imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

// Fix Orientation
switch($exif['Orientation']){
	
    case 3:
        $image_p = imagerotate($image_p, 180, 0);
        break;
		
    case 6:
        $image_p = imagerotate($image_p, -90, 0);
        break;
		
    case 8:
        $image_p = imagerotate($image_p, 90, 0);
        break;

};

// Output
imagejpeg($image_p, $thumbFile, 100);

};

?>