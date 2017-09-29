<?php

// atualiza o numero de hashtags
function atualiza_numero_hashtag(){

// hashtag
$hashtag = retorne_hashtag_requeste();

// array de retorno
$array_retorno["dados"] = retorne_tamanho_resultado(retorne_numero_hashtags($hashtag));

// retorno
return json_encode($array_retorno);

};

?>