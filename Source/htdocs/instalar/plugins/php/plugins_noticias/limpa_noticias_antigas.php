<?php

// limpa noticias antigas
function limpa_noticias_antigas(){

// globals
global $tabela_banco;

// tabelas
$tabela = $tabela_banco[35];

// id de usuario logado
$uid = retorne_idusuario_logado();

// query
$query = "delete from $tabela where uid='$uid';";

// limpando...
plugin_executa_query($query);

};

?>