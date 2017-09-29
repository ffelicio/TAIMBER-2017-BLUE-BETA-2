<?php

// adiciona visualizado em publicações, comentários etc
function adiciona_visualizado($id, $tabela_campo){

// globals
global $tabela_banco;

// valida id e tabela de banco de dados
if($id == null or $tabela_banco == null){
	
	// retorno nulo
	return null;
	
};

// data atual
$data = data_atual();

// tabela
$tabela = $tabela_banco[40];

// id de usuário logado
$uid = retorne_idusuario_logado();

// querys
$query[0] = "select id from $tabela_campo;";
$query[1] = "select id from $tabela where id_post='$id' and uid='$uid';";
$query[2] = "insert into $tabela values(null, '$uid', '$id', '$tabela_campo', '$data');";

// valida o número de linhas, ou seja, se o id existe na tabela informada
if(retorne_numero_linhas_query($query[0]) == 0){
	
	// retorno nulo
	return null;
	
};

// valida o número de linhas, ou seja, se o id existe na tabela informada
if(retorne_numero_linhas_query($query[1]) != 0){
	
	// retorno nulo
	return null;
	
};

// adiciona visualizado
plugin_executa_query($query[2]);

};

?>