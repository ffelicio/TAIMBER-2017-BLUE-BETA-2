<?php

// retorna se está usando capa ou não
function retorne_usa_capa(){

// globals
global $tabela_banco;

// valida o modo página
if(retorne_modo_pagina() == true){

	// id de usuário logado
	$uid = retorne_idusuario_logado();
	
	// id de página via request
	$pagina = retorne_idpagina_request();
	
	// valida usuário dono da página
	if(retorne_usuario_dono_pagina($uid, $pagina) == true){
		
		// retorno
		return true;
		
	};
	
	// tabela de imagem de capa de página
	$tabela = $tabela_banco[21];
	
	// query
	$query = "select url_host_grande from $tabela where id='$pagina';";

}else{
	
	// id de usuário via request
	$uid = retorne_idusuario_request();
	
	// valida usuário dono do perfil
	if(retorne_usuario_dono_perfil($uid) == true){
		
		// retorno
		return true;
		
	};
	
	// tabela de image de capa de usuário
	$tabela = $tabela_banco[3];

	// query
	$query = "select url_host_grande from $tabela where uid='$uid';";

};

// dados de query
$dados = retorne_dados_query($query);

// retorno
return $dados[URL_HOST_GRANDE] != null;

};

?>