<?php

// retorna o numero de paginas do usuario
function retorne_numero_paginas_usuario($uid){

// globals
global $tabela_banco;

// query
$query = "select *from $tabela_banco[18] where uid='$uid';";

// dados de query
$dados_query = plugin_executa_query($query);

// retorno
return $dados_query["linhas"];

};

?>