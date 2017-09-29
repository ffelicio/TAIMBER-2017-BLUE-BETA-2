<?php

// atualiza o email do usuario
function atualizar_email(){

// globals
global $idioma_sistema;
global $tabela_banco;

// valida usuario logado
if(retorne_usuario_logado() == false){
	
	// array de retorno
	$array_retorno["dados"] = mensagem_erro($idioma_sistema[400]);

	// retorno nulo
	return json_encode($array_retorno);
	
};

// valida usuario pode alterar o email
if(retorne_pode_alterar_email() == false){
	
	// array de retorno
	$array_retorno["dados"] = mensagem_erro($idioma_sistema[441]);

	// retorno nulo
	return json_encode($array_retorno);
	
};

// nome de usuario logado
$nome_usuario = retorne_nome_usuario_logado();

// id de usuario logado
$uid = retorne_idusuario_logado();

// email
$email[0] = converte_minusculo(retorne_campo_formulario_request(33));
$email[1] = converte_minusculo(retorna_email_usuario_logado());

// valida emails são iguais
if($email[0] == $email[1]){
	
	// array de retorno
	$array_retorno["dados"] = mensagem_erro($nome_usuario.$idioma_sistema[455]);

	// retorno nulo
	return json_encode($array_retorno);	
	
};

// valida email de usuario ja cadastrado
if(retorne_email_cadastrado($email[0]) == true){
	
	// array de retorno
	$array_retorno["dados"] = mensagem_erro($nome_usuario.$idioma_sistema[456]);

	// retorno nulo
	return json_encode($array_retorno);	
	
};

// valida emails
if($email[0] == null or $email[1] == null or verifica_se_email_valido($email[0]) == false){
	
	// array de retorno
	$array_retorno["dados"] = mensagem_erro($nome_usuario.$idioma_sistema[457]);

	// retorno nulo
	return json_encode($array_retorno);	
	
};

// tabela
$tabela = $tabela_banco[0];

// query
$query = "update $tabela set e_mail='$email[0]' where e_mail='$email[1]' and uid='$uid';";

// atualizando email
plugin_executa_query($query);

// se chegou ate aqui e por que o usuario existe
salva_sessao_usuario($email[0], retorna_senha_usuario_logado(), $uid);

// atualiza ou retorna os dados da sessao do usuario
atualiza_retorna_dados_usuario_sessao(true, true);

// adiciona o ativar usuario
adicionar_ativar_usuario();

// atualiza o numero de alteracoes de e-mail em um dia
atualiza_numero_alterou_email_dia();

// array de retorno
$array_retorno["dados"] = mensagem_sucesso($nome_usuario.$idioma_sistema[458].$email[0].$idioma_sistema[163]);

// retorno
return json_encode($array_retorno);

};

?>