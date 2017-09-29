<?php

// limpa os feeds
function limpar_feeds(){

// globals
global $tabela_banco;

// id de usuario logado
$idusuario = retorne_idusuario_logado();

// query
$query = "delete from $tabela_banco[8] where uid='$idusuario';";

// limpa as visitas
plugin_executa_query($query);

};

?>