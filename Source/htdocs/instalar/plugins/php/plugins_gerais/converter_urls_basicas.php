<?php

// converte todas as urls em campos básicos como hashtag, links etc
function converter_urls_basicas($conteudo){

// converte codigos especiais
$conteudo = converte_conteudo_hashtag($conteudo);

// converte url em link
$conteudo = converte_url_link($conteudo);

// retorno
return $conteudo;

};

?>