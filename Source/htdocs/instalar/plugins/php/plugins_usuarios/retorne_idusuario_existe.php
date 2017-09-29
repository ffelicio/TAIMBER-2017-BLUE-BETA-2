<?php

// retorna de o id de usuario existe
function retorne_idusuario_existe($uid){

// globals
global $tabela_banco;

// tabela
$tabela = $tabela_banco[0];

// query
$query = "select *from $tabela where uid='$uid';";

// dados de query
$dados_query = plugin_executa_query($query);

// valida numero de linhas
if($dados_query["linhas"] == 0){
	
	// nao existe!
	return false;
	
}else{
	
	// existe
	return true;
	
};

};

?>