<?php

// pre visualiza as musicas de publicacao
function previsualiza_musicas_publicacao($chave){

// array de retorno
$array_retorno["dados"] = constroe_musicas_publicacao($chave);

// retorno
return json_encode($array_retorno);

};

?>