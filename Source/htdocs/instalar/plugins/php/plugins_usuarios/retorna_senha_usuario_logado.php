<?php

// retorna a senha do usuario logado
function retorna_senha_usuario_logado(){

// globals
global $tabela_banco;

// dados compilados do usuario
$dados_compilados_usuario = $_SESSION[SESSAO_DADOS_USUARIO_LOGADO];

// dados separados
$dados_login = $dados_compilados_usuario[$tabela_banco[0]];

// retorno
return $dados_login[SENHA];

};

?>