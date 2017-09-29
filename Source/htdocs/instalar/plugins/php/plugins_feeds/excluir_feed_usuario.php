<?php

// exclui feed de usuario
function excluir_feed_usuario(){

// globals
global $tabela_banco;

// tabela
$tabela = $tabela_banco[8];

// id de feed
$id = retorne_campo_formulario_request(4);

// id de usuario logado
$uid = retorne_idusuario_logado();

// query
$query = "delete from $tabela where uid='$uid' and id_post='$id';";

// excluindo feed
plugin_roda_query($query);

};

?>