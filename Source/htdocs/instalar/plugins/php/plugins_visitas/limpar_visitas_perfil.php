<?php

// limpa as visitas do perfil
function limpar_visitas_perfil(){

// globals
global $tabela_banco;

// id de usuario logado
$idusuario = retorne_idusuario_logado();

// query
$query = "delete from $tabela_banco[11] where uid='$idusuario';";

// limpa as visitas
plugin_executa_query($query);

};

?>