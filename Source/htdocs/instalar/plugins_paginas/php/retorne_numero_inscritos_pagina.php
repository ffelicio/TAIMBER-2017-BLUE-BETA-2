<?php

// retorna o numero de inscritos da pagina
function retorne_numero_inscritos_pagina($id){

// globals
global $tabela_banco;

// tabela
$tabela = $tabela_banco[22];

// query
$query = "select *from $tabela where pagina='$id';";

// dados de query
$dados_query = plugin_executa_query($query);

// retorno
return $dados_query["linhas"];

};

?>