<?php

// obtem informacoes de site
function obter_informacoes_site($url){

// captura dados de site
$dados_site = separa_dados_data_site(false, $url);

// separa dados
$titulo = $dados_site['titulo'];
$descricao = $dados_site['descricao'];
$keywords = $dados_site['keywords'];
$lista_imagens = $dados_site['lista_imagens'];

// array de retorno
$array_retorno[0] = $titulo;
$array_retorno[1] = $descricao;
$array_retorno[2] = $lista_imagens;
$array_retorno[3] = $keywords;
$array_retorno[4] = $url;

// retorno
return $array_retorno;

};

?>