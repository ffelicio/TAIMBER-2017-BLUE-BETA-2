<?php

// limpa os comentarios
function limpar_comentarios(){

// globals
global $tabela_banco;

// id de usuario logado
$idusuario = retorne_idusuario_logado();

// query
$query = "delete from $tabela_banco[7] where uid='$idusuario' or uidamigo='$idusuario';";

// limpa as visitas
plugin_executa_query($query);

};

?>