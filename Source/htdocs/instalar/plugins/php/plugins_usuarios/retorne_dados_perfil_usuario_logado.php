<?php

// retorna os dados do perfil de usuario logado
function retorne_dados_perfil_usuario_logado(){

// globals
global $tabela_banco;

// dados de usuario logado
$dados = atualiza_retorna_dados_usuario_logado_sessao();

// retorno
return $dados[$tabela_banco[1]];

};

?>