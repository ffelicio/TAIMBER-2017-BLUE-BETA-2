<?php

// alterar senha de usuario
function alterar_senha(){

// globals
global $idioma_sistema;
global $tabela_banco;

// dados de formulario
$senha_atual = converte_minusculo(retorne_campo_formulario_request(15));
$nova_senha = converte_minusculo(retorne_campo_formulario_request(16));
$nova_senha_confirma = converte_minusculo(retorne_campo_formulario_request(17));

// senha do usuario
$senha_usuario = retorna_senha_usuario_logado();

// nome de usuario
$nome_usuario = retorne_nome_usuario_logado();

// valida senha
if(codifica_md5($senha_atual) != $senha_usuario){
	
	// dados de retorno
	$array_retorno["dados"] = mensagem_erro($nome_usuario.$idioma_sistema[139]);
	
	// retorno
	return json_encode($array_retorno);
	
};

// valida nova senha igual
if($nova_senha != $nova_senha_confirma){
	
	// dados de retorno
	$array_retorno["dados"] = mensagem_erro($nome_usuario.$idioma_sistema[140]);
	
	// retorno
	return json_encode($array_retorno);
	
};

// valida tamanho da nova senha
if(strlen($nova_senha) < TAMANHO_MINIMO_SENHA or strlen($nova_senha_confirma) < TAMANHO_MINIMO_SENHA){
	
	// dados de retorno
	$array_retorno["dados"] = mensagem_erro($nome_usuario.$idioma_sistema[141].TAMANHO_MINIMO_SENHA.$idioma_sistema[142]);
	
	// retorno
	return json_encode($array_retorno);
	
};

// id de usuario
$idusuario = retorne_idusuario_logado();

// email de usuario logado
$email = retorna_email_usuario_logado();

// data
$data = data_atual();

// cifra a senha
$nova_senha = codifica_md5($nova_senha);

// query
$query = "update $tabela_banco[0] set senha='$nova_senha', data='$data' where uid='$idusuario' and e_mail='$email';";

// atualiza a senha
plugin_executa_query($query);

// se chegou ate aqui e por que o usuario existe
salva_sessao_usuario($email, $nova_senha, $idusuario);

// dados de retorno
$array_retorno["dados"] = 1;
	
// retorno
return json_encode($array_retorno);
	
};

?>