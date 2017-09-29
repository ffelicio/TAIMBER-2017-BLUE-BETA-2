<?php

// retorna se um perfil é privado
function retorne_perfil_privado($uid){

// valida uid
if($uid == null){
	
	// valida o modo pagina
	if(retorne_modo_pagina() == true){
		
		// nao ha este tipo de privacidade na página!
		return false;
		
	}else{
		
		// pega o uid de usuario via requeste
		$uid = retorne_idusuario_request();

	};
	
};

// valida uid
if($uid == null){
	
	// retorno
	return false;
	
};

// retorno
return retorna_configuracao_privacidade(1, $uid) == true;

};

?>