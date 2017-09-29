<?php

// reseta os amigos do mensageiro
function resetar_amigos_mensageiro(){

// valida chave
if(retorna_chave_request() != null){
	
	// limpando sessao
	$_SESSION[SESSAO_UIDAMIGO_TEMP_MENSAGEIRO] = null;

};

};

?>