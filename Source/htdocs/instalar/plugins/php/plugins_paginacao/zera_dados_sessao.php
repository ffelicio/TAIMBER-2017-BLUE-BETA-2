<?php

// zera dados de sessao
function zera_dados_sessao(){

// atualiza dados de sessao
$_SESSION[SESSAO_NOME_PESQ_AMIGO_LOCAL][retorne_idusuario_request()] = null;
$_SESSION[SESSAO_NOME_PESQ_GERAL][retorne_idusuario_request()] = null;

};

?>