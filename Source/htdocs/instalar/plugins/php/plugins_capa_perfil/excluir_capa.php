<?php

// exclui capa
function excluir_capa(){

// globals
global $tabela_banco;

// id de pagina
$pagina = retorne_idpagina_request();

// id de usuario logado
$uid = retorne_idusuario_logado();

// valida pagina
if($pagina != null){
	
	// valida usuario logado dono de pagina
	if(retorne_usuario_logado_dono_pagina($pagina) == false){
		
		// retorno nulo
		return null;
		
	};

	// tabela
	$tabela[0] = $tabela_banco[21];
	$tabela[1] = $tabela_banco[5];	
	
	// exclui e recria pastas
	excluir_pastas_subpastas(retorne_pasta_usuario($uid, 10, true), true);

	// query
	$query[0] = "delete from $tabela[0] where id='$pagina';";
	$query[1] = "delete from $tabela[1] where uid='$uid' and pagina='$pagina' and modo='2';";

}else{
	
	// tabela
	$tabela[0] = $tabela_banco[3];
	$tabela[1] = $tabela_banco[5];	
	
	// exclui e recria pastas
	excluir_pastas_subpastas(retorne_pasta_usuario($uid, 8, true), true);

	// query
	$query[0] = "delete from $tabela[0] where uid='$uid';";
	$query[1] = "delete from $tabela[1] where uid='$uid' and modo='2';";

};

// executando query
plugin_executa_query($query[0]);
plugin_executa_query($query[1]);

};

?>