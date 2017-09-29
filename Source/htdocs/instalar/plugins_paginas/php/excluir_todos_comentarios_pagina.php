<?php

// exclui todos os comentarios
function excluir_todos_comentarios_pagina($id_post, $tabela_comentario){

// globals
global $tabela_banco;

// id de usuario logado
$uid = retorne_idusuario_logado();

// query
$query = "delete from $tabela_banco[7] where id_post='$id_post' and tabela_comentario='$tabela_comentario' and uid='$uid';";

// exclui todos os comentarios
plugin_executa_query($query);

};

?>