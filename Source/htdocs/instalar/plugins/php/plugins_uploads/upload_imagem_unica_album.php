<?php

// upload de imagem unica album
function upload_imagem_unica_album($foto, $pasta_upload_root, $tamanho_normal, $tamanho_miniatura, $host_retorno, $upload_miniatura, $tamanho_thumbnail){

// array com endereços de imagens
$array_enderecos = upload_imagem($foto, $pasta_upload_root, $tamanho_normal, $tamanho_miniatura, true, false, $host_retorno, $tamanho_thumbnail, null, null);

// array de retorno
$retorno[URL_HOST_GRANDE] = $array_enderecos["host_normal"];
$retorno[URL_HOST_MINIATURA] = $array_enderecos["host_miniatura"];
$retorno[URL_HOST_THUMBNAIL] = $array_enderecos[URL_HOST_THUMBNAIL];

// array de retorno
$retorno[URL_ROOT_GRANDE] = $array_enderecos["root_normal"];
$retorno[URL_ROOT_MINIATURA] = $array_enderecos["root_miniatura"];
$retorno[URL_ROOT_THUMBNAIL] = $array_enderecos[URL_ROOT_THUMBNAIL];

// retorno
return $retorno;

};

?>