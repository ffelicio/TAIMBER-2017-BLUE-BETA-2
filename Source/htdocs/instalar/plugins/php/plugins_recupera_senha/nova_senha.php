<?php

// define nova senha
function nova_senha(){

// globals
global $idioma_sistema;
global $tabela_banco;

// chave
$chave_requeste = retorna_chave_request();

// dados de formulario
$nova_senha = converte_minusculo(retorne_campo_formulario_request(16));
$nova_senha_confirma = converte_minusculo(retorne_campo_formulario_request(17));

// dados
$dados = retorne_dados_chave($chave_requeste, $tabela_banco[31]);

// separa os dados
$email = $dados[EMAIL];

// data
$data = data_atual();

// valida nova senha igual
if($nova_senha != $nova_senha_confirma){
	
	// dados de retorno
	$array_retorno["dados"] = mensagem_erro($idioma_sistema[450]);
	
	// retorno
	return json_encode($array_retorno);
	
};

// valida tamanho da nova senha
if(strlen($nova_senha) < TAMANHO_MINIMO_SENHA or strlen($nova_senha_confirma) < TAMANHO_MINIMO_SENHA){
	
	// dados de retorno
	$array_retorno["dados"] = mensagem_erro($idioma_sistema[451].TAMANHO_MINIMO_SENHA.$idioma_sistema[142]);
	
	// retorno
	return json_encode($array_retorno);
	
};

// cifra a senha
$nova_senha = codifica_md5($nova_senha);

// id de usuario
$idusuario = retorne_idusuario_email($email);

// query
$query[0] = "update $tabela_banco[0] set senha='$nova_senha', data='$data' where uid='$idusuario' and e_mail='$email';";
$query[1] = "delete from $tabela_banco[31] where email='$email';";

// atualiza a senha
plugin_roda_query($query[0]);
plugin_roda_query($query[1]);

// dados de retorno
$array_retorno["dados"] = 1;

// se chegou ate aqui e por que o usuario existe
salva_sessao_usuario($email, $nova_senha, $idusuario);

// retorno
return json_encode($array_retorno);

};

?>