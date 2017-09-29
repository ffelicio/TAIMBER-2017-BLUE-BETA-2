<?php

// pre visualiza as videos de publicacao
function previsualiza_videos_publicacao($chave){

// array de retorno
$array_retorno["dados"] = constroe_videos_publicacao($chave);

// retorno
return json_encode($array_retorno);

};

?>