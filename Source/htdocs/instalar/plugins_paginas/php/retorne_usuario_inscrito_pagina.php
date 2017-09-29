<?php

// retorna se o usuario e inscrito da pagina
function retorne_usuario_inscrito_pagina($uid, $pagina){

// globals 
global $tabela_banco;

// tabela
$tabela = $tabela_banco[22];

// query
$query = "select *from $tabela where pagina='$pagina' and uidamigo='$uid';";

// dados de query
$dados_query = plugin_executa_query($query);

// valida o numero de linhas
if($dados_query["linhas"] == 1){
	
	// usuario inscrito
	return true;
	
}else{
	
	// usuario nao inscrito
	return false;

};

};

?>