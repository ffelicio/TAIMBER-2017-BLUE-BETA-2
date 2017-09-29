<?php

// retorna se a pagina existe
function retorne_pagina_existe($pagina){

// globals
global $tabela_banco;

// valida pagina
if($pagina == null){
	
	// pagina nao existe
	return false;
	
};

// query
$query = "select *from $tabela_banco[18] where id='$pagina';";

// dados de query
$dados_query = plugin_executa_query($query);

// valida o numero de linhas e retorna
if($dados_query["linhas"] == 0){
	
	// pagina nao existe
	return false;
	
}else{
	
	// pagina existe
	return true;

};

};

?>