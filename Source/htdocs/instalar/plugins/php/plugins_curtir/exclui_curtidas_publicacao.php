<?php

// exclui as curtidas de publicacao, imagens etc
function exclui_curtidas_publicacao($id_post, $tabela_curtiu){

// globals
global $tabela_banco;

// query
$query = "delete from $tabela_banco[9] where id_post='$id_post' and tabela_curtiu='$tabela_curtiu';";

// exclui todos os comentarios
plugin_executa_query($query);

};

?>