<?php

// retorna se pode alterar o email
function retorne_pode_alterar_email(){

// globals
global $tabela_banco;

// tabela
$tabela = $tabela_banco[32];

// id de usuario logado
$uid = retorne_idusuario_logado();

// data de hoje
$data_hoje = retorne_data_dia_mes_ano();

// query
$query = "select *from $tabela where uid='$uid';";

// dados de query
$dados_query = plugin_executa_query($query);

// separa os dados
$dados = $dados_query["dados"][0];

// separando os dados
$tentativas = $dados[TENTATIVAS];
$data = $dados[DATA];

// valida numero de tentativas
if($tentativas > NUMERO_ALTERAR_EMAIL_DIA and $data == $data_hoje){
	
	// retorno
	return false;

}else{
	
	// retorno
	return true;
	
};

};

?>