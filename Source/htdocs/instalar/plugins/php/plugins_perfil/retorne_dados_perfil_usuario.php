<?php

// retorna os dados do perfil de usuario
function retorne_dados_perfil_usuario($uid){

// globals
global $tabela_banco;

// tabela
$tabela = $tabela_banco[1];

// query
$query = "select *from $tabela where uid='$uid';";

// dados de query
$dados_query = plugin_executa_query($query);

// retorno
return $dados_query["dados"][0];

};

?>