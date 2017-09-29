<?php

// gera o token da pagina
function gera_token_pagina(){

// atualiza o iterador
$_SESSION[SESSAO_ITERACAO_TOKEN_PAGINA] += 1;

// data atual
$token = md5(data_atual().$_SESSION[SESSAO_ITERACAO_TOKEN_PAGINA]);

// salvando token na sessao
$_SESSION[SESSAO_TOKEN_PAGINA][$token] = $token;

// retorno
return $_SESSION[SESSAO_TOKEN_PAGINA][$token];

};

?>