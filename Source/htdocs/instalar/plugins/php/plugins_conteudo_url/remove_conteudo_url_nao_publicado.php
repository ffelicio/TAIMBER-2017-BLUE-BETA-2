<?php

// remove o conteudo url nao publicado
function remove_conteudo_url_nao_publicado(){

// globals
global $tabela_banco;

// id de usuario logado
$uid = retorne_idusuario_logado();

// tabela
$tabela = $tabela_banco[29];

// query
$query = "delete from $tabela where uid='$uid' and publicado='0';";

// atualizando...
plugin_executa_query($query);

};

?>