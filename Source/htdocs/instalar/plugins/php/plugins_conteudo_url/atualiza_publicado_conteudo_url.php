<?php

// atualiza o publicado de conteudo de url
function atualiza_publicado_conteudo_url($chave){

// globals
global $tabela_banco;

// id de usuario logado
$uid = retorne_idusuario_logado();

// tabela
$tabela = $tabela_banco[29];

// query
$query = "update $tabela set publicado='1' where chave='$chave' and uid='$uid';";

// atualizando...
plugin_executa_query($query);

};

?>