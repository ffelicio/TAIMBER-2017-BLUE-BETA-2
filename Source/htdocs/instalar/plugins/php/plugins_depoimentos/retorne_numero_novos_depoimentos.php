<?php

// retorna o numero de novos depoimentos
function retorne_numero_novos_depoimentos($idusuario){

// globals
global $tabela_banco;

// tabela
$tabela = $tabela_banco[13];

// query
$query = "select *from $tabela where uid='$idusuario' and aceito='0';";

// dados de query
$dados_query = plugin_executa_query($query);

// retorno
return $dados_query["linhas"];

};

?>