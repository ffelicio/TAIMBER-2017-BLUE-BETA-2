<?php

// limpa as curtidas
function limpar_curtidas(){

// globals
global $tabela_banco;

// id de usuario logado
$idusuario = retorne_idusuario_logado();

// query
$query = "delete from $tabela_banco[9] where uid='$idusuario' or uidamigo='$idusuario';";

// limpa as visitas
plugin_executa_query($query);

};

?>