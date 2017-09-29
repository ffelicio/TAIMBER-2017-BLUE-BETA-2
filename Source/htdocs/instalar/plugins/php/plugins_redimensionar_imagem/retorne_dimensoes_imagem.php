<?php

// retorna as dimensoes da imagem
function retorne_dimensoes_imagem($root_imagem){

// obtendo dimensoes
list($width, $height) = getimagesize($root_imagem);

// separando dados
$dados["largura"] = $width;
$dados["altura"] = $height;

// retorno
return $dados;


};

?>