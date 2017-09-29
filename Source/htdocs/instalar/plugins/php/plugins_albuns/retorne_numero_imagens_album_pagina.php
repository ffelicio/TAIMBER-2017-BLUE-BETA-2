<?php

// retorna o numero de imagens de album da pagina
function retorne_numero_imagens_album_pagina($pagina){

// globals
global $tabela_banco;

// tabela
$tabela = $tabela_banco[4];

// query
$query = "select *from $tabela where pagina='$pagina';";

// dados de query
$dados_query = plugin_executa_query($query);

// retorno
return $dados_query["linhas"];

};

?>