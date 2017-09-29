<?php

// converte url em link
function converte_url_link($conteudo){

// convertendo em links
$conteudo = preg_replace('$(\s|^)(https?://[a-z0-9_./?=&-]+)(?![^<>]*>)$i', ' <a href="$2" target="_blank">$2</a> ', $conteudo." ");
$conteudo = preg_replace('$(\s|^)(www\.[a-z0-9_./?=&-]+)(?![^<>]*>)$i', '<a target="_blank" href="http://$2"  target="_blank">$2</a> ', $conteudo." ");

// retorno
return $conteudo;

};

?>