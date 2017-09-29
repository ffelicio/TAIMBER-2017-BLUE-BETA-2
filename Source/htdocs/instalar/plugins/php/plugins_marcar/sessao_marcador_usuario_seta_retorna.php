<?php

// seta ou retorna sessao marcador de usuario
function sessao_marcador_usuario_seta_retorna($id, $tabela, $chave, $uidamigo, $modo){

// valida o modo
switch($modo){
	
	case 1: // atualiza
	$_SESSION[SESSAO_MARCADOR_USUARIO][$chave][$uidamigo] = $uidamigo;
	$_SESSION[SESSAO_MARCADOR_USUARIO_REFERENCIA][$chave][$uidamigo][0] = $id;
	$_SESSION[SESSAO_MARCADOR_USUARIO_REFERENCIA][$chave][$uidamigo][1] = $tabela;
	break;
	
	case 2: // limpa
	unset($_SESSION[SESSAO_MARCADOR_USUARIO][$chave][$uidamigo]);
	unset($_SESSION[SESSAO_MARCADOR_USUARIO_REFERENCIA][$chave][$uidamigo][0]);
	unset($_SESSION[SESSAO_MARCADOR_USUARIO_REFERENCIA][$chave][$uidamigo][1]);
	break;
	
	case 3: // retorna uidamigo marcado
	if($_SESSION[SESSAO_MARCADOR_USUARIO][$chave][$uidamigo] != null){
		
		// ha uidamigo marcado
		return true;
		
	}else{
		
		// nao ha uidamigo marcado
		return false;
		
	};
	break;
	
	case 4: // retorna o uidamigo de sessao
	return $_SESSION[SESSAO_MARCADOR_USUARIO][$chave][$uidamigo];
	break;
	
	case 5: // retorna todos os uidamigo de sessao
	return $_SESSION[SESSAO_MARCADOR_USUARIO][$chave];
	break;
	
	case 6: // limpa todos os uidamigo de sessao
	unset($_SESSION[SESSAO_MARCADOR_USUARIO][$chave]);
	unset($_SESSION[SESSAO_MARCADOR_USUARIO_REFERENCIA][$chave]);
	break;
	
};

// retorno
return null;

};

?>