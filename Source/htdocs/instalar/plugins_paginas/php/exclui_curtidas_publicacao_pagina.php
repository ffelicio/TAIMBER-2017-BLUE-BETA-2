<?php

// exclui as curtidas de publicacao, imagens etc
function exclui_curtidas_publicacao_pagina($id_post, $tabela_curtiu){

// globals
global $tabela_banco;

// id de usuario logado
$uid = retorne_idusuario_logado();

// query
$query = "delete from $tabela_banco[9] where id_post='$id_post' and tabela_curtiu='$tabela_curtiu' and uid='$uid';";

// exclui todos os comentarios
plugin_executa_query($query);

};

?>