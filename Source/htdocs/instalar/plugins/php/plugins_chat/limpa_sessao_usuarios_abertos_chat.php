<?php

// limpa a sessao de usuarios abertos de chat
function limpa_sessao_usuarios_abertos_chat($uid){

// valida uid
if($uid == null){
	
	// limpa a sessao
	$_SESSION[SESSAO_USUARIOS_ABERTOS_CHAT] = null;

}else{
	
	// limpa a sessao
	$_SESSION[SESSAO_USUARIOS_ABERTOS_CHAT][$uid] = null;
	
};

};

?>