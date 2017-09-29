<?php

// retorna se o conteudo da pagina pode ser exibido
function retorne_conteudo_pagina_pode_exibir(){

// valida fazer logout
if(retorne_campo_formulario_request(2) == 1){
	
	// retorno pode exibir conteudo
	return true;
	
};

// valida se a pagina existe
if(retorne_idpagina_request() != null and retorne_pagina_existe(retorne_idpagina_request()) == false){
	
	// nao pode exibir o conteudo
	return false;
	
};

// valida usuario logado
if(retorne_usuario_logado() == false){

    // pode exibir conteudo
	return true;
	
};

// valida perfil de usuario existe
if(retorna_perfil_usuario_existe(true, retorne_idusuario_request()) == false){

    // nao pode exibir conteudo
    return false;	
	
};

// valida usuario bloqueado
if(retorne_usuario_bloqueio(retorne_idusuario_request()) == true){
	
	// nao pode exibir conteudo
	return false;
	
}else{
	
	// pode exibir conteudo
	return true;
	
};

// retorno
return true;

};

?>