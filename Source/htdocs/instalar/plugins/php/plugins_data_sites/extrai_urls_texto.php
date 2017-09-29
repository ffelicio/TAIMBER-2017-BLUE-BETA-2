<?php

// extrai urls de texto
function extrai_urls_texto($texto){

// obtendo urls
preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $texto, $array_retorno);

// retorno
return $array_retorno;

};

?>