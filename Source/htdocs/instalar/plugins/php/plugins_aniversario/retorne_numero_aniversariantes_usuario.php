<?php

// retorna o numero de aniversariantes de usuario logado
function retorne_numero_aniversariantes_usuario(){

// globals
global $tabela_banco;

// tabela
$tabela = $tabela_banco[25];

// id de usuario logado
$uid = retorne_idusuario_logado();

// query
$query = "select *from $tabela where uid='$uid';";

// contador
$contador = 0;

// dados de query
$dados_query = plugin_executa_query($query);

// retorno
return $dados_query["linhas"];

};

?>