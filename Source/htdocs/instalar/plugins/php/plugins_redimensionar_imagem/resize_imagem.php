<?php

// redimensionando imagens
function resize_imagem($largura, $imagem, $imagem_salvar){

// dados da imagem
$dados_imagem = getimagesize($imagem);

// valida o tipo de imagem
switch($dados_imagem['mime']){
	
    case 'image/jpeg':
    $image_create_func = 'imagecreatefromjpeg';
	$imagem_salvar_func = 'imagejpeg';
    break;

    case 'image/png':
    $image_create_func = 'imagecreatefrompng';
	$imagem_salvar_func = 'imagepng';
    break;

    case 'image/gif':
    $image_create_func = 'imagecreatefromgif';
	$imagem_salvar_func = 'imagegif';
    break;

	default:
	$image_create_func = 'imagecreatefromjpeg';
	$imagem_salvar_func = 'imagejpeg';
	
};

// Cria um identificador para nova imagem
$imagem_original = $image_create_func($imagem);

// entralaca a imagem para carregar mais rapido
imageinterlace($imagem_original, true);

// Salva o tamanho antigo da imagem
list($largura_antiga, $altura_antiga) = getimagesize($imagem);

// calcula a nova altura
$altura = ($altura_antiga / $largura_antiga) * $largura;

// Cria uma nova imagem com o tamanho indicado
// Esta imagem servirá de base para a imagem a ser reduzida
$imagem_tmp = imagecreatetruecolor($largura, $altura);

// Faz a interpolação da imagem base com a imagem original
imagecopyresampled($imagem_tmp, $imagem_original, 0, 0, 0, 0, $largura, $altura, $largura_antiga, $altura_antiga);

// Salva a nova imagem
$resultado = $imagem_salvar_func($imagem_tmp, $imagem_salvar, 100);

// Libera memoria
imagedestroy($imagem_original);
imagedestroy($imagem_tmp);

};

?>