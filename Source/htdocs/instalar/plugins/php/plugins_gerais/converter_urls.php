<?php

// converte todas as urls, links, videos etc
function converter_urls($adiciona_link_imagem, $conteudo){

// decodifica entidades html
$conteudo = html_entity_decode($conteudo);

// converte url em imagem
$conteudo = converte_tag_imagem($conteudo, $adiciona_link_imagem);

// adiciona uma quebra de linha
$conteudo = adiciona_quebra_linha($conteudo);

// converte url em video do youtube
$conteudo = converte_url_video_youtube($conteudo);

// converte codigos especiais
$conteudo = converte_codigos_especiais($conteudo);

// converte codigos especiais
$conteudo = converte_conteudo_hashtag($conteudo);

// converte url em link
$conteudo = converte_url_link($conteudo);

// retorno
return $conteudo;

};

?>