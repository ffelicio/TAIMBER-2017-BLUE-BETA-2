<?php

// atualiza a descricao de imagem de album
function atualizar_descricao_imagem_album(){

// globals
global $tabela_banco;

// dados do formulario
$conteudo = retorne_campo_formulario_request_htmlentites(36);
$id = retorne_campo_formulario_request(4);
$chave = retorne_campo_formulario_request(3);

// tabela
$tabela = $tabela_banco[4];

// id de usuario logado
$uid = retorne_idusuario_logado();

// query
$query = "update $tabela set descricao_imagem='$conteudo' where id='$id' and uid='$uid' and chave='$chave';";

// atualizando descricao
plugin_executa_query($query);

};

?>