<?php

// retorna o id de janela de usuarios de chat abertos
function retorne_id_janela_usuarios_abertos_chat($modo){

// retorno
switch($modo){
	
	case 0:
	// principal
	return codifica_md5("janela_usuarios_abertos_chat_".retorne_idusuario_logado());
	break;
	
    case 1:
    // lista com usuarios abertos	
    return codifica_md5("lista_usuarios_abertos_chat_".retorne_idusuario_logado());
    break;
	
};

};

?>