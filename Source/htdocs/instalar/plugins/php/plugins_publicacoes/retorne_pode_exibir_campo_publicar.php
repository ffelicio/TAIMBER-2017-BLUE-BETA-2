<?php

// retorna se pode exibir o campo de publicação
function retorne_pode_exibir_campo_publicar(){

// pagina
$pagina = retorne_idpagina_request();

// valida usuario logado
if(retorne_usuario_logado() == false){
	
    // retorno
	return false;
	
};

// valida pode exibir campo de publicar na pagina
if($pagina != null and retorne_usuario_dono_pagina(retorne_idusuario_logado(), $pagina) == false){
	
    // retorno
	return false;
	
};

// valida usuario dono do perfil
if($pagina == null and retorne_usuario_dono_perfil(retorne_idusuario_request()) == false){

    // retorno
	return false;

};

// retorno
return true;

};

?>