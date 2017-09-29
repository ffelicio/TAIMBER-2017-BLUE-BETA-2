<?php

// retorna o numero de paginas inscritas pelo usuario
function retorne_numero_paginas_inscritas_usuario($idusuario){

// globals
global $tabela_banco;

// query
$query = "select *from $tabela_banco[22] where uidamigo='$idusuario';";

// dados de query
$dados_query = plugin_executa_query($query);

// retorno
return $dados_query["linhas"];

};

?>