<?php

// atualiza a sessao com usuarios abertos em chat
function atualiza_sessao_usuarios_abertos_chat($uid, $modo){

// modo 1 adiciona
// modo 2 remove
// modo 3 retorna todos
// modo 4 remove todos

switch($modo){
	
    case 1:
	$_SESSION[SESSAO_USUARIOS_ABERTOS_CHAT][$uid] = $uid;
    break;
	
	case 2:
	unset($_SESSION[SESSAO_USUARIOS_ABERTOS_CHAT][$uid]);
	break;
	
	case 3:
	return $_SESSION[SESSAO_USUARIOS_ABERTOS_CHAT];
	break;
	
	case 4:
	unset($_SESSION[SESSAO_USUARIOS_ABERTOS_CHAT]);
	break;
	
};

};

?>