<?php

// logar usuario
function logar_usuario($email, $senha, $modo_json){

// globals
global $idioma_sistema;
global $tabela_banco;

// email e senha de parametros da funcao
$email_parametro = $email;
$senha_parametro = $senha;

// valida senha e email
if($email_parametro == null or $senha_parametro == null){
	
	// dados do formulario
	$email = converte_minusculo(retorne_campo_formulario_request(0));
	$senha = converte_minusculo(retorne_campo_formulario_request(1));

}else{
	
	// define email e senha
	$email = $email_parametro;
	$senha = $senha_parametro;
	
};

// uid de usuario baseado em nome amigavel
$uid = retorne_idusuario_amigavel($email, 0, null);

// valia email
if(verifica_se_email_valido($email) == false and $uid == null){
	
	// array retorno
	$array_retorno["dados"] = mensagem_erro($idioma_sistema[8]);
	
	// valida modo json
	if($modo_json == true){
		
		// retorno
		return json_encode($array_retorno);
		
	}else{
		
		// retorno
		return false;
		
	};
	
};

// valida modo json
if($modo_json == true){
	
	// cifra a senha
	$senha = codifica_md5($senha);

};

// valida uid
if($uid == null){
	
	// query
	$query = "select *from $tabela_banco[0] where e_mail='$email' and senha='$senha';";

}else{
	
	// query
	$query = "select *from $tabela_banco[0] where uid='$uid' and senha='$senha';";
	
};

// array de dados
$array_dados = plugin_executa_query($query);

// dados do comando
$dados = retorne_dados_comando($array_dados["comando"]);

// id de usuario
$idusuario = $array_dados["dados"][0][UID];

// numero de linhas
$linhas = $array_dados["linhas"];

// valida numero de linhas
if($linhas == 0){
    
	// array retorno
	$array_retorno["dados"] = mensagem_erro($idioma_sistema[6]);
	
	// valida modo json
	if($modo_json == true){
		
		// retorno
		return json_encode($array_retorno);
		
	}else{
		
		// retorno
		return false;
		
	};
	
};

// se chegou ate aqui e por que o usuario existe
salva_sessao_usuario($email, $senha, $idusuario);

// salva todos os dados do usuario na sessao
atualiza_retorna_dados_usuario_sessao(true, true);

// remove o recuperador de senha ao logar
remove_recuperar_senha_logar();

// aplica o odioma do usuario
aplica_idioma_usuario();

// erradica as recomendacoes
erradicar_recomendacoes();

// array retorno
$array_retorno["dados"] = -1;

// valida o modo json
if($modo_json == true){
	
	// retorno
	return json_encode($array_retorno);

}else{
	
	// retorno
	return true;
	
};

};

?>