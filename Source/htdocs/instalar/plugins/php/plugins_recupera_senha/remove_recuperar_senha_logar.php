<?php

// remove o recuperador de senha ao logar
function remove_recuperar_senha_logar(){

// globals
global $tabela_banco;

// tabela
$tabela = $tabela_banco[31];

// data de hoje
$data_hoje = retorne_data_dia_mes_ano();

// email do usuario logado
$email = retorna_email_usuario_logado();

// query
$query = "select *from $tabela where email='$email';";

// dados de query
$dados_query = plugin_executa_query($query);

// separa os dados
$dados = $dados_query["dados"][0];

// separando os dados
$data = $dados[DATA];

// valida as datas
if($data != $data_hoje){
	
	// query
	$query = "delete from $tabela where email='$email';";
	
	// removendo registro
	plugin_executa_query($query);

};

};

?>