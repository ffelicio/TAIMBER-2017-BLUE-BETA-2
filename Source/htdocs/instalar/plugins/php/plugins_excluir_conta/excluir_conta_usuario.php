<?php

// exclui a conta do usuario
function excluir_conta_usuario(){

// globals
global $idioma_sistema;
global $tabela_banco;

// valida usuario logado
if(retorne_usuario_logado() == false){
	
    // dados de retorno
    $array_retorno["dados"] = 1;
	
    // retorno
    return json_encode($array_retorno);
	
};

// dados de formulario
$senha_atual = codifica_md5(converte_minusculo(retorne_campo_formulario_request(15)));

// senha do usuario
$senha_usuario = retorna_senha_usuario_logado();

// nome de usuario
$nome_usuario = retorne_nome_usuario_logado();

// valida senha
if($senha_atual != $senha_usuario){
	
	// dados de retorno
	$array_retorno["dados"] = mensagem_erro($nome_usuario.$idioma_sistema[139]);
	
	// retorno
	return json_encode($array_retorno);
	
};

// exclui dados do usuario
excluir_dados_usuario();

// exclui arquivos
excluir_pastas_subpastas(retorne_pasta_usuario(retorne_idusuario_logado(), null, true), false);

// limpa sessao
logout_usuario();

// limpa o email de sessao
$_SESSION[SESSAO_EMAIL] = null;

// dados de retorno
$array_retorno["dados"] = 1;
	
// retorno
return json_encode($array_retorno);

};

?>