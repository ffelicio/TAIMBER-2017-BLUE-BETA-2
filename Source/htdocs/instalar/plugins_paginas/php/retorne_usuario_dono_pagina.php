<?php

// retorna se o usuario e o dono da pagina
function retorne_usuario_dono_pagina($uid, $id){

// globals
global $tabela_banco;

// valida usuario logado
if(retorne_usuario_logado() == false){
	
	// retorno falso
	return false;
	
};

// query
$query = "select *from $tabela_banco[18] where id='$id' and uid='$uid';";

// dados de query
$dados_query = plugin_executa_query($query);

// valida o numero de linhas
if($dados_query["linhas"] == 1){
	
	// dono da pagina
	return true;
	
}else{
	
	// nao e o dono da pagina
	return false;
	
};

};

?>