<?php

// retorna o nome do usuario logado
function retorne_nome_usuario_logado(){

// globals
global $tabela_banco;

// dados compilados do usuario
$dados_compilados_usuario = $_SESSION[SESSAO_DADOS_USUARIO_LOGADO];

// separa os dados do perfil
$dados_perfil = $dados_compilados_usuario[$tabela_banco[1]];

// retorno
return $dados_perfil[NOME];

};

?>