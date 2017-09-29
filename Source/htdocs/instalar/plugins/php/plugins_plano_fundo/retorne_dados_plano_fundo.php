<?php

// retorna os dados de plano de fundo
function retorne_dados_plano_fundo(){

// globals
global $tabela_banco;

// tabela
$tabela = $tabela_banco[38];

// id de usuario via requeste
$uid = retorne_idusuario_request();

// query
$query = "select *from $tabela where uid='$uid';";

// dados de query
$dados_query = plugin_executa_query($query);

// retorno
return $dados_query["dados"][0];

};

?>