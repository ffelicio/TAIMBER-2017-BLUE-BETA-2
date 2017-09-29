<?php

// cadastra o usuario
function cadastrar_usuario(){

// globals
global $idioma_sistema;
global $tabela_banco;

// dados do formulario
$nome = converte_minusculo(retorne_campo_formulario_request(31));
$sobrenome = converte_minusculo(retorne_campo_formulario_request(32));
$email = converte_minusculo(retorne_campo_formulario_request(33));
$nova_senha = converte_minusculo(retorne_campo_formulario_request(34));
$nova_senha_confirma = converte_minusculo(retorne_campo_formulario_request(35));

// define a captular
$nome = captular($nome);
$sobrenome = captular($sobrenome);

// remove espacos em branco
$email = trim($email);

// valida dados de formulario
if($nome == null or $sobrenome == null or $email == null or $nova_senha == null or $nova_senha_confirma == null){
	
	// array retorno
	$array_retorno["dados"] = mensagem_erro($idioma_sistema[355]);
	
	// retorno
	return json_encode($array_retorno);	
	
};

// valida se as senhas possuem o tamanho minimo
if(strlen($nova_senha) < TAMANHO_MINIMO_SENHA or strlen($nova_senha_confirma) < TAMANHO_MINIMO_SENHA){
	
	// array retorno
	$array_retorno["dados"] = mensagem_erro($idioma_sistema[305].TAMANHO_MINIMO_SENHA.$idioma_sistema[142]);
	
	// retorno
	return json_encode($array_retorno);		
	
};

// valida nome
if(is_numeric($nome) == true){

	// array retorno
	$array_retorno["dados"] = mensagem_erro($idioma_sistema[303]);
	
	// retorno
	return json_encode($array_retorno);	
	
};

// valida sobrenome
if(is_numeric($sobrenome) == true){

	// array retorno
	$array_retorno["dados"] = mensagem_erro($idioma_sistema[304]);
	
	// retorno
	return json_encode($array_retorno);	
	
};

// valida se as senhas sao iguais
if($nova_senha != $nova_senha_confirma){
	
	// array retorno
	$array_retorno["dados"] = mensagem_erro($idioma_sistema[302]);
	
	// retorno
	return json_encode($array_retorno);
	
};

// valia email
if(verifica_se_email_valido($email) == false){
	
	// array retorno
	$array_retorno["dados"] = mensagem_erro($idioma_sistema[8]);
	
	// retorno
	return json_encode($array_retorno);
	
};

// valida nome
if(retorna_palavra_chave_existe_string($nome, "@") == true){
	
	// array retorno
	$array_retorno["dados"] = mensagem_erro($idioma_sistema[516]);
	
	// retorno
	return json_encode($array_retorno);	
	
};

// valida sobrenome
if(retorna_palavra_chave_existe_string($sobrenome, "@") == true){
	
	// array retorno
	$array_retorno["dados"] = mensagem_erro($idioma_sistema[517]);
	
	// retorno
	return json_encode($array_retorno);	
	
};

// data atual
$data_atual = data_atual();

// valida numero de linhas
if(retorne_email_cadastrado($email) == false){
	
	// cifra a senha
	$nova_senha = codifica_md5($nova_senha);

    // query de cadastro
	$query[0] = "select *from $tabela_banco[0] where e_mail='$email';";
	$query[1] = "insert into $tabela_banco[0] values(null, '$email', '$nova_senha', '$data_atual');";

	// cadastra o usuario
	plugin_roda_query($query[1]);

	// array de dados
	$array_dados = plugin_roda_query($query[0]);	
	
	// ultimo id de cadastro
	$idusuario = $array_dados["dados"][0][UID];
	
	// dados padrao do perfil ao se cadastrar
	$array_dados_perfil[] = $idusuario;
	$array_dados_perfil[] = $nome;
	$array_dados_perfil[] = $sobrenome;

	// se chegou ate aqui e por que o usuario existe
    salva_sessao_usuario($email, $nova_senha, $idusuario);

	// array retorno
	$array_retorno["dados"] = -1;
	
	// atualiza o perfil do usuario ao se cadastrar
	atualiza_perfil_usuario_cadastrar($array_dados_perfil);
	
	// adiciona o ativar usuario
	adicionar_ativar_usuario();
	
	// adiciona nome amigavel ao se cadastrar
	adiciona_nome_amigavel_cadastrar($nome, $sobrenome);

	// retorno
	return json_encode($array_retorno);
	
}else{

	// array retorno
	$array_retorno["dados"] = mensagem_erro($idioma_sistema[7]);
	
	// retorno
	return json_encode($array_retorno);
	
};

};

?>